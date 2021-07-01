@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit profile') }}</div>


                    <div class="card-body">
                        {!! Form::open(['action'=> ['App\Http\Controllers\UserController@update',$user->id],
                        'method'=>'POST','enctype'=>'multipart/form-data','files'=>'true'])!!}
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                <div class="col-md-6">
                                    <input id="vardas" type="text" class="form-control @error('name') is-invalid @enderror" name="name" readonly value="{{$user->name}}" required autocomplete="name" autofocus>

                                </div>
                            </div>

                        <div class="form-group row">
                            <label for="El. paštas" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                <input id="email" name="email" type="text" class="form-control" readonly value="{{$user->email}}">
                            </div>
                        </div>

                            <div class="form-group row">
                                <label for="Profilio nuotrauka" class="col-md-4 col-form-label text-md-right">{{ __('Profile picture') }}</label>
                                <div class="col-md-6">
                                    <img src="data:image/png;base64,{{ chunk_split(base64_encode($user->profilio_nuotrauka)) }}"  class="img-fluid" alt="Responsive image">
                                    <br><br>
                                    {{Form::file('profilio_nuotrauka')}}
                                    <!--<input id="profilio_nuotrauka" name="profilio_nuotrauka" type="file" class="form-control"> -->

                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>

                        {!!Form::hidden('_method','PUT')!!}
                        {!! Form::close() !!}

<br><br><br>
                        {!! Form::open(['action'=> ['App\Http\Controllers\UserController@destroy',$user->id],
                        'method'=>'POST','enctype'=>'multipart/form-data','files'=>'true'])!!}
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete your account?')">
                                    {{ __('Delete account') }}
                                </button>
                            </div>
                        </div>
                        {!!Form::hidden('_method','DELETE')!!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
