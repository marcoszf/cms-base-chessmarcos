<?php 
class MainSiteController extends BaseController {

    public function index()
    {
        return View::make('site.pages.home');
    }

    #envio do formulário de contato
    public function sendContact(){
    	$mensagens = array(
			'name.required'  =>  "* Preencha o campo nome",
			'email.required' =>  "* Preencha o campo e-mail",
			'message.required' =>  "* Digite sua mensagem",
			'email' => '* O e-mail informado é inválido'
		);
		$rules = array(
			'name'          => 'required',
			'email'         => 'required|email',
			'message'	    => 'required'
		);

		$validator = Validator::make(Input::all(), $rules, $mensagens);

		if ($validator->fails()) {

			return Response::json([
				'success' => false,
				'errors' => $validator->errors()->toArray()
				]);

		} else {
				$msg_form = Input::get('message');
	      $contactData = array(
				'name' 		=> Input::get('name'),
				'email' 	=> Input::get('email'),
				'messages' 	=> $msg_form
			);
	      

				Mail::send('site.mails.contatomail', $contactData, function($message) {
				    $message->to('contato@dimbox.com.br', 'Dimbox')->subject('Dimbox - Nova mensagem ');
				});

		      return Response::json([
		      	'success' => true
		      	]);
		}
    }
}
?>