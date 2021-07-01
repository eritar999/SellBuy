@extends('layouts.app')
@section('content')
  <div class=" pt-5" style="    margin:;
  padding-top: ">
    <a class="btn btn-dark" style="float:right;"href="{{ url("/posts/create") }}">
      <span>Create a listing</span>
    </a>
  </div>
  <div class=" pt-5" style="    margin:;
  padding-top: ">
   </div>
  
@if($count > 0)
@foreach ($posts as $skelbimas)
  <div class="container main-section border card-header" style="margin-bottom: 2%">
      <div class="row">
        <h4 class="text-primary" style="text-align:center;">{{$skelbimas->pavadinimas}}</h4>
        <div class="col-lg-12 col-sm-12 col-12">
          <div class="row" style="text-align:left">
            <div class="col-lg-6 col-sm-2 col-5">
              @foreach ($data as $keys)
              @if ($keys->business_name == $skelbimas->pavadinimas)
                  @foreach(json_decode($keys->business_imgs, true) as $key => $media_gallery)
                      <a href="{{ url('/uploads/Img/MultipleImg/'.$media_gallery) }}" data-toggle="lightbox" data-title="Package Media Gallery" data-gallery="gallery">
                     <img src="{{ url('/uploads/Img/MultipleImg/'.$media_gallery) }}" class="img-fluid mb-2" alt="white sample"/ width="200" height="200">
                     </a>
                     @break
                  @endforeach
                  @break
              @endif
              @endforeach
            </div>
            <div class="col-lg-6 col-sm-10 col-7">

              <p>
                {{$skelbimas->tekstas}}
              </p>

            </div>
          </div>
          <div class="row post-detail">
            <div class="col-lg-12 col-sm-12 col-12">
                <ul class="list-inline">

                  <li class="list-inline-item">
                    <i class="fa fa-calendar" aria-hidden="true"></i> <span>Listed <b>{{$skelbimas->sukurimo_data}}</b></span>
                  </li>
                  <span style="display:inline-block">
                    <li class="list-inline-item">
                    <img src="data:image/png;base64,{{ chunk_split(base64_encode($skelbimas->autorius->profilio_nuotrauka)) }}" class="" width="20px">
                    User -
                    <a href="user/{{$skelbimas->fk_Naudotojasid}}">{{$skelbimas->autorius->name}}</a>
                  </li>
                  </span>

                </ul>
                <div class="buttons">
                  <span style="display:inline-block">
                    <a class="nav-link btn btn-primary"href="posts/{{$skelbimas->skelbimoNr}}">View</a>
                  </span>
                  @if (Auth::id())
                  @if (Auth::id() == $skelbimas->fk_Naudotojasid )
                  <span style="display:inline-block">
                    <a class="nav-link btn btn-primary" href="{{url("posts/".$skelbimas->skelbimoNr)."/edit "}}">Update</a>
                  </span>
                  @endif

                   


                  
                  @endif
                </div>
            </div>
          </div>
        </div>
     </div>
  </div>
@endforeach
@else
  <h3 style="color:red">You have no listings.</h3>
@endif
{!! $posts->links() !!}
@endsection
