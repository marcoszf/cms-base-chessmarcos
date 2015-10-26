<?php
class News extends Eloquent {
	protected $fillable = array('title', 'text', 'summary', 'date', 'source');
    protected $table = 'tab_news';
}
?>