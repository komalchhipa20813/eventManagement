Dropzone.options.eventdropzoneForm =
 {
 	autoProcessQueue:false,
 	acceptedFiles:".png,.jpg,.bmp,.jpeg",
 	maxFilesize: 50,
    // method:'POST',
    // url:aurl + "/event-gallery",
 	init:function(){
 		var submitButton=document.querySelector("#submit-all");
 		myDropzpne=this;

 		submitButton.addEventListener('click',function(){

 			if($('#event').val() == null || $('#event').val() == '0')
 			{
 				toaster_message('Please Select Event', 'error');
 			}
 			else
 			{
 				myDropzpne.processQueue();
 			}

 			 
 		});

 		this.on("complete",function(){
 			if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
 			{
 				var _this=this;
 				_this.removeAllFiles();
 				$("#event").val("0").trigger("change");
 				$(".select2").select2();
 			}
 			load_images();
 		});



 	}
};



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

$(document).ready(function() {
	/* Display Update Country Modal*/
    $("body").on("click", ".remove_image", function(event) {
        var id = $(this).data("id");
        var name=$(this).data("name");
        event.preventDefault();

        	 const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger me-2",
            },
            buttonsStyling: false,
        });

        swalWithBootstrapButtons
            .fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true,
            })
            .then((result) => {
                if (result.value) {
       			 $.ajax({
                  type: "post",
                  url: aurl +'/'+currentLocation+"/delete-image",
                  data: {id: id,name:name},
                  dataType: "JSON",
                  success: function(data) {
                  	load_images();
                  },
                  error: function (error) {
                      toaster_message(error,'error'); 
                  }
              });
       			 } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire(
                        "Cancelled",
                        "Your Data Is Safe",
                        "info"
                    );
                }
            });


    });

// Add Image
    $("body").on("click", "#add-image", function(event) {
      event.preventDefault();
      $('.dropzone_div').removeClass('div-remove');
      $('.filter-div').addClass('div-remove');
      $(".select2").select2();
      $("#event").select2();
    });

    //Cancel 
    $("body").on("click", "#cancel", function(event) {
      event.preventDefault();
      $('.dropzone_div').addClass('div-remove');
      $('.filter-div').removeClass('div-remove');
      $(".select2").select2();
    });

    //Cancel 
    $("body").on("click", "#clear_filter_image", function(event) {
      event.preventDefault();
      load_images();
      $("#event_id").val("0").trigger("change");
        $(".select2").select2();
    });

//Filter Image
    $("body").on("click", "#filter_image", function(event) {
      event.preventDefault();
      var event_id=($('#event_id').val() == null) ? '0' : $('#event_id').val() ;
    
       // var event_id=$('#event_id').val();
      if($('#event_id').val() == null)
      {
        toaster_message('Please Select Event.', 'error');
      }
      else
      {
        $.ajax({
            url: aurl + "/event-gallery/event-images",
            type: "POST",
            data: { event_id: event_id },
            dataType: "JSON",
            success: function(data) {

              $("#uploaded_image").html(data.html);
            },
            error: function(request) {
                toaster_message('Something Went Wrong! Please Try Again.', 'error');
            },
        });
      }
        
    });
});