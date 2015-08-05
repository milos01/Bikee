@extends('layouts.master')
@section('head')
	@parent
	<title>Edit {{$bike->ime}}</title>
@stop
@section('controles')
@stop
@section('image')
@stop
@section('lol')
<div class = "navbar navbar-default">
<div class = "container pull-left" style="padding:25px;font-family: 'Lobster';font-size:50px;"><a href="{{URL::route('userHome')}}" style="text-decoration:none;color:rgba(64, 62, 59, 1);">Bikee</a></div>	
	<div class="container pull-right" style="margin-top:40px;width:200px;">
	@if(Auth::check())
		{{Auth::user()->ImePrz}}
		<a href="{{URL::route('getLogout')}}">
			<button type="button" class="btn btn-default" aria-label="Left Align">
				Logout
			</button>
		</a>	
	@endif
	</div>
</div>
@stop
@section('content')
<ol class="breadcrumb">
  		<li><a href="{{URL::route('userHome')}}">Home</a></li>
  		<li class="active">Edit {{$bike->ime}}</li>
</ol>

		<div class = "modal-dialog" style="width:300px; height:500px">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Edit Bike</h4>
				</div>
				<div class="modal-body">
					<form id = "target_form1" method= "post"action= "{{URL::route('editBikeAll',$bike->id)}}">
						<label for="sel1">Ime:</label>
						<div class="form-group{{($errors->has('username')) ? 'has-error' :  ''}}" style="margin-bottom:10px">
							<input id="bikename" name="bikename" type="text"class="form-control" value="{{$bike->ime}}">
							<!-- @if($errors->has('username'))
								{{$errors->first('username')}}
							@endif -->
						</div>
						<label for="sel1">Marka:</label>
						<div class="form-group{{($errors->has('password')) ? 'has-error' :  ''}}">
							<input id="brand" name="brand" type="text"class="form-control"value="{{$bike->tip}}">
							<!-- @if($errors->has('password'))
								{{$errors->first('password')}}
							@endif -->
						</div>
						<label for="sel1">Tip:</label>
						<div class="form-group{{($errors->has('password')) ? 'has-error' :  ''}}">
							<input id="type" name="type" type="text"class="form-control"value="{{$bike->marka}}">
							<!-- @if($errors->has('password'))
								{{$errors->first('password')}}
							@endif -->
						</div>
						<label for="sel1">Slika:</label>
						<div class="form-group{{($errors->has('password')) ? 'has-error' :  ''}}">
							<input id="pic" name="pic" type="text"class="form-control"value="{{$bike->pic}}">
							<!-- @if($errors->has('password'))
								{{$errors->first('password')}}
							@endif -->
						</div>
						<label for="sel1">Status:</label>
						<div class="form-group{{($errors->has('password')) ? 'has-error' :  ''}}">
							<input id="status" name="status" type="text"class="form-control"value="{{$bike->status}}">
							<!-- @if($errors->has('password'))
								{{$errors->first('password')}}
							@endif -->
						</div>
						<label for="sel1">Prodat:</label>
						<div class="form-group{{($errors->has('password')) ? 'has-error' :  ''}}">
							<input id="prodat" name="prodat" type="text"class="form-control"value="{{$bike->prodat}}">
							<!-- @if($errors->has('password'))
								{{$errors->first('password')}}
							@endif -->
						</div>
						
						<div class="modal-footer">
							<button type="submit"class = "btn btn-primary"data-dismiss = "modal" id = "AddBike">Submit</button>
						</div>
						{{Form::token()}} 
					</form>
				</div>
				
				
			</div>
		</div>
@stop
@section('footer')
@stop
@section('javascript')
	 @parent
	 <script src = "../../js/app.js" type="text/javascript"></script>
@stop
@if(Session::has('modal'))
	<script type="text/javascript">
		$("{{Session::get('modal')}}").modal('show');
	</script>
@endif