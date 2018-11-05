<?php
namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;
use App\Http\Requests\SubjectRequest;
use Response;
use Yajra\Datatables\Datatables;
use Auth;
use App\Student;

class StudentSubjectController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::all();
       
        return view('subjects.student-index', ['subjects' => $subjects]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loadSelectedSubjects()
    {
        $logged_email = Auth::user()->email;
        $student_id = Student::where('email', $logged_email)->first()->id;
        $student = Student::find($student_id);

        $my_subjects = $student->subjects()->get();

        return Datatables::of($my_subjects)->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loadMySubjects()
    {
        $logged_email = Auth::user()->email;
        $student_id = Student::where('email', $logged_email)->first()->id;
        $student = Student::find($student_id);

        $subjects = Subject::orderBy('code')->pluck('name', 'id');
       
        return view('subjects.student-own', ['student' => $student, 'subjects' => $subjects]);
    }

    /**
     *********************************************************************************************************************
     * Display a listing of the resource for Datatable.
     *
     */
    public function saveMySubjects(Request $request)
    {
        $logged_email = Auth::user()->email;
        $student_id = Student::where('email', $logged_email)->first()->id;
        $student = Student::find($student_id);

        $result = $student->subjects()->sync($request->subjects);
        
        if ($result) {
            $request->session()->flash('type', 'success');
            $request->session()->flash('msg', 'Subjects are successfully updated!');
        } else {
            $request->session()->flash('type', 'danger');
            $request->session()->flash('msg', 'Error!');
        }
        return redirect('student/subjects/my');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\SubjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //return Response::json($subject);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        //return Response::json($subject);
    }

    public function loadSubjects() {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\SubjectRequest  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectRequest $request, Subject $subject)
    {
       //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
       //
    }
}
