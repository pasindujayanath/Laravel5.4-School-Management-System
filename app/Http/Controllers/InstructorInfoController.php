<?php
namespace App\Http\Controllers;

use App\Instructor;
use App\Http\Requests\InstructorRequest;
use App\User;
use Response;

class InstructorInfoController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get logged Instructor Email.
        $logged_email = auth()->guard()->user()->email;

        // Get Instructor Info.
        $instructor = Instructor::where('email', $logged_email)->first();

        return view('instructors.info', ['instructor' => $instructor]);
    }

    /**
     *********************************************************************************************************************
     * Get Instructor Info.
     *
     */
    public function getInstructorInfo()
    {
        // Get logged Instructor Email.
        $logged_email = auth()->guard()->user()->email;

        // Get Instructor Info.
        $instructor = Instructor::where('email', $logged_email)->first();

        return Response::json($instructor);
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
