{{ Form::open(array('url' => '/callSupport', 'class' => 'block validate')) }}

   
    <h6 class="heading-hr"><i class="icon-support"></i> Abrir um chamado para a equipe de suporte</h6>
    <div class="form-group">

        <div class="row">
            <div class="col-md-6">
                {{ Form::label('nome', 'Seu Nome') }} <span class="mandatory">*</span>
                {{ Form::text('nome', Input::old('nome'), array('class' => 'form-control has-error', 'placeholder' => 'Digite seu nome')) }}
                @if ($errors->has('nome')) <p class="help-block"><span class="mandatory">{{ $errors->first('nome') }}</span></p> @endif
            </div>
            <div class="col-md-6">
                {{ Form::label('email', 'Seu E-mail') }} <span class="mandatory">*</span>
                {{ Form::text('email', Input::old('email'), array('class' => 'form-control', 'placeholder' => 'Digite seu e-mail')) }}
                @if ($errors->has('email')) <p class="help-block"><span class="mandatory">{{ $errors->first('email') }}</span></p> @endif
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                {{ Form::label('site', 'Endreço do seu site') }} <span class="mandatory">*</span>
                {{ Form::text('site', Input::old('site'), array('class' => 'form-control', 'placeholder' => 'http://www.seusite.com.br')) }}
                @if ($errors->has('site')) <p class="help-block"><span class="mandatory">{{ $errors->first('site') }}</span></p> @endif
            </div>
            <div class="col-md-6">
                {{ Form::label('support', 'Qual o Problema ?') }}
                {{ Form::select('support', array('' => '', 'Support' => 'E-mail', 'Sles' => 'Erro no CMS', 'Lawers' => 'Ajuste no Site', 'Information' => 'Criação de Artes', 'need-product' => 'Precisa de algum produto', 'suggestion' => 'Sugestões', 'rate-treatment' => 'Avalie nosso atendimento'), Input::old('sede'), array('class' => 'select-full' , 'data-placeholder' => 'Escolha uma opção')) }}
            </div>
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('message', 'Descrição:') }} <span class="mandatory">*</span>
        {{ Form::textarea('message', null, array('class' => 'elastic form-control', 'size' => '5x5', 'placeholder' => 'Descreva com detalhes o que você preicsa')) }}
        @if ($errors->has('message')) <p class="help-block"><span class="mandatory">{{ $errors->first('message') }}</span></p> @endif
    </div>
    <div class="text-right">
        {{ Form::reset('Cancelar', array('class'=>'btn btn-danger')) }}
        {{ Form::submit('Enviar', array('class'=>'btn btn-primary')) }}
    </div>
</form>