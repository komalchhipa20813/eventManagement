@extends('frontend.layout.master')
@section('title',"User")
@section('content')
<section id="" class=""> 
<div class="row events">
    @if(!$data['events']->isEmpty())
     @foreach ($data['events'] as $event)
     
     <div class="col-md-3 col-sm-6">
        <a href="{{ route('events.images',encryptid($event->id)) }}">
            <img  src="{{ asset('images/events/thumnail/'.$event->image) }}" width="100%" height="280" alt="Blog Image 2"/>
            
            <p class="name-member">{{ ucwords($event->title)}}</p>
        </a>
    </div>
    
    @endforeach
    @endif
    
   
   
    
   
   
   
</div>
</section>

@endsection