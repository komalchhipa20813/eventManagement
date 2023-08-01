<!DOCTYPE html>
<html lang="en">
<head>
  <title>Event Gallery</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav" >
        <li class="active" style="margin-left: 450px;font-size: 30px;"><a >{{$event->title}} Gallery</a></li>
        <li class="active" style="margin-left: 450px;font-size: 20px;" ><a href="{{ route('home')}}">Back</a></li>
      </ul>

    </div>
  </div>
</nav>
  
<div class="container text-center" style="min-height: 100vh;">    
  <div class="row">
     @if(!$data['images']->isEmpty())
     @foreach ($data['images'] as $image)
    <div class="col-md-2" style="margin-bottom:16px;" align="center">
      <a href=""><img src="{{ asset('images/events/'.$image->image) }}" class="img-thumbnail" width="175" heigth="175" style="heigth:175px;">
      </a>
    </div>
     @endforeach
    @endif
    
    
  </div>
</div>



</body>
</html>
