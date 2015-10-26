<?php
class UserController extends BaseController {
	public function getDelete($id){
		$user = User::find($id);
		$user->delete();

		// redirect
		Session::flash('message', 'Usuário deletado com sucesso');
		return Redirect::to('user/showList');
	}
	public function postEdit($id){
		//die('ok');
		$mensagens = array(
			'required' =>  "Este campo é obrigatório",
			'alpha_num' =>  "O usuário deve conter somente letras e números",
			'email' =>  "Digite um e-mail válido",
			'username.min'  => "O usuário deve conter no mínimo três dígitos",
			'password.min'  => "A senha deve conter no mínimo seis dígitos",
			'same'  => "O valor de confirmação deve ser o mesmo da senha"
		);
		#criando regra de validação
		$rules = array(
			'name'          	=> 'required',
			'lastname'          => 'required',
			'telephone'         => 'required',
			'username'      	=> 'required|alpha_num|min:3',
			'email'         	=> 'required|email',
			'password-repeat'	=> 'same:password'
		);

		$validator = Validator::make(Input::all(), $rules, $mensagens);

		// verifica se ouve falha na validação-------------
		if ($validator->fails()) {
			#obtém as mensagens de erros validator
			$messages = $validator->messages();

			#redirect com as mensagens de erros, e populando os campos digitados "old'
			return Redirect::to('user/'.$id.'/edit')
				->withErrors($validator)
				->withInput(Input::all());

		}else{
			$user = User::find($id);
			$user->name 		= Input::get('name');
			$user->lastname 	= Input::get('lastname');
			$user->address 		= Input::get('address');
			$user->neighborhood = Input::get('neighborhood');
			$user->city 		= Input::get('city');
			$user->state 		= Input::get('state');
			$user->cep 			= Input::get('cep');
			$user->sex 			= Input::get('sex');
			$user->sex 			= Input::get('sex');
			$user->telephone 	= Input::get('telephone');
			$user->imgcustom	= Input::get('imgcustom');
			$user->email 		= Input::get('email');
			$user->username 	= Input::get('username');
			$passUser = Input::get('password');
			if (!empty($passUser)){
				$user->password 	= Hash::make(Input::get('password'));
			}
			$user->save();
			
			Session::flash('message', 'Dados atualizados com sucesso!');
			return Redirect::to('user/showList');
		}
	}
	public function getEdit($id){
		if (Auth::check())
		{
			$user = User::find($id);
		    return View::make('modules-main.users.edit')->with('user',$user);
		} else{
			return Redirect::to('login');
		}
	}
	public function getShow(){
		if (Auth::check())
		{
			$users = User::all();
		    return View::make('modules-main.users.list')->with('users', $users);
		} else{
			return Redirect::to('login');
		}
	}
    public function getInsert()
    {
	  if (Auth::check())
		{
		    return View::make('modules-main.users.insert');
		} else{
			return Redirect::to('login');
		}
    }
    public function postInsert(){
    	$mensagens = array(
			'required' =>  "Este campo é obrigatório",
			'alpha_num' =>  "O usuário deve conter somente letras e números",
			'email' =>  "Digite um e-mail válido",
			'username.min'  => "O usuário deve conter no mínimo três dígitos",
			'password.min'  => "A senha deve conter no mínimo seis dígitos",
			'same'  => "O valor de confirmação deve ser o mesmo da senha"
		);
		#criando regra de validação
		$rules = array(
			'name'          	=> 'required',
			'lastname'          => 'required',
			'telephone'          => 'required',
			'username'      	=> 'required|alpha_num|min:3',
			'email'         	=> 'required|email',
			'password'			=> 'required|min:6',
			'password-repeat'	=> 'required|same:password'
		);

		$validator = Validator::make(Input::all(), $rules, $mensagens);

		// verifica se ouve falha na validação-------------
		if ($validator->fails()) {

			#obtém as mensagens de erros validator
			$messages = $validator->messages();

			#redirect com as mensagens de erros, e populando os campos digitados "old'
			return Redirect::to('user/showInsert')
				->withErrors($validator)
				->withInput(Input::all());

		} else {#validado com sucesso--------------
			$user = new User;
			$user->name 		= Input::get('name');
			$user->lastname 	= Input::get('lastname');
			$user->address 		= Input::get('address');
			$user->neighborhood = Input::get('neighborhood');
			$user->city 		= Input::get('city');
			$user->state 		= Input::get('state');
			$user->cep 			= Input::get('cep');
			$user->sex 			= Input::get('sex');
			$user->sex 			= Input::get('sex');
			$user->telephone 	= Input::get('telephone');
			$user->imgcustom	= Input::get('imgcustom');
			$user->email 		= Input::get('email');
			$user->username 	= Input::get('username');
			$user->password 	= Hash::make(Input::get('password'));
			$user->save();
			// redirect our user back to the form so they can do it all over again
			Session::flash('message', 'Usuário cadastrado com sucesso!');
			return Redirect::to('user/showInsert');
		}
    }
}

?>