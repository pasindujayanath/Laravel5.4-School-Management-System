/*
 ***********************************************************************************************************************
 ***********************************************************************************************************************
 *  For Instructor Console - Students.
 *
 */ 
$(document).ready(function(){
    var tblStudents;
	var action;
    var urlAllStudents =  baseUrl+'/instructor/students/all';
	var urlStudent =  baseUrl+'/admin/students';
	var method;
	var url;
	var rowId;
	var urlUpdateStudent = baseUrl+'/admin/students/'
    var errorMsgs = "";

/*
 ***********************************************************************************************************************
 *  Load Students info into DataTable.
 *
 */ 
    tblStudents = $('#tbl_students').DataTable( {
        "processing"    : true,
        "serverSide"    : false,
        "responsive"    : true,
        "ajax"          : {
            "url"       : urlAllStudents,
            "type"      : "GET"
        },
        "columns": [
            { data: 'stu_id' },
            { data: 'name' },
            { data: 'dob' },
            { data: 'email' },
            { data: 'phone' },
            { data: 'address' }
        ],
        "columnDefs"    : [
            { 
                className: "align-center",
                "targets": [6],
                "render"    : function ( data, type, full, meta){
                    let id = full.id;
                    return `<button href="#" class="btn btn-xs btn-info btn-view" data-id="${id}">
                                <i class="fa fa-eye"></i>
                            </button>
                            <button href="#" class="btn btn-xs btn-warning btn-edit" data-id="${id}">
                               <i class="fa fa-plus"> Comment</i>
                            </button>`;
                } 
            }
        ]
    });    	

/*
 ***********************************************************************************************************************
 *  Load Students info into modal for viewing.
 *
 */ 
	$('#tbl_students tbody').on( 'click', '.btn-view', function () {
        var id = $(this).data('id');

        $.get(urlStudent + '/' + id, function (data) {
     		$('#modal_student_title').html('Student Information (Student ID: ' + data.stu_id + ')');

            $('#form_student').find('input[name="stu_id"]').val(data.stu_id);
            $('#form_student').find('input[name="f_name"]').val(data.f_name);
            $('#form_student').find('input[name="l_name"]').val(data.l_name);
            $('#form_student').find('input[name="initials"]').val(data.initials);
            $('#form_student').find('input[name="init_in_full"]').val(data.init_in_full);
            $('#form_student').find('input[name="dob"]').val(data.dob);
            $('#form_student').find('input[name="email"]').val(data.email);
            $('#form_student').find('input[name="email"]').val(data.email);
            $('#form_student').find('input[name="phone"]').val(data.phone);
            $('#form_student').find('input[name="address"]').val(data.address);
            $('#form_student').find('input[name="guardian_name"]').val(data.guardian_name);
            $('#form_student').find('input[name="guardian_phone"]').val(data.guardian_phone);
            $('#form_student').find('input[name="comment"]').val(data.comment);

            $("#form_student :input").prop("disabled", true);
            $("#edit-hide").show();

            $('#form_student').find('#divFormFooter').hide(); 

            $('#modal_studentinfo').modal('show');
        });

        $('#list-subjects').html('');
        $('#no-subjects').html('');

        $.get(urlStudent + '/' + id + '/subjects', function (data) {
            if (data.length != 0) {
                $('#row-subjects').show();
                
                jQuery.each( data, function( i, val ) {
                    $('#list-subjects').append('<li>' + val.code + ' - ' + val.name + '</li>');
                });
            } else {
                $('#row-subjects').show();
                $('#list-subjects').append('');
                $('#no-subjects').html('No subjects are selected yet.');
            }    
        });
    });

/*
 ***********************************************************************************************************************
 * Load Students info into modal for editing.
 *
 */ 
	$('#tbl_students tbody').on( 'click', '.btn-edit', function () {
        action = 'edit';

        var id = $(this).data('id');

        $.get(urlStudent + '/' + id, function (data) {
            $('#modal_student_title').html('Update Student Information (Student ID: ' + data.stu_id + ')');

            rowId = data.id;

            $('#form_student').find('input[name="stu_id"]').val(data.stu_id);
            $('#form_student').find('input[name="f_name"]').val(data.f_name);
            $('#form_student').find('input[name="l_name"]').val(data.l_name);
            $('#form_student').find('input[name="initials"]').val(data.initials);
            $('#form_student').find('input[name="init_in_full"]').val(data.init_in_full);
            $('#form_student').find('input[name="dob"]').val(data.dob);
            $('#form_student').find('input[name="email"]').val(data.email);;
            $('#form_student').find('input[name="phone"]').val(data.phone);
            $('#form_student').find('input[name="address"]').val(data.address);
            $('#form_student').find('input[name="guardian_name"]').val(data.guardian_name);
            $('#form_student').find('input[name="guardian_phone"]').val(data.guardian_phone);
            $('#form_student').find('input[name="comment"]').val(data.comment);

            $("#form_student :input").prop("disabled", false);
            $("#edit-hide").hide();

            $('#row-subjects').hide();

            $('#form_student').find('#divFormFooter').show(); 

            $('#modal_studentinfo').modal('show');
        }) 
    });

/*
 ***********************************************************************************************************************
 *  Update existing Student.
 *
 */    
    $("#form_student").submit(function(e){
        e.preventDefault();
    });

    $('#form_student').parsley().off('field:validated').on('field:validated', function(e) {
        var ok = $('.parsley-error').length === 0;
    })
    .on('form:submit', function(e) {
        errorMsgs = '';
        
        method = 'PUT';
        url = urlUpdateStudent+rowId;

        $.ajax({
            type: method,
            url: url,
            data: $('#form_student').serialize(),
            dataType: 'json',
            success: function (res) {
               if (res.success) {
                    swal({
                        icon: "success",
                        title: "Success!",
                        text: res.msg,
                        button: false,
                        timer: 3000
                    });

                    $('#form_student').trigger("reset");

                    $('#modal_studentinfo').modal('hide');
            	} else {
                    swal({
                        icon: "error",
                        title: "Error!",
                        text: res.msg, 
                        button: "OK"
                    });
                }
            },
            error: function (res) {
                if (res.status == 422) {
                    var errors = JSON.parse(res.responseText);

                    $.each(errors, function (index, error) {
                        errorMsgs += error ? error + "\n" : "";
                    });

                    swal({
                        icon: "error",
                        title: "Error!", 
                        text: errorMsgs, 
                        button: "OK"
                    });
                } else {
                    swal({
                        icon: "error",
                        title: "Error!",
                        text: 'An internal server error occured.\n Please, contact system administrator!', 
                        button: "OK"
                    });
                }
            }
        });
    });

// Date picker
    $('.inline-datepicker').datepicker({
        todayHighlight: true
    });

/*
 ***********************************************************************************************************************
 *  Reset From Validations when Modal closing.
 *
 */
    $('#modal_studentinfo').on('hide.bs.modal', function() {
        $('#form_student').parsley().reset();
    });   
});	