@extends('layouts.default')

@section('head')
    <link href="{{ asset('assets/css/modules/users/style.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/jquery.datetimepicker.css') }}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{ asset('assets/js/modules/banner/customBanner.js') }}"></script> <!-- específico -->
@stop

@section('content')
	
	<div class="page-header">
	    <div class="page-title">
	      <h3>{{ Lang::get('mod-banner/infoMsg.TITLE_EDIT') }}<small>{{ Lang::get('mod-banner/infoMsg.DESCRIPTION_PAGE_EDIT') }} </small></h3>
	    </div>
  	</div>
	<!-- /page header --><!-- Breadcrumbs line -->
	<div class="breadcrumb-line">
		<ul class="breadcrumb">
		  <li><a href="{{ URL::to('/cms2ms') }}">{{ Lang::get('mod-banner/infoMsg.BREADCRUMB_GO_HOME') }}</a></li>
		  <li><a href="{{ URL::to('banner/showList') }}">{{ Lang::get('mod-banner/infoMsg.BREADCRUMB_BACK_CURRENT_LIST') }}</a></li>
		  <li><a href='{{ URL::to("banner/$banner->id/showEdit") }}'>{{ Lang::get('mod-banner/infoMsg.BREADCRUMB_CURRENT_EDIT') }}</a></li>
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

        {{ Form::model($banner, array('route' => array('banner.update', $banner->id), 'files'=> true, 'method'=>'POST', 'class'=>'form-horizontal forms_main')) }}
			<?php 
                $b_onlydate = substr($banner->show_begin , 0, 10);
                $b_onlytime = substr($banner->show_begin , 10, 16);
                $b_dateMysql = implode("/",array_reverse(explode("-",$b_onlydate)));
                $datetime_begin = $b_dateMysql . $b_onlytime;
                
                $e_onlydate = substr($banner->show_end , 0, 10);
                $e_onlytime = substr($banner->show_end, 10, 16);
                $e_dateMysql = implode("/",array_reverse(explode("-",$e_onlydate)));
                $datetime_end = $e_dateMysql . $e_onlytime;

            ?>
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
                            {{ Form::label('title', Lang::get('mod-banner/infoMsg.LABEL_BAN_TITLE')) }} <span class="mandatory">*</span>
							{{ Form::text('title', Input::old('title'), array('class' => 'form-control', 'placeholder' => Lang::get('mod-banner/infoMsg.PH_BAN_TITLE'))) }}
							@if ($errors->has('title')) <p class="help-block"><span class="redalert">{{ $errors->first('title') }}</span></p> @endif
                        </div>
                    </div>

                    <div class="form-group"><!-- Link do Banner -->
                        <div class="col-md-8">
                            {{ Form::label('link', Lang::get('mod-banner/infoMsg.LABEL_BAN_LINK')) }}
                            {{ Form::text('link', Input::old('link'), array('class' => 'form-control', 'placeholder' => Lang::get('mod-banner/infoMsg.PH_BAN_LINK'))) }}
                            @if ($errors->has('link')) <p class="help-block"><span class="redalert">{{ $errors->first('link') }}</span></p> @endif
                        </div>
                    </div>

                    <div class="form-group"><!-- Data Inicial do Banner -->
                        <div class="col-md-8">
                            {{ Form::label('show_begin', Lang::get('mod-banner/infoMsg.LABEL_BAN_BEGIN')) }} <span class="mandatory">*</span>
                            {{ Form::text('show_begin', $datetime_begin, array('class' => 'form-control', 'id'=>'dt_inicio_ins', 'placeholder' => Lang::get('mod-banner/infoMsg.PH_BAN_BEGIN'))) }}
                            @if ($errors->has('show_begin')) <p class="help-block"><span class="redalert">{{ $errors->first('show_begin') }}</span></p> @endif
                        </div>
                    </div>
                    
                    <div class="form-group"><!-- Data final do Banner -->
                        <div class="col-md-8">
                            {{ Form::label('show_end', Lang::get('mod-banner/infoMsg.LABEL_BAN_END')) }} <span class="mandatory">*</span>
                            {{ Form::text('show_end', $datetime_end, array('class' => 'form-control', 'id'=>'dt_fim_ins', 'placeholder' => Lang::get('mod-banner/infoMsg.PH_BAN_END'))) }}
                            @if ($errors->has('show_end')) <p class="help-block"><span class="redalert">{{ $errors->first('show_end') }}</span></p> @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="imagem">{{ Lang::get('mod-banner/infoMsg.LABEL_IMAGE') }}</label>
                        <div class="col-sm-10">
                            <input type="file" class="styled form-control" name="imagem" id="report-screenshot">
                            <span class="help-block">{{ Lang::get('mod-banner/infoMsg.INFO_EXTENSION_SUP') }}</span>
                        </div>
                    </div>
                    <?php 
                        $fotos = DB::table('tab_images')->where('module_id', $banner->id)->first();
                        
                        $imgThumb = isset($fotos->title) ? sprintf(Config::get('constants.path_banner_imgs'),$banner->id, 'thumb' ,$fotos->title ) : 'nulo';
                        $imgOriginal = isset($fotos->title) ? sprintf(Config::get('constants.path_banner_imgs'),$banner->id, 'original' ,$fotos->title ) : 'nulo';
                    ?>
                    @if(file_exists($imgThumb))
                        <a data-toggle="modal" role="button" href="#default_modal"><img src="{{ asset($imgThumb) }}" alt=""></a>

                        <div id="default_modal" class="modal fade" tabindex="-1" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">{{ Lang::get('mod-banner/infoMsg.LABEL_IMAGE') }}</h4>
                                    </div>

                                    <div class="modal-body with-padding">
                                        <img src="{{ asset($imgOriginal) }}" alt="" width="568">
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-warning" data-dismiss="modal"><i class="icon-cancel-circle"></i> {{ Lang::get('mod-banner/infoMsg.BTN_IMG_CLOSE') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label class="col-sm-2 control-label"> {{ Lang::Get('mod-banner/infoMsg.LABEL_STATUS') }}</label>
                        <div class="col-sm-10">
                            <div class="block-inner">
                                <label class="radio-inline radio-info">
                                   
                                <input type="radio" name="status" value="A" id="status" <?php if( $banner->status== "A") { echo 'checked="checked"'; } ?> >{{ Lang::Get('mod-banner/infoMsg.LABEL_ACTIVE') }}
                                </label>
                                <label class="radio-inline radio-info">
                                    <input type="radio" name="status" value="I" id="status" <?php if( $banner->status== "I") { echo 'checked="checked"'; } ?> >{{ Lang::Get('mod-banner/infoMsg.LABEL_INACTIVE') }}
                                </label>

                            </div>
                        </div>
                    </div>

                <div class="text-center">
	              {{ Form::submit( Lang::Get('mod-banner/infoMsg.BTN_REGISTER') , array('class'=>'btn btn-success')) }}
	              {{ Form::reset(Lang::Get('mod-banner/infoMsg.BTN_CANCEL'), array('class'=>'btn btn-default')) }}
	            </div>
            </div>
        </div>
                
		{{ Form::close() }}
@stop