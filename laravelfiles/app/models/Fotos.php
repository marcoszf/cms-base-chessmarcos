<?php
class Fotos extends Eloquent {
	protected $fillable = array('module_title', 'title', 'description');
    protected $table = 'tab_images';
}
?>