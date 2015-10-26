@extends('layouts.default')

@section('head')
	<link href="{{ asset('assets/css/modules/users/style.css') }}" rel="stylesheet" type="text/css"> <!-- específico -->
	<script type="text/javascript" src="{{ asset('assets/js/modules/users/index.js') }}"></script> <!-- específico -->
@stop

@section('content')
	
	<section id="content-users-list">
	<div class="page-header">
	    <div class="page-title">
	      <h3>Gerenciar Usuários<small>Neste módulo você pode gerenciar os usuários cadastrados no cms</small></h3>
	      <md-button href="{{ URL::to('user/showInsert') }}" class="md-raised md-button md-default-theme"><img src="{{ asset('assets/images/icons/add.png') }}" alt="">  {{ Lang::get('mod-users/infoMsg.BTN_USER_NEW') }}</md-button>
	    </div>

  	</div>
	<!-- /page header --><!-- Breadcrumbs line -->
	<div class="breadcrumb-line">
		<ul class="breadcrumb">
		  <li><a href="{{ URL::to('/cms2ms') }}">{{ Lang::get('mod-users/infoMsg.BREADCRUMB_GO_HOME') }}</a></li>
		  <li><a href="{{ URL::to('user/showList') }}">{{ Lang::get('mod-users/infoMsg.BREADCRUMB_CURRENT_LIST') }}</a></li>
		  <li class="active">{{ Lang::get('mod-users/infoMsg.BREADCRUMB_NEED_HELP') }} <a href="#">aqui</a></li>
		</ul>
			<div class="visible-xs breadcrumb-toggle"><a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a></div>
		
	</div>

		@if (Session::has('message'))
			<div class="msgInfoMain alert alert-info">{{ Session::get('message') }}</div>

		@endif
	    <table id="table_list_users" class="table table-striped table-bordered">
	        <thead>
	            <tr>
	                <th class="invoice-number">ID</th>
	                <th>Nome</th>
	                <th>Usuário</th>
	                <th>E-mail</th>
	                <th class="invoice-date">Data de cadastro</th>
	                <th class="invoice-expand text-center">Ação</th>
	            </tr>
	        </thead>
	        <tbody>
	        @foreach($users as $key => $value)
	            <tr>
	                <td><a href="invoice.html"><strong>{{ $value->id }}</strong></a></td>
	                <td>{{ $value->name }}</td>
	                <td>{{ $value->username }}</td>
	                <td>{{ $value->email }}</td>
	                <td><span class="text-semibold">{{ date('d/m/Y H:i:s', strtotime($value->created_at)) }}</span></td>
	                <td><div class="table-controls">
	                <a href='{{ URL::to("user/$value->id/edit") }}' class="btn btn-link btn-icon btn-xs tip" title="Editar"><i class="icon-pencil"></i></a> 
	                <a href="#" class="btnExcludeData btn btn-link btn-icon btn-xs tip" data-idExclude="{{ $value->id }}" title="Excluir" ng-click="showExclude($event)"><i class="icon-remove3"></i></a></td>
                </tr>
	                 
	            
	        @endforeach
	        </tbody>
	    </table>
    </section>
@stop