<?php

class BikeController extends BaseController{
	public function addBike(){
		$validate = Validator::make(Input::all(),array(
				'bikename' => 'required|min:3',
				'brand' => 'required|min:3',
				'type' => 'required|min:3',
				'pic' => 'required'
			));
		if ($validate->fails()) {
			return Redirect::route('userHome')->withErrors($validate)->withInput()->with('fail','Incorect input data!');
		}else{
			$bajs = new Bike();
			$bajs->ime = Input::get('bikename');
			$bajs->marka = Input::get('brand');
			$bajs->tip = Input::get('type');
			$bajs->nadlezni = Auth::user()->id;
			$bajs->pic = Input::get('pic');
			$bajs->ocena = 1.0;
			$bajs->lat = 33.33;
			$bajs->lng = 22.22;
			$bajs->status = 0;
			$bajs->prodat = 0;
		
			if ($bajs->save()) {
				return Redirect::route('userHome')->with('success','You added bike successfully');
			}else{
				return Redirect::route('userHome')->with('fail','An error occured!');
			}
		}
	}
	public function showBike($id){
		$bike = Bike::find($id);
		$allBikes = Bike::where('nadlezni','=',Auth::user()->id)->get();
		$comment = DB::table('comments')->orderBy('created_at','desc')->get();
		$users = User::all();
		return View::make('layouts.bike')->with('bike',$bike)->with('comment',$comment)->with('users',$users)->with('allBikes',$allBikes);
	}
	public function rateBike($id,$ocena){
		$bike = Bike::find($id);
		$bike->ocena = ($bike->ocena + $ocena)/2;
		// $bike->brojac++;
		$bike->save();
		return Redirect::route('showBike',$id); 

	}
	public function editBike($id){
		$bike = Bike::find($id);
		return View::make('layouts.edit')->with('bike',$bike);
	}
	public function editBikeAll($id){
		$validate = Validator::make(Input::all(),array(
				'bikename' => 'required|min:3',
				'brand' => 'required|min:3',
				'type' => 'required|min:3',
				'pic' => 'required',
				'status' => 'required',
				'prodat' => 'required'
			));
		if ($validate->fails()) {
			return Redirect::route('userHome')->withErrors($validate)->withInput()->with('fail','Incorect input data!');
		}else{
			$bajs = Bike::find($id);
			$bajs->ime = Input::get('bikename');
			$bajs->marka = Input::get('brand');
			$bajs->tip = Input::get('type');
			$bajs->pic = Input::get('pic');
			$bajs->status = Input::get('status');
			$bajs->prodat = Input::get('prodat');
			
			if ($bajs->save()) {
				return Redirect::route('userHome')->with('success','You edited bike successfully');
			}else{
				return Redirect::route('userHome')->with('fail','An error occured!');
			}
		}
	}
	
}