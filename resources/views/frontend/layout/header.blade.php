<header id="header">
    <div id="menu" class="header-menu sticky">
        <div class="box">
            <div class="row">
                <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
                    <div class="container-fluid navbar-brand">
                        <a class="navbar-brand navbar-brand-text" >Event</a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                            <a class="nav-link {{ active_class(['/']) }}" aria-current="page" href="{{route('home')}}">Home</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link {{ active_class(['events','events/*']) }}" aria-current="page" href="{{route('events.index')}}">Event</a>
                            </li>
                            
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Dropdown
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link {{ active_class(['about-us']) }}" aria-current="page" href="{{route('about-us.index')}}">About Us</a>
                            </li>
                        </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    @php 
    use Carbon\Carbon;
   
    @endphp
    @if(Request::segment(1) == '')
    <div id="demo" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
        </div>
            <div class="carousel-item active">
                <img src="{{ asset('assets/images/evento/demo/bg-slide-01.jpg') }}" alt="Los Angeles" class="d-block w-100">
                <div class="carousel-caption">
                @if(!empty(getUpComingEventData()))
                    <p><span class="start-text"><b>From THE {{Carbon::parse(getUpComingEventData()->date)->format('d F y')}}</b></span></p>
                    <h4 class="entry-title"><a href="#">{{getUpComingEventData()->title}}</a></h4>
                    @endif
                </div>
            </div>
            <div class="carousel-item">
                 <img src="{{ asset('assets/images/evento/demo/bg-slide-02.jpg') }}" alt="Chicago" class="d-block w-100">
                 <div class="carousel-caption">
                 <!-- <div class="entry-content"> -->
                    @if(!empty(getUpComingEventData()))
                    <p><span class="start-text"><b>From THE {{Carbon::parse(getUpComingEventData()->date)->format('d F y')}}</b></span></p>
                    <h4 class="entry-title"><a href="#">{{getUpComingEventData()->title}}</a></h4>
                    @endif
                <!-- </div> -->
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
        </div>
    @endif

    

</header>