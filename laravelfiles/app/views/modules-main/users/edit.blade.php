@extends('layouts.default')

@section('head')
	<link href="{{ asset('assets/css/modules/users/style.css') }}" rel="stylesheet" type="text/css">
@stop

@section('content')

	<div class="page-header">
	    <div class="page-title">
	      <h3>Atualizar dados do perfil <small>Nesta página você pode alterar os dados do seu usuário. </small></h3>
	    </div>
  	</div>
	<!-- /page header --><!-- Breadcrumbs line -->
	<div class="breadcrumb-line">
		<ul class="breadcrumb">
		  <li><a href="{{ URL::to('/cms2ms') }}">Voltar para Home</a></li>
		  <li><a href="{{ URL::to('user/showList') }}">Voltar para Usuários cadastrados</a></li>
		  <li><a href="{{ URL::to('#') }}">Você está em Atualizar dados do perfil</a></li>
		  <li class="active">Se precisar de ajuda clique <a href="#">aqui</a></li>
		</ul>
			<div class="visible-xs breadcrumb-toggle"><a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a></div>
		<ul class="breadcrumb-buttons collapse">
		</ul>
	</div>

	@if (Session::has('message'))
		<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif

	<div class="col-lg-2"> 
        <!-- Profile links -->
        <div class="block">
            <div class="block">
                <div class="thumbnail">
                    <div class="thumb"><img alt="" src="../../files/user/01/01.png">
                        <div class="thumb-options"><span><a href="#" class="btn btn-icon btn-success"><i class="icon-pencil"></i></a><a href="#" class="btn btn-icon btn-success"><i class="icon-remove"></i></a></span></div>
                    </div>
                    <div class="caption text-center">
                        <h6>%User% <small>Cargo</small></h6>
                        <div class="icons-group"><a href="#" title="Flick" class="tip"><i class="icon-flickr2"></i></a> <a href="#" title="Twitter" class="tip"><i class="icon-twitter"></i></a> <a href="#" title="Facebook" class="tip"><i class="icon-facebook"></i></a> </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /profile links --> 
    </div>
    <div class="col-lg-10">
    <!-- Page tabs -->

	<section class="content-users-form-insert">
		{{ Form::model($user, array('route' => array('user.update', $user->id))) }}


			<div class="block-inner">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                {{ Form::label('name', 'Nome') }} <span class="mandatory">*</span>
								{{ Form::text('name', Input::old('name'), array('class' => 'form-control', 'placeholder' => 'Digite seu nome')) }}
								@if ($errors->has('name')) <p class="help-block"><span class="redalert">{{ $errors->first('name') }}</span></p> @endif
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('lastname', 'Sobrenome') }} <span class="mandatory">*</span>
								{{ Form::text('lastname', Input::old('lastname'), array('class' => 'form-control', 'placeholder' => 'Digite Sobrenome')) }}
								@if ($errors->has('lastname')) <p class="help-block"><span class="redalert">{{ $errors->first('lastname') }}</span></p> @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                {{ Form::label('address', 'Endereço') }} 
								{{ Form::text('address', Input::old('address'), array('class' => 'form-control', 'placeholder' => 'Rua parana, 125')) }}
								@if ($errors->has('address')) <p class="help-block"><span class="redalert">{{ $errors->first('address') }}</span></p> @endif
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('neighborhood', 'Bairro') }}
								{{ Form::text('neighborhood', Input::old('neighborhood'), array('class' => 'form-control', 'placeholder' => 'Digite seu bairro')) }}
								@if ($errors->has('neighborhood')) <p class="help-block"><span class="redalert">{{ $errors->first('neighborhood') }}</span></p> @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                {{ Form::label('city', 'Cidade') }}
								{{ Form::text('city', Input::old('city'), array('class' => 'form-control', 'placeholder' => 'Digite sua cidade')) }}
								@if ($errors->has('city')) <p class="help-block"><span class="redalert">{{ $errors->first('city') }}</span></p> @endif
                            </div>
                            <div class="col-md-4">
                                {{ Form::label('state', 'Estado') }}
								{{ Form::text('state', Input::old('state'), array('class' => 'form-control', 'placeholder' => 'Digite seu Estado')) }}
								@if ($errors->has('state')) <p class="help-block"><span class="redalert">{{ $errors->first('state') }}</span></p> @endif
                            </div>
                            <div class="col-md-4">
                                {{ Form::label('cep', 'Cep') }}
								{{ Form::text('cep', Input::old('cep'), array('class' => 'form-control', 'placeholder' => 'Digite seu cep (somente números)')) }}
								@if ($errors->has('cep')) <p class="help-block"><span class="redalert">{{ $errors->first('cep') }}</span></p> @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                {{ Form::label('email', 'E-mail') }} <span class="mandatory">*</span>
								{{ Form::text('email', Input::old('email'), array('class' => 'form-control', 'placeholder' => 'Digite um e-mail válido')) }}
								@if ($errors->has('email')) <p class="help-block"><span class="redalert">{{ $errors->first('email') }}</span></p> @endif
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('sex', 'Sexo')}}
                                {{  Form::select('sex', array('i' => 'Ideterminado', 'm' => 'Masculino', 'f' => 'Feminino',  'e' => 'Empresa'),null, array('class' => 'select-full')); }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
	                            {{ Form::label('telephone', 'Telefone') }} <span class="mandatory">*</span>
								{{ Form::text('telephone', Input::old('telephone'), array('class' => 'form-control', 'data-mask' => '(99) 9999-99999', 'placeholder' => '(99) 9999-99999')) }}
								@if ($errors->has('telephone')) <p class="help-block"><span class="redalert">{{ $errors->first('telephone') }}</span></p> @endif

                                </div>
                            <div class="col-md-6">
                                
                                {{ Form::label('imgcustom' ,'Carregar Imagem do Perfil') }}
                                {{ Form::file('imgcustom', array('class' => 'styled form-control')) }}
                                @if ($errors->has('imgcustom')) <p class="help-block"><span class="redalert">{{ $errors->first('imgcustom') }}</span></p> @endif
                                <span class="help-block">Arquivos suportados: gif, png, jpg. Max file size 2Mb</span></div>
                        </div>
                    </div>
                </div>
                <h6 class="heading-hr"><i class="icon-lock"></i> Informaçoes de Segurança:</h6>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            {{ Form::label('username', 'Usuário') }} <span class="mandatory">*</span>
							{{ Form::text('username', Input::old('username'), array('class' => 'form-control', 'readonly', 'placeholder' => 'Digite um nome de usuário')) }}
							@if ($errors->has('username')) <p class="help-block"><span class="redalert">{{ $errors->first('username') }}</span></p> @endif
                        </div>
                        <div class="col-md-6">
                            
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            {{ Form::label('password', 'Nova Senha') }}
							{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Digite uma senha de no mínimo 6 caractere')) }}
							@if ($errors->has('password')) <p class="help-block"><span class="redalert">{{ $errors->first('password') }}</span></p> @endif
							<span class="help-block">Apenas insira uma nova senha caso deseje modificar a atual</span>
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('password-repeat', 'Confirmação da senha') }}
							{{ Form::password('password-repeat', array('class' => 'form-control', 'placeholder' => 'Digite novamente a senha')) }}
							@if ($errors->has('password-repeat')) <p class="help-block"><span class="redalert">{{ $errors->first('password-repeat') }}</span></p> @endif
                        </div>
                    </div>
                </div>

 				<!--
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Privilégio: </label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="visibility" class="styled" checked="checked">
                                    Administrador</label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="visibility" class="styled">
                                    Usuário</label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="visibility" class="styled">
                                    Estágiario</label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="visibility" class="styled">
                                    Secretária</label>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="text-center">
	              {{ Form::submit('Atualizar', array('class'=>'btn btn-success')) }}
	            </div>
                </div>
                
		{{ Form::close() }}
	</section>
@stop