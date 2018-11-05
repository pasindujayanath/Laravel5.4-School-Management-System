/*
 ***********************************************************************************************************************
 ***********************************************************************************************************************
 *  For Instructor Console - Info.
 *
 */
$(document).ready(function(){
    var urlInstructorInfo =  baseUrl+'/instructor/infomation';
    var id;
    var method;
    var url;
    var urlUpdateInstructor =  baseUrl+'/admin/instructors/';
    var errorMsgs = "";

/*
 ***********************************************************************************************************************
 *  Load Instructor info for View.
 *
 */
    load_instructor_info();

    function load_instructor_info() {    
        $.get(urlInstructorInfo, function (data) {
            id = data.id;

            $('#form_instructor_info').find('input[name="ins_id"]').val(data.ins_id);
            $('#form_instructor_info').find('input[name="f_name"]').val(data.f_name);
            $('#form_instructor_info').find('input[name="l_name"]').val(data.l_name);
            $('#form_instructor_info').find('input[name="initials"]').val(data.initials);
            $('#form_instructor_info').find('input[name="init_in_full"]').val(data.init_in_full);
            $('#form_instructor_info').find('input[name="dob"]').val(data.dob);
            $('#form_instructor_info').find('input[name="experience"]').val(data.experience);
            $('#form_instructor_info').find('input[name="qualification"]').val(data.qualification);
            $('#form_instructor_info').find('input[name="email"]').val(data.email).show();
            $('#form_instructor_info').find('input[name="dummy_email"]').hide();
            $('#form_instructor_info').find('input[name="phone"]').val(data.phone);
            $('#form_instructor_info').find('input[name="address"]').val(data.address);

            $("#form_instructor_info :input").prop("disabled", true);

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
        $("#form_instructor_info :input").prop("disabled", false);

        $(this).hide();
        $("#div-all-required").show();
        $("#btn-info-update").show();
    });  

/*
 ***********************************************************************************************************************
 *  Update Instructor info.
 *
 */ 
    $("#form_instructor_info").submit(function(e){
        e.preventDefault();
    });

    $('#form_instructor_info').parsley().off('field:validated').on('field:validated', function(e) {
        var ok = $('.parsley-error').length === 0;
    })
    .on('form:submit', function(e) {
        errorMsgs = '';

        method = 'PUT';
        url = urlUpdateInstructor+id;

        $.ajax({
            type: method,
            url: url,
            data: $('#form_instructor_info').serialize(),
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
                    
                    $('#form_instructor_info').trigger("reset");
                    $('#form_instructor_info').parsley().reset();  

                    $("#btn-info-update").hide();
                    $("#btn-info-edit").show();

                    load_instructor_info();
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