@extends('frontend.layout.master')
@section('title',"User")
@section('content')

<section id="" class=""> 
<div class="row events">
<div class="col-md-12 col-sm-12 events-back">
            @if(!$data['events']->isEmpty()) 
                <span class="back">
                    <div class="">
                        <button onClick="listGrid('list');"  id="list" class="btn btn-dark btn-sm"><i class="fa fa-list" aria-hidden="true"></i> List</button> 
                        <button onClick="listGrid('grid');" id="grid" class="btn btn-dark btn-sm"><span class="glyphicon glyphicon-th"></span><i class="fa fa-th"></i> Grid</button> 
                    </div>

                </span>
            @endif
        </div>
</div>
<div class="row grid-events">
    @if(!$data['events']->isEmpty())
     @foreach ($data['events'] as $event)
     
     <div class="col-md-2 col-sm-2">
        <a href="{{ route('events.images',encryptid($event->id)) }}">
            <img  src="{{ asset('images/events/thumnail/'.$event->image) }}" width="100%" height="130" alt="Blog Image 2"/>
            
            <p class="name-member" data-toggle="tooltip" data-placement="top" title="{{ ucwords($event->title)}}">{{ ucwords($event->title)}}</p>
        </a>

        
    </div>
    
    @endforeach
    @endif
</div>
<div class="row list-event list-group-div" style="background-color: white;">
    @php 
     $class_col_md=($data['count'] > 10) ? "col-md-4" : "col-md-6";
     $class_col_sm=($data['count'] > 10) ? "col-sm-2" : "col-sm-3";
    @endphp
    @if(!$data['events']->isEmpty())
     @foreach ($data['events'] as $event)
    <div class="{{$class_col_md}} {{$class_col_sm}} " style="padding-top: 10px;">
        <div class="row ">
            <div class="col-md-3 col-sm-3">
                <a href="{{ route('events.images',encryptid($event->id)) }}">
                    <img  src="{{ asset('images/events/thumnail/'.$event->image) }}" width="100%" height="40px" alt="Blog Image 2"/>
                </a>
            </div>
            <div class="col-md-9 col-sm-9">
                <p class="list-event-text"  data-toggle="tooltip" data-placement="top" title="{{ ucwords($event->title)}}"><a href="{{ route('events.images',encryptid($event->id)) }}">{{ucwords($event->title)}}</a></p>
                            
            </div>
      
        </div>
    </div>
    
    @endforeach
    @endif
</div>
</section>

@endsection
@push('custom-scripts')
<script>
    function listGrid(obj)
    {
        if(obj == 'list')
        {
            $('.grid-events').addClass('list-group-div');
            $('.list-event').removeClass('list-group-div');

        }
        else if(obj == 'grid')
        {
            $('.list-event').addClass('list-group-div'); 
            $('.grid-events').removeClass('list-group-div');
        }

    }
    </script>
@endpush