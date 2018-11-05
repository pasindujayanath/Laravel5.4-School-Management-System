<?php
namespace App\Http\Controllers;

use App\Subject;
use App\Http\Requests\SubjectRequest;
use Response;
use Yajra\Datatables\Datatables;

class AdminSubjectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin', ['only' => 'index', 'store', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::all();
       
        return view('subjects.admin-index', ['subjects' => $subjects]);
    }

    /**
     *********************************************************************************************************************
     * Display a listing of the resource for Datatable.
     *
     */
    public function getAllData()
    {
        $subjects = Subject::all();

        return Datatables::of($subjects)->make(true);
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
        $new_subject_id = $this->generateSubjectId();

        $request_data = $request->all();
        $request_data['sbj_id'] = $new_subject_id;

        $result = Subject::create($request_data);
 
        if ($result) {
            $response = [
                'success' => true,
                'msg' => 'Subject is successfully created!'     
            ];            
        } else {
            $response = [
                'success' => false,
                'msg' => 'Subject could not be created!'     
            ];
        }
        return Response::json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        return Response::json($subject);
    }

    /**
     *********************************************************************************************************************
     * Display the specified resource.
     *
     * @param  \App\Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function showInstructors(Subject $subject)
    {
        $instructors = $subject->instructors()->get();

        return Response::json($instructors);
    }

    /**
     *********************************************************************************************************************
     * Display the specified resource.
     *
     * @param  \App\Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function showStudents(Subject $subject)
    {
        $students = $subject->students()->get();

        return Response::json($students);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        return Response::json($subject);
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
        $result = $subject->update($request->all());

        if ($result) {
            $response = [
                'success' => true,
                'msg' => 'Subject is successfully updated!'     
            ];            
        } else {
            $response = [
                'success' => false,
                'msg' => 'Subject could not be updated!'     
            ];
        }
        return Response::json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $result = $subject->delete();

        if ($result) {
            $response = [
                'success' => true,
                'msg' => 'Subject is successfully deleted!'     
            ];            
        } else {
            $response = [
                'success' => false,
                'msg' => 'Subject could not be deleted!'     
            ];
        }
        return Response::json($response);
    }

    /**
     **************************************************************************************************************
     * Generate Subject ID.
     */
    public function generateSubjectId()
    {
        $result = Subject::orderBy('id', 'desc')->first();

        if (! empty($result)) {
            $last_subject_id = $result->sbj_id;

            $last_number = substr($last_subject_id, 3);
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

            $new_subject_id = 'SBJ' . $new_numbering; 
        } else {
            $new_subject_id = 'SBJ00001';
        }
        return $new_subject_id;
    }
}
