/*
 ***********************************************************************************************************************
 ***********************************************************************************************************************
 *  For Admin Console - Subjects.
 *
 */ 
$(document).ready(function(){
    var tblSubject;
	var action;
    var urlAllSubjects =  baseUrl+'/admin/subjects/all';
	var urlSubject =  baseUrl+'/admin/subjects';
	var method;
	var url;
	var rowId;
	var urlUpdateOrDeleteSubject = baseUrl+'/admin/subjects/'
    var errorMsgs = "";

/*
 ***********************************************************************************************************************
 *  Load Subjects info into DataTable.
 *
 */ 
    tblSubject = $('#tbl_subjects').DataTable( {
        "processing"    : true,
        "serverSide"    : false,
        "responsive"    : true,
        "ajax"          : {
            "url"       : urlAllSubjects,
            "type"      : "GET"
        },
        "columns": [
            { data: 'sbj_id' },
            { data: 'code' },
            { data: 'name' },
            { data: 'year' },
            { data: 'semester' },
            { data: 'periods' }
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
 *  Load Subjects info into modal for Adding.
 *
 */ 
	$('#btnAddSubject').click(function(){
		action = 'add';

        $('#modal_subject_title').html('Add Subject Information');

        $('#form_subject').trigger('reset');

        $("#form_subject :input").prop("disabled", false);

        $('#row-instructors').hide();
        $('#row-students').hide();

        $('#form_subject').find('#divFormFooter').show();

        $('#modal_subjectinfo').modal('show');
    });	

/*
 ***********************************************************************************************************************
 *  Load Subjects info into modal for viewing.
 *
 */ 
	$('#tbl_subjects tbody').on( 'click', '.btn-view', function () {
        var id = $(this).data('id');

        $.get(urlSubject + '/' + id, function (data) {
     		$('#modal_subject_title').html('Subject Information (Subject ID: ' + data.sbj_id + ')');

            $('#form_subject').find('input[name="sbj_id"]').val(data.sbj_id);
            $('#form_subject').find('input[name="code"]').val(data.code);
            $('#form_subject').find('input[name="name"]').val(data.name);
            $('#form_subject').find('input[name="year"]').val(data.year);
            $('#form_subject').find('input[name="semester"]').val(data.semester);
            $('#form_subject').find('input[name="periods"]').val(data.periods);

            $("#form_subject :input").prop("disabled", true);

            $('#form_subject').find('#divFormFooter').hide(); 

            $('#modal_subjectinfo').modal('show');
        });

        $('#list-instructors').html('');
        $('#no-instructors').html('');
        $('#list-students').html('');
        $('#no-students').html('');

        $.get(urlSubject + '/' + id + '/instructors', function (data) {
            if (data.length != 0) {
                $('#row-instructors').show();
                console.log(data);
                
                jQuery.each( data, function( i, val ) {
                    $('#list-instructors').append('<li>' + val.ins_id + ' - ' + val.f_name + ' ' + val.l_name + '</li>');
                });
            } else {
                $('#row-instructors').show();
                $('#list-instructors').append('');
                $('#no-instructors').html('No instructors are selected yet.');
            }    
        });

        $.get(urlSubject + '/' + id + '/students', function (data) {
            if (data.length != 0) {
                $('#row-students').show();
                console.log(data);
                jQuery.each( data, function( i, val ) {
                    $('#list-students').append('<li>' + val.stu_id + ' - ' + val.f_name + ' ' + val.l_name + '</li>');
                });
            } else {
                $('#row-students').show();
                $('#list-students').append('');
                $('#no-students').html('No students are selected yet.');
            }    
        });
    });

/*
 ***********************************************************************************************************************
 * Load Subjects info into modal for editing.
 *
 */ 
	$('#tbl_subjects tbody').on( 'click', '.btn-edit', function () {
        action = 'edit';

        var id = $(this).data('id');

        $.get(urlSubject + '/' + id, function (data) {
            $('#modal_subject_title').html('Update Subject Information (Subject ID: ' + data.sbj_id + ')');

            rowId = data.id;

            $('#form_subject').find('input[name="sbj_id"]').val(data.sbj_id);
            $('#form_subject').find('input[name="code"]').val(data.code);
            $('#form_subject').find('input[name="name"]').val(data.name);
            $('#form_subject').find('input[name="year"]').val(data.year);
            $('#form_subject').find('input[name="semester"]').val(data.semester);
            $('#form_subject').find('input[name="periods"]').val(data.periods);

            $("#form_subject :input").prop("disabled", false);

            $('#row-instructors').hide();
            $('#row-students').hide();

            $('#form_subject').find('#divFormFooter').show(); 

            $('#modal_subjectinfo').modal('show');
        });
    });

/*
 ***********************************************************************************************************************
 *  Create new Subject / update existing Subject.
 *
 */    
    $("#form_subject").submit(function(e){
        e.preventDefault();
    });

    $('#form_subject').parsley().off('field:validated').on('field:validated', function(e) {
        var ok = $('.parsley-error').length === 0;
    })
    .on('form:submit', function(e) {
        errorMsgs = '';

        if(action === 'add') {
        	method = 'POST';
            url = urlSubject;
        } else {
        	method = 'PUT';
            url = urlUpdateOrDeleteSubject+rowId;
        }

        $.ajax({
            type: method,
            url: url,
            data: $('#form_subject').serialize(),
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

                    $('#form_subject').trigger("reset");

                    $('#modal_subjectinfo').modal('hide');
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
 *  Delete Subject.
 *
 */
    $('#tbl_subjects tbody').on('click', '.btn-del', function (event) {
        var id = $(this).data('id');

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            }
        });

        swal({
            icon: "warning",
            title: "Are you sure?",
            text: "Delete this Subject?",
            buttons: true,
            dangerMode: true,
        })
        .then((isConfirmed) => {
            if (isConfirmed) {
                $.ajax({
                    url: urlUpdateOrDeleteSubject+id,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    dataType: "JSON",
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
                    text: 'Subject is not deleted.',
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
    $('#modal_subjectinfo').on('hide.bs.modal', function() {
        $('#form_subject').parsley().reset();
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
        tblSubject.ajax.reload(null,false);
    }    
});	