<?php
namespace App\Http\Controllers;

use App\Instructor;
use App\Http\Requests\InstructorRequest;
use App\User;
use Hash;
use Response;
use Yajra\Datatables\Datatables;

class AdminInstructorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin', ['only' => 'index', 'store', 'show', 'edit', 'destroy', 'generateInstructorId']);
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
       
        return view('instructors.admin-index', ['instructors' => $instructors]);
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
        // generate a new instructor id.
        $new_instructor_id = $this->generateInstructorId();
        $request_data = $request->all();
        $request_data['ins_id'] = $new_instructor_id;

        $user_type = 'ins';
        $instructor_default_password = 'Instructor@123';
        // assign date which pass into table:'users'.
        $user_data = [
            'type' => $user_type,
            'name' => $request->f_name . ' ' . $request->l_name,
            'email' => $request->email,
            'password' => Hash::make($instructor_default_password)
        ];    

        $result_instructor = Instructor::create($request_data);     // pass data into table:'instructors' and get the result.
        $result_user = User::create($user_data);                    // pass data into table:'users' and get the result.
 
        if ($result_instructor && $result_user) {   // only if above queries are executed succefully:
            $response = [
                'success' => true,
                'msg' => 'Instructor is successfully created!'     
            ];            
        } else {
            $response = [
                'success' => false,
                'msg' => 'Instructor could not be created!'     
            ];
        }
        return Response::json($response);
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
        return Response::json($instructor);
    }

    /**
     *********************************************************************************************************************
     * Display the specified resource.
     *
     * @param  \App\Instructor $instructor
     * @return \Illuminate\Http\Response
     */
    public function showSubjects(Instructor $instructor)
    {
        $subjects = $instructor->subjects()->get();

        return Response::json($subjects); 
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
        return Response::json($instructor);
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
        // assign date which pass into table:'users'.
        $user_name = $request->f_name . ' ' . $request->l_name;

        $result_instructor = $instructor->update($request->all());    // pass updated data into table:'students' and get the result.
        $result_user = User::where('email', $request->email)->update(['name' => $user_name]); // pass updated data into table:'users' and get the result.

        if ($result_instructor && $result_user) {
            $response = [
                'success' => true,
                'msg' => 'Instructor is successfully updated!'     
            ];            
        } else {
            $response = [
                'success' => false,
                'msg' => 'Instructor could not be updated!'     
            ];
        }
        return Response::json($response);
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
        $result = $instructor->delete();

        if ($result) {
            $response = [
                'success' => true,
                'msg' => 'Instructor is successfully deleted!'     
            ];            
        } else {
            $response = [
                'success' => false,
                'msg' => 'Instructor could not be deleted!'     
            ];
        }
        return Response::json($response);
    }

    /**
     *********************************************************************************************************************
     * Generate Instructor ID.
     */
    public function generateInstructorId()
    {
        $result = Instructor::orderBy('id', 'desc')->first();

        if (! empty($result)) {
        	$last_instructor_id = $result->ins_id;

            $last_number = substr($last_instructor_id, 3);
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

            $new_instructor_id = 'INS' . $new_numbering; 
        } else {
            $new_instructor_id = 'INS00001';
        }
        return $new_instructor_id;
    }
}
