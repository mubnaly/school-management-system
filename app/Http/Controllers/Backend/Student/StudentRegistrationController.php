<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use App\Models\StudentYear;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use PDF;

class StudentRegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function StudentRegistrationView()
    {
        // Cache dropdown data for 1 hour
        $years = Cache::remember('student_years', 3600, function () {
            return StudentYear::select('id', 'name')->get();
        });

        $classes = Cache::remember('student_classes', 3600, function () {
            return StudentClass::select('id', 'name')->get();
        });

        $latestYear = $years->first();
        $data['year_id'] = $latestYear ? $latestYear->id : null;

        $latestClass = $classes->first();
        $data['class_id'] = $latestClass ? $latestClass->id : null;

        // Eager load ALL relationships in one query
        $data['allData'] = AssignStudent::with([
            'student:id,name,id_no,image,code',
            'student_year:id,name',
            'student_class:id,name'
        ])
        ->where('year_id', $data['year_id'])
        ->where('class_id', $data['class_id'])
        ->select('id', 'student_id', 'roll', 'year_id', 'class_id')
        ->get();

        $data['years'] = $years;
        $data['classes'] = $classes;

        return view('backend.student.student_registration.student_view', $data);
    }

    public function StudentClassYearWise(Request $request)
    {
        $years = Cache::remember('student_years', 3600, function () {
            return StudentYear::select('id', 'name')->get();
        });

        $classes = Cache::remember('student_classes', 3600, function () {
            return StudentClass::select('id', 'name')->get();
        });

        $data['years'] = $years;
        $data['classes'] = $classes;
        $data['year_id'] = $request->year_id;
        $data['class_id'] = $request->class_id;

        // Optimized query with selective fields
        $data['allData'] = AssignStudent::with([
            'student:id,name,id_no,image,code',
            'student_year:id,name',
            'student_class:id,name'
        ])
        ->where('year_id', $request->year_id)
        ->where('class_id', $request->class_id)
        ->select('id', 'student_id', 'roll', 'year_id', 'class_id')
        ->get();

        return view('backend.student.student_registration.student_view', $data);
    }

    public function StudentRegistrationAdd()
    {
        // Cache all dropdown data
        $data['years'] = Cache::remember('student_years', 3600, fn() => StudentYear::select('id', 'name')->get());
        $data['classes'] = Cache::remember('student_classes', 3600, fn() => StudentClass::select('id', 'name')->get());
        $data['groups'] = Cache::remember('student_groups', 3600, fn() => StudentGroup::select('id', 'name')->get());
        $data['shifts'] = Cache::remember('student_shifts', 3600, fn() => StudentShift::select('id', 'name')->get());

        return view('backend.student.student_registration.student_add', $data);
    }

    public function StudentRegistrationStore(Request $request)
    {
        DB::transaction(function () use ($request) {
            $checkYear = StudentYear::select('name')->find($request->year_id)->name;

            // Optimized query - only get max ID
            $lastStudent = User::where('role', 'student')
                ->selectRaw('MAX(id) as max_id')
                ->value('max_id');

            $studentId = ($lastStudent ?? 0) + 1;
            $id_no = $checkYear . str_pad($studentId, 4, '0', STR_PAD_LEFT);

            $user = new User();
            $user->id_no = $id_no;
            $user->password = bcrypt(rand(1000, 9999));
            $user->role = 'student';
            $user->code = rand(1000, 9999);
            $user->name = $request->name;
            $user->father = $request->father;
            $user->mother = $request->mother;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->birth = $request->birth;

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('upload/student_images'), $filename);
                $user->image = $filename;
            }

            $user->save();

            $assign_student = new AssignStudent();
            $assign_student->student_id = $user->id;
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            $discount_student = new DiscountStudent();
            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->fee_category_id = 1;
            $discount_student->discount = $request->discount ?? 0;
            $discount_student->save();

            // Clear cache after adding student
            Cache::forget('student_count');
        });

        $notification = [
            'message' => 'Student successfully registered!',
            'alert-type' => 'success',
        ];

        return redirect()->route('student.registration.view')->with($notification);
    }

    public function StudentRegistrationEdit($student_id)
    {
        $data['years'] = Cache::remember('student_years', 3600, fn() => StudentYear::select('id', 'name')->get());
        $data['classes'] = Cache::remember('student_classes', 3600, fn() => StudentClass::select('id', 'name')->get());
        $data['groups'] = Cache::remember('student_groups', 3600, fn() => StudentGroup::select('id', 'name')->get());
        $data['shifts'] = Cache::remember('student_shifts', 3600, fn() => StudentShift::select('id', 'name')->get());

        $data['editData'] = AssignStudent::with(['student', 'discount'])
            ->where('student_id', $student_id)
            ->first();

        return view('backend.student.student_registration.student_edit', $data);
    }

    public function StudentRegistrationUpdate(Request $request, $student_id)
    {
        DB::transaction(function () use ($request, $student_id) {
            $user = User::findOrFail($student_id);
            $user->fill([
                'name' => $request->name,
                'father' => $request->father,
                'mother' => $request->mother,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'gender' => $request->gender,
                'religion' => $request->religion,
                'birth' => $request->birth,
            ]);

            if ($request->hasFile('image')) {
                if ($user->image) {
                    @unlink(public_path('upload/student_images/' . $user->image));
                }
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('upload/student_images'), $filename);
                $user->image = $filename;
            }

            $user->save();

            AssignStudent::where('id', $request->id)
                ->where('student_id', $student_id)
                ->update([
                    'year_id' => $request->year_id,
                    'class_id' => $request->class_id,
                    'group_id' => $request->group_id,
                    'shift_id' => $request->shift_id,
                ]);

            DiscountStudent::where('assign_student_id', $request->id)
                ->update(['discount' => $request->discount ?? 0]);
        });

        return redirect()->route('student.registration.view')->with([
            'message' => 'Student data updated successfully!',
            'alert-type' => 'success',
        ]);
    }

    public function StudentRegistrationPromotion($student_id)
    {
        $data['years'] = Cache::remember('student_years', 3600, fn() => StudentYear::select('id', 'name')->get());
        $data['classes'] = Cache::remember('student_classes', 3600, fn() => StudentClass::select('id', 'name')->get());
        $data['groups'] = Cache::remember('student_groups', 3600, fn() => StudentGroup::select('id', 'name')->get());
        $data['shifts'] = Cache::remember('student_shifts', 3600, fn() => StudentShift::select('id', 'name')->get());

        $data['editData'] = AssignStudent::with(['student', 'discount'])
            ->where('student_id', $student_id)
            ->first();

        return view('backend.student.student_registration.student_promotion', $data);
    }

    public function StudentUpdatePromotion(Request $request, $student_id)
    {
        DB::transaction(function () use ($request, $student_id) {
            $assign_student = AssignStudent::create([
                'student_id' => $student_id,
                'year_id' => $request->year_id,
                'class_id' => $request->class_id,
                'group_id' => $request->group_id,
                'shift_id' => $request->shift_id,
            ]);

            DiscountStudent::create([
                'assign_student_id' => $assign_student->id,
                'fee_category_id' => 1,
                'discount' => $request->discount ?? 0,
            ]);
        });

        return redirect()->route('student.registration.view')->with([
            'message' => 'Student promoted successfully!',
            'alert-type' => 'success',
        ]);
    }

    public function StudentRegistrationDetails($student_id)
    {
        $data['details'] = AssignStudent::with([
            'student',
            'discount',
            'student_class',
            'student_year',
            'group',
            'shift'
        ])
        ->where('student_id', $student_id)
        ->firstOrFail();

        $pdf = PDF::loadView('backend.student.student_registration.student_details_pdf', $data);

        return $pdf->download($data['details']->student->id_no . '_' . $data['details']->student->name . '.pdf');
    }
}
