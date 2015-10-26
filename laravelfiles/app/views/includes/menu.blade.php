<div class="col-sm-3 col-md-2 sidebar">
  <ul class="nav nav-sidebar">
    <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
    <li><a href="#">Analytics</a></li>
  </ul>
  <ul class="nav nav-sidebar">
  <h4>Módulos</h4>
    <li><a href="{{ URL::to('news/showList') }}">Notícias</a></li>
    <li><a href="{{ URL::to('banner/showList') }}">Banner</a></li>
    <li><a href="{{ URL::to('user/showList') }}">Usuários</a></li>
  </ul>
  <ul class="nav nav-sidebar">
  <h4>Formulários</h4>
    <li><a href="{{ URL::to('contact/showList') }}">Contato</a></li>
  </ul>
</div>