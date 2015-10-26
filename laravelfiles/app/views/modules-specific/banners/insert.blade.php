@extends('layouts.default')

@section('head')
    <link href="{{ asset('assets/css/modules/users/style.css') }}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{ asset('assets/js/controllers/bannerController.js') }}"></script> <!-- específico -->
    <script type="text/javascript" src="{{ asset('assets/js/services/bannerService.js') }}"></script> <!-- específico -->
@stop

@section('content')
	
	<div class="page-header">
	    <div class="page-title">
	      <h3>{{ Lang::get('mod-banner/infoMsg.TITLE_INSERT') }}<small>{{ Lang::get('mod-banner/infoMsg.DESCRIPTION_PAGE_ADD') }} </small></h3>
	    </div>
  	</div>
	<!-- /page header --><!-- Breadcrumbs line -->
	<div class="breadcrumb-line">
		<ul class="breadcrumb">
		  <li><a href="{{ URL::to('/cms2ms') }}">{{ Lang::get('mod-banner/infoMsg.BREADCRUMB_GO_HOME') }}</a></li>
		  <li><a href="{{ URL::to('banner/showList') }}">{{ Lang::get('mod-banner/infoMsg.BREADCRUMB_BACK_CURRENT_LIST') }}</a></li>
		  <li><a href="{{ URL::to('banner/showInsert') }}">{{ Lang::get('mod-banner/infoMsg.BREADCRUMB_CURRENT_INSERT') }}</a></li>
		  <li class="active">{{ Lang::get('mod-banner/infoMsg.BREADCRUMB_NEED_HELP') }} <a href="#">aqui</a></li>
		</ul>
			<div class="visible-xs breadcrumb-toggle"><a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a></div>
		<ul class="breadcrumb-buttons collapse">
		</ul>
	</div>

	@if (Session::has('message'))
		<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif

	
    <!-- Page tabs -->


		{{ Form::open(array('url' => url('banner/insert'), 'class'=>'form-horizontal forms_main', 'files'=> true, 'method'=>'POST', 'name'=>'formInsertBanner')) }}
			
			<div class="panel panel-default">
                <div class="panel-heading">
                    <h6 class="panel-title"><i class="icon-new"></i> {{ Lang::get('mod-banner/infoMsg.TITLE_INSERT') }}</h6>
                </div>

                <div class="panel-body">
                    <div class="alert alert-success fade in block-inner">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ Lang::get('mod-banner/infoMsg.INFO_FILL_FIELDS') }}
                    </div>

                    <div class="form-group"><!-- Nome do Banner -->
                        <div class="col-md-8">
                            {{ Form::label('ban_titulo', Lang::get('mod-banner/infoMsg.LABEL_BAN_TITLE')) }} <span class="mandatory">*</span>
							{{ Form::text('ban_titulo', Input::old('ban_titulo'), array('class' => 'form-control', 'ng-required'=>'true','placeholder' => Lang::get('mod-banner/infoMsg.PH_BAN_TITLE'))) }}
							@if ($errors->has('ban_titulo')) <p class="help-block"><span class="redalert">{{ $errors->first('ban_titulo') }}</span></p> @endif
                        </div>
                    </div>

                    <div class="form-group"><!-- Link do Banner -->
                        <div class="col-md-8">
                            {{ Form::label('ban_link', Lang::get('mod-banner/infoMsg.LABEL_BAN_LINK')) }}
                            {{ Form::text('ban_link', Input::old('ban_link'), array('class' => 'form-control', 'placeholder' => Lang::get('mod-banner/infoMsg.PH_BAN_LINK'))) }}
                            @if ($errors->has('ban_link')) <p class="help-block"><span class="redalert">{{ $errors->first('ban_link') }}</span></p> @endif
                        </div>
                    </div>

                    <div class="form-group"><!-- Data Inicial do Banner -->
                        <div class="col-md-8">
                            {{ Form::label('ban_inicio', Lang::get('mod-banner/infoMsg.LABEL_BAN_BEGIN')) }} <span class="mandatory">*</span>
                            {{ Form::text('ban_inicio', Input::old('ban_inicio'), array('class' => 'form-control', 'id'=>'dt_inicio_ins', 'placeholder' => Lang::get('mod-banner/infoMsg.PH_BAN_BEGIN'))) }}
                            @if ($errors->has('ban_inicio')) <p class="help-block"><span class="redalert">{{ $errors->first('ban_inicio') }}</span></p> @endif
                        </div>
                    </div>
                    
                    <div class="form-group"><!-- Data final do Banner -->
                        <div class="col-md-8">
                            {{ Form::label('ban_fim', Lang::get('mod-banner/infoMsg.LABEL_BAN_END')) }} <span class="mandatory">*</span>
                            {{ Form::text('ban_fim', Input::old('ban_fim'), array('class' => 'form-control', 'id'=>'dt_fim_ins', 'placeholder' => Lang::get('mod-banner/infoMsg.PH_BAN_END'))) }}
                            @if ($errors->has('ban_fim')) <p class="help-block"><span class="redalert">{{ $errors->first('ban_fim') }}</span></p> @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="imagem">{{ Lang::get('mod-banner/infoMsg.LABEL_IMAGE') }}</label>
                        <div class="col-sm-10">
                            <input type="file" class="styled form-control" name="imagem" id="report-screenshot">
                            <span class="help-block">{{ Lang::get('mod-banner/infoMsg.INFO_EXTENSION_SUP') }}</span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> {{ Lang::Get('mod-banner/infoMsg.LABEL_STATUS') }}</label>
                        <div class="col-sm-10">
                            <div class="block-inner">
                                <label class="radio-inline radio-info">
                                    {{ Form::radio('ban_status', 'A', array('checked'=>'checked')) }} {{ Lang::Get('mod-banner/infoMsg.LABEL_ACTIVE') }}
                                </label>
                                <label class="radio-inline radio-info">
                                    {{ Form::radio('ban_status', 'I') }} {{ Lang::Get('mod-banner/infoMsg.LABEL_INACTIVE') }}
                                </label>
                            </div>
                        </div>
                    </div>

                <div class="text-center">
	              {{ Form::submit( Lang::Get('mod-banner/infoMsg.BTN_REGISTER') , array('class'=>'btn btn-success', 'ng-disabled'=>'formInsertBanner.$invalid')) }}
	              {{ Form::reset(Lang::Get('mod-banner/infoMsg.BTN_CANCEL'), array('class'=>'btn btn-default')) }}
	            </div>
            </div>
        </div>
                
		{{ Form::close() }}
@stop