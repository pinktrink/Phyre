<?php
namespace Phyre;

class regex{
	private $_pattern;
	
	private static $_prop_methods = array(
		'_'
	);
	
	
	
	public function __construct($pattern){
		$this->_pattern = $pattern;
	}
	
	public function test(){
		
	}
	
	public function match(){
		
	}
	
	public function split(){
		
	}
	
	public function _(){
		
	}
	
	
	
	public function __get($var){
		if(in_array($var, self::$_prop_methods)){
			return $this->$var();
		}
		
		return NULL;
	}
}
?>