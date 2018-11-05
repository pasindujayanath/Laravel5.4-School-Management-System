@extends('layouts.app')

@section('nav_tabs')
	<li class="active"><a href="{{ url('student/home') }}"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
	<li class=""><a href="{{ url('student/instructors') }}"><i class="fa fa-user-circle-o"></i> <span>Instructors</span></a></li>
	<li class=""><a href="{{ url('student/subjects') }}"><i class="fa fa-book"></i> <span>Subjects</span></a></li>
	<li class=""><a href="{{ url('student/classrooms') }}"><i class="fa fa-building"></i> <span>Classes</span></a></li>
	<li class=""><a href="{{ url('student/info') }}"><i class="fa fa-user"></i> <span>My info</span></a></li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10">
            <h1> &nbsp; <i class="lnr lnr-home"> Dashboard</i></h1>
            <hr/>
        </div>  
    </div>
    
    <div class="well">
        <h1></h1>
        <h5>You are successfully logged in as a student.</h5>
        <h3>Welcome to the system!</h3>
    </div>
@endsection
