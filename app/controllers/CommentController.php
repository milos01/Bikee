<?php 

class CommentController extends BaseController{
	public function postComment($id,$idb){

		if(Request::ajax()){
			$validate = Validator::make(Input::all(),array(
					'body' => 'required',
				));
			if ($validate->fails()) {
				return "Wrong inputs";
				// return Redirect::route('showBike',$idb)->withErrors($validate)->withInput()->with('fail','Incorect input data!');
			}else{
				$nadlezni = Bike::find($idb)->nadlezni;
				$noti =  new Notifications();
				$noti->from = Auth::user()->id;
				$noti->to = $nadlezni;
				$noti->bike = $idb;
				$noti->read = 0;
				$noti->type = 0;

				$comment = new Comment();
				$comment->body = Input::get('body');
				$comment->from = $id;
				$comment->to = $idb;
				if ($comment->save() && $noti->save()) {
					return "Comment added";
					// return Redirect::route('showBike',$idb)->with('success','Comment added');
				}else{
					return "An error occured!";
					// return Redirect::route('showBike',$idb)->with('fail','An error occured!');
				}
			}
		}
	}
}