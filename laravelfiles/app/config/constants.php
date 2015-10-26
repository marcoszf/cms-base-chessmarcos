<?php
//file : app/config/constants.php

return [

		'path_upload' => 'uploads/%s/%d/%s',
		'path_upload_temp' => 'uploads/temp/%s',

		'path_banner_imgs' => 'uploads/banner/%d/%s/%s',

    'title'      => 'Z-CMS | Gestor de Conteúdo',
		'url_atual'  => sprintf('http://%s%s', $_SERVER['HTTP_HOST'], $_SERVER['REQUEST_URI']),


];