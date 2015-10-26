@extends('layouts.default')

@section('head')
	<link href="{{ asset('assets/css/modules/users/style.css') }}" rel="stylesheet" type="text/css"> <!-- específico -->
	<script type="text/javascript" src="{{ asset('assets/js/controllers/contactController.js') }}"></script> <!-- específico -->
@stop

@section('content')
	
	<section id="content-users-list" ng-controller="listContact">
	
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
		  <li><a href="{{ URL::to('contact/showInsert') }}">{{ Lang::get('mod-contact/infoMsg.BREADCRUMB_CURRENT_LIST') }}</a></li>
		  <li class="active">{{ Lang::get('mod-contact/infoMsg.BREADCRUMB_NEED_HELP') }} <a href="#">aqui</a></li>
		</ul>
			<div class="visible-xs breadcrumb-toggle"><a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a></div>
		
		<md-button href="{{ URL::to('contact/showInsert') }}" class="md-raised md-button md-default-theme"><img src="{{ asset('assets/images/icons/add.png') }}" alt="">  {{ Lang::get('mod-contact/infoMsg.BTN_NEW') }}</md-button>
	</div>
		@if (Session::has('message'))
			<div class="msgInfoMain alert alert-info">{{ Session::get('message') }}</div>
		@endif

	<div>
	  <alert ng-repeat="alert in alerts" type="<%alert.type%>" close="closeAlert($index)"><% alert.msg %></alert>
	</div>

	    <table id="table_list_contacts" class="table table-striped table-bordered">
	        <thead>
	            <tr>
	                <th class="invoice-number">ID</th>
	                <th>Nome</th>
	                <th>E-mail</th>
	                <th>Descrição</th>
	                <th class="invoice-date">Data do envio</th>
	                <th class="invoice-expand text-center">Ação</th>
	            </tr>
	        </thead>
	        <tbody>
	        @foreach($contact as $key => $value)
	            <tr>
	                <td><a href="invoice.html"><strong>{{ $value->id }}</strong></a></td>
	                <td>{{ $value->name }}</td>
	                <td>{{ $value->email }}</td>
	                <td>{{ $value->description }}</td>
	                <td><span class="text-semibold">{{ date('d/m/Y', strtotime($value->created_at)) }}</span></td>
	                <td class="text-center"><div class="btn-group">
		                    <button type="button" class="btn fa fa-caret-square-o-down dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
		                    <ul class="dropdown-menu icons-right dropdown-menu-right">
		                        <li><a ng-click="deleteRow({{ $value->id }})" class="btnExcludeData" data-idExclude="{{ $value->id }}" href="#" ><i class="fa fa-trash-o"></i> {{ Lang::get('mod-news/infoMsg.LI_EXCLUDE') }}</a></li>
		                    </ul>
		                </div></td>
	            </tr>
	        @endforeach
	        </tbody>
	    </table>
	    <article class="dlgExcludeConfirm">
	    	Deseja realmente excluir esta mensagem?
	    </article>
    </section>
@stop