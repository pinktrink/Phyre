<?php
namespace Phury;
use Phury\variable;

function p(){
	$args = func_get_args();
	
	return new Phury($args);
}

class Phury implements ArrayAccess{
	private $_data;
	
	public function __construct(){
		
	}
}
?>