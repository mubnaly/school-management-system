<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function UserView()
    {
        $allData = User::all();
        // $data['allData'] = User::where('role', 'admin')->get();
        $data['allData'] = User::all();
        return view('backend.user.view_user', $data);
    }


    public function UserAdd()
    {
        return view('backend.user.add_user');
    }

    public function UserStore(Request $request)
    {

        $validatedData = $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required',
            'role' => 'required', // added
            'mobile' => 'required', // added
            'gender' => 'required|in:male,female', // Add gender validation
            'password' => 'required|min:6', // Add password validation
        ]);

        $data = new User();
        $random = "0JAK2LBM3NCO4PDQ5RES6TFU7VGW8XHY9ZI";
        $code = substr(str_shuffle($random), 0, 8);

        // Generate username from email (remove @gmail.com and other common domains)
        $username = $this->generateUniqueUsername($request->email);

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

        $data->save();

        $notification = array(
            'message' => 'Users Successfully Added!',
            'alert-type' => 'success'
        );

        return redirect()->route('user.view')->with($notification);
    }

    public function UserEdit($id)
    {
        $editData = User::find($id);
        return view('backend.user.edit_user', compact('editData'));
    }

    // public function UserUpdate(Request $request, $id)
    // {
    //     $data = User::find($id);
    //     $data->name = $request->name;
    //     $data->email = $request->email;
    //     $data->role = $request->role;
    //     $data->save();

    //     $notification = array(
    //         'message' => 'The user was successfully converted!',
    //         'alert-type' => 'success'
    //     );

    //     return redirect()->route('user.view')->with($notification);
    // }


    public function UserUpdate(Request $request, $id)
{
    $data = User::find($id);

    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $id,
        'role' => 'required',
        'mobile' => 'required',
        'gender' => 'required|in:male,female',
    ]);

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

    if ($request->password) {
        $data->password = bcrypt($request->password);
    }

    $data->save();

    $notification = array(
        'message' => 'User updated successfully!',
        'alert-type' => 'success'
    );

    return redirect()->route('user.view')->with($notification);
}

    public function UserDelete($id)
    {
        $user = User::find($id);
        $user->delete();

        $notification = array(
            'message' => 'The user was successfully removed!',
            'alert-type' => 'success'
        );

        return redirect()->route('user.view')->with($notification);
    }


    // Add this to ensure unique usernames
    private function generateUniqueUsername($email)
{
    $baseUsername = strtolower(explode('@', $email)[0]);
    $baseUsername = preg_replace('/[^a-z0-9]/', '', $baseUsername);

    $username = $baseUsername;
    $counter = 1;

    // Check if username already exists, if so, append numbers
    while (User::where('user_name', $username)->exists()) {
        $username = $baseUsername . $counter;
        $counter++;
    }

    return $username;
}
}
