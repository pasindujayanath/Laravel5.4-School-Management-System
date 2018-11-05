<?php
namespace App\Http\Controllers;

use App\Student;
use App\Http\Requests\StudentRequest;
use App\User;
use Hash;
use Response;
use Yajra\Datatables\Datatables;

class AdminStudentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin', ['only' => 'index', 'store', 'show', 'edit', 'destroy', 'generateStudentId']);
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
       
        return view('students.admin-index', ['students' => $students]);
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
        // generate a new student id.
        $new_student_id = $this->generateStudentId();
        $request_data = $request->all();
        $request_data['stu_id'] = $new_student_id; // assign new new student id into array.

        $user_type = 'stu';
        $student_default_password = 'Student@123';
        // assign date which pass into table:'users'.
        $user_data = [
            'type' => $user_type,
            'name' => $request->f_name . ' ' . $request->l_name,
            'email' => $request->email,
            'password' => Hash::make($student_default_password)
        ];    

        $result_student = Student::create($request_data);   // pass data into table:'students' and get the result. 
        $result_user = User::create($user_data);            // pass data into table:'users' and get the result.

        if ($result_student && $result_user) { // only if above queries are executed succefully:
            $response = [
                'success' => true,
                'msg' => 'Student is successfully created!'     
            ];            
        } else {
            $response = [
                'success' => false,
                'msg' => 'Student could not be created!'     
            ];
        }
        return Response::json($response);
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
        $subjects = $student->subjects()->get();

        return Response::json($student); 
    }

    /**
     *********************************************************************************************************************
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function showSubjects(Student $student)
    {
        $subjects = $student->subjects()->get();

        return Response::json($subjects); 
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
        // assign date which pass into table:'users'.
        $user_name = $request->f_name . ' ' . $request->l_name;

        $result_student = $student->update($request->all());    // pass updated data into table:'students' and get the result.
        $result_user = User::where('email', $request->email)->update(['name' => $user_name]); // pass updated data into table:'users' and get the result.

        if ($result_student && $result_user) {
            $response = [
                'success' => true,
                'msg' => 'Student is successfully updated!'     
            ];            
        } else {
            $response = [
                'success' => false,
                'msg' => 'Student could not be updated!'     
            ];
        }
        return Response::json($response);
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
        $result = $student->delete();

        if ($result) {
            $response = [
                'success' => true,
                'msg' => 'Student is successfully deleted!'     
            ];            
        } else {
            $response = [
                'success' => false,
                'msg' => 'Student could not be deleted!'     
            ];
        }
        return Response::json($response);
    }

    /**
     *********************************************************************************************************************
     * Generate Student ID.
     */
    public function generateStudentId()
    {
        $result = Student::orderBy('id', 'desc')->first();

        if (! empty($result)) {
            $last_student_id = $result->stu_id;

            $last_number = substr($last_student_id, 3);
            $new_number = $last_number + 1;

            $num_length = strlen((string)$new_number);

            if ($num_length == 1) {
                $new_numbering = '0000' . $new_number;
            } elseif ($num_length == 2) {
                $new_numbering = '000' . $new_number;
            } elseif ($num_length == 3) {
                $new_numbering = '00' . $new_number;
            } elseif ($num_length == 4) {
                $new_numbering = '0' . $new_number;
            } else {
                $new_numbering = $new_number;
            }

            $new_student_id = 'STU' . $new_numbering; 
        } else {
            $new_student_id = 'STU00001';
        }
        return $new_student_id;
    }
}
