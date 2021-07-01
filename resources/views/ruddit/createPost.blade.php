
@extends('layouts.app')
@section('content')
        <h1 style="text-align: center" class="card-header">New listing</h1>
        <div class="login-form">
                <div clas="card-body">
                    {!! Form::open(['action'=> 'App\Http\Controllers\PostsController@store',
                    'method'=>'POST','enctype'=>'multipart/form-data','id'=>'regForm'])!!}
                    <input type="hidden" name="_token" value="{{  csrf_token() }}">

                            <div class="form-group">
                                {!! Form::label('pavadinimas', 'Name') !!}
                                <div class="col-md-3">
                                    {!! Form::text('pavadinimas','',['class' => 'form-control','placeholder'=>'Name of the listing']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('brand', 'Brand') !!}
                                <div class="col-md-3">
                                    {!! Form::textarea('brand','',['class' => 'form-control','placeholder'=>'Brand eg.: Samsung ','rows'=>'1']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('model', 'Model') !!}
                                <div class="col-md-3">
                                    {!! Form::textarea('model','',['class' => 'form-control','placeholder'=>'Model eg.: S40 ','rows'=>'1']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('screensize', 'Screen size') !!}
                                <div class="col-md-3">
                                    {!! Form::textarea('screensize','',['class' => 'form-control','placeholder'=>'Screen size eg.: 23x15 ','rows'=>'1']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('ramsize', 'Ram size') !!}
                                <div class="col-md-3">
                                    {!! Form::textarea('ramsize','',['class' => 'form-control','placeholder'=>'Ram size eg.: 4(gb) ','rows'=>'1']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('storagesize', 'Storage size') !!}
                                <div class="col-md-3">
                                    {!! Form::textarea('storagesize','',['class' => 'form-control','placeholder'=>'Storage size eg.: 64(gb) ','rows'=>'1']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('color', 'Color') !!}
                                <div class="col-md-3">
                                    {!! Form::textarea('color','',['class' => 'form-control','placeholder'=>'Color eg.: red ','rows'=>'1']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('price', 'Price') !!}
                                <div class="col-md-3">
                                    {!! Form::textarea('price','',['class' => 'form-control','placeholder'=>'Price eg.: 250 ','rows'=>'1']) !!}
                                </div>
                            </div>
                                <div class="form-group">
                                   <div class="col-md-6">
                                    <label for="Business Image">Upload Multiple Files :</label>
                                    <input type="file" class="form-control-file" id="business_img" name="business_imgs[]"  accept="image/*" multiple>
                                 </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 col-md-offset-4">
                                    {!! Form::submit('Create', ['class=glyphicon glyphicon-refresh btn btn-primary']) !!}
                                </div>
                            </div>
                            <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                            <script>
                                $(document).ready(function() {
                                    $("#regForm").validate({
                                        rules: {
                                            pavadinimas: {
                                                required: true,
                                                minlength: 3,
                                                maxlength: 30
                                            },
                                            brand:{
                                                required: true,
                                                maxlength: 20
                                            },
                                            model: {
                                                required: true,
                                                maxlength: 15
                                            },
                                            screensize: {
                                                required: true,
                                                maxlength: 10
                                            },
                                            ramsize: {
                                                required: true,
                                                digits: true,
                                                maxlength:3
                                            },
                                            storagesize: {
                                                required: true,
                                                digits: true,
                                                maxlength:3
                                            },
                                            color: {
                                                required: true,
                                                minlength: 3,
                                                maxlength:10
                                            },
                                            price: {
                                                required: true,
                                                minlength:1
                                            }
                                        },
                                        messages: {
                                            pavadinimas: {
                                                required: "Name of the listing is required",
                                                minlength: "Name of the listing must be at least 5 characters",
                                                maxlength: "Name of the listing 30 characters"
                                            },
                                            brand: {
                                                required: "Last name is required",
                                                maxlength: "Last name cannot be more than 20 characters"
                                            },
                                            model: {
                                                required: "Phone model is required",
                                                maxlength: "Phone model cannot be more than 15 characters",
                                            },
                                            screensize: {
                                                required: "Phone screen size is required",
                                                maxlength: "Phone screen size cannot be more than 10 digits"
                                            },
                                            ramsize: {
                                                required: "RAM size is required",
                                                digits: "RAM size can only be in digits",
                                                maxlength: "RAM size cannot be more than 3 digits"
                                            },
                                            storagesize: {
                                                required: "Storage size is required",
                                                digits: "Storage size can only be in digits",
                                                maxlength: "Storage size cannot be more than 3 digits"
                                            },
                                            color: {
                                                required:  "Color is required",
                                                minlength: "Color must be at least 3 characters",
                                                maxlength: "Color cannot be more than 10 characters"
                                            },
                                            price: {
                                                required: "Price is required",
                                                minlength: "Price must be at least 1 digit"
                                            }
                                        }
                                    });
                                });
                            </script>
                        {!! Form::close() !!}
                    </div>
            </div>
        </body>
</html>
@endsection
