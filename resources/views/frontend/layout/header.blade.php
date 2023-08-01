<header id="header">
    <div id="menu" class="header-menu sticky">
        <div class="box">
            <div class="row">
                <nav role="navigation" class="col-sm-12">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!--== Logo ==-->
                        <span class="navbar-brand logo">
                           Events
                        </span>

                    </div>
                    <div class="navbar-collapse collapse">

                        <!--== Navigation Menu ==-->
                        <ul class="nav navbar-nav">
                            <li class="{{ active_class(['/']) }}"><a href="{{ route('home')}}">Home</a></li>
                            <li class="{{ active_class(['/']) }}"> </li>
                            <li class="{{ active_class(['events','events/*']) }}"><a href="{{route('events.index')}}">Event</a></li>
                            <li class="{{ active_class(['about-us']) }}"><a href="{{route('about-us.index')}}">About Us</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    @php 
    use Carbon\Carbon;
   
    @endphp
    @if(Request::segment(1) == '')
    <!--== Site Description ==-->
    <div class="header-cta">
        <div class="container">
            <div class="row">
                <div class="entry-content">
                    @if(!empty(getUpComingEventData()))
                    <p>{{Request::segment(1)}}</p>
                    <p><span class="start-text"><b>From THE {{Carbon::parse(getUpComingEventData()->date)->format('d F y')}}</b></span></p>
                    <h4 class="entry-title"><a href="#">{{getUpComingEventData()->title}}</a></h4>
                    <!-- <h5><span><b>Schrodinger confirms that Germany international ...</b></span></h5> -->
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="header-bg">
        <div id="preloader">
            <div class="preloader"></div>
        </div>
        <div class="main-slider" id="main-slider">
            <!--== Main Slider  ==-->
            <ul class="slides">
                <li><img src="{{ asset('assets/images/evento/demo/bg-slide-01.jpg') }}" alt="Slide Image"/></li>
                <li><img src="{{ asset('assets/images/evento/demo/bg-slide-02.jpg') }}" alt="Slide Image 2"/></li>
            </ul>

        </div>
    </div>
    @endif

    

</header>