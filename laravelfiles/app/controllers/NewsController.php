<?php

use Symfony\Component\Security\Core\User\UserInterface;

	class NewsController extends BaseController{

		protected $modulo = 'news';

		

		public function getDelete($id){
			$news = News::find($id);
			$news->delete();
			
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

		public function postUpload(){

			$imagem = Input::file('file') !== null && !empty(Input::file('file')) ? Input::file('file') : null;
			if ($imagem) {
				$session_id = Session::getId();
				$pathTemp = sprintf(Config::get('constants.path_upload_temp'), $session_id);
				$extension = $imagem->getClientOriginalExtension();
				$fileName = rand(11111,99999).'.'.$extension; // renameing image
				
				if(!File::exists($pathTemp)) {
					File::makeDirectory($pathTemp, $mode = 0777, true, true);
					return 'nao existe';
				}

				$targetFileTemp = $pathTemp . DIRECTORY_SEPARATOR . $fileName;

				Image::make($imagem)->save($targetFileTemp);
				
				return 'existe';
			}
			return 'no';
		}

		public function postInsert(){

			$news = new News;
			$news->title 				= Input::get('title');
			$news->source 			= Input::get('link');
			$news->summary 			= Input::get('summary');
			$news->text 				= Input::get('text');

			$news->save();

			$path_id = DB::getPdo()->lastInsertId();

			$session_id = Session::getId();
				$pathTemp = sprintf(Config::get('constants.path_upload_temp'), $session_id);
				$files = File::allFiles($pathTemp);

				if (count(glob($pathTemp."/*")) === 0 ) {// empty
					return 'vazio';
				} else{
					foreach ($files as $file)
					{
						$pathThumb      = sprintf(Config::get('constants.path_upload'), $this->modulo, $path_id, 'thumb');
		        $pathMedia      = sprintf(Config::get('constants.path_upload'), $this->modulo, $path_id, 'media');
		        $pathLarge      = sprintf(Config::get('constants.path_upload'), $this->modulo, $path_id, 'large');
		        $pathOriginal   = sprintf(Config::get('constants.path_upload'), $this->modulo, $path_id, 'original');

		        $this->recursive_mkdir( $pathThumb );
		        $this->recursive_mkdir( $pathMedia );
		        $this->recursive_mkdir( $pathLarge );
		        $this->recursive_mkdir( $pathOriginal );

						$fileName = $file->getFilename();
						
						$fileTemp =  $pathTemp . DIRECTORY_SEPARATOR . $fileName;
						$targetFileThumb        = $pathThumb . DIRECTORY_SEPARATOR . $fileName;
		        $targetFileMedia        = $pathMedia . DIRECTORY_SEPARATOR . $fileName;
		        $targetFileLarge        = $pathLarge . DIRECTORY_SEPARATOR . $fileName;
		        $targetFileOriginal     = $pathOriginal . DIRECTORY_SEPARATOR . $fileName;

						Image::make($fileTemp)->widen(180)->save($targetFileThumb);
		        Image::make($fileTemp)->widen(380)->save($targetFileMedia);
		        Image::make($fileTemp)->widen(800)->save($targetFileLarge);
		        Image::make($fileTemp)->save($targetFileOriginal);
					}
					File::deleteDirectory($pathTemp); //apaga diretório temp - session com as imagens
				}
			return 1;
		}
		public function getShow(){
			
			if (Auth::check())
			{

				$news = News::all();
		    return View::make('modules-specific.news.list')->with(array('news'=> $news));
			} else{
				return Redirect::to('login');
			}
		}

    public function getInsert()
    {
		  if (Auth::check())
			{
			    return View::make('modules-specific.news.insert');
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