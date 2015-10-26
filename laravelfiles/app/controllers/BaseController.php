<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	function recursive_mkdir($path, $mode = 0777) {
    $dirs = explode(DIRECTORY_SEPARATOR , $path);
    $count = count($dirs);
    $path = '.';
    for ($i = 0; $i < $count; ++$i) {
        $path .= DIRECTORY_SEPARATOR . $dirs[$i];
        if (!is_dir($path) && !mkdir($path, $mode)) {
            return false;
        }
    }
    return true;
	}

}
