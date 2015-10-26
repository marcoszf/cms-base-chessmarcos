@extends('layouts.default')

@section('head')
	<link href="{{ asset('assets/css/modules/users/style.css') }}" rel="stylesheet" type="text/css"> <!-- específico -->
	<script type="text/javascript" src="{{ asset('assets/js/controllers/newsController.js') }}"></script> <!-- específico -->
	<script type="text/javascript" src="{{ asset('assets/js/services/newsService.js') }}"></script> <!-- específico -->
	
	<script type="text/javascript" src="{{ asset('assets/plugins/angular-ui/ui-bootstrap-tpls-0.12.1.min.js') }}"></script> <!-- Plugin -->
@stop

@section('content')
	
	<section id="content-users-list" ng-controller="listNews">
	
	<div class="page-header">
	    <div class="page-title">
	      <h3>{{ Lang::get('mod-news/infoMsg.NAME') }}<small>{{ Lang::get('mod-news/infoMsg.DESCRIPTION') }}</small></h3>
	    </div>
	    <span class="msgInfoMain help-block alert alert-info" ng-show="alert" ><% alert %></span> 
  	</div>
	<!-- /page header --><!-- Breadcrumbs line -->
	<div class="breadcrumb-line">
		<ul class="breadcrumb">
		  <li><a href="{{ URL::to('/cms') }}">{{ Lang::get('mod-news/infoMsg.BREADCRUMB_GO_HOME') }}</a></li>
		  <li><a href="{{ URL::to('news/showList') }}">{{ Lang::get('mod-news/infoMsg.BREADCRUMB_CURRENT_LIST') }}</a></li>
		  <li class="active">{{ Lang::get('mod-news/infoMsg.BREADCRUMB_NEED_HELP') }} <a href="#">aqui</a></li>
		</ul>
			<div class="visible-xs breadcrumb-toggle"><a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a></div>
		
	</div>
		@if (Session::has('message'))
			<div class="msgInfoMain alert alert-info">{{ Session::get('message') }}</div>
		@endif

	<div>
	  <alert ng-repeat="alert in alerts" type="<%alert.type%>" close="closeAlert($index)"><% alert.msg %></alert>
	</div>

<div class="panel-heading">
            <h6 class="panel-title"><i class="icon-newspaper"></i>

      <md-button href="{{ URL::to('news/showInsert') }}" class="md-raised md-button md-default-theme"><img src="{{ asset('assets/images/icons/add.png') }}" alt="">  {{ Lang::get('mod-news/infoMsg.BTN_BAN_NEW') }}</md-button>
      </h6>
        </div>
	    <table ng-show="{{ $news->count() }}" id="table_list_contacts" class="table table-striped table-bordered">
	        <thead>
	            <tr>
	                <th width="20">{{ Lang::get('mod-news/infoMsg.LI_LABEL_ID') }}</th>
                  <th>{{ Lang::get('mod-news/infoMsg.LI_LABEL_TITLE') }}</th>
                  <th>{{ Lang::get('mod-news/infoMsg.LI_LABEL_DATE') }}</th>
                  <th>{{ Lang::get('mod-news/infoMsg.LI_LABEL_IMAGES') }}</th>
                  <th width="50">{{ Lang::get('mod-news/infoMsg.LI_LABEL_STATUS') }}</th>
                  <th width="80">{{ Lang::get('mod-news/infoMsg.LI_LABEL_ACTIONS') }}</th>
	            </tr>
	        </thead>
	        
	        <tbody>
	        	
		        @foreach($news as $key => $value)
		            <tr id="row-{{ $value->id }}" >
		                <td>{{ $value->id }}</td>
		                <td>{{ $value->title }}</td>
		                <td><span class="text-semibold">{{ date('d/m/Y H:i:s', strtotime($value->date)) }}</span></td>
		                <td><button class="btn btn-default" ng-click="showDialogImgs($event)"> Imagens </button></td>
		                <td>{{ $value->status == 'A' ? 'Ativo' : 'Inativo' }}</td>
		                <td class="text-center"><div class="btn-group">
		                    <button type="button" class="btn fa fa-caret-square-o-down dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
		                    <ul class="dropdown-menu icons-right dropdown-menu-right">
		                        <li><a ng-click="deleteRow({{ $value->id }})" class="btnExcludeData" data-idExclude="{{ $value->id }}" href="#" ><i class="fa fa-trash-o"></i> {{ Lang::get('mod-news/infoMsg.LI_EXCLUDE') }}</a></li>
		                        <li><a href='{{ URL::to("banner/$value->id/showEdit") }}' class="btnShowImages"><i class="fa fa-pencil-square-o"></i> {{ Lang::get('mod-news/infoMsg.LI_EDIT') }}</a></li>
		                    </ul>
		                </div></td>
		            </tr>
		        @endforeach
	        
	        </tbody>
	        	<div class="default-info bg-info col-md-3" style="text-align:center" ng-show="!{{ $news->count() }}">Não há registros</div>

	    </table>

	    <script type="text/ng-template" id="myModalContent.html">
        <div class="modal-header">
            <h3 class="modal-title">Im a modal!</h3>
        </div>
        <div class="modal-body">
            
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" ng-click="ok()">OK</button>
            <button class="btn btn-warning" ng-click="cancel()">Cancel</button>
        </div>
    </script>
    
    </section>

    
@stop