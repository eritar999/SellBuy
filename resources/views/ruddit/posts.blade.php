@extends('layouts.app')
@section('content')
  <div class=" pt-5" style="    margin:;
  padding-bottom: ">
  </div>

    <div clas="card-body">
      {!! Form::open(['action'=> 'App\Http\Controllers\PostsController@filter',
      'method'=>'GET'])!!}
      <input type="hidden" name="_token" value="{{  csrf_token() }}">


      <div class="container">
        <div class="row">

            <div class="form-group">
              {!! Form::label('brand', 'Brand') !!}
              <div class="col-md-8">
                  {!! Form::textarea('brand','',['class' => 'form-control','placeholder'=>'Brand eg.: Samsung ','rows'=>'1']) !!}
              </div>

          </div>
          <div class="form-group">
            {!! Form::label('model', 'Model') !!}
            <div class="col-md-8">
                {!! Form::textarea('model','',['class' => 'form-control','placeholder'=>'Model eg.: S40 ','rows'=>'1']) !!}
            </div>
        </div>
        </div>
      </div>

      <div class="container">
        <div class="row">

          <div class="form-group">
            {!! Form::label('screensize', 'Screen size') !!}
            <div class="col-md-8">
                {!! Form::textarea('screensize','',['class' => 'form-control','placeholder'=>'Screen size eg.: 23x15 ','rows'=>'1']) !!}
            </div>

          </div>
          <div class="form-group">
            {!! Form::label('ramsize', 'Ram size') !!}
            <div class="col-md-8">
                {!! Form::textarea('ramsize','',['class' => 'form-control','placeholder'=>'Ram size eg.: 4(gb) ','rows'=>'1']) !!}
            </div>
        </div>
        </div>
      </div>

      <div class="container">
        <div class="row">

          <div class="form-group">
            {!! Form::label('minprice', 'Minimum price') !!}
            <div class="col-md-8">
                {!! Form::input('number','minprice','',['class' => 'form-control','placeholder'=>'Price eg.: 50 ','rows'=>'1']) !!}
            </div>

          </div>
          <div class="form-group">
            {!! Form::label('maxprice', 'Maximum price') !!}
            <div class="col-md-8">
                {!! Form::input('number','maxprice','',['class' => 'form-control','placeholder'=>'Price eg.: 250 ','rows'=>'1']) !!}
            </div>
          </div>
        
          <select class="form-select form-select-sm" aria-label=".form-select-sm example" id='vl' name='vl'>
            <option value="1" >Html</option>
            <option value="2" >XML</option>
            <option value="3" >JSON</option>
          </select>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="form-group">
            Check if you want to bookmark:{{ Form::checkbox('my_checkbox', '1') }} <br>
            {!! Form::label('bookname', 'Bookmark name') !!}
            <div class="col-md-8">
                {!! Form::input('bookname','bookname','',['class' => 'form-control','placeholder'=>'Bookmark','rows'=>'1']) !!}
            </div>
          </div>
        </div>
      </div>
              <div class="form-group">
                <div class="col-md-12 col-md-offset-8" style="margin-bottom: 20px">
                    {!! Form::submit('Filter', ['class= btn btn-dark']) !!}
                </div>
            </div>
        {!! Form::close() !!}
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
                    <a class="nav-link btn btn-primary"href="posts/{{$skelbimas->skelbimoNr}}" target="_blank">View</a>
                  </span>
                  @guest
                   @else   
                   <div class="float-right">
                    <a class="nav-link btn btn-warning float-right"href="bookposts/{{$skelbimas->skelbimoNr}}">Bookmark</a>
                  </div>
                  @endguest
                </div>
            </div>
          </div>
        </div>
     </div>
  </div>
@endforeach
@else
  <h3 style="color:red">There are no results according to your filter parameters. Please try again.</h3>
@endif
{!! $posts->appends(Request::except('page'))->render() !!}

@endsection
