<?php
namespace App\Http\Controllers;

use App\Student;
use App\Http\Requests\StudentRequest;
use Yajra\Datatables\Datatables;

class InstructorStudentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('instructor');
    }

    /**
     *********************************************************************************************************************
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
       
        return view('students.instructor-index', ['students' => $students]);
    }

    /**
     *********************************************************************************************************************
     * Display a listing of the resource for Datatable.
     *
     */
    public function getAllData()
    {
        $students = Student::all();

        // Create 'name' for each student.
        foreach ($students as $student) {
            $student['name'] = $student->initials . ' ' .  $student->f_name . ' ' . $student->l_name; 
        }

        return Datatables::of($students)->make(true);
    }

    /**
     *********************************************************************************************************************
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     *********************************************************************************************************************
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StudentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        //
    }

    /**
     *********************************************************************************************************************
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //return Response::json($student); 
    }

    /**
     *********************************************************************************************************************
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //return Response::json($student);
    }

    /**
     *********************************************************************************************************************
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\StudentRequest $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, Student $student)
    {
        //
    }

    /**
     *********************************************************************************************************************
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
       //
    }
}
