@extends('layouts.master')
@section('head')
	@parent
	<title>{{Auth::user()->ImePrz}}'s profile</title>
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
  		<li class="active">Rented bikes</li>
</ol>
<div class="row" style="margin-bottom:40px;">
	<div class="col-sm-5 col-md-3">
	  	<div class="caption">
	    </div>
		<div class="thumbnail">
		      <img src="{{Auth::user()->pic}}">
		</div>
	</div>
</div>
	<ul class="list-group pull-left" style="width:207px">
	</ul>

	

<!-- Overall -->
<div class="panel panel-default pull-left" style="width:600px;margin-top:-268px;margin-left:20px">
  <div class="panel-heading">Overall</div>
  <div class="panel-body">
  <ul class="media-list">
	  @foreach($rented as $rent)
	  @foreach($bikes as $bike)
	  	@if($rent->gazda == Auth::user()->id && $rent->which == $bike->id && $bike->status == 1)
	  	
		  <li class="media">
		    <div class="media-left">
		    <div class="media-body">
		      <h5 class="media-heading pull-left"><a href="{{URL::route('showBike',$bike->id)}}" style="text-decoration:none;color:black">{{$bike->ime}}</a></h5>
		    </div>
		      <a href="{{URL::route('showBike',$bike->id)}}">
		        <img class="media-object" src="{{$bike->pic}}" style="max-width:100px">
		      </a>
		      <div class="container" style="position:relative;height:70px;width:30px;margin-left:120px;margin-top:-80px;padding:35px 0px;"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></div>

		   		@foreach($users as $user)
		   			@if($user->id == $rent->who)
		   			<a href="#" >
		     		   <img class="media-object" src="{{$user->pic}}" style="max-width:80px;margin-left:170px;margin-top:-70px">
		      		</a>
		      		@endif
		      	@endforeach
		      
		    </div>
		  </li>
		  <hr>
		@endif
		@endforeach
	  @endforeach
  </ul>
  </div>
</div>
<!-- End Overall -->

<!-- View Bike -->
<div class="modal fade"  id = "showBike" tabindex = "-1" role = "dialog"aria-hidden ="true" >
		<div class = "modal-dialog" style="width:300px; height:500px">
			<div class="modal-content">
				<div class="modal-header">
					<button type ="button" class = "close" data-dismiss="modal">
						<span aria-hidden = "true">&times;</span>
						<span class = "sr-only">Close</span>
					</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					
				</div>
			</div>
		</div>
	</div>
<!-- End View Bike -->
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