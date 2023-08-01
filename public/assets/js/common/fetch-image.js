load_images();
function load_images()
{
	$.ajax({
        url: aurl + "/event-gallery/show",
        success: function(data) {
            $("#uploaded_image").html(data);
        },
        error: function(request) {
            toaster_message('Something Went Wrong! Please Try Again.', 'error');
        },
    });
}