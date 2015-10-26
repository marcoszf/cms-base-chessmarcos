<?php

use Symfony\Component\Security\Core\User\UserInterface;

	class BannerController extends BaseController{

		protected $modulo = 'banner';

		public function getDelete($id){
			$banner = Banner::find($id);
			$banner->delete();

			DB::table('tab_images')->where('module_id', '=', $id)->where('module_title', '=', 'banner')->delete();
			
			return 1;
		}

		public function postEdit($id){
			$mensagens = array(
				'required' =>  "Este campo é obrigatório"
			);
			#criando regra de validação
			$rules = array(
				'title'      	    	=> 'required',
				'show_begin'       	=> 'required',
				'show_end'         	=> 'required'
			);
			$validator = Validator::make(Input::all(), $rules, $mensagens);

			// verifica se ouve falha na validação-------------
			if ($validator->fails()) {

				#obtém as mensagens de erros validator
				$messages = $validator->messages();

				#redirect com as mensagens de erros, e populando os campos digitados "old'
				return Redirect::to('banner/'.$id.'/showEdit')
				->withErrors($validator)
				->withInput(Input::all());

			} else {#validado com sucesso--------------
				/*if (Input::file('imagem')->isValid()){
					die('valido');
				}*/
				

				$b_onlydate = substr(Input::get('show_begin'), 0, 10);
				$b_onlytime = substr(Input::get('show_begin'), 10, 16);
				$b_dateMysql = implode("-",array_reverse(explode("/",$b_onlydate)));
				$b_dateTimeMysql = $b_dateMysql . $b_onlytime;

				$e_onlydate = substr(Input::get('show_end'), 0, 10);
				$e_onlytime = substr(Input::get('show_end'), 10, 16);
				$e_dateMysql = implode("-",array_reverse(explode("/",$e_onlydate)));
				$e_dateTimeMysql = $e_dateMysql . $e_onlytime;

				$banner = Banner::find($id);
				$banner->title 				= Input::get('title');
				$banner->link 				= Input::get('link');
				$banner->show_begin 	= $b_dateTimeMysql;
				$banner->show_end 		= $e_dateTimeMysql;
				$banner->status 			= Input::get('status');
				
				$banner->save();

				$path_id = $id;
				$imgForm =  Input::file('imagem');
				$imagem = Input::file('imagem') !== null && !empty($imgForm) ? Input::file('imagem') : null;
				if ($imagem){
		      $pathThumb      = sprintf(Config::get('constants.path_upload'), $this->modulo, $path_id, 'thumb');
	        $pathMedia      = sprintf(Config::get('constants.path_upload'), $this->modulo, $path_id, 'media');
	        $pathLarge      = sprintf(Config::get('constants.path_upload'), $this->modulo, $path_id, 'large');
	        $pathOriginal   = sprintf(Config::get('constants.path_upload'), $this->modulo, $path_id, 'original');

	        $this->recursive_mkdir( $pathThumb );
	        $this->recursive_mkdir( $pathMedia );
	        $this->recursive_mkdir( $pathLarge );
	        $this->recursive_mkdir( $pathOriginal );
	        
	        $extension = Input::file('imagem')->getClientOriginalExtension(); // getting image extension
		      $fileName = rand(11111,99999).'.'.$extension; // renameing image

		      $targetFileThumb        = $pathThumb . DIRECTORY_SEPARATOR . $fileName;
	        $targetFileMedia        = $pathMedia . DIRECTORY_SEPARATOR . $fileName;
	        $targetFileLarge        = $pathLarge . DIRECTORY_SEPARATOR . $fileName;
	        $targetFileOriginal     = $pathOriginal . DIRECTORY_SEPARATOR . $fileName;

	        Image::make(Input::file('imagem'))->widen(180)->save($targetFileThumb);
	        Image::make(Input::file('imagem'))->widen(380)->save($targetFileMedia);
	        Image::make(Input::file('imagem'))->widen(800)->save($targetFileLarge);
	        Image::make(Input::file('imagem'))->save($targetFileOriginal);

	        $imgExist = DB::table('tab_images')->where('module_id', $id)->first();
	        
	        if($imgExist){
	        	DB::table('tab_images')->where('module_id', $id)->where('module_title', $this->modulo)->update(array('title' => $fileName));
	        } else{
	        	$fotos = new Fotos;
						$fotos->module_id 			= $path_id;
						$fotos->module_title 		= $this->modulo;
						$fotos->title 					= $fileName;
						$fotos->cape 						= 1;
						$fotos->order 					= 0;
						$fotos->status 					= 'A';
						$fotos->save();
	        }
				}

				// redirect our user back to the form so they can do it all over again
				Session::flash('message', 'Banner atualizado com sucesso!');
				return Redirect::to('banner/showList');
			}
		}

		public function postInsert(){
			$mensagens = array(
			'required' =>  "Este campo é obrigatório"
		);
		#criando regra de validação
		$rules = array(
			'ban_titulo'          	=> 'required',
			'ban_inicio'          	=> 'required',
			'ban_fim'       		   	=> 'required'
		);

		$validator = Validator::make(Input::all(), $rules, $mensagens);

		// verifica se ouve falha na validação-------------
		if ($validator->fails()) {

			#obtém as mensagens de erros validator
			$messages = $validator->messages();

			#redirect com as mensagens de erros, e populando os campos digitados "old'
			return Redirect::to('banner/showInsert')
				->withErrors($validator)
				->withInput(Input::all());

		} else {#validado com sucesso--------------
			/*if (Input::file('imagem')->isValid()){
				die('valido');
			}*/
			

			$b_onlydate = substr(Input::get('ban_inicio'), 0, 10);
			$b_onlytime = substr(Input::get('ban_inicio'), 10, 16);
			$b_dateMysql = implode("-",array_reverse(explode("/",$b_onlydate)));
			$b_dateTimeMysql = $b_dateMysql . $b_onlytime;

			$e_onlydate = substr(Input::get('ban_fim'), 0, 10);
			$e_onlytime = substr(Input::get('ban_fim'), 10, 16);
			$e_dateMysql = implode("-",array_reverse(explode("/",$e_onlydate)));
			$e_dateTimeMysql = $e_dateMysql . $e_onlytime;

			$banner = new Banner;
			$banner->title 				= Input::get('ban_titulo');
			$banner->link 				= Input::get('ban_link');
			$banner->show_begin 	= $b_dateTimeMysql;
			$banner->show_end 		= $e_dateTimeMysql;
			$banner->status 			= Input::get('ban_status');
			
			$banner->save();

			$path_id = DB::getPdo()->lastInsertId();
			
			$imagem = Input::file('imagem') !== null && !empty($imgForm) ? Input::file('imagem') : null;
			if ($imagem){
	      $pathThumb      = sprintf(Config::get('constants.path_upload'), $this->modulo, $path_id, 'thumb');
        $pathMedia      = sprintf(Config::get('constants.path_upload'), $this->modulo, $path_id, 'media');
        $pathLarge      = sprintf(Config::get('constants.path_upload'), $this->modulo, $path_id, 'large');
        $pathOriginal   = sprintf(Config::get('constants.path_upload'), $this->modulo, $path_id, 'original');

        $this->recursive_mkdir( $pathThumb );
        $this->recursive_mkdir( $pathMedia );
        $this->recursive_mkdir( $pathLarge );
        $this->recursive_mkdir( $pathOriginal );
        
        $extension = Input::file('imagem')->getClientOriginalExtension(); // getting image extension
	      $fileName = rand(11111,99999).'.'.$extension; // renameing image

	      $targetFileThumb        = $pathThumb . DIRECTORY_SEPARATOR . $fileName;
        $targetFileMedia        = $pathMedia . DIRECTORY_SEPARATOR . $fileName;
        $targetFileLarge        = $pathLarge . DIRECTORY_SEPARATOR . $fileName;
        $targetFileOriginal     = $pathOriginal . DIRECTORY_SEPARATOR . $fileName;

        Image::make(Input::file('imagem'))->widen(180)->save($targetFileThumb);
        Image::make(Input::file('imagem'))->widen(380)->save($targetFileMedia);
        Image::make(Input::file('imagem'))->widen(800)->save($targetFileLarge);
        Image::make(Input::file('imagem'))->save($targetFileOriginal);

        $fotos = new Fotos;
				$fotos->module_id 			= $path_id;
				$fotos->module_title 		= $this->modulo;
				$fotos->title 					= $fileName;
				//$fotos->description 	= $description;
				$fotos->cape 						= 1;
				$fotos->order 					= 0;
				$fotos->status 					= 'A';
				$fotos->save();
			}

			// redirect our user back to the form so they can do it all over again
			Session::flash('message', 'Banner cadastrado com sucesso!');
			return Redirect::to('banner/showInsert');
		}
		}
		public function getShow(){
			
			if (Auth::check())
			{
				$banner = Banner::all();
			    return View::make('modules-specific.banners.list')->with('banner', $banner);
			} else{
				return Redirect::to('login');
			}
		}

    public function getInsert()
    {
		  if (Auth::check())
			{
			    return View::make('modules-specific.banners.insert');
			} else{
				return Redirect::to('login');
			}
    }
    public function getEdit($id){
			if (Auth::check())
			{
					$banner = Banner::find($id);
			    return View::make('modules-specific.banners.edit')->with('banner',$banner);
			} else{
				return Redirect::to('login');
			}
		}

	}
?>