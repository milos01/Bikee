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
				$comment = new Comment();
				$comment->body = Input::get('body');
				$comment->from = $id;
				$comment->to = $idb;
				if ($comment->save()) {
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