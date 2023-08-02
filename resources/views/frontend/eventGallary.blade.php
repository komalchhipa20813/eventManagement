@extends('frontend.layout.master')
@section('title',"User")
@section('content')
@push('plugin-styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
<style type="text/css">
    .gallery
    {
        display: inline-block;
        margin-top: 20px;
    }
   
    .form-image-upload{
        background: #e8e8e8 none repeat scroll 0 0;
        padding: 15px;
    }
    
    </style>
@endpush
<section id="team" class="team"> 
    <div class="row event-images">
        <div class="col-md-12 col-sm-12 event-back">
            @if(!$data['events']->isEmpty()) 
                <span class="back"><a href="{{ route('events.index') }}"><i class="fa fa-arrow-circle-left " style="font-size:48px;"></i></a></span>
            @endif
        </div>
    @if(!$data['events']->isEmpty())
    
    <div class="row ">
     @foreach ($data['events'] as $event)
        
        <div class="col-md-3 col-sm-6 event-images">
        <a class="thumbnail fancybox image" data-fancybox="gallery"  rel="ligthbox" href="{{ asset('images/events/'.$event->image) }}">
            <img class="event-blog-image img-responsive" src="{{ asset('images/events/'.$event->image) }}" width="100%" height="280" alt="Blog Image 2"/>
        </a>
        </div>
    
    @endforeach
    </div>
    @else
    <div class="title-start col-md-12 col-md-offset-12">
        <br />
        <h2></h2>
        <p class="sub-text text-center">No Image Avaialbe <br>
        <a  class="back-no-image image" role="button" href="{{ route('events.index') }}" >Back</a>
    </p>
    </div>
    @endif
   
</div>
</section>

@endsection
@push('plugin-scripts')

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<script src="{{ asset('assets/js/jquery.fancybox.min.js') }}"></script>

@endpush

@push('custom-scripts')
<script type="text/javascript">
    $(document).ready(function(){
//         Fancybox.bind("[data-fancybox]", {
//     // Your custom options
// });
        $(".fancybox").fancybox({

            idleTime  : false,
                baseClass : 'fancybox-custom-layout',
                margin    : 0,
                gutter    : 0,
                infobar   : false,
                thumbs    : {
                    hideOnClose : false,
                    parentEl    : '.fancybox-outer'
                },
                touch : {
                    vertical : false
                },
                // buttons : [
                //     'close',
                //     'thumbs',
                //     'share'
                // ],
                animationEffect   : "fade",
                animationDuration : 300,
                onInit : function( instance ) {
                    // Create new wrapping element, it is useful for styling
                    // and makes easier to position thumbnails
                    instance.$refs.inner.wrap( '<div class="fancybox-outer"></div>' );
                },
                caption : function(instance, item) {
                    return '<h3>Collection #162 – <br /> The Histographer</h3><p>This collection of photos, curated by The Histographer, is a collection around the concept of \'Autumn is here\'.</p><p><a href="https://unsplash.com/collections/curated/162" target="_blank">unsplash.com</a></p>';
                }
                                    });
    });
</script>

   

@endpush
