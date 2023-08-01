@extends('admin.layout.master')
@section('title',"Event")
@section('content')
@push('plugin-styles')
@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/basic.css') }}" rel="stylesheet" />
@endpush
<div class="quicklink-sidebar-menu ctm-border-radius shadow-sm grow bg-white card">
	<div class="card-body panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title"> Upload Image</h5>
			
		</div>
	</div>
</div>
<div class="row filter-div">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class=" ">
          <div class="col-md-12">
            <div class="mb-3">
              <label for="event_id" class="  control-label">Event </label>
              <select class="form-select form-control select2" id="event_id" name="event_id" placeholder="Select evento">
                @if(!$data['events']->isEmpty())
                <option selected value="0" disabled class="input-cstm">Please Select</option>
                @foreach ($data['events'] as $event)
                <option value="{{ $event->id}}">{{ ucfirst($event->title) }}</option>
                @endforeach
              @else
                <option selected disabled class="input-cstm">Please First Enter Event</option>
              @endif
              </select>
            </div>      
          </div>
          <div class="col-md-12">
            <button type="button" class="btn btn-primary" id="add-image" >Add Image</button>
            <button type="button" class="btn btn-primary" id="filter_image" >Filter</button>
            <button type="button" class="btn btn-primary" id="clear_filter_image" >Clear Filter</button>
          </div>
        </div>  
      </div>
    </div>
  </div>
</div>
<div class="row dropzone_div div-remove" id="dropzone_div">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <form class="dropzone needsclick forms-sample" id="eventdropzoneForm" action="{{route('event-gallery.store')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" class="form-control" id="id" name="id" value="{{ encryptid('0')}}">
        <div class=" ">
          <div class="col-md-12">
            <div class="mb-3">
                <label for="event" class="  control-label">Event  <span class="text-danger"> * </span></label>
                <select class="form-select form-control select2" id="event" name="event" placeholder="Select evento">
                  @if(!$data['events']->isEmpty())
                  <option selected value="0" disabled class="input-cstm">Please Select</option>
                  @foreach ($data['events'] as $event)
                  <option value="{{ $event->id}}">{{ ucfirst($event->title) }}</option>
                  @endforeach
                @else
                  <option selected disabled class="input-cstm">Please First Enter Event</option>
                @endif
                </select>
            </div>      
          </div>
          <div class="col-md-12 " id="qeventdropzoneForm">
            <div class="mb-3 dropzone-upload">
              <div class="dz-message ">    
                Drop files here or click to upload.<BR>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="mb-3">
              <button type="button" class="btn btn-primary submit-all" id="submit-all" >Upload</button>
              <button type="button" class="btn btn-secondary" id="cancel" >Cancel</button>
            </div>    
          </div>
        </div> 
        </form> 
      </div>
    </div>
  </div>
</div>
<div class="quicklink-sidebar-menu ctm-border-radius shadow-sm grow bg-white card">
	<div class="card-body panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title"> Images</h5>
		</div>
		<div class="panel-body" id="uploaded_image">
		</div>
	</div>
</div>

@endsection
@push('plugin-scripts')
 <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.validate.min.js')}}"></script>
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script></script>
  <script src="{{ asset('assets/plugins/dropzone/5.9.3/dropzone.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script src="{{ asset('assets/js/event-gallery/event-gallery.js') }}"></script>
@endpush





