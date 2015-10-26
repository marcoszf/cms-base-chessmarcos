<?php

class MainCmsController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default 2ms Controller
	|--------------------------------------------------------------------------
	|
	| 
	|
	*/

	public function index()
	{

		// carrega página principal do cms
		if (Auth::check())
		{
		    return View::make('page-main.home');
		} else{
			return Redirect::to('login');
		}
		
	}

	function getLogin(){
		// carrega página de login do cms
		return View::make('page-main.login');
	}

	function postLogin(){
		
		$mensagens = array(
			'required' =>  "O :attribute é obrigatório",
			'alphaNum' =>  "O :attribute deve somente conter letras e números",
			'min'  => "O :attribute deve conter no mínimo três dígitos"
		);

		$rules = array(
			'login'    => 'required|min:3', // make sure the email is an actual email
			'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
		);

		$validator = Validator::make(Input::all(), $rules, $mensagens);

		if ($validator->fails()) {

			#obtém as mensagens de erros validator
			$messages = $validator->messages();

			#redirect com as mensagens de erros, e populando os campos digitados "old'
			return Redirect::to('login')
				->withErrors($validator)
				->withInput(Input::except('password'));

		} else {#validado com sucesso--------------

				$userdata = array(
					'username' 	=> Input::get('login'),
					'password' 	=> Input::get('password')
				);
			if (Auth::attempt($userdata)) {
				#login com sucesso
				return Redirect::to('cms');
			} else {
				#Falha no login
				Session::flash('message', 'Usuário ou senha incorreto');
				return Redirect::to('login');
			}
		}
	}
	public function getLogout(){
		Auth::logout();
		return Redirect::to('login');
	}

}