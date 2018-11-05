<?php
namespace App\Http\Controllers;

use App\Instructor;
use App\Http\Requests\InstructorRequest;
use App\User;
use Hash;
use Response;
use Yajra\Datatables\Datatables;

class StudentInstructorController extends Controller
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
     *********************************************************************************************************************
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instructors = Instructor::all();
       
        return view('instructors.student-index', ['instructors' => $instructors]);
    }

    /**
     *********************************************************************************************************************
     * Display a listing of the resource for Datatable.
     *
     */
    public function getAllData()
    {
        $instructors = Instructor::all();

        // Create 'name' for each student.
        foreach ($instructors as $instructor) {
            $instructor['name'] = $instructor->initials . ' ' .  $instructor->f_name . ' ' . $instructor->l_name; 
        }

        return Datatables::of($instructors)->make(true);
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
     * @param  App\Http\Requests\InstructorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstructorRequest $request)
    {
        //
    }

    /**
     *********************************************************************************************************************
     * Display the specified resource.
     *
     * @param  \App\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function show(Instructor $instructor)
    {
        //return Response::json($instructor);
    }

    /**
     *********************************************************************************************************************
     * Show the form for editing the specified resource.
     *
     * @param  \App\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function edit(Instructor $instructor)
    {
        //return Response::json($instructor);
    }

    /**
     *********************************************************************************************************************
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\InstructorRequest  $request
     * @param  \App\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function update(InstructorRequest $request, Instructor $instructor)
    {
        //
    }

    /**
     *********************************************************************************************************************
     * Remove the specified resource from storage.
     *
     * @param  \App\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instructor $instructor)
    {
        //
    }
}
