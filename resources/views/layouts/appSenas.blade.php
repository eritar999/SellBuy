<!DOCTYPE html>
<html lang="en">
<head>
	<title></title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style>
        .custom{
          margin-bottom:10px;
        }
    </style>
</head>
<body>
	
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="index">Ruddit</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
		  <li class="nav-item">
			<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="posts">Skelbimai</a>
		  </li>
		</ul>
		  <div class="float-right">
		  <ul class="navbar-nav mr-auto">


				  <li class="nav-item dropdown">
					  <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
						 aria-haspopup="true" aria-expanded="false">
						  Vartotojas
					  </a>
					  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" >
						  <a class="dropdown-item" href="profile">Profilis</a>
						  <a class="dropdown-item" href="reports">Skundai</a>
						  <div class="dropdown-divider"></div>
						  <a class="dropdown-item" href="#">Atsijungti</a>

					  </div>

				  </li>

			  <li class="nav-item">
				  <a class="nav-link" href="login">Prisijungti</a>
			  </li>
		  </ul>
		  </div>

	  </div>
    </nav>
<<<<<<< HEAD
	@if (\Session::has('success'))
	<div class="alert alert-success">
		<p>{!! \Session::get('success') !!}</p>
	</div>
@endif
@if (count($errors) > 0)
	<div class="alert alert-danger">
		<p></p>
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
=======

>>>>>>> dd766f1b2981dc9e373fd54cb22a9324f6bbc861
    @yield('content')

</body>
</html>

