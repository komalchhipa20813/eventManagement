@extends('frontend.layout.master')
@section('title',"User")
@section('content')
@push('plugin-styles')


<link href="{{ asset('assets/css/jquery.bsPhotoGallery-min.css') }}" rel="stylesheet" />
<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
@endpush
<section id="team" class="team"> 
    <div class="row event-images">
        <div class="col-md-12 col-sm-12 event-back">
            @if(!$data['events']->isEmpty()) 
                <span class="back"><a href="{{ route('events.index') }}"><i class="fa fa-arrow-circle-left " style="font-size:48px;"></i></a></span>
            @endif
        </div>
    @if(!$data['events']->isEmpty())
    <ul class="row first">
     @foreach ($data['events'] as $event)
        <li>
        <div class="col-md-3 col-sm-6 event-images">
            <img class="blog-image" src="{{ asset('images/events/'.$event->image) }}" width="100%" height="280" alt="Blog Image 2"/>
        </div>
    </li>
    @endforeach
    </ul>
    @else
    <div class="title-start col-md-4 col-md-offset-4">
        <br />
        <h2></h2>
        <p class="sub-text text-center">No Image Avaialbe <br>
        <a  class="back-no-image" role="button" href="{{ route('events.index') }}" >Back</a>
    </p>
    </div>
    @endif
   
</div>
</section>

@endsection
@push('plugin-scripts')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></scrip>

@endpush

@push('custom-scripts')

<script src="{{ asset('assets/js/jquery.bsPhotoGallery-min.js') }}"></script>
// <script src="{{ asset('assets/js/src/jquery.bsPhotoGallery.js') }}"></script>

<script>
      $(document).ready(function(){
        $('ul.first').bsPhotoGallery({
          "classes" : "",
          "hasModal" : true,
          "shortText" : false  
        });
      });
    </script>
   

@endpush
