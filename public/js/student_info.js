/*
 ***********************************************************************************************************************
 ***********************************************************************************************************************
 *  For Student Console - Info.
 *
 */
$(document).ready(function(){
    var urlStudentInfo =  baseUrl+'/student/infomation';
    var id;
    var method;
    var url;
    var urlUpdateStudent = baseUrl+'/admin/students/'
    var errorMsgs = "";

/*
 ***********************************************************************************************************************
 *  Load Students info for view.
 *
 */ 
    load_student_info();

    function load_student_info() {
    	$.get(urlStudentInfo, function (data) {
            id = data.id;

            $('#form_student_info').find('input[name="stu_id"]').val(data.stu_id);
            $('#form_student_info').find('input[name="f_name"]').val(data.f_name);
            $('#form_student_info').find('input[name="l_name"]').val(data.l_name);
            $('#form_student_info').find('input[name="initials"]').val(data.initials);
            $('#form_student_info').find('input[name="init_in_full"]').val(data.init_in_full);
            $('#form_student_info').find('input[name="dob"]').val(data.dob);
            $('#form_student_info').find('input[name="email"]').val(data.email).show();
            $('#form_student_info').find('input[name="dummy_email"]').hide();
            $('#form_student_info').find('input[name="email"]').val(data.email);
            $('#form_student_info').find('input[name="phone"]').val(data.phone);
            $('#form_student_info').find('input[name="address"]').val(data.address);
            $('#form_student_info').find('input[name="guardian_name"]').val(data.guardian_name);
            $('#form_student_info').find('input[name="guardian_phone"]').val(data.guardian_phone);
            $('#form_student_info').find('input[name="comment"]').val(data.comment);

            $("#form_student_info :input").prop("disabled", true);

            $("#div-all-required").hide();
            $("#btn-info-edit").prop("disabled", false);
        });
    }

 /*
 ***********************************************************************************************************************
 *  Enable Instructor info Form for Edit.
 *
 */ 
    $("#btn-info-edit").click(function(){
        $("#form_student_info :input").prop("disabled", false);
        
        $("#div-all-required").css("hidden", false);

        $(this).hide();
        $("#div-all-required").show();
        $("#btn-info-update").show();
    });     

/*
 ***********************************************************************************************************************
 *  Update existing Student.
 *
 */    
    $("#form_student_info").submit(function(e){
        e.preventDefault();
    });

    $('#form_student_info').parsley().off('field:validated').on('field:validated', function(e) {
        var ok = $('.parsley-error').length === 0;
    })
    .on('form:submit', function(e) {
        errorMsgs = '';

       	method = 'PUT';
        url = urlUpdateStudent+id;

        $.ajax({
            type: method,
            url: url,
            data: $('#form_student_info').serialize(),
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
                    
                    $('#form_student_info').trigger("reset");
                    $('#form_student_info').parsley().reset();  

                    $("#btn-info-update").hide();
                    $("#btn-info-edit").show();

                    load_student_info();
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
});	