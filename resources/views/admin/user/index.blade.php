@extends('admin.layout.master')
@section('title',"User")
@section('content')
@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush
<div class="quicklink-sidebar-menu ctm-border-radius shadow-sm grow bg-white card">
	<div class="card-body panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title"> Users List</h5>
			<div class="panel-heading mt-20">
            <div class="heading-elements text-end">
				
					<a class="btn btn-primary add_user" data-id="{{ encryptid('0') }}">Add <i class="fa fa-plus" aria-hidden="true"></i></a>
				
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
            <table id="user_tbl" class="table" style="width: 98% !important;">
              <thead>
                <tr>
		            <th width="20px"><input type="checkbox" name="select_all" id="select_all" class="styled " onclick="select_all(this);"  ></th>
		            <th>Name</th>
		            <th>Designation</th>
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

<div class="modal fade select addmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="user_modal">
  <div class="modal-dialog modal-lg">
     <div class="modal-content">
    	<form class="forms-sample" id="user_form">
		@csrf
		<div class="modal-header">
	        <h5 class="modal-title text-center" id="title_user_modal">User Form</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      	</div>
       <div class="modal-body">
	        <div class="row">
				<input type="hidden" class="form-control id" id="id" name="id" value="{{ encryptid('0')}}">

	         	<div class="col-md-6">
					<div class="mb-3">
						<label for="name" class="  control-label" id="title_user">User Name <span class="text-danger"> * </span></label>
						<input type="text" class="form-control" name="name" id="name" autocomplete="off" placeholder="Enter user name">
		          	</div>
		      	</div>
            <div class="col-md-6">
                  <div class="mb-3">
                      <label for="email" class="  control-label">Email <span class="text-danger"> * </span></label>
                      <input type="email" class="form-control" name="email" value="" id="email" placeholder="Enter Email">
                  </div>
            </div>
            <div class="col-md-6 password">
                <div class="mb-3">
                    <label for="password" class="  control-label">Password <span class="text-danger"> * </span></label>
                    <input type="password" class="form-control" name="password" id="password" autocomplete="off" placeholder="Enter Password">
                </div>
            </div>
            <div class="col-md-6 confirmpassword">
                <div class="mb-3">
                    <label for="confirmpassword" class="  control-label">Confirm Password <span class="text-danger"> * </span></label>
                    <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" autocomplete="off" placeholder="Enter Confirm Password">
                </div>
            </div>
            <div class="col-md-6 mb-3">
            <label class="form-label">Designation</label>
            <select class="select_dropdown form-select role " id="role" data-width="100%" name="role" >
                <option value="0" selected disabled>Please Select</option>
                <option value="2">HR</option>
                <option value="3">Supporter</option>
            </select>
          </div>
		      	<div class="col-md-6">
		          	<div class="mb-3">
			            <label for="postal_code" class="  control-label">Status</label>
			            <div class="switchery-sm edituser">
		                    <input class="switchery" type="checkbox" id="" name="status" checked onchange="onchenagecheck(this);">
		                </div>
		          </div>
		      </div>
	      </div>
	  	</div>
  		<div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
	        <button type="button" id="submit_user" class="btn btn-primary submit_user">Save</button>
      	</div>
	</form>
    </div>
  </div>
</div>

@endsection
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.validate.min.js')}}"></script>
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/forms/styling/switchery.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/select2.js') }}"></script>
  <script src="{{ asset('assets/js/common/selectAll.js') }}"></script>
  <script src="{{ asset('assets/js/user/user.js') }}"></script>
  <script src="{{ asset('assets/js/common/custom.js') }}"></script>
@endpush
