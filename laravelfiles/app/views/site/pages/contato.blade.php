<section id="msgWrap" style="display: none;" class="formWrap msgWrap large-12 medium-12 small-12 columns">

    <section class="msgForm form">
    <article id="msgSendContact" class="msg-forms"></article>
      <h2 id="dizola">diga um olá</h2>
      {{ Form::open(array('url'=> url('contact'), 'id' => 'form-contact')) }}
        <div class="campo">
          <p>Nome</p>
          {{ Form::text('name', Input::old('name'), array('autofocus'=>'autofocus')) }}
        </div>
        <!-- END CAMPO -->
        <div class="campo">
          <p>Email</p>
          {{ Form::text('email') }}
        </div>
        <!-- END CAMPO -->
        <div class="campo">
          <p>Mensagem</p>
          {{ Form::textarea('message') }}
        </div>
        <!-- END CAMPO -->
        <input class="enviar" id="send-contact" type="image" src="{{ asset('assets/site/images/bts/submit.png') }}">
        
      {{ Form::close() }}
      <!-- END FORM -->
    </section>
</section>