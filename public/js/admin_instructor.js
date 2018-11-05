/*
 ***********************************************************************************************************************
 ***********************************************************************************************************************
 *  For Admin Console - Instructors.
 *
 */ 
$(document).ready(function(){
    var tblInstructor;
    var action;
    var urlAllInstructors =  baseUrl+'/admin/instructors/all';
    var urlInstructor =  baseUrl+'/admin/instructors';
    var method;
    var url;
    var rowId;
    var urlUpdateOrDeleteInstructor = baseUrl+'/admin/instructors/';
    var errorMsgs = "";

/*
 ***********************************************************************************************************************
 *  Load Instructors info into DataTable.
 *
 */ 
    tblInstructor = $('#tbl_instructors').DataTable( {
        "processing"    : true,
        "serverSide"    : false,
        "responsive"    : true,
        "ajax"          : {
            "url"       : urlAllInstructors,
            "type"      : "GET"
        },
        "columns": [
            { data: 'ins_id' },
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
                               <i class="fa fa-edit"></i>
                            </button>
                            <button href="#" class="btn btn-xs btn-danger btn-del" data-id="${id}">
                                <i class="fa fa-trash"></i>
                            </button>`;
                } 
            }
        ]
    });    

/*
 ***********************************************************************************************************************
 *  Load modal for Adding.
 *
 */ 
	$('#btnAddInstructor').click(function(){
		action = 'add';

        $('#modal_instructor_title').html('Add Instructor Information');

        $('#form_instructor').trigger('reset');

        $('#form_instructor').find('input[name="email"]').show();
        $('#form_instructor').find('input[name="dummy_email"]').hide();

        $("#form_instructor :input").prop("disabled", false);

        $('#row-comment').hide();
        $('#row-subjects').hide();

        $('#form_instructor').find('#divFormFooter').show();

        $('#modal_instructorinfo').modal('show');
    });	

/*
 ***********************************************************************************************************************
 *  Load Instructors info into modal for viewing.
 *
 */ 
	$('#tbl_instructors tbody').on( 'click', '.btn-view', function () {
        var id = $(this).data('id');

        $.get(urlInstructor + '/' + id, function (data) {
     		$('#modal_instructor_title').html('Instructor Information (Instructor ID: ' + data.ins_id + ')');

            $('#form_instructor').find('input[name="ins_id"]').val(data.ins_id);
            $('#form_instructor').find('input[name="f_name"]').val(data.f_name);
            $('#form_instructor').find('input[name="l_name"]').val(data.l_name);
            $('#form_instructor').find('input[name="initials"]').val(data.initials);
            $('#form_instructor').find('input[name="init_in_full"]').val(data.init_in_full);
            $('#form_instructor').find('input[name="dob"]').val(data.dob);
            $('#form_instructor').find('input[name="experience"]').val(data.experience);
            $('#form_instructor').find('input[name="qualification"]').val(data.qualification);
            $('#form_instructor').find('input[name="email"]').val(data.email).show();
            $('#form_instructor').find('input[name="dummy_email"]').hide();
            $('#form_instructor').find('input[name="phone"]').val(data.phone);
            $('#form_instructor').find('input[name="address"]').val(data.address);
            $('#form_instructor').find('input[name="comment"]').val(data.comment);
            
            $('#row-comment').show();
            $("#form_instructor :input").prop("disabled", true);

            $('#form_instructor').find('#divFormFooter').hide(); 

            $('#modal_instructorinfo').modal('show');
        }); 

        $('#list-subjects').html('');
        $('#no-subjects').html('');

        $.get(urlInstructor + '/' + id + '/subjects', function (data) {
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
 * Load Instructors info into modal for editing.
 *
 */ 
	$('#tbl_instructors tbody').on( 'click', '.btn-edit', function () {
        action = 'edit';

        var id = $(this).data('id');

        $.get(urlInstructor + '/' + id, function (data) {
            $('#modal_instructor_title').html('Update Instructor Information (Instructor ID: ' + data.ins_id + ')');

            rowId = data.id;

            $('#form_instructor').find('input[name="ins_id"]').val(data.ins_id);
            $('#form_instructor').find('input[name="f_name"]').val(data.f_name);
            $('#form_instructor').find('input[name="l_name"]').val(data.l_name);
            $('#form_instructor').find('input[name="initials"]').val(data.initials);
            $('#form_instructor').find('input[name="init_in_full"]').val(data.init_in_full);
            $('#form_instructor').find('input[name="dob"]').val(data.dob);
            $('#form_instructor').find('input[name="experience"]').val(data.experience);
            $('#form_instructor').find('input[name="qualification"]').val(data.qualification);
            $('#form_instructor').find('input[name="email"]').val(data.email).hide();
            $('#form_instructor').find('input[name="dummy_email"]').val(data.email).show();
            $('#form_instructor').find('input[name="phone"]').val(data.phone);
            $('#form_instructor').find('input[name="address"]').val(data.address);
            $('#form_instructor').find('input[name="comment"]').val(data.comment);

            $("#form_instructor :input").prop("disabled", false);
            $('#form_instructor').find('input[name="dummy_email"]').prop("disabled", true);

            $('#row-comment').hide();
            $('#row-subjects').hide();

            $('#form_instructor').find('#divFormFooter').show(); 

            $('#modal_instructorinfo').modal('show');
        }); 
    });

/*
 ***********************************************************************************************************************
 *  Create new Instructor / update existing Instructor.
 *
 */    
    $("#form_instructor").submit(function(e){
        e.preventDefault();
    });

    $('#form_instructor').parsley().off('field:validated').on('field:validated', function(e) {
        var ok = $('.parsley-error').length === 0;
    })
    .on('form:submit', function(e) {
        errorMsgs = '';

        if(action === 'add') {
        	method = 'POST';
            url = urlInstructor;
        } else {
        	method = 'PUT';
            url = urlUpdateOrDeleteInstructor+rowId;
        }

        $.ajax({
            type: method,
            url: url,
            data: $('#form_instructor').serialize(),
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
                    reload_table();

                    $('#form_instructor').trigger("reset");

                    $('#modal_instructorinfo').modal('hide');
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

/*
 ***********************************************************************************************************************
 *  Delete Instructor.
 *
 */
    $('#tbl_instructors tbody').on('click', '.btn-del', function (event) {
        var id = $(this).data('id');

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            }
        });

        swal({
            icon: "warning",
            title: "Are you sure?",
            text: "Delete this Instructor?",
            buttons: true,
            dangerMode: true,
        })
        .then((isConfirmed) => {
            if (isConfirmed) {
                //var csrf = window.Laravel.csrfToken;

                $.ajax({
                    url: urlUpdateOrDeleteInstructor+id,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    dataType: "JSON",
                    //data: {_method: 'DELETE', _token: csrf},
                    type: "DELETE",
                    success: function(res) {
                        if (res.success) {
                            reload_table();
                            
                            swal({
                                icon: "success",
                                title: "Success!",
                                text: res.msg,
                                button: false,
                                timer: 3000
                            });   
                        }  else  {
                            swal({
                                icon: "error",
                                title: "Error!",
                                text: res.msg,
                                button: "OK"
                            });   
                        }
                    }
                });
            } else {
                swal({
                    icon: "info",
                    title: "Safe!",
                    text: 'Instructor is not deleted.',
                    button: false,
                    timer: 3000
                });
            }
        });         
    });    

/*
 ***********************************************************************************************************************
 *  Reset From Validations when Modal closing.
 *
 */
    $('#modal_instructorinfo').on('hide.bs.modal', function() {
        $('#form_instructor').parsley().reset();
    });

    // Date picker
    $('.inline-datepicker').datepicker({
        todayHighlight: true
    });

/*
 ***********************************************************************************************************************
 *  Reload DataTable Ajax.
 *
 */
    function reload_table() {
        tblInstructor.ajax.reload(null,false);
    }
});	