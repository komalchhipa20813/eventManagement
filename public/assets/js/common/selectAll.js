function select_all(obj) {

    if (obj.checked) {
        $(".checkbox").each(function() {
            $(this).prop("checked", "checked");
            $(this).parent().addClass("checked");
        });
    } else {
        $('.checkbox').each(function() {
            this.checked = false;
            $(this).parent().removeClass("checked");
        });
    }
}

function single_unselected(obj)
{
	var i=0;
	var tbl_id= $(obj).parent().parent().parent().parent().attr('id');
	var table = $('#'+tbl_id).dataTable();
	var total_data= table.fnGetData().length;
	var limit=$('select[name="'+ tbl_id+'_length"]').val();
	$(".checkbox:checked").each(function()
  	{
      i++;
  	});

	if(total_data < limit && i == total_data )
	{
		$('#select_all').each(function() {
	        $(this).prop("checked", "checked");
	        $(this).parent().removeClass("checked");
	    });
	}
	else if(i == limit){
		$('#select_all').each(function() {
	        $(this).prop("checked", "checked");
	        $(this).parent().removeClass("checked");
	    });
	}
	else
	{
		$('#select_all').each(function() {
	        this.checked = false;
	        $(this).parent().removeClass("checked");
	    });
	}
	
}