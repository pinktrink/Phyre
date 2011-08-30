<?php
/*
pad > array, string
length > array, string
count > array, string
split > array, string
replace > array, string
shuffle > array, string
pos > array, string
*/

namespace Phury;

class variable implements ArrayAccess{
	private $_data = NULL;
	private $_prop_methods = array(
		'is_array', 'not_array',
		'is_bool', 'not_bool',
		'is_callable', 'not_callable',
		'is_double', 'not_double',
		'is_float', 'not_float',
		'is_int', 'not_int',
		'is_integer', 'not_integer',
		'is_long', 'not_long',
		'is_null', 'not_null',
		'is_numeric', 'not_numeric',
		'is_object', 'not_object',
		'is_real', 'not_real',
		'is_resource', 'not_resource',
		'is_scalar', 'not_scalar',
		'is_string', 'not_string',
		'is_closure', 'not_closure',
		'is_function', 'not_function',
		'is_lambda', 'not_lambda',
		'is_iterable', 'not_iterable',
		'is_traversable', 'not_traversable',
		'type',
		'_'
	);
	
	
	
	//Type functions
	public function __construct($var){
		$this->_data = $var;
	}
	
	public function is_array(){
		return is_array($this->_data);
	}
	
	public function not_array(){
		return !is_array($this->_data);
	}
	
	public function is_bool(){
		return is_bool($this->_data);
	}
	
	public function not_bool(){
		return !is_bool($this->_data);
	}
	
	public function is_boolean(){
		return is_bool($this->_data);
	}
	
	public function not_boolean(){
		return !is_bool($this->_data);
	}
	
	public function is_callable(){
		return is_callable($this->_data);
	}
	
	public function not_callable(){
		return !is_callable($this->_data);
	}
	
	public function is_double(){
		return is_double($this->_data);
	}
	
	public function not_double(){
		return !is_double($this->_data);
	}
	
	public function is_float(){
		return is_float($this->_data);
	}
	
	public function not_float(){
		return !is_float($this->_data);
	}
	
	public function is_int(){
		return is_int($this->_data);
	}
	
	public function not_int(){
		return !is_int($this->_data);
	}
	
	public function is_integer(){
		return is_integer($this->_data);
	}
	
	public function not_integer(){
		return !is_integer($this->_data);
	}
	
	public function is_long(){
		return is_long($this->_data);
	}
	
	public function not_long(){
		return !is_long($this->_data);
	}
	
	public function is_null(){
		return is_null($this->_data);
	}
	
	public function not_null(){
		return !is_null($this->_data);
	}
	
	public function is_numeric(){
		return is_numeric($this->_data);
	}
	
	public function not_numeric(){
		return !is_numeric($this->_data);
	}
	
	public function is_object(){
		return is_object($this->_data);
	}
	
	public function not_object(){
		return !is_object($this->_data);
	}
	
	public function is_real(){
		return is_real($this->_data);
	}
	
	public function not_real(){
		return !is_real($this->_data);
	}
	
	public function is_resource(){
		return is_resource($this->_data);
	}
	
	public function not_resource(){
		return !is_resource($this->_data);
	}
	
	public function is_scalar(){
		return is_scalar($this->_data);
	}
	
	public function not_scalar(){
		return !is_scalar($this->_data);
	}
	
	public function is_string(){
		return is_string($this->_data);
	}
	
	public function not_string(){
		return !is_string($this->_data);
	}
	
	public function is_closure(){
		return $this->_data instanceof Closure;
	}
	
	public function not_closure(){
		return !$this->_data instanceof Closure;
	}
	
	public function is_function(){
		return $this->_data instanceof Closure;
	}
	
	public function not_function(){
		return !$this->_data instanceof Closure;
	}
	
	public function is_lambda(){
		return $this->_data instanceof Closure;
	}
	
	public function not_lambda(){
		return !$this->_data instanceof Closure;
	}
	
	public function is_iterable(){
		return (is_array($this->_data) || $var instanceof Traversable);
	}
	
	public function not_iterable(){
		return !(is_array($this->_data) || $var instanceof Traversable);
	}
	
	public function is_traversable(){
		return (is_array($this->_data) || $var instanceof Traversable);
	}
	
	public function not_traversable(){
		return !(is_array($this->_data) || $var instanceof Traversable);
	}
	
	public function type(){
		if(!isset($this->_data)) return "NULL";
		if($this->is_bool()) return "boolean";
		if($this->is_float()) return "double";
		if($this->is_string()) return "string";
		if($this->is_array()) return "array";
		if($this->is_object()) return "object";
		if($this->is_resource()) return "resource";
		if($this->is_null()) return "null";
		if($this->is_closure()) return "closure";
		return "unknown type";
	}
	
	public function set($data){
		$this->_data = $data;
	}
	
	public function cast($type){
		switch($type){
			case "boolean":
			case "integer":
			case "float":
			case "string":
			case "array":
			case "object":
			case "null":
				break;
			
			case "closure":
				$type = "object";
				break;
			
			default:
				return false;
		}
		
		settype($this->_data, $type);
		return true;
	}
	
	
	
	//Array functions
	public function change_key_case(){
		
	}
	
	public function chunk(){
		
	}
	
	public function combine(){
		
	}
	
	public function count_values(){
		
	}
	
	public function diff_assoc(){
		
	}
	
	public function diff_key(){
		
	}
	
	public function diff_uassoc(){
		
	}
	
	public function diff_ukey(){
		
	}
	
	public function fill_keys(){
		
	}
	
	public function fill(){
		
	}
	
	public function filter(){
		
	}
	
	public function flip(){
		
	}
	
	public function intersect_assoc(){
		
	}
	
	public function intersect_key(){
		
	}
	
	public function intersect_uassoc(){
		
	}
	
	public function intersect_ukey(){
		
	}
	
	public function intersect(){
		
	}
	
	public function key_exists(){
		
	}
	
	public function keys(){
		
	}
	
	public function map(){
		
	}
	
	public function merge_recursive(){
		
	}
	
	public function merge(){
		
	}
	
	public function multisort(){
		
	}
	
	public function pop(){
		
	}
	
	public function product(){
		
	}
	
	public function push(){
		
	}
	
	public function rand(){
		
	}
	
	public function reduce(){
		
	}
	
	public function replace_recursive(){
		
	}
	
	public function reverse(){
		
	}
	
	public function search(){
		
	}
	
	public function shift(){
		
	}
	
	public function slice(){
		
	}
	
	public function splice(){
		
	}
	
	public function sum(){
		
	}
	
	public function udiff_assoc(){
		
	}
	
	public function udiff_uassoc(){
		
	}
	
	public function udiff(){
		
	}
	
	public function uintersect_assoc(){
		
	}
	
	public function uintersect_uassoc(){
		
	}
	
	public function uintersect(){
		
	}
	
	public function unique(){
		
	}
	
	public function unshift(){
		
	}
	
	public function values(){
		
	}
	
	public function walk_recursive(){
		
	}
	
	public function walk(){
		
	}
	
	public function arsort(){
		
	}
	
	public function asort(){
		
	}
	
	public function compact(){
		
	}
	
	public function count(){
		
	}
	
	public function current(){
		
	}
	
	public function each(){
		
	}
	
	public function end(){
		
	}
	
	public function extract(){
		
	}
	
	public function has(){
		
	}
	
	public function key(){
		
	}
	
	public function krsort(){
		
	}
	
	public function natcasesort(){
		
	}
	
	public function natsort(){
		
	}
	
	public function next(){
		
	}
	
	public function prev(){
		
	}
	
	public function range(){
		
	}
	
	public function reset(){
		
	}
	
	public function rsort(){
		
	}
	
	public function sizeof(){
		
	}
	
	public function sort(){
		
	}
	
	public function uasort(){
		
	}
	
	public function uksort(){
		
	}
	
	public function usort(){
		
	}
	
	
	
	//String functions
	public function addcslashes(){
		
	}
	
	public function addslashes(){
		
	}
	
	public function bin2hex(){
		
	}
	
	public function chop(){
		
	}
	
	public function chunk_split(){
		
	}
	
	public function convert_cyr_string(){
		
	}
	
	public function convert_uudecode(){
		
	}
	
	public function convert_uuencode(){
		
	}
	
	public function count_chars(){
		
	}
	
	public function crc32(){
		
	}
	
	public function crypt(){
		
	}
	
	public function explode(){
		
	}
	
	public function fprintf(){
		
	}
	
	public function get_html_translation_table(){
		
	}
	
	public function hebrev(){
		
	}
	
	public function hebrevc(){
		
	}
	
	public function hex2bin(){
		
	}
	
	public function html_entity_decode(){
		
	}
	
	public function htmlentities(){
		
	}
	
	public function htmlspecialchars_decode(){
		
	}
	
	public function htmlspecialchars(){
		
	}
	
	public function implode(){
		
	}
	
	public function join(){
		
	}
	
	public function lcfirst(){
		
	}
	
	public function levenshtein(){
		
	}
	
	public function localeconf(){
		
	}
	
	public function ltrim(){
		
	}
	
	public function md5_file(){
		
	}
	
	public function md5(){
		
	}
	
	public function metaphone(){
		
	}
	
	public function money_format(){
		
	}
	
	public function nl_langinfo(){
		
	}
	
	public function nl2br(){
		
	}
	
	public function number_format(){
		
	}
	
	public function ord(){
		
	}
	
	public function parse_str(){
		
	}
	
	public function printf(){
		
	}
	
	public function quoted_printable_decode(){
		
	}
	
	public function quoted_printable_encode(){
		
	}
	
	public function quotemeta(){
		
	}
	
	public function rtrim(){
		
	}
	
	public function setlocale(){
		
	}
	
	public function sha1(){
		
	}
	
	public function similar_text(){
		
	}
	
	public function soundex(){
		
	}
	
	public function sprintf(){
		
	}
	
	public function sscanf(){
		
	}
	
	public function getcsv(){
		
	}
	
	public function ireplace(){
		
	}
	
	public function repeat(){
		
	}
	
	public function rot13(){
		
	}
	
	public function word_count(){
		
	}
	
	public function casecmp(){
		
	}
	
	public function chr(){
		
	}
	
	public function cmp(){
		
	}
	
	public function coll(){
		
	}
	
	public function cspn(){
		
	}
	
	public function strip_tags(){
		
	}
	
	public function stripcslashes(){
		
	}
	
	public function ipos(){
		
	}
	
	public function stripslashes(){
		
	}
	
	public function istr(){
		
	}
	
	public function len(){
		
	}
	
	public function natcasecmp(){
		
	}
	
	public function natcmp(){
		
	}
	
	public function ncasecmp(){
		
	}
	
	public function ncmp(){
		
	}
	
	public function pbrk(){
		
	}
	
	public function rchr(){
		
	}
	
	public function rev(){
		
	}
	
	public function ripos(){
		
	}
	
	public function rpos(){
		
	}
	
	public function spn(){
		
	}
	
	public function str(){
		
	}
	
	public function tok(){
		
	}
	
	public function tolower(){
		
	}
	
	public function toupper(){
		
	}
	
	public function tr(){
		
	}
	
	public function substr_compare(){
		
	}
	
	public function substr_count(){
		
	}
	
	public function substr_replace(){
		
	}
	
	public function substr(){
		
	}
	
	public function trim(){
		
	}
	
	public function ucfirst(){
		
	}
	
	public function ucwords(){
		
	}
	
	public function vfprintf(){
		
	}
	
	public function vprintf(){
		
	}
	
	public function vsprintf(){
		
	}
	
	public function wordwrap(){
		
	}
	
	
	
	//Other
	public function _(){
		return $this->_data();
	}
	
	public function __get($var){
		if(in_array($var, $this->_prop_methods)){
			return $this->$var();
		}
		return NULL;
	}
}
?>