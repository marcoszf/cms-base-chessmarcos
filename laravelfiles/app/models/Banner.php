<?php
class Banner extends Eloquent {
	protected $fillable = array('title', 'text', 'show_begin', 'show_end', 'link');
    protected $table = 'tab_banners';
}
?>