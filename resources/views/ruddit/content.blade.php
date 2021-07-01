@extends('layouts.app')
@section('content')
<head>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('css/komcss.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <style>


     </style>
</head>
@if(session('response'))
<div class="alert alert-success">{{session('response')}}</div>
@elseif(session('responsew'))
<div class="alert alert-danger">{{session('responsew')}}</div>
@elseif(session('error'))
<script type="text/javascript">
  $( document ).ready(function() {
       $('#myModal').modal('show');
  });
</script>
@endif




<div class="container justify-content-center" style="text-align: center">
  <div class="row1">
    <div class="col-md-12">
        <div class="blog-post">
        <h1>{{$post->pavadinimas}}</h1>
        <div class="row" style="
        display: block;
         margin: 36px 10%;
          text-align: center  ;background-color: lightyellow ;height: 555px;";>
          <div class="" style="margin: 0 auto;">
            <div class="text" style="    height: 110px; margin-top: 2%; width: 100%;color:green"> </div>
          </div>

               @foreach($data as $key => $data)
               <tr>
                  <td>
                     @foreach(json_decode($data->business_imgs, true) as $key => $media_gallery)
                     <a href="{{ url('/uploads/Img/MultipleImg/'.$media_gallery) }}" data-toggle="lightbox" data-title="Package Media Gallery" data-gallery="gallery">
                     <img src="{{ url('/uploads/Img/MultipleImg/'.$media_gallery) }}" class="img-fluid mb-2" alt="white sample"/ width="50" height="50">
                     </a>
                     @endforeach
                  </td>
               </tr>

            @endforeach

         <div class="row1">
          <i class="fa fa-calendar" aria-hidden="true"></i> Post date<span> {{$post->sukurimo_data}}</span>
         </div>

         <div class="row1">
          <i class="fa fa-mobile" aria-hidden="true"></i> Brand: <span>{{$post->brand}}</span>
        </div>

        <div class="row1">
          <i class="fa fa-bookmark" aria-hidden="true"></i> Model: <span>{{$post->model}}</span>
        </div>

        <div class="row1">
          <i class="fa fa-pencil" aria-hidden="true"></i> Screen size: <span>{{$post->screensize}} cm</span>
        </div>

        <div class="row1">
          <i class="fa fa-square" aria-hidden="true"></i> RAM size: <span>{{$post->ramsize}} Gb</span>
        </div>

        <div class="row1">
          <i class="fa fa-phone-square" aria-hidden="true"></i> Storage size: <span>{{$post->storagesize}} Gb</span>
        </div>

        <div class="row1">
          <i class="fa fa-tint" aria-hidden="true"></i> Color: <span>{{$post->color}}</span>
        </div>

        <div class="row1">
          <i class="fa fa-money" aria-hidden="true"></i> Price: <span>{{$post->price}} €</span>
        </div>
        <div class="row1">
          <i class="fa fa-wheelchair-alt" aria-hidden="true"></i>User: <span>
            <a href="{{url('/user',[$post->fk_Naudotojasid])}}"> {{$autorius->name}}</span></a>
          </div>
        </div>
    </div>
  </div>
</div>

@endsection


