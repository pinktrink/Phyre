<?php
namespace Phyre;

include 'phury_variable.php';
include 'phury_regex.php';

function Phyre(){
	$ret = array();
	$args = func_get_args();
	
	if(count($args) > 1){
		foreach($args as $arg){
			array_push($ret, new variable($arg));
		}
	}else{
		$ret = new variable($args[0]);
	}
	
	return $ret;
}

function p(){
	return call_user_func_array('Phyre\Phyre', func_get_args());
}

function regex(){
	$ret = array();
	
	foreach(func_get_args() as $arg){
		array_push($ret, new regex($arg));
	}
	
	return $ret;
}

function r(){
	return call_user_func_array('Phyre\regex', func_get_args());
}

$x = p(array(1, 2, 3, 4, 5))->flip->flip->flip->i(2)->up->cast(variable::STRING)->cat('foo')->append('12345')->prepend('hi')->substr(3, 3)->cast(variable::ARR)->shift->substr(1)->split->pop->bin2hex->split->join(' ')->cat('ine folks');
var_dump($x);
?>