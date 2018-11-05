/*
 ***********************************************************************************************************************
 ***********************************************************************************************************************
 *  For Admin Console - Classes.
 *
 */ 
$(document).ready(function(){
    var tblClassroom;
	var action;
    var urlAllClassrooms =  baseUrl+'/admin/classrooms/all';
	var urlClassroom =  baseUrl+'/admin/classrooms';
	var method;
	var url;
	var rowId;
	var urlUpdateOrDeleteClassroom = baseUrl+'/admin/classrooms/'
    var errorMsgs = "";

/*
 ***********************************************************************************************************************
 *  Load Classrooms info into DataTable.
 *
 */ 
    tblClassroom = $('#tbl_classroom').DataTable( {
        "processing"    : true,
        "serverSide"    : false,
        "responsive"    : true,
        "ajax"          : {
            "url"       : urlAllClassrooms,
            "type"      : "GET"
        },
        "columns": [
            { data: 'cls_id' },
            { data: 'code' },
            { data: 'name' },
            { data: 'year' },
            { data: 'semester' },
            { data: 'floor' },
            { data: 'room' },
            { data: 'capacity' }
        ],
        "columnDefs"    : [
            { 
                className: "align-center",
                "targets": [8],
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
 *  Load Classrooms info into modal for Adding.
 *
 */ 
	$('#btnAddClassroom').click(function(){
		action = 'add';

        $('#modal_classroom_title').html('Add Classroom Information');

        $('#form_classroom').trigger('reset');

        $("#form_classroom :input").prop("disabled", false);

        $('#form_classroom').find('#divFormFooter').show();

        $('#modal_classroominfo').modal('show');
    });	

/*
 ***********************************************************************************************************************
 *  Load Classrooms info into modal for viewing.
 *
 */ 
	$('#tbl_classroom tbody').on( 'click', '.btn-view', function () {
        var id = $(this).data('id');

        $.get(urlClassroom + '/' + id, function (data) {
     		$('#modal_classroom_title').html('Classroom Information (Classroom ID: ' + data.cls_id + ')');

            $('#form_classroom').find('input[name="cls_id"]').val(data.cls_id);
            $('#form_classroom').find('input[name="code"]').val(data.code);
            $('#form_classroom').find('input[name="name"]').val(data.name);
            $('#form_classroom').find('input[name="year"]').val(data.year);
            $('#form_classroom').find('input[name="semester"]').val(data.semester);
            $('#form_classroom').find('input[name="floor"]').val(data.floor);
            $('#form_classroom').find('input[name="room"]').val(data.room);
            $('#form_classroom').find('input[name="capacity"]').val(data.capacity);

            $("#form_classroom :input").prop("disabled", true);

            $('#form_classroom').find('#divFormFooter').hide(); 

            $('#modal_classroominfo').modal('show');
        }); 
    });

/*
 ***********************************************************************************************************************
 * Load Classrooms info into modal for editing.
 *
 */ 
	$('#tbl_classroom tbody').on( 'click', '.btn-edit', function () {
        action = 'edit';

        var id = $(this).data('id');

        $.get(urlClassroom + '/' + id + '/edit', function (data) {
            $('#modal_classroom_title').html('Update Classroom Information (Classroom ID: ' + data.cls_id + ')');

            rowId = data.id;

            $('#form_classroom').find('input[name="cls_id"]').val(data.cls_id);
            $('#form_classroom').find('input[name="code"]').val(data.code);
            $('#form_classroom').find('input[name="name"]').val(data.name);
            $('#form_classroom').find('input[name="year"]').val(data.year);
            $('#form_classroom').find('input[name="semester"]').val(data.semester);
            $('#form_classroom').find('input[name="floor"]').val(data.floor);
            $('#form_classroom').find('input[name="room"]').val(data.room);
            $('#form_classroom').find('input[name="capacity"]').val(data.capacity);
            $("#form_classroom :input").prop("disabled", false);

            $('#form_classroom').find('#divFormFooter').show(); 

            $('#modal_classroominfo').modal('show');
        });
    });

/*
 ***********************************************************************************************************************
 *  Create new Classroom / update existing Classroom.
 *
 */    
    $("#form_classroom").submit(function(e){
        e.preventDefault();
    });

    $('#form_classroom').parsley().off('field:validated').on('field:validated', function(e) {
        var ok = $('.parsley-error').length === 0;
    })
    .on('form:submit', function(e) {
        errorMsgs = '';

        if(action === 'add') {
        	method = 'POST';
            url = urlClassroom;
        } else {
        	method = 'PUT';
            url = urlUpdateOrDeleteClassroom+rowId;
        }

        $.ajax({
            type: method,
            url: url,
            data: $('#form_classroom').serialize(),
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

                    $('#form_classroom').trigger("reset");

                    $('#modal_classroominfo').modal('hide');
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
 *  Delete Classroom.
 *
 */
    $('#tbl_classroom tbody').on('click', '.btn-del', function (event) {
        var id = $(this).data('id');

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            }
        });

        swal({
            icon: "warning",
            title: "Are you sure?",
            text: "Delete this Classroom?",
            buttons: true,
            dangerMode: true,
        })
        .then((isConfirmed) => {
            if (isConfirmed) {
                $.ajax({
                    url: urlUpdateOrDeleteClassroom+id,
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
                    text: 'Classroom is not deleted.',
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
    $('#modal_classroominfo').on('hide.bs.modal', function() {
        $('#form_classroom').parsley().reset();
    });

/*
 ***********************************************************************************************************************
 *  Reload DataTable Ajax.
 *
 */
    function reload_table() {
        tblClassroom.ajax.reload(null,false);
    }    
});	