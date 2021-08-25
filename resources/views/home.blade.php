@extends('layouts.app')

@section('content')
<div class="container">


<a style="margin-bottom:20px;font-size:20px" href="/Add-Center" class="btn btn-primary">Add Sport Center</a>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Sport Center Name</th>
     
      <th scope="col">Detail</th>
    </tr>
  </thead>
  <tbody>
  @foreach($center as $centers)
    <tr>
      <th scope="row">{{$centers->id}}</th>
      <td>{{$centers->name}}</td>
      
      <td><a href="/center/{{$centers->id}}" class="btn btn-primary">View</a></td>
    </tr>
    @endforeach
  </tbody>
</table>

    <!-- @foreach($center as $centers)
    <div class="card mb-3">
        <div class="card-body">
            <h1 class="card-title">{{$centers->name}}</h1>
            <p class="card-text">{{$centers->description}}</p>
            <p class="card-text">{{$centers->address}}</p>
        </div>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{asset('images/sai.png')}}" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset('images/car.jpg')}}" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset('images/sai.png')}}" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="card-body">
        <a href="/center/{{ $centers->id }}/edit" class="btn btn-outline-primary">Edit Post</a>
            <form id="delete-frm" class="" action="" method="POST">
            @method('DELETE')
            @csrf
        <button type="submit" class="btn btn-danger">Delete Sport Center</button>
        </form>
            <h1 class="card-title">{{$centers->name}}</h1>
            <p class="card-text">{{$centers->description}}</p>
            <p class="card-text">{{$centers->address}}</p>
        </div>
    </div>
    @endforeach -->
</div>
@endsection