/*
 ***********************************************************************************************************************
 ***********************************************************************************************************************
 *  For Instructor Console & Student Console - Classes.
 *
 */ 
$(document).ready(function(){
    var tblClassroom;
    var action;
    var urlAllClassrooms =  baseUrl+'/admin/classrooms/all';
    var urlClassroom =  baseUrl+'/admin/classrooms';
 
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
                            </button>`;
                } 
            }
        ]
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
        }) 
    }); 
}); 