<?php

class RentController extends BaseController{
	public function rentBike($id,$nadlezni){
		$validate = Validator::make(Input::all(),array(
				'crd' => 'required|min:3',
				'cvc' => 'required|min:3',
				'exp' => 'required|min:3',
				'day' => 'required'
			));
		if ($validate->fails()) {
			return Redirect::route('showBike',$id)->withErrors($validate)->withInput()->with('fail','Incorect input data!');
		}else{
			$bike = Bike::find($id);
			$bike->status = 1;
			$rent = new Rent();
			$rent->gazda = $nadlezni;
			$rent->who = Auth::user()->id;
			$rent->which = $id;
			$rent->crd = Input::get('crd');
			$rent->cvc = Input::get('cvc');
			$rent->exp = Input::get('exp');
			$rent->day = Input::get('day');
			
			if ($rent->save() && $bike->save()) {
			 	return Redirect::route('showBike',$id)->with('success','You rented bike successfully');
			}else{
			 	return Redirect::route('showBike',$id)->with('fail','An error occured!');
			}
		}
	}
	public function viewRented(){
		$rented = Rent::all();
		$bikes = Bike::all();
		$users = User::all();
		return View::make('layouts.rent')->with('rented',$rented)->with('bikes',$bikes)->with('users',$users);
	}
}