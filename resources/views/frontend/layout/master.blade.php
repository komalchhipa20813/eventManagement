<!DOCTYPE html>
<html lang="en">
	
<head>
		<title>Event - Landing Page</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>  
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="description" content="">
        <title>@yield('title') | Event Management System</title>

		<!--== CSS Files ==-->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
        <!-- <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" /> -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/font-awesome.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/owl.carousel.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/flexslider.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/fancySelect.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" />
		
		<!--== Google Fonts ==-->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Belgrano' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Dosis' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
		@stack('plugin-styles')
	</head>
	<body>
        @include('frontend.layout.header')
        <div class="content">
            <div class="container box">
                @yield('content')
            </div>
		</div>
        @include('frontend.layout.footer')
      
        <!--== Javascript Files ==-->
		
		<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
		<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
		<script   src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
  crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


        <!-- <script src="{{ asset('assets/js/jquery-2.1.0.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script> -->
	
        <script src="{{ asset('assets/js/jquery.scrollTo.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.nav.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.flexslider.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.accordion.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.placeholder.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.fitvids.js') }}"></script>
        <script src="{{ asset('assets/js/gmap3.js') }}"></script>
        <script src="{{ asset('assets/js/fancySelect.js') }}"></script>
        <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
		@stack('plugin-scripts')
        <script src="{{ asset('assets/js/main.js') }}"></script>
		

    <script>
		$(document).ready(function() {
 
		//   $("#testimonial-container").owlCarousel({
		 
		//       navigation : false, // Show next and prev buttons
		//       slideSpeed : 700,
		//       paginationSpeed : 400,
		//       singleItem:true,
		//   });
 
		});
		</script>
		<!-- url -->
	   <script type="text/javascript">
	     var aurl = {!! json_encode(url('/')) !!}
	     /* Ajax Set Up */
	     $.ajaxSetup({
	          headers: {
	              "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content"),
	          },
	      });
	   </script>
    @stack('custom-scripts')
    </body>
</html>