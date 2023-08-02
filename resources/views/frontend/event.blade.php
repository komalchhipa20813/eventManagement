@extends('frontend.layout.master')
@section('title',"User")
@section('content')

<section id="" class=""> 

<div class="row events">
        <div class="col-md-12 col-sm-12 events-back">
            @if(!$data['events']->isEmpty()) 
                <!-- <span class="back"><a href="{{ route('events.index') }}"><i class="fa fa-arrow-circle-left " style="font-size:48px;"></i></a></span> -->
                <span class="back">
                <div class="btn-group">
                    <a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list"></span>List</a> 
                    <a href="#" id="grid" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th"></span>Grid</a>
                </div>
                </span>
            @endif
        </div>
    @if(!$data['events']->isEmpty())
     @foreach ($data['events'] as $event)
     
     <div class="col-md-2 col-sm-2">
        <a href="{{ route('events.images',encryptid($event->id)) }}">
            <img  src="{{ asset('images/events/thumnail/'.$event->image) }}" width="100%" height="130" alt="Blog Image 2"/>
            
            <p class="name-member">{{ ucwords($event->title)}}</p>
        </a>
    </div>
    
    @endforeach
    @endif
</div>
<div class="row list-event list-group-div" style="background-color: white;">
    @php 
     $class_col_md=($data['count'] > 10) ? "col-md-3" : "col-md-6";
     $class_col_sm=($data['count'] > 10) ? "col-sm-2" : "col-sm-3";
    @endphp
    @if(!$data['events']->isEmpty())
     @foreach ($data['events'] as $event)
    <div class="{{$class_col_md}} {{$class_col_sm}} " style="padding-top: 10px;">
        <div class="md-3 ">
        <a href="{{ route('events.images',encryptid($event->id)) }}">
        <img  src="{{ asset('images/events/thumnail/'.$event->image) }}" width="20px" height="20px" alt="Blog Image 2"/>
        <p class="" style="padding-left: 11px;    display: inline !important;">{{ ucwords($event->title)}}</p>
        </a>
        </div>
    </div>
    
    @endforeach
    @endif
</div>
</section>

@endsection