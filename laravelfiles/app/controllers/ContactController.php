<?php 
class ContactController extends BaseController {

public function getInsert(){
	if (Auth::check()) {
		return View::make('modules-main.contact.insert');
	} else{
		return Redirect::to('login');
	}
}
public function getShow(){
		if (Auth::check())
		{
			$contact = Contact::all();
		    return View::make('modules-main.contact.list')->with('contact', $contact);
		} else{
			return Redirect::to('login');
		}
	}
	public function getDelete($id){
		$contact = Contact::find($id);
		$contact->delete();

		// redirect
		Session::flash('message', 'Mensagem deletada com sucesso!');
		return Redirect::to('contact/showList');
	}

}
?>