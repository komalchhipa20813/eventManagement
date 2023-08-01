
/*DataTable*/
$("#event_tbl").DataTable({
    aLengthMenu: [
        [10, 30, 50, -1],
        [10, 30, 50, "All"],
    ],
    iDisplayLength: 10,

    ajax: {
        type: "POST",
        url: aurl + "/event/listing",
    },
    columns: [{ data: "0" }, { data: "1" },{ data: "2" }, { data: "3" }],
});

$(document).ready(function() {

    $('#filename_employee').change(function(events){
        var tmppath=URL.createObjectURL(events.target.files[0]);
        $(".empimage").fadeIn("fast").attr('src',URL.createObjectURL(events.target.files[0]));
  });

    /* Validation Of Bank Form */
    $("#event_form").validate({
        rules: {
            title: {
                required: true,
                event_check: true,
                normalizer: function(value) {
                    return $.trim(value);
                },
            },
            event_date:{
                required: true,
            }
        },

        messages: {
            title: {
                required: "Please enter event title.",
            },
            event_date:{
                required: "Please select event date.",
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

    $.validator.addMethod(
        "event_check",
        function(value) {
            var x = 0;
            var id = $("#event_id").val();
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
        "Event Already Exists"
    );

    /* Add Bank Modal */
    $("body").on("click", ".add_event", function() {
        $("#event_form").validate().resetForm();
        $("#event_form").trigger("reset");
        $("#event_modal").modal("show");
        $("#event_id").val($(this).data("id"));
        $("#title_event_modal").text("Add Event");
        $(".submit_event").text("Add Event");
        $('.empimage').attr('src','');
        $(".editevent").html(
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
    $(".submit_event").click(function(event) {
        event.preventDefault();
        var form = $("#event_form")[0];
        var formData = new FormData(form);
        if ($("#event_form").valid()) {
            $.ajax({
                url: aurl + "/event",
                type: "POST",
                dataType: "JSON",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#event_modal").modal("hide");
                    toaster_message(data.message, data.icon);
                },
                error: function(request) {
                    toaster_message('Something Went Wrong! Please Try Again.', 'error');
                },
            });
        }
    });

    /* Display Update Country Modal*/
    $("body").on("click", ".edit_event", function(event) {
        var id = $(this).data("id");
        $("#event_id").val(id);
        event.preventDefault();
        $.ajax({
            url: aurl + "/event/" + id + "/edit",
            type: "GET",
            data: { id: id },
            dataType: "JSON",
            success: function(data) {
                if (data.status) {
                    $("#event_form").trigger("reset");
                    $("#event_form").validate().resetForm();
                    $("#event_modal").modal("show");
                    $("#title_event_modal").text("Update event");
                    $(".submit_event").text("Update Event");
                    $("#title").val(data.data.event.title);
                    $('#event_date').val(data.date);
                    $('.empimage').attr('src',aurl+'/images/events/thumnail/'+data.data.event.image);
                    var checked=(data.data.event.status == 1) ? 'checked':'';
                    $(".editevent").html(
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
