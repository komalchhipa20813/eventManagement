$(document).ready(function() {
    feather.replace();
    $("body").on("click", ".delete", function(event) {
        event.preventDefault();
        var id = $(this).data("id");
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
                        type: "DELETE",
                        url: aurl + "/" + currentLocation + "/{" + id + "}",
                        success: function(data) {
                            toaster_message(
                                data.message,
                                data.icon,
                                data.redirect_url
                            );
                        },
                        error: function(request) {
                            toaster_message(
                                "Something Went Wrong! Please Try Again.",
                                "error"
                            );
                        },
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
});

$('body').on("click", ".delete_all", function(event){
  event.preventDefault();
  var ids = new Array();
  $(".checkbox:checked").each(function()
  {
      var id = $(this).attr('id');
      ids.push(id);
  });
  if(ids.length == 0)
  {
      error_toaster_message('Please select records','error',''); 
  }
  else
  {
      const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger me-2'
      },
      buttonsStyling: false,
      })

      swalWithBootstrapButtons.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true
      }).then((result) => {
          if (result.value) {
              $.ajax({
                  type: "post",
                  url: aurl +'/'+currentLocation+"/delete-all",
                  data: {ids: ids},
                  dataType: "JSON",
                  success: function(data) {
                      $('#select_all').each(function() {
                        this.checked = false;
                        $(this).parent().removeClass("checked");
                    });
                      toaster_message(data.message,data.icon);
                  },
                  error: function (error) {
                      toaster_message(error,'error'); 
                  }
              });
          } else if (result.dismiss === Swal.DismissReason.cancel){
              toaster_message('Cancle deleting','error');
          }
      });
  }
});