/*
 ***********************************************************************************************************************
 ***********************************************************************************************************************
 *  For Student Console - Subjects - All.
 *
 */  
$(document).ready(function(){
    var tblSubject;
    var urlAllSubjects =  baseUrl+'/admin/subjects/all';
	var urlSubject =  baseUrl+'/admin/subjects';

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
    });
});	