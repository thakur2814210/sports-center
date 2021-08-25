@extends('layouts.app')

@section('content')
<div class="container">
<div class="card text-center">
  <div class="card-header">
  <h1>{{$name}}</h1>
  </div>
  <div class="card-body">
   
    <p class="card-text">{{$description}}</p>
    <p class="card-text">{{$address}}</p>
  </div>
  <div class="card-footer text-muted">
  <a style="margin-bottom:10px" href="/center/{{$id}}/edit" class="btn btn-outline-primary">Edit Sport Center</a>
            <form id="delete-frm" class="" action="" method="POST">
            @method('DELETE')
            @csrf
        <button type="submit" class="btn btn-outline-danger">Delete Sport Center</button>
        </form>
  </div>
</div>

<div class="row justify-content-center"> 
  <div class="column">
  @foreach($images as $image)
    <img src="{{asset('storage/uploads/'.$image->name)}}" style="width:100%">
   
@endforeach
  </div>
  <!-- <div class="column">
      
    <img src="{{asset('images/sai.png')}}" style="width:100%">
    <img src="{{asset('images/car.jpg')}}" style="width:100%">
    <img src="{{asset('images/sai.png')}}" style="width:100%">
  </div>   -->
  <!-- <div class="column">
    
  <img src="{{asset('images/sai.png')}}" style="width:100%">
    <img src="{{asset('images/car.jpg')}}" style="width:100%">
    <img src="{{asset('images/sai.png')}}" style="width:100%">
  </div> -->
  
</div>

</div>
@endsection
