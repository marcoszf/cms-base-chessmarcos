<section id="signIn" style="display: none;" class="formWrap signinWrap large-12 medium-12 small-12 columns">
        <section class="signIn form">
        <article id="message-login" class="msg-forms"></article>
          <h2>acesse sua conta</h2>
          {{ Form::open(array('url' => url('login/site'), 'id' => 'form-login')) }}
            <div class="campo">
              <p>Email</p>
              {{ Form::text('email', Input::old('email'), array('autofocus'=>'autofocus', 'id'=>'email-login')) }}

            </div>
            <!-- END CAMPO -->
            <div class="campo">
              <p>Senha</p>
              {{ Form::password('password') }}
            </div>
            <!-- END CAMPO -->
            <p><a href="">Esqueceu a senha?</a></p>

            <input class="enviar" id="send-login" type="image" src="{{ asset('assets/site/images/bts/submit.png') }}">
          {{ Form::close() }}
          <!-- END FORM -->

          <a id="criar" href="#">
            <div class="criarConta"><p>Crie uma conta grátis!</p></div>
          </a>

        <div class="social">
            <p>Siga-nos: </p>
            <ul>
              <li><a href="https://www.facebook.com/dimbox" target="__blank"><img src="{{ asset('assets/site/images/icons/facebook.png') }}" alt=""></a></li>
              <li><a href="https://plus.google.com/101642340864666397968/about" target="__blank"><img src="{{ asset('assets/site/images/icons/google.png') }}" alt=""></a></li>
              <li><a href="https://twitter.com/dimboxoficial" target="__blank"><img src="{{ asset('assets/site/images/icons/twitter.png') }}" alt=""></a></li>
            </ul>
          </div>
        </section>
          
    </section>
<!-- ================================== END LOGIN -->