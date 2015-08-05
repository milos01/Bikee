<?php 

class CommentController extends BaseController{
	public function postComment($id,$idb){
		$validate = Validator::make(Input::all(),array(
				'body' => 'required',
			));
		if ($validate->fails()) {
			return Redirect::route('showBike',$idb)->withErrors($validate)->withInput()->with('fail','Incorect input data!');
		}else{
			$comment = new Comment();
			$comment->body = Input::get('body');
			$comment->from = $id;
			$comment->to = $idb;
			if ($comment->save()) {
				
				return Redirect::route('showBike',$idb)->with('success','Comment added');
			}else{
				return Redirect::route('showBike',$idb)->with('fail','An error occured!');
			}
		}
	}
}