@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Profile view') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">


                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                <div class="col-md-6">
                                    <input id="vardas" type="text" class="form-control @error('name') is-invalid @enderror" name="name" readonly value="{{$user->name}}" required autocomplete="name" autofocus>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Profilio nuotrauka" class="col-md-4 col-form-label text-md-right">{{ __('Profile picture') }}</label>
                                <div class="col-md-6">
                                    <img src="data:image/png;base64,{{ chunk_split(base64_encode($user->profilio_nuotrauka)) }}" class="img-fluid" alt="Responsive image">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
