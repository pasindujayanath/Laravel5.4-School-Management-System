@extends('layouts.app')

@section('nav_tabs')
	<li class=""><a href="{{ url('student/home') }}"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
	<li class=""><a href="{{ url('student/instructors') }}"><i class="fa fa-user-circle-o"></i> <span>Instructors</span></a></li>
	<li class=""><a href="{{ url('student/subjects') }}"><i class="fa fa-book"></i> <span>Subjects</span></a></li>
	<li class=""><a href="{{ url('student/classrooms') }}"><i class="fa fa-building"></i> <span>Classes</span></a></li>
	<li class="active"><a href="{{ url('student/info') }}"><i class="fa fa-user"></i> <span>My info</span></a></li>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-9">
			<h1> &nbsp; <i class="fa fa-users"> Students</i></h1>
			<hr/>
		</div>
		<div class="col-md-3">
			<h3 class="pull-right">ID: {{$student->stu_id}}</h3>
		</div>
	</div>

	<div class="well" id="well_students">
		<form action="#" id="form_student_info" data-parsley-trigger="keyup">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="stu_id">
			<div id="edit-hide">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
					      	<label for="f_name">First Name:</label>
					      	<input type="text" class="form-control" placeholder="First Name" name="f_name" value="{{$student->f_name}}"
					      		required 
					      		data-parsley-pattern="/^([A-Za-z])+$/" 
					      		data-parsley-length="[2, 40]">
			    		</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
					      	<label for="l_name">Last Name:</label>
					      	<input type="text" class="form-control" placeholder="Last Name" name="l_name" value="{{$student->l_name}}"
					      		required 
					      		data-parsley-pattern="/^([A-Za-z])+$/" 
					      		data-parsley-length="[2, 40]">
					    </div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
					      	<label for="initials">Initials:</label>
					      	<input type="text" class="form-control" placeholder="Initials" name="initials" value="{{$student->initials}}"
					      		required 
					      		data-parsley-pattern="/^([A-Z]\.)+$/"
					      		data-parsley-length="[2, 16]">
					    </div>
					</div>
					<div class="col-md-9">
						<div class="form-group">
					      	<label for="init_in_full">Initials in Full:</label>
					      	<input type="text" class="form-control" placeholder="Initials in Full" name="init_in_full" value="{{$student->init_in_full}}"
					      		required
					      		data-parsley-pattern="/^([A-Za-z\s])+$/" 
					      		data-parsley-length="[2, 140]">
					    </div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
					      	<label for="dob">Date of Birth:</label>
					      	<div class="input-group date" data-date-autoclose="true" data-provide="datepicker" data-date-format="yyyy-mm-dd">
								<input type="text" class="form-control" placeholder="Date of Birth" name="dob" value="{{$student->dob}}"
					      		required>
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>	
					    </div>
					</div>
					<div class="col-md-9">
					</div>
				</div>
				<div class="row">
					<div class="col-md-9">
						<div class="form-group">
					      	<label for="email">Email:</label>
					      	<input type="email" class="form-control" placeholder="Email" name="email" value="{{$student->email}}"
					      		required 
					      		data-parsley-type="email">
					    </div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
					      	<label for="phone">Phone:</label>
					      	<input type="text" class="form-control" placeholder="Phone" name="phone" value="{{$student->phone}}"
					      		required 
					      		data-parsley-type="digits" 
					      		data-parsley-pattern="/^0(\d){9}$/" 
					      		data-parsley-length="[10, 10]">
					    </div>
					</div>
				</div>
			    <div class="row">
					<div class="col-md-12">
						<div class="form-group">
					      	<label for="address">Address:</label>
					      	<input type="text" class="form-control" placeholder="Address" name="address" value="{{$student->address}}"
					      		required 
					      		data-parsley-pattern="/^([A-Za-z\&\s\.,:\-_'0-9#])+$/" 
					      		data-parsley-length="[2, 200]">
					    </div>
					</div>
				</div>
				<hr/>
			    <div class="row well">
			    	<strong>Guardian Info:</strong><br/>
					<div class="col-md-9">
						<div class="form-group">
					      	<label for="guardian_name">Name:</label>
					      	<input type="text" class="form-control" placeholder="Name of the Guardian" name="guardian_name" value="{{$student->guardian_name}}"
					      		required 
					      		data-parsley-pattern="/^([A-Za-z\.\s])+$/" 
					      		data-parsley-length="[2, 140]">
					    </div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
					      	<label for="guardian_phone">Phone:</label>
					      	<input type="text" class="form-control" placeholder="Phone of the Guardian" name="guardian_phone" value="{{$student->guardian_phone}}"
					      		required 
					      		data-parsley-type="digits" 
					      		data-parsley-pattern="/^0(\d){9}$/" 
					      		data-parsley-length="[10, 10]">
					    </div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group" >
					<div class="col-md-12" id="divFormFooter">
						<div id="div-all-required">
							<span class="label label-warning">All Fields are required.</span>
						</div>
						<div class="pull-right">
							<button id="btn-info-edit" name="btnInfoEdit" type="button" class="btn btn-primary btn-info-edit">
								Edit
							</button>
							<button id="btn-info-update" name="btnInfoEdit" type="submit" class="btn btn-primary btn-info-edit" style="display:none;">
								Update
							</button>    
	  					</div>	
					</div>
				</div>
			</div>	
		</form>
	</div>

	<div class="well">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
			      	<label for="comment">Instructor Comments:</label>
			      	<input type="text" class="form-control" placeholder="Comment" name="comment" value="{{$student->comment}}" disabled>
			    </div>
			</div>
		</div>	
	</div>	
@endsection

@section('scripts')
	<script src="{{ URL::asset('js/student_info.js') }}"></script>
@endsection