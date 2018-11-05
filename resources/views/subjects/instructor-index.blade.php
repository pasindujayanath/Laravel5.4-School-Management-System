@extends('layouts.app')

@section('nav_tabs')
	<li class=""><a href="{{ url('instructor/home') }}"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
    <li class=""><a href="{{ url('instructor/students') }}"><i class="fa fa-users"></i> <span>Students</span></a></li>
    <li class="active">
		<a href="#" class="has-arrow" aria-expanded="true"><i class="fa fa-book"></i> <span>Subjects</span></a>
		<ul aria-expanded="true">
			<li class="active"><a href="{{ url('instructor/subjects') }}">All Subjects</a></li>
			<li class=""><a href="{{ url('instructor/subjects/my') }}">My Subjects</a></li>
		</ul>
	</li>
    <li class=""><a href="{{ url('instructor/classrooms') }}"><i class="fa fa-building"></i> <span>Classes</span></a></li>
	<li class=""><a href="{{ url('instructor/info') }}"><i class="fa fa-user-circle-o"></i> <span>My Info</span></a></li>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-10">
			<h1> &nbsp; <i class="fa fa-book"></i> All Subjects</i></h1>
			<hr/>
		</div>
		<div class="col-md-2">
			<br/>
			<button type="button" class="btn btn-primary btn-lg btn-link btn-add pull-right" id="btnAddSubject">
			    <i class="fa fa-plus"> Add New</i>
			</button>
		</div>	
	</div>
		
	<div class="well" id="well_subjects">
		<table class="table table-striped table-hover table-responsive" id="tbl_subjects" style="width:100%;">
		    <thead>
		    	<tr>
		        	<th>Subject ID</th>
		        	<th>Code</th>
		        	<th>Name</th>
		        	<th>Year</th>
		        	<th>Semester</th>
		        	<th>Periods</th>
		        	<th style="width:15%;">Actions</th>
		      	</tr>
		    </thead>
		    <tbody>
		    </tbody>
		</table>
	</div>

	<!-- Modal -->
  	<div class="modal fade" id="modal_subjectinfo" role="dialog">
    	<div class="modal-dialog modal-lg">
      	<!-- Modal content-->
	    	<div class="modal-content">
	        	<div class="modal-header">
	          		<button type="button" class="close" data-dismiss="modal">&times;</button>
	          		<h4 class="modal-title" id="modal_subject_title">Subject Information</h4>
	        	</div>
	        	<div class="modal-body">
	        		<form action="#" id="form_subject" data-parsley-trigger="keyup">
	        			<input type="hidden" name="_token" value="{{ csrf_token() }}">
	        			<input type="hidden" name="stu_id">
	        			<div class="row">
	        				<div class="col-md-6">
	        					<div class="form-group">
							      	<label for="code">Code:</label>
							      	<input type="text" class="form-control" placeholder="Code" name="code"
							      		required
							      		data-parsley-pattern="/^[A-Z]{2}[0-9]{4}$/" 
							      		data-parsley-length="[6, 6]">
					    		</div>
	        				</div>
	        				<div class="col-md-6">
	        					<div class="form-group">
							      	<label for="name">Name:</label>
							      	<input type="text" class="form-control" placeholder="Name" name="name" 
							      		required
							      		data-parsley-pattern="/^([A-Za-z0-9\s\.:\-_()])+$/" 
							      		data-parsley-length="[2, 140]">
							    </div>
	        				</div>
	        			</div>
	        			<div class="row">
	        				<div class="col-md-4">
	        					<div class="form-group">
							      	<label for="year">Year:</label>
							      	<input type="text" class="form-control" placeholder="Year" name="year"
							      		required
							      		data-parsley-pattern="/^[0-9]+$/" 
							      		data-parsley-length="[1, 1]">
							    </div>
	        				</div>
	        				<div class="col-md-4">
	        					<div class="form-group">
							      	<label for="semester">Semester:</label>
							      	<input type="text" class="form-control" placeholder="Semester" name="semester"
							      		required
							      		data-parsley-pattern="/^[0-9]+$/" 
							      		data-parsley-length="[1, 1]">
							    </div>
	        				</div>
	        				<div class="col-md-4">
	        					<div class="form-group">
							      	<label for="periods">Periods:</label>
							      	<input type="text" class="form-control" placeholder="Periods" name="periods"
							      		required
							      		data-parsley-pattern="/^[0-9]+$/" 
							      		data-parsley-length="[1, 3]">
							    </div>
	        				</div>
	        			</div>
	        			<div class="row" id="row-students">
	        				<hr/>
	        				<div class="col-md-12">
		        				<h4>Selected Students:</h4>
		        				<ul id="list-students"></ul>
		        				<p id="no-students"></p>
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
	<script src="{{ URL::asset('js/admin_subject.js') }}"></script>
@endsection