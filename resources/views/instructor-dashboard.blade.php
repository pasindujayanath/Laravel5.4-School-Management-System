@extends('layouts.app')

@section('nav_tabs')
	<li class="active"><a href="{{ url('instructor/home') }}"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
    <li class=""><a href="{{ url('instructor/students') }}"><i class="fa fa-users"></i> <span>Students</span></a></li>
    <li class=""><a href="{{ url('instructor/subjects') }}"><i class="fa fa-book"></i> <span>Subjects</span></a></li>
    <li class=""><a href="{{ url('instructor/classrooms') }}"><i class="fa fa-building"></i> <span>Classes</span></a></li>
	<li class=""><a href="{{ url('instructor/info') }}"><i class="fa fa-user-circle-o"></i> <span>My Info</span></a></li>
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
        <h5>You are successfully logged in as an instructor.</h5>
        <h3>Welcome to the system!</h3>
    </div>
@endsection
