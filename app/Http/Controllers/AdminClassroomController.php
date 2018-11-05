<?php
namespace App\Http\Controllers;

use App\Classroom;
use App\Http\Requests\ClassroomRequest;
use Response;
use Yajra\Datatables\Datatables;

class AdminClassroomController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $classrooms = Classroom::all();
       
        return view('classrooms.admin-index', ['classrooms' => $classrooms]);
    }

    /**
     *********************************************************************************************************************
     * Display a listing of the resource for Datatable.
     *
     */
    public function getAllData()
    {
        $classrooms = Classroom::all();

        return Datatables::of($classrooms)->make(true);
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
     * @param  App\Http\Requests\ClassroomRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassroomRequest $request)
    {
        $new_classroom_id = $this->generateClassroomId();

        $request_data = $request->all();
        $request_data['cls_id'] = $new_classroom_id;

        $result = Classroom::create($request_data);
 
        if ($result) {
            $response = [
                'success' => true,
                'msg' => 'Class is successfully created!'     
            ];            
        } else {
            $response = [
                'success' => false,
                'msg' => 'Class could not be created!'     
            ];
        }
        return Response::json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        return Response::json($classroom);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        return Response::json($classroom);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\ClassroomRequest $request
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(ClassroomRequest $request, Classroom $classroom)
    {
        $result = $classroom->update($request->all());

        if ($result) {
            $response = [
                'success' => true,
                'msg' => 'Class is successfully updated!'     
            ];            
        } else {
            $response = [
                'success' => false,
                'msg' => 'Class could not be updated!'     
            ];
        }
        return Response::json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        $result = $classroom->delete();

        if ($result) {
            $response = [
                'success' => true,
                'msg' => 'Class is successfully deleted!'     
            ];            
        } else {
            $response = [
                'success' => false,
                'msg' => 'Class could not be deleted!'     
            ];
        }
        return Response::json($response);
    }

    /**
     *********************************************************************************************************************
     * Generate Classroom ID.
     */
    public function generateClassroomId()
    {
        $result = Classroom::orderBy('id', 'desc')->first();

        if (! empty($result)) {
            $last_classroom_id = $result->cls_id;

            $last_number = substr($last_classroom_id, 3);
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

            $new_classroom_id = 'CLS' . $new_numbering; 
        } else {
            $new_classroom_id = 'CLS00001';
        }
        return $new_classroom_id;
    }
}
