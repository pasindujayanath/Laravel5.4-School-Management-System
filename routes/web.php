<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Commen 'welcome'-screen related Route.
 *
 */
Route::get('/', function () {
    return view('welcome');
});

/**
 * Adminisitrator Login & Password Management related Routes.
 *
 */
Route::get('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin', 'Admin\LoginController@login');
Route::post('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin-password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin-password/reset', 'Admin\ResetPasswordController@reset');
Route::get('admin-password/reset/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');

/**
 * User Login & Password Management related Routes.
 *
 */
Auth::routes();

/**
 * Middleware - auth:admin related Admin Routes.
 *
 */
Route::group(['middleware' => ['auth:admin']], function () {
	Route::get('admin/home', 'AdminController@index');

	Route::get('admin/instructors/all', 'AdminInstructorController@getAllData');	
	
	Route::get('admin/students/all', 'AdminStudentController@getAllData');
});

/**
 * Commen Routes.
 *
 */
Route::get('admin/instructors/{instructor}/subjects', 'AdminInstructorController@showSubjects');
Route::resource('admin/instructors', 'AdminInstructorController');
	
Route::get('admin/students/{student}/subjects', 'AdminStudentController@showSubjects');
Route::resource('admin/students', 'AdminStudentController');
	
Route::get('admin/subjects/{subject}/instructors', 'AdminSubjectController@showInstructors');	
Route::get('admin/subjects/{subject}/students', 'AdminSubjectController@showStudents');	
Route::get('admin/subjects/all', 'AdminSubjectController@getAllData');
Route::resource('admin/subjects', 'AdminSubjectController');

Route::get('admin/classrooms/all', 'AdminClassroomController@getAllData');
Route::resource('admin/classrooms', 'AdminClassroomController');


/**
 * Middleware - auth related Routes.
 * 
 */
Route::group(['middleware' => ['auth']], function () {
	/**
	 * Student related Routes.
	 *
	 */
	Route::get('student/home', 'StudentHomeController@index');

	Route::get('student/infomation', 'StudentInfoController@getStudentInfo');
	Route::resource('student/info', 'StudentInfoController');

	Route::get('student/instructors/all', 'StudentInstructorController@getAllData');
	Route::resource('student/instructors', 'StudentInstructorController');

	Route::get('student/subjects/selected', 'StudentSubjectController@loadSelectedSubjects');
	Route::get('student/subjects/my', 'StudentSubjectController@loadMySubjects');
	Route::post('student/subjects/my/save', 'StudentSubjectController@saveMySubjects');
	Route::resource('student/subjects', 'StudentSubjectController');

	Route::resource('student/classrooms', 'StudentClassroomsController');

	/**
	 * Instructor related Routes.
	 *
	 */
	Route::get('instructor/home', 'InstructorHomeController@index');
	
	Route::get('instructor/infomation', 'InstructorInfoController@getInstructorInfo');
	Route::resource('instructor/info', 'InstructorInfoController');

	Route::get('instructor/students/all', 'InstructorStudentController@getAllData');
	Route::resource('instructor/students', 'InstructorStudentController');

	Route::get('instructor/subjects/selected', 'InstructorSubjectController@loadSelectedSubjects');
	Route::get('instructor/subjects/my', 'InstructorSubjectController@loadMySubjects');
	Route::post('instructor/subjects/my/save', 'InstructorSubjectController@saveMySubjects');	
	Route::resource('instructor/subjects', 'InstructorSubjectController');

	Route::resource('instructor/classrooms', 'InstructorClassroomsController');
});

