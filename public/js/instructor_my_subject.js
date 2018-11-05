/*
 ***********************************************************************************************************************
 ***********************************************************************************************************************
 *  For Instructor Console - Subjects - My.
 *
 */ 
$(document).ready(function(){
    var tblSubject;
    var urlAllSubjects =  baseUrl+'/instructor/subjects/selected';
	var urlSubject =  baseUrl+'/admin/subjects';

/*
 ***********************************************************************************************************************
 *  Load Subjects info into DataTable.
 *
 */ 
    tblSubject = $('#tbl_my_subjects').DataTable( {
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
                            </button>`;
                } 
            }
        ]
    });    

/*
 ***********************************************************************************************************************
 *  Load Subjects info into modal for viewing.
 *
 */ 
	$('#tbl_my_subjects tbody').on( 'click', '.btn-view', function () {
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
        
        $('#list-students').html('');
        $('#no-students').html('');

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

});	