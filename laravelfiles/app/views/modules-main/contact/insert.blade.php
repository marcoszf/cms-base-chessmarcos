@extends('layouts.default')

@section('head')
    <link href="{{ asset('assets/css/modules/newsStyle.css') }}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{ asset('assets/js/controllers/contactController.js') }}"></script> <!-- específico -->
@stop

@section('content')
	<section ng-controller="insertContact">
		<div class="page-header">
	    <div class="page-title">
	      <h3>{{ Lang::get('mod-contact/infoMsg.NAME') }}<br><small>{{ Lang::get('mod-contact/infoMsg.DESCRIPTION') }}</small></h3>
	    </div>
	    <span class="msgInfoMain help-block alert alert-info" ng-show="alert" ><% alert %></span> 
  	</div>

		<!-- /page header --><!-- Breadcrumbs line -->
	<div class="breadcrumb-line">
		<ul class="breadcrumb">
		  <li><a href="{{ URL::to('/cms') }}">{{ Lang::get('mod-contact/infoMsg.BREADCRUMB_GO_HOME') }}</a></li>
		  <li><a href="{{ URL::to('contact/showList') }}">{{ Lang::get('mod-contact/infoMsg.BREADCRUMB_CURRENT_INSERT') }}</a></li>
		  <li class="active">{{ Lang::get('mod-contact/infoMsg.BREADCRUMB_NEED_HELP') }} <a href="#">aqui</a></li>
		</ul>
			<div class="visible-xs breadcrumb-toggle"><a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a></div>
	</div>
	
	{{ Form::open(array('url' => url('contact/insert'), 'name'=>'formInsertContact','class'=>'form-horizontal forms_main','novalidate' => 'novalidate')) }}
		<div class="panel panel-default">
			<div class="panel-heading">
          <h6 class="panel-title"><i class="icon-new"></i> {{ Lang::get('mod-contact/infoMsg.TITLE_INSERT') }}</h6>
      </div>
			<div class="panel-body">
				
				 <md-input-container class="md-icon-float form-group" show-errors='{showSuccess: true}'>
			      <!-- Use floating label instead of placeholder -->
			      {{ Form::label('name', Lang::get('mod-contact/infoMsg.LABEL_FORM_NAME')) }} 
			      <md-icon md-svg-src="{{ asset('assets/images/icons/silhueta-ico.svg') }}" class="name"></md-icon>
			      {{ Form::text('name', Input::old('name'), array('ng-required'=>'true',  'ng-model' => 'contact.name',  'placeholder' => Lang::get('mod-contact/infoMsg.PH_NEWS_LINK'))) }}
			      <div ng-messages="formInsertContact.name.$error">
		          <p ng-show="formInsertContact.name.$error.required" class="help-block" ng-message="required">Informe seu nome.</p>
		        </div>
			    </md-input-container>
			    
			    <md-input-container class="md-icon-float form-group" show-errors='{showSuccess: true}'>
			      <!-- Use floating label instead of placeholder -->
			      {{ Form::label('email', Lang::get('mod-contact/infoMsg.LABEL_FORM_EMAIL')) }} 
			      <md-icon md-svg-src="{{ asset('assets/images/icons/email-ico.svg') }}" class="name"></md-icon>
			      {{ Form::email('email', Input::old('email'), array('ng-required'=>'true', 'type'=>'email', 'ng-model' => 'contact.email',  'placeholder' => Lang::get('mod-contact/infoMsg.PH_NEWS_LINK'))) }}
			      <div ng-messages="formInsertContact.email.$error">
		          <p ng-show="formInsertContact.email.$invalid" class="help-block" ng-message="required">Informe um email válido.</p>
		        </div>
			    </md-input-container>

					<md-input-container class="md-icon-float form-group" show-errors='{showSuccess: true}'>
			      <!-- Use floating label instead of placeholder -->
			      {{ Form::label('subject', Lang::get('mod-contact/infoMsg.LABEL_FORM_SUBJECT')) }} 
			      <md-icon md-svg-src="{{ asset('assets/images/icons/subject-ico.svg') }}" class="name"></md-icon>
			      {{ Form::text('subject', Input::old('subject'), array('ng-required'=>'true',  'ng-model' => 'contact.subject',  'placeholder' => Lang::get('mod-contact/infoMsg.PH_NEWS_LINK'))) }}
			      <div ng-messages="formInsertContact.subject.$error">
		          <p ng-show="formInsertContact.subject.$error.required" class="help-block" ng-message="required">Informe o assunto da mensagem.</p>
		        </div>
			    </md-input-container>
					
					<md-input-container class="md-icon-float form-group" show-errors='{showSuccess: true}'>
			      <!-- Use floating label instead of placeholder -->

			      {{ Form::label('message', Lang::get('mod-contact/infoMsg.LABEL_FORM_MESSAGE')) }} 
						<md-icon md-svg-src="{{ asset('assets/images/icons/text-ico.svg') }}" class="name"></md-icon>	
			      {{ Form::textarea('message', Input::old('message'), array('ng-required'=>'true',  'ng-model' => 'contact.message',  'placeholder' => Lang::get('mod-contact/infoMsg.PH_NEWS_LINK'))) }}
			      <div ng-messages="formInsertContact.message.$error">
		          <p ng-show="formInsertContact.message.$error.required" class="help-block" ng-message="required">Escreva a sua mensagem.</p>
		        </div>
			    </md-input-container>

	    </div>
		</div>
	{{ Form::close() }}

		<div class="text-center">
        <button class="btn btn-success" ng-click="save()">{{ Lang::Get('mod-news/infoMsg.BTN_REGISTER') }}</button>
        <button class="btn btn-default" ng-click="reset()">{{ Lang::Get('mod-news/infoMsg.BTN_RESET') }}</button>
    </div>
	</section>
@stop