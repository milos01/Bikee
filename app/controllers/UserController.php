<?php 

class UserController extends BaseController{
	public function postCreate(){
		$this->layout = null;
		if(Request::ajax()){
			$validate = Validator::make(Input::all(),array(
				'username' => 'required|min:4',
				'password' => 'required|min:3',
				'rPassword' => 'required|same:password',
				'email' => 'required',
				'ImePrz' => 'required|min:4',
				'city' => 'required|min:2'
			));
		if ($validate->fails()) {
			return "Wrong inputs";
			// return Redirect::route('home')->with('success','You registered successfully');
		}
		else{	
			$user = new User();
			$user->username = Input::get('username');
			$user->password = Hash::make(Input::get('password'));
			$user->email = Input::get('email');
			$user->ImePrz = Input::get('ImePrz');
			$user->TipKor = Input::get('type');
			$user->pic = Input::get('slika');
			$user->city = Input::get('city');
		
		 	if ($user->save()) {
		 		return "Success";
		 	}else{
		 		 return "Something went wrong!";
		 	}
		}
		
		
		}
	}
	public function postLogin(){
		$validate = Validator::make(Input::all(),array(
			'username'=>'required',
			'password'=>'required'
		));
		if ($validate->fails()){
			return Redirect::route('home')->withErrors($validate)->withInput()->with('fail','Fill all fields, login again.');
		}else{
			$remember = (Input::has('remember'))?true : false;
			$auth = Auth::attempt(array(
					'username'=> Input::get('username'),
					'password'=> Input::get('password')
				),$remember);
			if($auth){
				//ako je loginov
				
				return Redirect::route('userHome');
			}else{
				//ake nije uspesno logovan
				return Redirect::route('home')->with('fail', 'Something wrong with input elements.');
			}
		}
	
	}
	public function userHomeMain($id){
		$user = User::find($id);
		$rented = Rent::all();
		$bikesMarka =   Bike::distinct()->select('marka')->get();
		$bikesTip =   Bike::distinct()->select('tip')->get();
		$bikes = Bike::where('nadlezni','=',$id)->get();
		if ($user) {
			return View::make('layouts.userMain')->with('bikes',$bikes)->with('user',$user)->with('rented',$rented)->with('bikesMarka',$bikesMarka)->with('bikesTip',$bikesTip);
		}else{
			return Redirect::route('userHome');
		}
		
		
	}
	public function getLogout(){
		Auth::logout();
		return Redirect::route('home');
	}
	public function userHome(){
		$rented = Rent::all();
		$bikesMarka =   Bike::distinct()->select('marka')->get();
		$bikesTip =   Bike::distinct()->select('tip')->get();
		if(Input::get('secret') == 111){
			$bikes = $this->searchBike(0,0);
			return View::make('layouts.user')->with('bikes',$bikes)->with('bikesMarka',$bikesMarka)->with('bikesTip',$bikesTip)->with('rented',$rented);
		}
		$bikes = Bike::all();
		return View::make('layouts.user')->with('bikes',$bikes)->with('bikesMarka',$bikesMarka)->with('bikesTip',$bikesTip)->with('rented',$rented);
	}
	public function sortBikes($id){
		if($id == 1){
			$bikes = DB::table('bajs')->where('status','=',0)->get();
			return $bikes;
		}elseif($id == 2){
			$bikes = DB::table('bajs')->where('status','=',1)->get();
			return $bikes;
		}elseif($id == 3){
			$bikes = DB::table('bajs')->where('prodat','=',1)->get();
			return $bikes;
		}
		elseif($id == 4){
			$bikes = DB::table('bajs')->orderBy('ocena','asc')->get();
			return $bikes;
		}
		elseif($id == 5){
			$bikes = DB::table('bajs')->orderBy('ocena','desc')->get();
			return $bikes;
		}else{
			$bikes = DB::table('bajs')->get();
			return $bikes;
		}
	}
	public function searchBike($tip,$cont){
		if($cont == 0 && $tip == 0){
			if(Input::get('marka') == "" && Input::get('tip') != ""){
				$bikes = DB::table('bajs')->where('tip','=',Input::get('tip'))->whereBetween('ocena', array(Input::get('ocenaFrom'), Input::get('ocenaTo')))->get();
				return $bikes;
			}
			elseif (Input::get('tip') == "" && Input::get('marka') != "") {
				$bikes =  DB::table('bajs')->where('marka','=',Input::get('marka'))->whereBetween('ocena', array(Input::get('ocenaFrom'), Input::get('ocenaTo')))->get();
				return $bikes; 
			}
			elseif(Input::get('marka') == "" && Input::get('tip') == ""){
				$bikes =  DB::table('bajs')->whereBetween('ocena', array(Input::get('ocenaFrom'), Input::get('ocenaTo')))->get();
				return $bikes; 
			 }
			 elseif(Input::get('marka') != "" && Input::get('tip') != ""){
				$bikes =  Bike::where('tip','=',Input::get('tip'))->where('marka','=',Input::get('marka'))->whereBetween('ocena', array(Input::get('ocenaFrom'), Input::get('ocenaTo')))->get();
				return $bikes; 
			 }
			 else{
			 	$bikes =  DB::table('bajs')->get();
			 	return $bikes; 
			 }
		}else{
			$rented = Rent::all();
			$bikesMarka =   Bike::distinct()->select('marka')->get();
			$bikesTip =   Bike::distinct()->select('tip')->get();
		 	$bikes = $this->sortBikes($tip);
		 	return View::make('layouts.user')->with('bikes',$bikes)->with('bikesMarka',$bikesMarka)->with('bikesTip',$bikesTip)->with('rented',$rented);

		}

	}
}