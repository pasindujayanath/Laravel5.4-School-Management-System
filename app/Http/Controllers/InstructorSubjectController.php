<?php
namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;
use App\Http\Requests\SubjectRequest;
use Yajra\Datatables\Datatables;
use Auth;
use App\Instructor;

class InstructorSubjectController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::all();
       
        return view('subjects.instructor-index', ['subjects' => $subjects]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loadSelectedSubjects()
    {
        $logged_email = Auth::user()->email;
        $instructor_id = Instructor::where('email', $logged_email)->first()->id;
        $instructor = Instructor::find($instructor_id);

        $my_subjects = $instructor->subjects()->get();

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
        $instructor_id = Instructor::where('email', $logged_email)->first()->id;
        $instructor = Instructor::find($instructor_id);

        $subjects = Subject::orderBy('code')->pluck('name', 'id');
       
        return view('subjects.instructor-own', ['instructor' => $instructor, 'subjects' => $subjects]);
    }

    /**
     *********************************************************************************************************************
     * Display a listing of the resource for Datatable.
     *
     */
    public function saveMySubjects(Request $request)
    {
        $logged_email = Auth::user()->email;
        $instructor_id = Instructor::where('email', $logged_email)->first()->id;
        $instructor = Instructor::find($instructor_id);

        $result = $instructor->subjects()->sync($request->subjects);
        
        if ($result) {
            $request->session()->flash('type', 'success');
            $request->session()->flash('msg', 'Subjects are successfully updated!');
        } else {
            $request->session()->flash('type', 'danger');
            $request->session()->flash('msg', 'Error!');
        }
        return redirect('instructor/subjects/my');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        //
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
