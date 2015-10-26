<!DOCTYPE html>
<html lang="pt-br">
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="Marcos Colombelli">
<title>CMS - ChessMarcos</title>

<link href="{{ asset('assets/plugins/bootstrap-3.3.2/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/plugins/font-awesome-4.3.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('assets/css/modules/users/login.css') }}" rel="stylesheet" type="text/css">

</head>
<body>

    <div class="container">

      
      {{ Form::open(array('url' => url('loginpost'), 'class'=>'form-signin', )) }}
        <h2 class="form-signin-heading">Login</h2>
        <label for="inputEmail" class="sr-only">Usuário</label>
        {{ Form::text('login', Input::old('login'), array( 'id' => 'inputEmail' ,'class' => 'form-control', 'placeholder' => 'Usuário')) }}
        
        <label for="inputPassword" class="sr-only">Senha</label>
        {{ Form::password('password', array('id' => 'inputPassword', 'class' => 'form-control', 'placeholder' => 'Password')) }}
        
        <button class="btn btn-lg btn-primary btn-block" type="submit">Acessar</button>
         <div class="mensagem-erro" style="margin-left:25px; color:#1b7d7e;">
            @if (Session::has('message'))
                    <p class="help-block"><span class="redalert">{{ Session::get('message') }}</span></p>
                @endif
                @if ($errors->has('login')) <p class="help-block"><span class="redalert">{{ $errors->first('login') }}</span></p> @endif

                @if ($errors->has('password')) <p class="help-block"><span class="redalert">{{ $errors->first('password') }}</span></p> @endif
         </div>
      {{ Form::close() }}
    </div> <!-- /container -->


</body>
</html>