<?php 

class CommentController extends BaseController{
	public function postComment($id,$idb){
		
		 if(Request::ajax()){
		 // 	$t = DB::table('notifications')->groupBy('from','to','bike','type')->get();
			// return $t;
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

				$comment2 = Comment::all();
				foreach ($comment2 as $com) {
					if($idb == $com->to){
						$noti2 =  new Notifications();
						$noti2->from = Auth::user()->id;
						$noti2->to = $com->from;
						$noti2->bike = $idb;
						$noti2->read = 0;
						$noti2->type = 2;
						$noti2->save();

					}	
				}
				
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