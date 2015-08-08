@extends('layouts.master')
@section('head')
	@parent
	<title>{{$user->ImePrz}}'s profile</title>
	<script src="https://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
@stop
@section('controles')
@stop
@section('image')
@stop
@section('lol')
<div class = "navbar navbar-default">
<div class = "container pull-left" style="padding:25px;font-family: 'Lobster';font-size:50px;"><a href="{{URL::route('userHome')}}" style="text-decoration:none;color:rgba(64, 62, 59, 1);">Bikee</a></div>	
	
	@if(Auth::check())
		
		<div class="pull-right" style="margin-top:40px;width:250px;height:50px;">
		{{Auth::user()->ImePrz}}
		<a href="{{URL::route('getLogout')}}">
			<button type="button" class="btn btn-default" aria-label="Left Align">
				Logout
			</button>
		</a>
		</div>	
	@endif
</div>
<div id="map_canvas02" style="width:100%;margin-top:-20px;margin-left:-10px;height:400px;margin-bottom:20px;border:1px solid #ccc;border:1px solid ccc;"></div>
@stop
@section('content')
@section('content')
<div class="row" style="margin-bottom:40px;">
	<div class="col-sm-5 col-md-3">
	  	<div class="caption">
	    </div>
		<div class="thumbnail">
		<img src="{{$user->pic}}">
		</div>
	</div>
</div>

	<!-- <div id="map_canvas" style="width:750px;height:300px;border:1px solid #ccc;margin-top:400px;border:1px solid red;"></div> -->
	<ul class="list-group pull-left" style="width:207px;margin-top:-260px;margin-left:250px;">
		<li class="list-group-item"><a href="#" data-target = "#group_form" data-toggle= "modal" style="text-decoration:none;color:black">Send massage</a></li>
		<li class="list-group-item"><a href="#" data-target = "#edit_bike" data-toggle= "modal" style="text-decoration:none;color:black">Search bike</a></li>
	</ul>
	
	<!-- Add Bike -->
	<div class="modal fade"  id = "group_form" tabindex = "-1" role = "dialog"aria-hidden ="true" >
		<div class = "modal-dialog" style="width:300px; height:500px">
			<div class="modal-content">
				<div class="modal-header">
					<button type ="button" class = "close" data-dismiss="modal">
						<span aria-hidden = "true">&times;</span>
						<span class = "sr-only">Close</span>
					</button>
					<h4 class="modal-title">Add Bike</h4>
				</div>
				<div class="modal-body">
					<form id = "target_form1" method= "post"action= "{{URL::route('addBike')}}">
						<div class="form-group{{($errors->has('username')) ? 'has-error' :  ''}}" style="margin-bottom:10px">
							<input id="bikename" name="bikename" type="text"class="form-control"placeholder="Bike name">
							<!-- @if($errors->has('username'))
								{{$errors->first('username')}}
							@endif -->
						</div>

						<div class="form-group{{($errors->has('password')) ? 'has-error' :  ''}}">
							<input id="brand" name="brand" type="text"class="form-control"placeholder="Bike brand">
							<!-- @if($errors->has('password'))
								{{$errors->first('password')}}
							@endif -->
						</div>
						<div class="form-group{{($errors->has('password')) ? 'has-error' :  ''}}">
							<input id="type" name="type" type="text"class="form-control"placeholder="Bike type">
							<!-- @if($errors->has('password'))
								{{$errors->first('password')}}
							@endif -->
						</div>
						<div class="form-group{{($errors->has('password')) ? 'has-error' :  ''}}">
							<input id="pic" name="pic" type="text"class="form-control"placeholder="Picture url">
							<!-- @if($errors->has('password'))
								{{$errors->first('password')}}
							@endif -->
						</div>
						
						<div class="modal-footer">
							<button type="submit"class = "btn btn-primary"data-dismiss = "modal" id = "AddBike">Add bike</button>
						</div>
						{{Form::token()}} 
					</form>
				</div>
				
				
			</div>
		</div>
	</div>
<!-- End Add Bike -->
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
<!-- Overall -->
<div class="panel panel-default" style="margin-left:0px;width:860px;position:absolute">
  <div class="panel-heading">Overall 
  	<div class="dropdown pull pull-right" style="margin-top:-7px">
	  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
	    Filter
	    <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
	  	<li><a href="{{URL::route('searchBike',array(0,10))}}">No filter</a></li>
	    <li><a href="{{URL::route('searchBike',array(1,10))}}">Available</a></li>
	    <li><a href="{{URL::route('searchBike',array(2,10))}}">Not available</a></li>
	    <li><a href="{{URL::route('searchBike',array(3,10))}}">Sold</a></li>
	    <li><a href="{{URL::route('searchBike',array(4,10))}}"><span class="glyphicon glyphicon-sort-by-order" aria-hidden="true"></span> Rating</a></li>
	    <li><a href="{{URL::route('searchBike',array(5,10))}}"><span class="glyphicon glyphicon-sort-by-order-alt" aria-hidden="true"></span> Rating</a></li>
	  </ul>
	</div>
  </div>
  <div class="panel-body">
  <ul class="media-list">
  @if(Auth::user()->TipKor == 'renter')
	  @foreach($bikes as $bike)
	  
		  <li class="media">
		    <div class="media-left">
		      <a href="#">
		        <img class="media-object" src="{{$bike->pic}}" style="max-width:100px">
		      </a>
		    </div>
		    <div class="media-body">
		      <h4 class="media-heading"><a href="{{URL::route('showBike',$bike->id)}}" style="text-decoration:none;color:black">{{$bike->ime}}</a></h4>
		      Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
		    </div>
		    <a href="{{URL::route('editBike',$bike->id)}}" class = "btn btn-default"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</a>
			@if($bike->ocena >= 3.0)
				<span class="label label-success pull-right" style="padding:5px 5px;">{{$bike->ocena}}</span>
			@else
				<span class="label label-danger pull-right" style="padding:5px 5px;">{{$bike->ocena}}</span>
			@endif
			@if($bike->status != 0)
				
				<span class="badge pull-right" style="margin-right:10px">Not available</span>
			@endif
			@if($bike->prodat != 0)
				<span class="badge pull-right" style="margin-right:10px">Sold</span>
			@endif
		  </li>
		  <hr>
		
	  @endforeach
	@elseif(Auth::user()->TipKor == 'kupac')
		@foreach($bikes as $bike)
		  <li class="media">
		    <div class="media-left">
		      <a href="#">
		        <img class="media-object" src="{{$bike->pic}}" style="max-width:100px">
		      </a>
		    </div>
		    <div class="media-body">
		      <h4 class="media-heading"><a href="{{URL::route('showBike',$bike->id)}}" style="text-decoration:none;color:black">{{$bike->ime}}</a></h4>
		      Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
		    </div>
		    <!-- <a href="{{URL::route('editBike',$bike->id)}}" class = "btn btn-default"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</a> -->
			@if($bike->ocena >= 3.0)
				<span class="label label-success pull-right" style="padding:5px 5px;">{{$bike->ocena}}</span>
			@else
				<span class="label label-danger pull-right" style="padding:5px 5px;">{{$bike->ocena}}</span>
			@endif
			@if($bike->status != 0)
			@foreach($rented as $rent)
				@if($bike->id == $rent->which && $rent->who == Auth::user()->id)
					<span class="badge pull-right" style="margin-right:10px">you</span>
				@endif
			@endforeach
			<span class="badge pull-right" style="margin-right:10px">not available</span>
			@endif
			@if($bike->prodat != 0)
				<span class="badge pull-right" style="margin-right:10px">Sold</span>
			@endif
		  </li>
		  <hr>
	  @endforeach
	@endif
  </ul>
  </div>
</div>
<!-- End Overall -->
<script type="text/javascript">
    	if (navigator.geolocation) {

        	navigator.geolocation.getCurrentPosition(showPosition);
    	} else {
        	x.innerHTML = "Geolocation is not supported by this browser.";
    	}
 	function showPosition(position) {
  	 	var lat = position.coords.latitude; 
  	 	var lng = position.coords.longitude; 
  	 	var latlng = new google.maps.LatLng(lat, lng);

    var myOptions = {
        zoom: 14,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("map_canvas02"),myOptions);

   var marker = new google.maps.Marker({
      position: new google.maps.LatLng(lat,lng),
      map: map,
      icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
      title: 'Your position'
        
  	});
   <?php 
   $users = User::all();
   foreach ($users as $user1) {
   	if ($user1->TipKor == "renter" && $user->id == $user1->id){
   	?>
   	marker1 = new google.maps.Marker({
      position: new google.maps.LatLng("{{$user1->lat}}","{{$user1->lng}}"),
      map: map,
      icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
      title: '{{$user1->ImePrz}}'
  	});
  	
  	<?php
  	}
   }
   ?>
     
}

</script>
@stop
@section('footer')
@stop
@section('javascript')
	 @parent
	 <script src = "../../js/app.js" type="text/javascript"></script>
@stop
