<?php
class Contact extends Eloquent {
	protected $fillable = array('name', 'email', 'description');
    protected $table = 'tab_contact';
}
?>