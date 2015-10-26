@extends('layouts.default')

@section('head')
    <link href="{{ asset('assets/css/modules/newsStyle.css') }}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{ asset('assets/js/controllers/newsController.js') }}"></script> <!-- específico -->
    <script type="text/javascript" src="{{ asset('assets/js/services/newsService.js') }}"></script> <!-- específico -->
@stop

@section('content')
<section ng-controller="insertUpdateController">

    <div class="page-header">
    <div class="page-title">
      <h3>{{ Lang::get('mod-news/infoMsg.TITLE_INSERT') }}<small>{{ Lang::get('mod-news/infoMsg.DESCRIPTION_PAGE_ADD') }} </small></h3>
    </div>
    </div>
    <!-- /page header --><!-- Breadcrumbs line -->
    <div class="breadcrumb-line">
    <ul class="breadcrumb">
      <li><a href="{{ URL::to('/cms2ms') }}">{{ Lang::get('mod-news/infoMsg.BREADCRUMB_GO_HOME') }}</a></li>
      <li><a href="{{ URL::to('news/showList') }}">{{ Lang::get('mod-news/infoMsg.BREADCRUMB_BACK_CURRENT_LIST') }}</a></li>
      <li><a href="{{ URL::to('news/showInsert') }}">{{ Lang::get('mod-news/infoMsg.BREADCRUMB_CURRENT_INSERT') }}</a></li>
      <li class="active">{{ Lang::get('mod-news/infoMsg.BREADCRUMB_NEED_HELP') }} <a href="#">aqui</a></li>
    </ul>
    	<div class="visible-xs breadcrumb-toggle"><a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a></div>
    <ul class="breadcrumb-buttons collapse">
    </ul>
    </div>

    <div>
      <alert ng-repeat="alert in alerts" type="<%alert.type%>" close="closeAlert($index)"><% alert.msg %></alert>
    </div>

    <!-- Page tabs -->


    {{ Form::open(array('url' => url('news/insert'), 'name'=>'formInsertNews' ,'class'=>'form-horizontal forms_main', 'files'=> true, 'method'=>'POST', 'novalidate' => 'novalidate')) }}
    	
    	<div class="panel panel-default">
            <div class="panel-heading">
                <h6 class="panel-title"><i class="icon-new"></i> {{ Lang::get('mod-news/infoMsg.TITLE_INSERT') }}</h6>
            </div>

            <div class="panel-body" uploader="uploader" nv-file-drop="">
                <div class="form-group" show-errors='{showSuccess: true}'><!-- Título da Notícia -->
                    <div class="col-md-8">
                        <span class="red">* </span>{{ Form::label('news_title', Lang::get('mod-news/infoMsg.LABEL_NEWS_TITLE'), array('class'=> 'control-label')) }} 
    					{{ Form::text('news_title', Input::old('news_title'), array('ng-required'=>'true', 'ng-model' => 'news.title', 'class' => 'form-control', 'placeholder' => Lang::get('mod-news/infoMsg.PH_NEWS_TITLE'))) }}
                        <p class="help-block" ng-if="formInsertNews.news_title.$error.required">Insira o Título da Notícia</p>
                    </div>
                        
                </div>

                <div class="form-group" show-errors='{showSuccess: true}'><!-- Link da Notícia -->
                    <div class="col-md-8">
                        <span class="red">* </span>{{ Form::label('news_link', Lang::get('mod-news/infoMsg.LABEL_NEWS_LINK'), array('class'=> 'control-label')) }}
                        {{ Form::text('news_link', Input::old('news_link'), array('ng-required'=>'true', 'ng-model' => 'news.link', 'class' => 'form-control', 'placeholder' => Lang::get('mod-news/infoMsg.PH_NEWS_LINK'))) }}
                        <p class="help-block" ng-if="formInsertNews.news_link.$error.required">Insira o link de referência da Notícia</p>
                    </div>
                </div>

                <div class="form-group" show-errors='{showSuccess: true}'><!-- Resumo da Notícia -->
                    <div class="col-md-8">
                        <span class="red">* </span>{{ Form::label('news_summary', Lang::get('mod-news/infoMsg.LABEL_NEWS_SUMMARY'), array('class'=> 'control-label')) }}
                        {{ Form::text('news_summary', Input::old('news_summary'), array('ng-required'=>'true', 'ng-model' => 'news.summary', 'class' => 'form-control', 'placeholder' => Lang::get('mod-news/infoMsg.PH_NEWS_SUMMARY'))) }}
                        <p class="help-block" ng-if="formInsertNews.news_summary.$error.required">Escreva um breve resumo para a Notícia</p>
                    </div>
                </div>

                <div class="form-group" show-errors='{showSuccess: true}'><!-- Texto da Notícia -->
                    <div class="col-md-8">
                        <span class="red">* </span>{{ Form::label('news_text', Lang::get('mod-news/infoMsg.LABEL_NEWS_TEXT'), array('class'=> 'control-label')) }}
                        {{ Form::textarea('news_text', null, array('ng-required'=>'true','ng-minlength'=>'20', 'ng-model' => 'news.text', 'size' => '5x5', 'class' => 'form-control', 'placeholder' => Lang::get('mod-news/infoMsg.PH_NEWS_TEXT'))) }}
                        <p class="help-block" ng-if="formInsertNews.news_text.$error.required">Escreva o texto da Notícia</p>
                        <p class="help-block" ng-if="formInsertNews.news_text.$error.minlength">Escreva no mínimo 20 caracteres</p>
                    </div>
                </div>
                
                <div class="form-group" show-errors='{showSuccess: true}'><!-- Data da Notícia -->
                    <div class="col-md-6">  
                        <p class="input-group">
                          <input type="text" name="news_date" class="form-control" datepicker-popup="<%format%>" ng-model="news.dt" is-open="opened" datepicker-options="dateOptions" ng-required="true" close-text="Fechar" />
                          <span class="input-group-btn">
                            <button type="button" class="btn btn-default" ng-click="open($event)"><i class="glyphicon glyphicon-calendar"></i></button>
                          </span>
                        </p>
                    </div>
                    <p class="help-block" ng-if="formInsertNews.news_date.$error.required">Insira a data da Notícia</p>
                </div>
                
                <div class="form-group"> <!-- Upload imagens Notícia -->
                    {{ Form::label('news_images', Lang::get('mod-news/infoMsg.LABEL_NEWS_IMAGES'), array('class'=> 'col-sm-2 control-label')) }}
                    <div class="col-sm-10">
                        <input type="file" class="styled form-control" nv-file-select="" name="news_images" uploader="uploader" multiple>
                        <span >{{ Lang::get('mod-news/infoMsg.INFO_EXTENSION_SUP') }}</span>
                    </div>
                </div>
                
                <div class="col-md-9" style="margin-bottom: 40px">
                
                <p>Arquivos na fila: <% uploader.queue.length %></p>

                <table class="table">
                    <thead>
                        <tr>
                            <th width="50%">Nome</th>
                            <th ng-show="uploader.isHTML5">Tamanho</th>
                            <th ng-show="uploader.isHTML5">Progresso</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in uploader.queue">
                            <td>
                                <strong><% item.file.name %></strong>
                                <!-- Image preview -->
                                <!--auto height-->
                                <!--<div ng-thumb="{ file: item.file, width: 100 }"></div>-->
                                <!--auto width-->
                                <div ng-show="uploader.isHTML5" ng-thumb="{ file: item._file, height: 100 }"></div>
                                <!--fixed width and height -->
                                <!--<div ng-thumb="{ file: item.file, width: 100, height: 100 }"></div>-->
                            </td>
                            <td ng-show="uploader.isHTML5" nowrap><% item.file.size/1024/1024|number:2 %> MB</td>
                            <td ng-show="uploader.isHTML5">
                                <div class="progress" style="margin-bottom: 0;">
                                    <div class="progress-bar" role="progressbar" ng-style="{ 'width': item.progress + '%' }"></div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span ng-show="item.isSuccess"><i class="glyphicon glyphicon-ok"></i></span>
                                <span ng-show="item.isCancel"><i class="glyphicon glyphicon-ban-circle"></i></span>
                                <span ng-show="item.isError"><i class="glyphicon glyphicon-remove"></i></span>
                            </td>
                            <td nowrap>
                                <button type="button" class="btn btn-success btn-xs" ng-click="item.upload()" ng-disabled="item.isReady || item.isUploading || item.isSuccess">
                                    <span class="glyphicon glyphicon-upload"></span> Upload
                                </button>
                                <button type="button" class="btn btn-warning btn-xs" ng-click="item.cancel()" ng-disabled="!item.isUploading">
                                    <span class="glyphicon glyphicon-ban-circle"></span> Cancelar
                                </button>
                                <button type="button" class="btn btn-danger btn-xs" ng-disabled="item.isUploaded" ng-click="item.remove()">
                                    <span class="glyphicon glyphicon-trash"></span> Remover
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div>
                    <div>
                        Status de  progresso:
                        <div class="progress" style="">
                            <div class="progress-bar" role="progressbar" ng-style="{ 'width': uploader.progress + '%' }"></div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success btn-s" ng-click="uploader.uploadAll()" ng-disabled="!uploader.getNotUploadedItems().length">
                        <span class="glyphicon glyphicon-upload"></span> Enviar todos
                    </button>
                    <button type="button" class="btn btn-warning btn-s" ng-click="uploader.cancelAll()" ng-disabled="!uploader.isUploading">
                        <span class="glyphicon glyphicon-ban-circle"></span> Cancelar todos
                    </button>
                    <button type="button" class="btn btn-danger btn-s" ng-click="uploader.clearQueue()" ng-disabled="!uploader.queue.length">
                        <span class="glyphicon glyphicon-trash"></span> Remover todos
                    </button>
                </div>

            </div>
            <!-- Fim Upload Imagens Noticias  -->


                <div class="form-group"> <!-- Status da Notícia -->
                    <label class="col-sm-2 control-label"> {{ Lang::Get('mod-news/infoMsg.LABEL_STATUS') }}</label>
                    <div class="col-sm-10">
                        <div class="block-inner">
                            <label class="radio-inline radio-info">
                                {{ Form::radio('news_status', 'A', array('checked'=>'checked', 'ng-model'=>'news.status')) }} {{ Lang::Get('mod-news/infoMsg.LABEL_ACTIVE') }}
                            </label>
                            <label class="radio-inline radio-info">
                                {{ Form::radio('news_status', 'I', array('ng-model'=>'news.status')) }} {{ Lang::Get('mod-news/infoMsg.LABEL_INACTIVE') }}
                            </label>
                        </div>
                    </div>
                </div>

        </div>
    </div>
            
    {{ Form::close() }}
    <div class="text-center">
        <button class="btn btn-success" ng-click="save()">{{ Lang::Get('mod-news/infoMsg.BTN_REGISTER') }}</button>
        <button class="btn btn-default" ng-click="reset()">{{ Lang::Get('mod-news/infoMsg.BTN_RESET') }}</button>
    </div>
</section>
@stop