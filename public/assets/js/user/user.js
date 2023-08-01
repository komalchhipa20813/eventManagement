
/*DataTable*/
$("#user_tbl").DataTable({
    aLengthMenu: [
        [10, 30, 50, -1],
        [10, 30, 50, "All"],
    ],
    iDisplayLength: 10,

    ajax: {
        type: "POST",
        url: aurl + "/user/listing",
    },
    columns: [{ data: "0" }, { data: "1" },{ data: "2" }, { data: "3" }],
});

$(document).ready(function() {
    /* Validation Of Bank Form */
    $("#user_form").validate({
        rules: {
            name: {
                required: true,
                user_check: true,
                normalizer: function(value) {
                    return $.trim(value);
                },
            },
            password: {
                required: true,
                minlength: 8,
                pwcheck: true,
            },
            confirmpassword: {
                required: true,
                equalTo: "#password",
            },
             email: {
                required: true,
                email: true,
                userEmailCheck: true,
            },
            role:{
            	required:true,
            }
            
        },

        messages: {
            name: {
                required: "Please Enter User Name.",
            },
            password: {
                required: "Please Enter Password",
                minlength: "Your Password Must Be At Least 8 Characters Long",
                pwcheck: "Please Enter Atleast One Uppercase, Number And Special Character!",
            },
            confirmpassword: {
                required: "This value should not be blank.",
            },
            email: {
                required: "Please Enter Email",
                userEmailCheck: "Email Name Already Exists",
            },
            role:{
            	required:"Please Select User Role",
            }
            
        },
        errorPlacement: function(error, element) {
            if (
                element.parents("div").hasClass("has-feedback") ||
                element.hasClass("select2-hidden-accessible")
            ) {
                error.appendTo(element.parent());
            } else if (
                element.parents("div").hasClass("uploader") ||
                element.hasClass("datepicker")
            ) {
                error.appendTo(element.parent().parent());
            } else {
                error.insertAfter(element);
            }
        },

        highlight: function(element) {
            $(element).removeClass("error");
        },
    });

     $.validator.addMethod("userEmailCheck", function(value) {
        var x = 0;
        var id = $(".id").val();
        var x = $.ajax({
            url: aurl + "/user/user-check",
            type: "POST",
            async: false,
            data: { email: value, id: id },
        }).responseText;
        if (x != 0) {
            return false;
        } else return true;
    });

    $.validator.addMethod("pwcheck", function(value, element) {
            return (
                value.match(/[a-z]/) &&
                value.match(/[A-Z]/) &&
                value.match(/[0-9]/) &&
                value.match(/[_!#@$%^&*]/)
            );
        });

    $.validator.addMethod(
        "user_check",
        function(value) {
            var x = 0;
            var id = $("#id").val();
            var x = $.ajax({
                url: aurl + "/event/event-check",
                type: "POST",
                async: false,
                data: {
                    title: value,
                    id: id,
                },
            }).responseText;
            if (x != 0) {
                return false;
            } else return true;
        },
        "User Already Exists"
    );

    /* Add Bank Modal */
    $("body").on("click", ".add_user", function() {
    	 $(".password").html('<div class="mb-3"><label for="password" class="  control-label">Password <span class="text-danger"> * </span></label> <input type="password" class="form-control" name="password" id="password" autocomplete="off" placeholder="Enter Password"> </div>');
         $(".confirmpassword").html('<div class="mb-3"><label for="confirmpassword" class="  control-label">Confirm Password <span class="text-danger"> * </span></label> <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" autocomplete="off" placeholder="Enter Confirm Password"></div>');
        
         $(".password").show();
         $(".confirmpassword").show();
        $("#user_form").validate().resetForm();
        $("#user_form").trigger("reset");
        $("#user_modal").modal("show");
        $("#id").val($(this).data("id"));
         $(".role").val("0").trigger("change");
        $("#title_user_modal").text("Add User");
        $(".submit_user").text("Add User");
        $(".edituser").html(
            '<input class="switcherye" type="checkbox" id="" name="status" checked >'
        );
         var elems = Array.prototype.slice.call(
            document.querySelectorAll(".switcherye")
        );
        elems.forEach(function(html) {
            var switchery = new Switchery(html);
        });
    });

    /* Adding And Updating Country Modal */
    $(".submit_user").click(function(event) {
        event.preventDefault();
        var form = $("#user_form")[0];
        var formData = new FormData(form);
        if ($("#user_form").valid()) {
            $.ajax({
                url: aurl + "/user",
                type: "POST",
                dataType: "JSON",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#user_modal").modal("hide");
                    toaster_message(data.message, data.icon);
                },
                error: function(request) {
                    toaster_message('Something Went Wrong! Please Try Again.', 'error');
                },
            });
        }
    });

    /* Display Update Country Modal*/
    $("body").on("click", ".edit_user", function(event) {
        var id = $(this).data("id");
        $("#id").val(id);
        event.preventDefault();
        $.ajax({
            url: aurl + "/user/" + id + "/edit",
            type: "GET",
            data: { id: id },
            dataType: "JSON",
            success: function(data) {
                if (data.status) {
                	 $(".password").hide();
         			$(".confirmpassword").hide();
                	$(".password").html('');
                    $(".confirmpassword").html('');

                    $("#user_form").trigger("reset");
                    $("#user_form").validate().resetForm();
                    $("#user_modal").modal("show");
                    $("#title_user_modal").text("Update User");
                    $(".submit_user").text("Update User");
                    $("#name").val(data.data.user.name);
                    $("#email").val(data.data.user.email);
                    $(".role option[value=" + data.data.user.role + "]").prop("selected", true);
                    modal_dropdown();
                    

                    var checked=(data.data.user.status == 1) ? 'checked':'';
                    $(".edituser").html(
                        '<input class="switcherye" type="checkbox" id="" name="status" '+checked+' >'
                    );
                     var elems = Array.prototype.slice.call(
                        document.querySelectorAll(".switcherye")
                    );
                    elems.forEach(function(html) {
                        var switchery = new Switchery(html);
                    });
                } else {
                    toaster_message(data.message, data.icon);
                }
            },
            error: function(request) {
                toaster_message('Something Went Wrong! Please Try Again.', 'error');
            },
        });
    });
});
