@extends('layouts.app')

@section('nav_tabs')
	<li class=""><a href="{{ url('admin/home') }}"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
	<li class=""><a href="{{ url('admin/students') }}"><i class="fa fa-users"></i> <span>Students</span></a></li>
	<li class="active"><a href="{{ url('admin/instructors') }}"><i class="fa fa-user-circle-o"></i> <span>Instructors</span></a></li>
	<li class=""><a href="{{ url('admin/subjects') }}"><i class="fa fa-book"></i> <span>Subjects</span></a></li>
	<li class=""><a href="{{ url('admin/classrooms') }}"><i class="fa fa-building"></i> <span>Classes</span></a></li>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-10">
			<h1> &nbsp; <i class="fa fa-user-circle-o"> Instructors</i></h1>
			<hr/>
		</div>
		<div class="col-md-2">
			<br/>
			<button type="button" class="btn btn-primary btn-lg btn-link btn-add pull-right" id="btnAddInstructor">
			    <i class="fa fa-plus"> Add New</i>
			</button>
		</div>	
	</div>

	<div class="well" id="well_instructors">
		<table class="table table-striped table-hover table-responsive" id="tbl_instructors" style="width:100%;">
		    <thead>
		    	<tr>
		        	<th>Instructor ID</th>
		        	<th>Name</th>
		        	<th>Date of Birth</th>
		        	<th>Email</th>
		        	<th>Phone</th>
		        	<th>Address</th>
		        	<th style="width:15%;">Actions</th>
		      	</tr>
		    </thead>
		    <tbody>
		    </tbody>
		</table>
	</div>

	<!-- Modal -->
  	<div class="modal fade" id="modal_instructorinfo" role="dialog">
    	<div class="modal-dialog modal-lg">
      	<!-- Modal content-->
	    	<div class="modal-content">
	        	<div class="modal-header">
	          		<button type="button" class="close" data-dismiss="modal">&times;</button>
	          		<h4 class="modal-title" id="modal_instructor_title">Instructor Information</h4>
	        	</div>
	        	<div class="modal-body">
	        		<form action="#" id="form_instructor" data-parsley-trigger="keyup">
	        			<input type="hidden" name="_token" value="{{ csrf_token() }}">
	        			<input type="hidden" name="ins_id">
	        			<div class="row">
	        				<div class="col-md-6">
	        					<div class="form-group">
							      	<label for="f_name">First Name:</label>
							      	<input type="text" class="form-control" placeholder="First Name" name="f_name"
							      		required 
							      		data-parsley-pattern="/^([A-Za-z])+$/" 
							      		data-parsley-length="[2, 40]">
					    		</div>
	        				</div>
	        				<div class="col-md-6">
	        					<div class="form-group">
							      	<label for="l_name">Last Name:</label>
							      	<input type="text" class="form-control" placeholder="Last Name" name="l_name" 
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
							      	<input type="text" class="form-control" placeholder="Initials" name="initials"
							      		required 
							      		data-parsley-pattern="/^([A-Z]\.)+$/"
							      		data-parsley-length="[2, 16]">
							    </div>
	        				</div>
	        				<div class="col-md-9">
	        					<div class="form-group">
							      	<label for="init_in_full">Initials in Full:</label>
							      	<input type="text" class="form-control" placeholder="Initials in Full" name="init_in_full"
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
										<input type="text" class="form-control" placeholder="Date of Birth" name="dob"
							      			required>
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									</div>	
							    </div>
	        				</div>
	        				<div class="col-md-9">
	        				</div>
	        			</div>
	        			<div class="row">
	        				<div class="col-md-3">
	        					<div class="form-group">
							      	<label for="experience">Work Experience (years):</label>
							      	<input type="text" class="form-control" placeholder="Work Experience" name="experience"
							      		required
							      		data-parsley-pattern="/^([0-9\.])+$/" 
							      		data-parsley-length="[1, 2]">
							    </div>
	        				</div>
	        				<div class="col-md-9">
	        					<div class="form-group">
							      	<label for="qualification">Qualification:</label>
							      	<input type="text" class="form-control" placeholder="Qualification" name="qualification"
							      		required
							      		data-parsley-pattern="/^([A-Za-z0-9\s\.,:\-_()])+$/" 
							      		data-parsley-length="[2, 100]">
							    </div>
	        				</div>
	        			</div>
	        			<div class="row">
	        				<div class="col-md-9">
	        					<div class="form-group">
							      	<label for="email">Email:</label>
							      	<input type="email" class="form-control" placeholder="Email" name="email"
							      		required 
							      		data-parsley-type="email">
							      	<input type="text" class="form-control" name="dummy_email">	
							    </div>
	        				</div>
	        				<div class="col-md-3">
	        					<div class="form-group">
							      	<label for="phone">Phone:</label>
							      	<input type="text" class="form-control" placeholder="Phone" name="phone"
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
							      	<input type="text" class="form-control" placeholder="Address" name="address"
							      		required 
							      		data-parsley-pattern="/^([A-Za-z\&\s\.,:\-_'0-9#])+$/" 
							      		data-parsley-length="[2, 200]">
							    </div>
	        				</div>
	        			</div>
	        			<div class="row" id="row-comment">
	        			<hr/>
	        				<div class="col-md-12">
	        					<div class="form-group">
							      	<label for="comment">Student Comments:</label>
							      	<input type="text" class="form-control" placeholder="Comment" name="comment">
							    </div>
	        				</div>
	        			</div>
	        			<div class="row" id="row-subjects">
	        				<hr/>
	        				<div class="col-md-12">
		        				<h4>Selected Subjects:</h4>
		        				<ul id="list-subjects"></ul>
		        				<p id="no-subjects"></p>
		        			</div>
	        			</div>
	        			<div class="row">
		        			<div class="form-group" >
								<div class="col-md-12" id="divFormFooter">
									<div >
										<span class="label label-warning">All Fields are required.</span>
									</div>
									<div class="pull-right">
										<button id="btnSubmit" name="btnSave" type="submit" class="btn btn-primary btn-save">
											Save
										</button>
			      						<button id="btnCancel" type="button" class="btn btn-danger closemodal" data-dismiss="modal">
			      							Cancel
			      						</button>
			      					</div>	
								</div>
							</div>
						</div>	
  					</form>
	        	</div>
	        <div class="modal-footer">
	          	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	    </div>
    </div>
@endsection

@section('scripts')
	<script src="{{ URL::asset('js/admin_instructor.js') }}"></script>
@endsection