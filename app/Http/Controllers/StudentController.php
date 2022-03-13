<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Group;
use Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return view('student.index', ['students' => $students]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Group::all();
        return view('student.create', ['groups' => $groups]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        $request->student_name =  ucwords(strtolower($request->student_name));
        $request->student_surname =  ucwords(strtolower($request->student_surname));
       
        $validator = Validator::make($request->all(),
            [
                'student_name' => ['required', 'min:2', 'max:30'],
                'student_surname' => ['required', 'min:2', 'max:30'],
            ],
            [
                'student_name.required' => 'Student Name required',
                'student_name.min' => 'Student Name is to short',
                'student_name.max' => 'Student Name is to long',

                'student_surname.required' => 'Student Surname required',
                'student_surname.min' => 'Student Surname is to short',
                'student_surname.max' => 'Student Surname is to long',


            ]
        );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }

        $student = new Student;
        $student->student_name = $request->student_name;
        $student->student_surname = $request->student_surname;
        $student->group_id = $request->group_id;
        $student->save();
        return redirect()->route('student.index')->with('success_message', 'Successfully stored');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $groups = Group::all();
        return view('student.edit', ['student' => $student, 'groups' => $groups]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $request->student_name =  ucwords(strtolower($request->student_name));
        $request->student_surname =  ucwords(strtolower($request->student_surname));
       
        $validator = Validator::make($request->all(),
            [
                'student_name' => ['required', 'min:2', 'max:30'],
                'student_surname' => ['required', 'min:2', 'max:30'],
            ],
            [
                'student_name.required' => 'Student Name required',
                'student_name.min' => 'Student Name is to short',
                'student_name.max' => 'Student Name is to long',

                'student_surname.required' => 'Student Surname required',
                'student_surname.min' => 'Student Surname is to short',
                'student_surname.max' => 'Student Surname is to long',
]
        );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }

        $student->student_name = $request->student_name;
        $student->student_surname = $request->student_surname;
        $student->group_id = $request->group_id;
        $student->save();
        return redirect()->route('student.index')->with('success_message', 'Successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('student.index')->with('success_message', 'Successfully deleted');

    }
}
