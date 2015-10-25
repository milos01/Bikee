<!doctype html>
<html lang="en">
<head>
	@section('head')
	<title>Sisms projekat</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../../style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
	@show
	
 
 
</head>
<body>
@section('image')
<div class="holder">
@show
@section('lol')
<div class = "navbar navbar-default" style="margin-bottom:60px;background:none;border:none">
	<div class = "container pull-left" style="padding:25px;font-family: 'Lobster';font-size:50px;"><a href="{{URL::route('userHome')}}" style="text-decoration:none;color:rgba(246, 246, 246, 1);">Bikee</a></div>	
	@if(Auth::check())
<div class="container pull-left">
		{{Auth::user()->ImePrz}}
		<a href="{{URL::route('getLogout')}}">
			<button type="button" class="btn btn-default" aria-label="Left Align">
				Logout
			</button>
		</a>
	</div>	
	@endif
</div>
	
@show

<div class="alert alert-danger alertDiv11" style="left:46%;top:40%;text-align:center;position:fixed;width:200px;height:200px;display:none;z-index:99999;border-radius:10px;">
		<div class = "container" style="z-index:99999;margin-top:-15px;background-image: url('../../img/x.png');width:170px;height:170px;margin-left:-15px;"></div>
		<div class="text" style="margin-top:-15px;">Worng inputs</div>
	</div>
	<div class="alert alert-success alertDiv22" style="left:46%;top:40%;text-align:center;position:fixed;width:200px;height:200px;display:none;z-index:99999;border-radius:10px;">
		<div class = "container" style="margin-top:-15px;background-image: url('../../img/y.png');width:170px;height:170px;margin-left:-15px"></div>
		<div class="text2" style="margin-top:-15px;"></div>
	</div>
<div class = "container" style="width:950px;">
@section('content')

<!-- Login modal -->
<div class="container" style="height:400px;width:800px;">
	<div class = "modal-dialog pull-left" style="width:300px; height:500px">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Login</h4>
			</div>
			<div class="modal-body">
				<form id="loginForm" class = "postLogin" method="post"action= "{{URL::route('postLogin')}}">
					<div class="" style="margin-bottom:10px">
						<input id="username" name="username" type="text"class="form-control"placeholder="Username">
						<!-- @if($errors->has('username'))
							{{$errors->first('username')}}
						@endif -->
					</div>

					<div class="">
						<input id="password" name="password" type="password"class="form-control"placeholder="Password">
						<!-- @if($errors->has('password'))
							{{$errors->first('password')}}
						@endif -->
					</div>
					<div class = "check/box">
						<label for = "remember">
							<input type ="checkbox"  id="remember">
							Remember me
						</label>
					</div>

					<div class="modal-footer">
						<button type="submit"class = "btn btn-primary"data-dismiss = "modal" id = "formSub">Login</button>
					</div>
					{{Form::token()}} 
				</form>
			</div>
		</div>
	</div>
 <!-- End Login -->

<!-- Register modal -->
	<div class = "modal-dialog pull-right" style="width:400px; height:500px">
		<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Register</h4>
				</div>

				<div class="modal-body">
				<form id="registerForm" class = "postCreate" method="post" action="{{URL::route('postCreate')}}">
						<div class="">
							<input id="usernameR" name="usernameR" type="text"class="form-control" placeholder="Username" >
								
						
						</div>

						<div class="">
							<input style = "margin-top:10px;" id="passwordR" name="passwordR" type="password"class="form-control" placeholder="Password">
							
						</div>
						<div class="">
							<input style = "margin-top:10px;margin-bottom:10px;" id="rPassword" name="rPassword" type="password"class="form-control" placeholder="Re-Password">
							
						</div>	
						<div class="">
							<input style = "margin-top:10px;margin-bottom:10px;" id="email" name="email" type="text"class="form-control" placeholder="Email">
							
						</div>
						<div class="">
							<input style = "margin-top:10px;margin-bottom:10px;" id="ImePrz" name="ImePrz" type="text"class="form-control" placeholder="Full Name">
							
						</div>
						<input class ="btn btn pull-right" type="button" id="botton" value="Browse" onclick="HandleBrowseClick();">
						<div class="input-group" style = "margin-bottom:10px;width:280px;">
 							<input class="form-control " type="file" id="browse" style="display: none" onChange="Handlechange();"/>
							<input class="form-control "type="text" id="filename" id="slika" name="slika" placeholder = "Picture url"/>
							
						</div>
						<div class="">
							<input style = "margin-top:10px;margin-bottom:10px;display:none;" id="city" name="city" type="text"class="form-control" placeholder="City">
							
						</div>
						<div class="input-group">
							<span class="input-group-addon">
	      						<input type="radio" name="type" value="renter" onclick="ala2();"> Renter
	      					</span>

	      					<span class="input-group-addon">
								<input type="radio" name="type"  value="kupac" onclick="ala();"> Kupac
							</span>
						</div>
						<div class="modal-footer">
							{{Form::submit('Register', array('class'=>'btn btn-orange'))}}
						</div>	
						{{Form::token()}} 
				</form>
				</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	
	function ala(){
		$('input[name="city"]').val("");
		$('#city').show();
		$('#city').prop('disabled', false);
	}
	function ala2(){
		// $('#city').prop('disabled', true);
		
		$('input[name="city"]').val("nona");
		$('#city').hide();
	}
	</script>
@show
</div>
@section('footer')
<div class="container" style="width:950px;height:100px;">
	<div class="container" style="color:white;position:absolute;width:920px;text-align:center;padding:20px 0px;border-top:1px solid white;bottom:0px;">
		<span style="font-size:13px;color:;cursor:pointer">Copyright © 2015 MilosMladen - All rights reserved.</span>
	</div>
	
</div>
@show
@section('javascript')
	
	 <script src = "http://code.jquery.com/jquery-1.11.2.min.js" type="text/javascript" ></script>
	 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	<script src = "../../js/app.js" type="text/javascript"></script>
@show
@section('image1')	
</div>
@show
</body>
</html>