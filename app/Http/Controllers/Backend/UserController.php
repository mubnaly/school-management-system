<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function UserView()
    {
        try {
            // Optimized query - only select needed fields
            $data['allData'] = User::select('id', 'name', 'email', 'mobile', 'role', 'status', 'code')
                ->orderBy('created_at', 'desc')
                ->get();

            return view('backend.user.view_user', $data);
        } catch (Exception $e) {
            Log::error('Error viewing users: ' . $e->getMessage());
            return redirect()->route('dashboard')->with([
                'message' => 'Error loading users. Please try again.',
                'alert-type' => 'error'
            ]);
        }
    }

    public function UserAdd()
    {
        return view('backend.user.add_user');
    }

    public function UserStore(Request $request)
    {
        try {
            // Enhanced validation
            $validatedData = $request->validate([
                'email' => 'required|email|unique:users,email|max:255',
                'name' => 'required|string|max:255',
                'role' => 'required|in:admin,instructor,student',
                'mobile' => 'required|string|max:20|unique:users,mobile',
                'gender' => 'required|in:male,female',
                'password' => 'required|string|min:6',
                'address' => 'nullable|string|max:500',
                'religion' => 'nullable|in:muslim,christian',
                'notes' => 'nullable|string|max:1000',
            ], [
                'email.unique' => 'This email is already registered in the system.',
                'mobile.unique' => 'This mobile number is already registered.',
                'password.min' => 'Password must be at least 6 characters.',
            ]);

            DB::beginTransaction();

            // Generate unique username
            $username = $this->generateUniqueUsername($request->email);

            // Generate unique code
            $code = $this->generateUniqueCode();

            $data = new User();
            $data->role = $request->role;
            $data->name = $request->name;
            $data->email = $request->email;
            $data->password = bcrypt($request->password);
            $data->user_name = $username;
            $data->mobile = $request->mobile;
            $data->gender = $request->gender;
            $data->religion = $request->religion ?? 'muslim';
            $data->code = $code;
            $data->status = 1;
            $data->address = $request->address;
            $data->notes = $request->notes;

            $data->save();

            DB::commit();

            $notification = [
                'message' => 'User successfully added!',
                'alert-type' => 'success'
            ];

            return redirect()->route('user.view')->with($notification);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation errors - show them to user
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error creating user: ' . $e->getMessage());

            $notification = [
                'message' => 'Error creating user. Please check if email/mobile already exists.',
                'alert-type' => 'error'
            ];

            return redirect()->back()
                ->withInput()
                ->with($notification);
        }
    }

    public function UserEdit($id)
    {
        try {
            $editData = User::findOrFail($id);
            return view('backend.user.edit_user', compact('editData'));
        } catch (Exception $e) {
            Log::error('Error loading user for edit: ' . $e->getMessage());
            return redirect()->route('user.view')->with([
                'message' => 'User not found.',
                'alert-type' => 'error'
            ]);
        }
    }

    public function UserUpdate(Request $request, $id)
    {
        try {
            $data = User::findOrFail($id);

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $id,
                'role' => 'required|in:admin,instructor,student',
                'mobile' => 'required|string|max:20|unique:users,mobile,' . $id,
                'gender' => 'required|in:male,female',
                'password' => 'nullable|string|min:6',
                'address' => 'nullable|string|max:500',
                'religion' => 'nullable|in:muslim,christian',
                'notes' => 'nullable|string|max:1000',
            ], [
                'email.unique' => 'This email is already registered.',
                'mobile.unique' => 'This mobile number is already registered.',
            ]);

            DB::beginTransaction();

            $data->name = $request->name;
            $data->email = $request->email;
            $data->role = $request->role;
            $data->mobile = $request->mobile;
            $data->gender = $request->gender;
            $data->address = $request->address;
            $data->notes = $request->notes;
            $data->religion = $request->religion ?? 'muslim';
            $data->birth = $request->birth;
            $data->id_no = $request->id_no;
            $data->father = $request->father;
            $data->mother = $request->mother;
            $data->join_date = $request->join_date;
            $data->designation_id = $request->designation_id;
            $data->status = $request->status ?? 1;

            if ($request->filled('password')) {
                $data->password = bcrypt($request->password);
            }

            $data->save();

            DB::commit();

            $notification = [
                'message' => 'User updated successfully!',
                'alert-type' => 'success'
            ];

            return redirect()->route('user.view')->with($notification);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error updating user: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with([
                    'message' => 'Error updating user. Please try again.',
                    'alert-type' => 'error'
                ]);
        }
    }

    public function UserDelete($id)
    {
        try {
            DB::beginTransaction();

            $user = User::findOrFail($id);

            // Prevent deleting yourself
            if ($user->id === auth()->id()) {
                return redirect()->route('user.view')->with([
                    'message' => 'You cannot delete your own account!',
                    'alert-type' => 'warning'
                ]);
            }

            $user->delete();

            DB::commit();

            $notification = [
                'message' => 'User deleted successfully!',
                'alert-type' => 'success'
            ];

            return redirect()->route('user.view')->with($notification);

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error deleting user: ' . $e->getMessage());

            return redirect()->route('user.view')->with([
                'message' => 'Error deleting user. User may have related data.',
                'alert-type' => 'error'
            ]);
        }
    }

    /**
     * Generate unique username from email
     */
    private function generateUniqueUsername($email)
    {
        $baseUsername = strtolower(explode('@', $email)[0]);
        $baseUsername = preg_replace('/[^a-z0-9]/', '', $baseUsername);

        $username = $baseUsername;
        $counter = 1;

        while (User::where('user_name', $username)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }

        return $username;
    }

    /**
     * Generate unique code
     */
    private function generateUniqueCode()
    {
        do {
            $code = strtoupper(substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 8));
        } while (User::where('code', $code)->exists());

        return $code;
    }
}
