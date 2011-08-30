<?php
namespace Phury;

class closure extends variable{
	private $_data = NULL;
	public static $blah;
	
	public function __construct($var){
		$this->_data = $var;
	}
	
	public function num_args(){
		return count($this->_data->parameter);
	}
	
	public function num_required_args(){
		return count(array_intersect($this->_data->parameter, (array)'required'));
	}
	
	public function num_optional_args(){
		return count(array_intersect($this->_data->parameter, (array)'optional'));
	}
	
	public function num_static_vars(){
		return count($this->_data->static);
	}
	
	public function static_vars(){
		return $this->_data->static;
	}
	
	public function apply($args){
		return call_user_func_array(array($this, '_data'), $args);
	}
	
	public function call(){
		return $this->apply(func_get_args());
	}
	
	public function __invoke(){
		return $this->apply(func_get_args());
	}
}
?>