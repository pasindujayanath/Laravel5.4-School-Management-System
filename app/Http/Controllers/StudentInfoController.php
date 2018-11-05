<?php
namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Response;

class StudentInfoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('student');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get logged Student Email.
        $logged_email = auth()->guard()->user()->email;

        // Get Student Info.
        $student = Student::where('email', $logged_email)->first();

        return view('students.info', ['student' => $student]);
    }

    /**
     *********************************************************************************************************************
     * Get Student Info.
     *
     */
    public function getStudentInfo()
    {
        // Get logged Student Email.
        $logged_email = auth()->guard()->user()->email;

        // Get Student Info.
        $student = Student::where('email', $logged_email)->first();

        return Response::json($student);
    }    
}
