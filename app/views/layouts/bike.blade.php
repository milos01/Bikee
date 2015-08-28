@extends('layouts.master')
@section('head')
	@parent
	 <script src="https://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
	<title>{{$bike->ime}} bike</title>
@stop
@section('controles')
@stop
@section('image')
@stop
@section('lol')
<?php $noti = Notifications::all()?>
<div class = "navbar navbar-default">
<div class = "container pull-left" style="padding:25px;font-family: 'Lobster';font-size:50px;"><a href="{{URL::route('userHome')}}" style="text-decoration:none;color:rgba(64, 62, 59, 1);">Bikee</a></div>	
	
	@if(Auth::check())
		
		<div id = "kaj"class="pull-right" style="margin-top:40px;width:250px;height:50px;">
		<div class="pull-left" id="notButt" style="cursor:pointer;font-size:18px;padding:0px 0px;width:18px;margin-right:10px;">
			<span class="glyphicon glyphicon-globe" aria-hidden="true" style="margin-top:4px;"></span>
		</div>
		<?php
			$counter = 0;
		?>
		@foreach($noti as $notification)
			@if(Auth::user()->id == $notification->to && $notification->to != $notification->from)
				@if($notification->read == 0)
					<?php $counter += 1; ?>
				@endif
			@endif
		@endforeach
		@if($counter >= 1)
		<span id="notification_count" style="
			padding: 3px 7px 3px 7px;
			background: #cc0000;
			color: #ffffff;
			font-weight: bold;
			margin-left: -18px;
			border-radius: 9px;
			-moz-border-radius: 9px; 
			-webkit-border-radius: 9px;
			 position: absolute;
			 margin-top: -11px;
			 font-size: 11px;">{{$counter}}</span>
 		@endif
		{{Auth::user()->ImePrz}}
		<a href="{{URL::route('getLogout')}}">
			<button type="button" class="btn btn-default" aria-label="Left Align">
				Logout
			</button>
		</a>
		</div>	
	@endif
</div>
<div class="container" id="notificationDiv" style="display:none;position:absolute;width:350px;top:85px;right:120px;z-index:9999;">
<div class="container arrow"></div>
<div class="container"   style="background-color:#fff;border-radius:2px;border:1px solid gray;width:350px;top:85px;right:120px;z-index:9999;border-bottom:none;">
<?php
	$count = 1;
?>
@foreach($noti as $notification)
	@if(Auth::user()->id == $notification->to && $notification->to != $notification->from)
		@if($notification->type == 0)
			<div class="container notif" style="border-bottom:1px solid gray;width:348px;padding: 20px 20px;margin-left:-15px">
				<b>{{User::find($notification->from)->ImePrz}}</b> commented on <b>{{Bike::find($notification->bike)->ime}}</b>
			</div>
			<?php
				$count += 1;
			?>
		@else
			<div class="container notif" style="border-bottom:1px solid gray;width:348px;padding: 20px 20px;margin-left:-15px">
				<b>{{User::find($notification->from)->ImePrz}}</b> rented <b>{{Bike::find($notification->bike)->ime}}</b>
			</div>
			<?php
				$count += 1;
			?>
		@endif
	@endif
	
@endforeach
</div>
</div>
<!-- <div class = "alert alert-danger alertDiv1" style="top:80px;text-align:center;position:fixed;width:100%;border-radius:0px;display:none;z-index:99999"><span class="glyphicon glyphicon-ok-circle bla" aria-hidden="true"></span> {{Session::get('success')}}</div> -->
	<div class="alert alert-danger alertDiv1" style="left:46%;top:40%;text-align:center;position:fixed;width:200px;height:200px;display:none;z-index:99999;border-radius:10px;">
		<div class = "container" style="margin-top:-15px;background-image: url('../../img/x.png');width:170px;height:170px;margin-left:-15px"></div>
		<div class="text" style="margin-top:-15px;"></div>
	</div>
	<div class="alert alert-success alertDiv2" style="left:46%;top:40%;text-align:center;position:fixed;width:200px;height:200px;display:none;z-index:99999;border-radius:10px;">
		<div class = "container" style="margin-top:-15px;background-image: url('../../img/y.png');width:170px;height:170px;margin-left:-15px"></div>
		<div class="text2" style="margin-top:-15px;"></div>
	</div>
@stop
@section('content')
	<ol class="breadcrumb">
  		<li><a href="{{URL::route('userHome')}}">Home</a></li>
  		<li class="active">{{$bike->ime}}</li>
	</ol>
	
	<div class="container" style="width:800px;">
	<div class="container" style="width:100%;height:300px;">
		<img class="media-object pull-left" src="{{$bike->pic}}" style="max-width:300px;">
		<div class="container pull-right" style="width:200px;height:50px;margin-top:50px;">
			@if(Auth::user()->TipKor == 'kupac')
			<div class="dropdown">
	  			<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
		    		Rate bike
		    		<span class="caret"></span>
	  			</button>
				  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
				    <li><a href="{{URL::route('rateBike',array($bike->id,1))}}">1</a></li>
				    <li><a href="{{URL::route('rateBike',array($bike->id,2))}}">2</a></li>
				    <li><a href="{{URL::route('rateBike',array($bike->id,3))}}">3</a></li>
				    <li><a href="{{URL::route('rateBike',array($bike->id,4))}}">4</a></li>
				    <li><a href="{{URL::route('rateBike',array($bike->id,5))}}">5</a></li>
				  </ul>
			</div>
			@else
			<p style="font-family:'Lobster';font-size:20px">You  own this bike!</p>
			<p style="font-family:'Lobster';font-size:20px">Bike rate: {{$bike->ocena}}</p>
			<p style="font-family:'Lobster';font-size:20px">Status:
			@if($bike->status == 0  && $bike->prodat == 0)
				<span style="color:green">available</span>
			@elseif($bike->status == 0  && $bike->prodat == 1)
				<span style="color:red">not available(sold)</span>
			@elseif($bike->status == 1  && $bike->prodat == 1)
				<span style="color:red">not available(sold)</span>
			@else
				<span style="color:red">not available</span>
			@endif
			@endif
			</p>
			@if(Auth::user()->TipKor == 'kupac')
			<!-- Rent Bike -->
			<span class="badge pull-right" style="margin-top:-25px;margin-right:25px;">{{$bike->ocena}}</span>
			@foreach($users as $user)
				@if($user->id == $bike->nadlezni)
					<p style="font-family:'Lobster';font-size:20px;margin-top:10px">Renter: {{$user->ImePrz}}</p>
				@endif
			@endforeach
			@if($bike->status == 0 && $bike->prodat == 0)
			<p style="font-family:'Lobster';font-size:20px;margin-top:10px;color:green">available</p>
			<a  href="#" data-target = "#rent_bike" data-toggle= "modal" class="btn btn-success" style="padding:10px 25px;margin-top:10px;margin-left:0px"><span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span> Rent bike</a>
			@else

				<p style="font-family:'Lobster';font-size:20px;margin-top:10px;color:red;">Not available</p>
			@endif
			<!-- End Rate Bike -->
			@endif
		</div>
	</div>
	<div class="pull-left" style="margin-top:50px;">
		<p style="font-family:'Lobster';font-size:20px">Description</p>
		Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries
	</div>
	<div class="container pull-left" style="margin-top:30px;margin-left:-15px;">
		<p style="font-family:'Lobster';font-size:20px">Bike position:</p>
	</div>
	<div id="map_canvas" style="width:750px;height:300px;border:1px solid #ccc;margin-top:40px"></div>
	<!-- Comment part -->
	<div class="container pull-left" style="margin-top:40px;margin-left:-13px;width:830px;">
	<form id="commentForm" class = "commentCreate" action="{{URL::route('postComment',array(Auth::user()->id,$bike->id))}}"method = "post">
		<div class="form-group group">
			<div class="input-group" style="width:660px;margin-bottom:-1px;">
		  		<span class="input-group-addon glyphicon glyphicon-comment" id="sizing-addon2"></span>
		 		<textarea class="form-control textHolder" style="margin-bottom:-2px;" name = "body"id = "bodyYo"></textarea>
			</div>
		</div>

		<div class="form-group pull-right" style="margin-top:-55px;margin-right:56px;">
			<input type = "submit" value = "Post" class="btn btn-primary subBTTN">
		</div>
		{{Form::token()}}
	</form>
	</div>
	<!-- End Comment part -->
	<!-- Show Commetns -->
	<div class="container " id = "cont"style="margin-top:50px;width:780px;margin-left:-15px">
	@foreach($comment as $comments)
		@if($comments->to  == $bike->id)
		<div class="panel panel-default">
	  		<div class="panel-body" style="font-family:'Open Sans',sans-serif;">
	  		@foreach($users as $user)
	  			@if($user->id == $comments->from)
	  			@if($bike->nadlezni == $comments->from)
	  				<span class="commentBody pull-left" aria-hidden="true" style="color:rgba(51, 121, 182, 1);"><b>
	  					{{$user->username}}
	  				</b></span><span>(owner)</span>
	  			@else
		  			<span class="commentBody pull-left" aria-hidden="true"><b>
		  				{{$user->username}}
		  			</b></span>
		  			@endif
	  			@endif
	  			@endforeach
	  				<span class="pull-right" aria-hidden="true" style ="padding:0px 8px">{{$comments->created_at}}</span><hr>
	   				<div class="pull-left">{{$comments->body}}</div>
	   						
	  		</div>
		</div>
		@endif
	@endforeach
	</div>
	<!-- End Shows Comments -->
	<!-- Rent Bike -->
	<div class="modal fade"  id = "rent_bike" tabindex = "-1" role = "dialog"aria-hidden ="true" >
	<div class = "modal-dialog" style="width:300px; height:500px">
			<div class="modal-content">
				<div class="modal-header">
					<button type ="button" class = "close" data-dismiss="modal">
						<span aria-hidden = "true">&times;</span>
						<span class = "sr-only">Close</span>
					</button>
					<h4 class="modal-title">Rent Bike</h4>
				</div>
				<div class="modal-body">
					<form id = "rntBike" method= "post"action= "{{URL::route('rentBike',array($bike->id,$bike->nadlezni))}}">
						<div class="form-group{{($errors->has('password')) ? 'has-error' :  ''}}">
							<input id="crd" name="crd" type="text"class="form-control"placeholder="Card number">
							<!-- @if($errors->has('password'))
								{{$errors->first('password')}}
							@endif -->
						</div>
						<div class="form-group{{($errors->has('password')) ? 'has-error' :  ''}}">
							<input id="cvc" name="cvc" type="text"class="form-control" placeholder="CVC">
							<!-- @if($errors->has('password'))
								{{$errors->first('password')}}
							@endif -->
						</div>
						<div class="form-group{{($errors->has('password')) ? 'has-error' :  ''}}">
							<input id="exp" name="exp" type="text"class="form-control" placeholder="Expiration">
							<!-- @if($errors->has('password'))
								{{$errors->first('password')}}
							@endif -->
						</div>
						<div class="form-group{{($errors->has('password')) ? 'has-error' :  ''}}">
							<input id="day" name="day" type="text"class="form-control" placeholder="Days(*Bike price per day)">
							<!-- @if($errors->has('password'))
								{{$errors->first('password')}}
							@endif -->
						</div>
						<div class="modal-footer">
							<button type="submit"class = "btn btn-primary"data-dismiss = "modal" id = "rentBike">Pay with Stripe</button>
						</div>
						{{Form::token()}} 
					</form>
				</div>
				
				
			</div>
		</div>
	</div>
	<!-- End Rent Bike -->
<script type="text/javascript">

    var latlng = new google.maps.LatLng("{{$bike->lat}}", "{{$bike->lng}}");
    var myOptions = {
        zoom: 10,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
</script>
@if($allBikes->isEmpty())
<script>
   var marker = new google.maps.Marker({
      position: new google.maps.LatLng("{{$bike->lat}}","{{$bike->lng}}"),
      map: map,
      icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
      title: '{{$bike->ime}}'
      
  });
</script>
@else
@foreach($allBikes as $allBike)
<script>
   var marker = new google.maps.Marker({
      position: new google.maps.LatLng("{{$allBike->lat}}","{{$allBike->lng}}"),
      map: map,
      icon: '<?php if($bike->id == $allBike->id){echo "http://maps.google.com/mapfiles/ms/icons/blue-dot.png";}else{echo"http://maps.google.com/mapfiles/ms/icons/red-dot.png";}?>',
      title: '{{$allBike->ime}}'
      
  });
</script>
@endforeach
@endif
@stop
@section('footer')
@stop
@section('javascript')
	 @parent
@stop
@if(Session::has('modal'))
	<script type="text/javascript">
		$("{{Session::get('modal')}}").modal('show');
	</script>
@endif

