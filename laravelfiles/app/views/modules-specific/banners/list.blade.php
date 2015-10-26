@extends('layouts.default')

@section('head')
	<link href="{{ asset('assets/css/modules/users/style.css') }}" rel="stylesheet" type="text/css"> <!-- específico -->
	<script type="text/javascript" src="{{ asset('assets/js/controllers/bannerController.js') }}"></script> <!-- específico -->
	<script type="text/javascript" src="{{ asset('assets/js/services/bannerService.js') }}"></script> <!-- específico -->
@stop

@section('content')
	
	

	<section id="content-users-list" ng-controller="ListCtrl">
	
	

	<div class="page-header">
	    <div class="page-title">
	      <h3>{{ Lang::get('mod-banner/infoMsg.NAME') }}<small>{{ Lang::get('mod-banner/infoMsg.DESCRIPTION') }}</small></h3>
	    </div>
  	</div>
	<!-- /page header --><!-- Breadcrumbs line -->
	<div class="breadcrumb-line">
		<ul class="breadcrumb">
		  <li><a href="{{ URL::to('/cms2ms') }}">{{ Lang::get('mod-banner/infoMsg.BREADCRUMB_GO_HOME') }}</a></li>
		  <li><a href="{{ URL::to('banner/showList') }}">{{ Lang::get('mod-banner/infoMsg.BREADCRUMB_CURRENT_LIST') }}</a></li>
		  <li class="active">{{ Lang::get('mod-banner/infoMsg.BREADCRUMB_NEED_HELP') }} <a href="#">aqui</a></li>
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

      <md-button href="{{ URL::to('banner/showInsert') }}" class="md-raised md-button md-default-theme"><img src="{{ asset('assets/images/icons/add.png') }}" alt="">  {{ Lang::get('mod-banner/infoMsg.BTN_BAN_NEW') }}</md-button>
      </h6>
        </div>
	    <table ng-show="{{ $banner->count() }}" id="table_list_contacts" class="table table-striped table-bordered">
	        <thead>
	            <tr>
	                <th width="20">{{ Lang::get('mod-banner/infoMsg.LI_LABEL_ID') }}</th>
                  <th>{{ Lang::get('mod-banner/infoMsg.LI_LABEL_TITLE') }}</th>
                  <th>{{ Lang::get('mod-banner/infoMsg.LI_LABEL_LINK') }}</th>
                  <th>{{ Lang::get('mod-banner/infoMsg.LI_LABEL_BEGIN') }}</th>
                  <th>{{ Lang::get('mod-banner/infoMsg.LI_LABEL_END') }}</th>
                  <th width="50">{{ Lang::get('mod-banner/infoMsg.LI_LABEL_STATUS') }}</th>
                  <th width="80">{{ Lang::get('mod-banner/infoMsg.LI_LABEL_ACTIONS') }}</th>
	            </tr>
	        </thead>
	        
	        <tbody>
	        
		        @foreach($banner as $key => $value)
		            <tr id="row-{{ $value->id }}" >
		                <td>{{ $value->id }}</td>
		                <td>{{ $value->title }}</td>
		                <td>{{ $value->link }}</td>
		                <td><span class="text-semibold">{{ date('d/m/Y H:i:s', strtotime($value->show_begin)) }}</span></td>
		                <td><span class="text-semibold">{{ date('d/m/Y H:i:s', strtotime($value->show_end)) }}</span></td>
		                <td>{{ $value->status == 'A' ? 'Ativo' : 'Inativo' }}</td>
		                <td class="text-center"><div class="btn-group">
		                    <button type="button" class="btn fa fa-caret-square-o-down dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
		                    <ul class="dropdown-menu icons-right dropdown-menu-right">
		                        <li><a ng-click="deleteRow({{ $value->id }})" class="btnExcludeData" data-idExclude="{{ $value->id }}" href="#" ><i class="fa fa-trash-o"></i> {{ Lang::get('mod-banner/infoMsg.LI_EXCLUDE') }}</a></li>
		                        <li><a href='{{ URL::to("banner/$value->id/showEdit") }}' class="btnShowImages"><i class="fa fa-pencil-square-o"></i> {{ Lang::get('mod-banner/infoMsg.LI_EDIT') }}</a></li>
		                    </ul>
		                </div></td>
		            </tr>
		        @endforeach
	        
	        </tbody>
	        	<div class="default-info bg-info col-md-3" style="text-align:center" ng-show="!{{ $banner->count() }}">Não há registros</div>

	    </table>
    </section>
@stop