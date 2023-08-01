@extends('admin.layout.master')
@section('title',"Event")
@section('content')
@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush
<div class="quicklink-sidebar-menu ctm-border-radius shadow-sm grow bg-white card">
	<div class="card-body panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title"> Event List</h5>
			<div class="panel-heading mt-20">
            <div class="heading-elements text-end">
				
					<a class="btn btn-primary add_event" data-id="{{ encryptid('0') }}">Add <i class="fa fa-plus" aria-hidden="true"></i></a>
				
					<a class="btn btn-danger btn-sm delete_all" id="delete_selected">Delete <i class="fa fa-trash position-left" aria-hidden="true"></i></a>
                
            </div>
    	</div>
		</div>
	</div>
</div>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive mt-2">
            <table id="event_tbl" class="table" style="width: 98% !important;">
              <thead>
                <tr>
		            <th width="20px"><input type="checkbox" name="select_all" id="select_all" class="styled " onclick="select_all(this);"  ></th>
		            <th>Event Title</th>
		            <th>Event Date</th>
		            <th width="200px">Action</th>
		        </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
<!-- Modal -->

<div class="modal fade addmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="event_modal">
  <div class="modal-dialog modal-dialog-centered">
     <div class="modal-content">
    	<form class="forms-sample" id="event_form">
		@csrf
		<div class="modal-header">
	        <h5 class="modal-title text-center" id="exampleModalLabel">Event Form</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      	</div>
       <div class="modal-body">
	        <div class="row">
				<input type="hidden" class="form-control" id="event_id" name="event_id" value="{{ encryptid('0')}}">
				<div class="col-md-12">
					<div class="mb-3">
						<label for="title" class="  control-label" id="title_Event_modal">Event Image<span class="text-danger"> * </span></label>
						<input type="file" name="file" id="filename_employee" class="form-control">
						<img id="employee_image_preview" class="empimage"  width="120px"><br>
		          	</div>
		      	</div>
	         	<div class="col-md-12">
					<div class="mb-3">
						<label for="title" class="  control-label" id="title_Event_modal">Event Title <span class="text-danger"> * </span></label>
						<input type="text" class="form-control" name="title" id="title" autocomplete="off" placeholder="Enter event title">
		          	</div>
		      	</div>
		      	<div class="col-md-12">
                    <div class="mb-3">
                      <label for="joining_date" class="  control-label">Date <span class="text-danger"> * </span></label>
                      <div class="input-group">
                      	<input type="text" name="event_date"  class="form-control datepicker " autocomplete="off" id="event_date" value="">
                      <span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>

                      </div>
                    </div>
                  </div>
		      	<div class="col-md-6">
		          	<div class="mb-3">
			            <label for="postal_code" class="  control-label">Status</label>
			            <div class="switchery-sm editevent">
		                    <input class="switchery" type="checkbox" id="" name="status" checked onchange="onchenagecheck(this);">
		                </div>
		          </div>
		      </div>
	      </div>
	  	</div>
  		<div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
	        <button type="button" id="submit_event" class="btn btn-primary submit_event">Save</button>
      	</div>
	</form>
    </div>
  </div>
</div>

@endsection
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
   <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/forms/styling/switchery.min.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.validate.min.js')}}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/select2.js') }}"></script>
  <script src="{{ asset('assets/js/common/selectAll.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
  <script src="{{ asset('assets/js/event/event.js') }}"></script>
  <script src="{{ asset('assets/js/common/custom.js') }}"></script>
@endpush
