<?php
require 'phyre_variable.php';
require 'phyre_regex.php';

function Phyre(){
	$ret = array();
	$args = func_get_args();
	
	if(count($args) > 1){
		foreach($args as $arg){
			array_push($ret, new variable($arg));
		}
	}else{
		$ret = new Phyre\variable($args[0]);
	}
	
	return $ret;
}

function p(){
	return call_user_func_array('Phyre', func_get_args());
}

function regex(){
	$ret = array();
	
	foreach(func_get_args() as $arg){
		array_push($ret, new Phyre\regex($arg));
	}
	
	return $ret;
}

function r(){
	return call_user_func_array('regex', func_get_args());
}
?>
