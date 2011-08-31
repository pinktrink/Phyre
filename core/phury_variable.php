<?php
/*
pad > array, string
length > array, string
count > array, string
split > array, string
replace > array, string
shuffle > array, string
pos > array, string
bindec
max
min
mean
avg
average
*/

namespace Phury;

class variable implements \ArrayAccess{
	const NIL = 1;
	const BOOL = 2;
	const BOOLEAN = 2;
	const INT = 4;
	const INTEGER = 4;
	const FLOAT = 8;
	const DOUBLE = 8;
	const REAL = 8;
	const STR = 16;
	const STRING = 16;
	const ARR = 32;
	const OBJ = 64;
	const OBJECT = 64;
	const RESOURCE = 128;
	const CLOSURE = 256;
	const LAMBDA = 256;
	const UNKNOWN = 512;
	const NUMERIC = 1024;
	
	const SCALAR = 41;
	const NONSCALAR = 992;
	
	private $_data = NULL;
	private static $_strict_types = array(
		self::NIL => 'NULL',
		self::BOOL => 'boolean',
		self::INT => 'integer',
		self::FLOAT => 'double',
		self::STRING => 'string',
		self::ARR => 'array',
		self::OBJECT => 'object',
		self::RESOURCE => 'resource',
		self::CLOSURE => 'closure',
		self::UNKNOWN => 'unknown type'
	);
	//This ensures that zero-arg methods can be used as properties.  Yeah it's slow, but some are lazy.
	private static $_prop_methods = array(  //If a method can work with zero arguments, its name should be placed in here
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
		'_',
		
		'change_key_case',
		'count_values',
		'filter',
		'flip',
		'keys', 'values',
		'multisort',
		'pop', 'shift',
		'product', 'sum',
		'rand',
		'reverse',
		'unique',
		'arsort', 'asort', 'krsort', 'ksort', 'natcasesort', 'natsort', 'rsort', 'sort',
		'current', 'each',  'end', 'key', 'next', 'prev', 'reset',
		'extract',
		'sizeof',
		
		'addslashes', 'stripcslashes', 'stripslashes',
		'bin2hex',
		'chunk_split',
		'convert_uudecode', 'convert_uuencode', 'uudecode', 'uuencode',
		'count_chars',
		'crc32',
		'crypt',
		'hebrev', 'hebrevc',
		'hex2bin',
		'html_entity_decode', 'htmlentities',
		'htmlspecialchars_decode', 'htmlspecialchars',
		'implode', 'join',
		'lcfirst', 'tolower', 'toupper', 'ucfirst', 'ucwords',
		'ltrim', 'rtrim', 'trim', 'chop',
		'md5', 'sha1',
		'metaphone', 'soundex',
		'nl2br',
		'number_format',
		'ord',
		'parse_str',
		'printf', 'sprintf',
		'quoted_printable_decode', 'quoted_printable_encode', 'qpdecode', 'qpencode',
		'quotemeta',
		'getcsv',
		'rot13',
		'word_count',
		'strip_tags',
		'len',
		'rev',
		'wordwrap',
		
		'num_args', 'num_required_args', 'num_optional_args',
		'num_static_vars', 'static_vars',
		'apply', 'call',
		
		'abs',
		'acos', 'acosh', 'cos', 'cosh',
		'asin', 'asinh', 'sin', 'sinh',
		'atan', 'atanh', 'tan', 'tanh',
		'bindec', 'decbin', 'dechex', 'decoct', 'hexdec', 'octdec',
		'ceil', 'floor', 'round',
		'deg2rad', 'rad2deg',
		'exp', 'expm1',
		'is_finite', 'is_infinite', 'is_nan',
		'log10', 'log1p', 'log',
		'sqrt',
		
		'length', 'count',
		'shuffle'
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
		if(!isset($this->_data)) return self::NIL;
		if($this->is_bool()) return self::BOOL;
		if($this->is_integer()) return self::INT;
		if($this->is_float()) return self::FLOAT;
		if($this->is_string()) return self::STRING;
		if($this->is_array()) return self::ARR;
		if($this->is_object()) return self::OBJECT;
		if($this->is_resource()) return self::RESOURCE;
		if($this->is_null()) return self::NIL;
		if($this->is_closure()) return self::CLOSURE;
		return self::UNKNOWN;
	}
	
	public function typestr(){
		return self::$_strict_types[$this->type()];
	}
	
	public function set($data){
		$this->_data = $data;
	}
	
	public function cast($type){
		switch($type){
			case self::BOOL:
			case self::INT:
			case self::FLOAT:
			case self::STRING:
			case self::ARR:
			case self::OBJECT:
			case self::NIL:
				break;
			
			case self::CLOSURE:
				$type = self::OBJECT;
				break;
			
			default:
				return false;
		}
		
		settype($this->_data, $type);
		return true;
	}
	
	
	
	//Array functions
	public function change_key_case($case = CASE_LOWER){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function chunk(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function combine(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function count_values(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function diff_assoc(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function diff_key(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function diff_uassoc(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function diff_ukey(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function fill_keys(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function fill(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function filter($callback = NULL){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function flip(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function intersect_assoc(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function intersect_key(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function intersect_uassoc(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function intersect_ukey(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function intersect(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function key_exists(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function keys($search_value = NULL, $strict = false){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function map(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function merge_recursive(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function merge(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function multisort(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function pop(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function product(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function push(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function rand($num_req = 1){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function reduce(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function replace_recursive(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function reverse($preserve_keys = false){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function search(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function shift(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function slice(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function splice(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function sum(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function udiff_assoc(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function udiff_uassoc(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function udiff(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function uintersect_assoc(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function uintersect_uassoc(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function uintersect(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function unique($sort_flags = SORT_STRING){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function unshift(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function values(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function walk_recursive(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function walk(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function arsort($sort_flags = SORT_REGULAR){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function asort($sort_flags = SORT_REGULAR){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function current(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function each(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function end(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function extract($extract_type = EXTR_OVERWRITE, $prefix = NULL){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function has(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function key(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function krsort($sort_flags = SORT_REGULAR){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function ksort($sort_flags = SORT_REGULAR){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function natcasesort(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function natsort(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function next(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function prev(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function range(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function reset(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function rsort($sort_flags = SORT_REGULAR){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function sizeof(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function sort($sort_flags = SORT_REGULAR){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function uasort(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function uksort(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	public function usort(){
		if(!$this->needs(self::ARR)) return false;
		
	}
	
	
	
	//String functions
	public function addcslashes(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function addslashes(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function bin2hex(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function chop($charlist = NULL){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function chunk_split($chunklen = 76, $end = "\r\n"){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function convert_cyr_string(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function convert_uudecode(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function convert_uuencode(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function uudecode(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function uuencode(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function count_chars($mode = 0){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function crc32(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function crypt($salt = NULL){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function explode(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function fprintf(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function hebrev($max_chars_per_line = 0){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function hebrevc($max_chars_per_line = 0){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function hex2bin(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function html_entity_decode($quote_style = ENT_COMPAT, $charset = 'UTF-8'){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function htmlentities($flags = ENT_COMPAT, $charset = NULL, $double_encode = true){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function htmlspecialchars_decode($quote_style = ENT_COMPAT){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function htmlspecialchars($flags = ENT_COMPAT, $charset = NULL, $double_encode = true){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function implode($glue = ''){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function join($glue = ''){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function lcfirst(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function levenshtein(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function ltrim($charlist = NULL){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function md5($raw_output = false){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function metaphone($phonemes = 0){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function money_format(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function nl2br($is_xhtml = true){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function number_format($decimals = 0, $dec_point = '.', $thousands_sep = ','){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function ord(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function parse_str(&$arr = NULL){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function printf(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function quoted_printable_decode(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function quoted_printable_encode(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function qpdecode(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function qpencode(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function quotemeta(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function rtrim($charlist = NULL){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function sha1($raw_output = false){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function similar_text(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function soundex(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function sprintf(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function sscanf(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function getcsv($delimiter = ',', $enclosure = '"', $escape = '\\'){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function ireplace(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function repeat(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function rot13(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function word_count($format = 0, $charlist = NULL){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function casecmp(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function chr(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function cmp(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function coll(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function cspn(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function strip_tags($allowable_tags = NULL){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function stripcslashes(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function ipos(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function stripslashes(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function istr(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function len(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function natcasecmp(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function natcmp(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function ncasecmp(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function ncmp(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function pbrk(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function rchr(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function rev(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function ripos(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function rpos(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function spn(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function str(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function tok(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function tolower(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function toupper(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function tr(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function substr_compare(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function substr_count(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function substr_replace(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function substr(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function trim($charlist = NULL){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function ucfirst(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function ucwords(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function vfprintf(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function vprintf(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function vsprintf(){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	public function wordwrap($width = 75, $break = "\n", $cut = false){
		if(!$this->needs(self::STRING)) return false;
		
	}
	
	
	
	//String and array functions
	public function pad(){
		if(!$this->needs(self::STRING, self::ARR)) return false;
		
		switch($this->type()){
			case self::STRING:
				break;
			
			case self::ARR:
				break;
		}
	}
	
	public function length(){
		if(!$this->needs(self::STRING, self::ARR)) return false;
		
		switch($this->type()){
			case self::STRING:
				break;
			
			case self::ARR:
				break;
		}
	}
	
	public function count(){
		if(!$this->needs(self::STRING, self::ARR)) return false;
		
		switch($this->type()){
			case self::STRING:
				break;
			
			case self::ARR:
				break;
		}
	}
	
	public function split(){
		if(!$this->needs(self::STRING, self::ARR)) return false;
		
		switch($this->type()){
			case self::STRING:
				break;
			
			case self::ARR:
				break;
		}
	}
	
	public function replace(){
		if(!$this->needs(self::STRING, self::ARR)) return false;
		
		switch($this->type()){
			case self::STRING:
				break;
			
			case self::ARR:
				break;
		}
	}
	
	public function shuffle(){
		if(!$this->needs(self::STRING, self::ARR)) return false;
		
		switch($this->type()){
			case self::STRING:
				break;
			
			case self::ARR:
				break;
		}
	}
	
	public function pos(){
		if(!$this->needs(self::STRING, self::ARR)) return false;
		
		switch($this->type()){
			case self::STRING:
				break;
			
			case self::ARR:
				break;
		}
	}
	
	
	
	//Closure functions
	public function num_args(){
		if(!$this->needs(self::CLOSURE)) return false;
		
		return count($this->_data->parameter);
	}
	
	public function num_required_args(){
		if(!$this->needs(self::CLOSURE)) return false;
		
		return count(array_intersect($this->_data->parameter, (array)'required'));
	}
	
	public function num_optional_args(){
		if(!$this->needs(self::CLOSURE)) return false;
		
		return count(array_intersect($this->_data->parameter, (array)'optional'));
	}
	
	public function num_static_vars(){
		if(!$this->needs(self::CLOSURE)) return false;
		
		return count($this->_data->static);
	}
	
	public function static_vars(){
		if(!$this->needs(self::CLOSURE)) return false;
		
		return $this->_data->static;
	}
	
	public function apply($args = array()){
		if(!$this->needs(self::CLOSURE)) return false;
		
		return call_user_func_array(array($this, '_data'), $args);
	}
	
	public function call(){
		if(!$this->needs(self::CLOSURE)) return false;
		
		return $this->apply(func_get_args());
	}
	
	public function __invoke(){
		if(!$this->needs(self::CLOSURE)) return false;
		
		return $this->apply(func_get_args());
	}
	
	
	
	//Object functions
	public function get_class(){
		if(!$this->needs(self::OBJECT)) return false;
		
		return get_class($this->_data);
	}
	
	
	
	//Integer functions
	public function abs(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function acos(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function asin(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function asinh(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function atan2(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function atan(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function atanh(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function base_convert(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function ceil(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function cos(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function cosh(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function decbin(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function dechex(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function decoct(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function deg2rad(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function exp(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function expm1(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function floor(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function fmod(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function getrandmax(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function hexdec(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function hypot(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function is_finite(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function is_infinite(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function is_nan(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function log10(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function log1p(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function log($base = M_E){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function octdec(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function pow(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function rad2deg(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function round($precision = 0, $mode = PHP_ROUND_HALF_UP){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function sin(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function sinh(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function sqrt(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function tan(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function tanh(){
		if(!$this->needs(self::INT)) return false;
		
	}
	
	public function upr(){
		if(!$this->needs(self::INT)) return false;
		
		return ++$this->_data;
	}
	
	public function rup(){
		if(!$this->needs(self::INT)) return false;
		
		return $this->_data++;
	}
	
	public function dnr(){
		if(!$this->needs(self::INT)) return false;
		
		return --$this->_data;
	}
	
	public function rdn(){
		if(!$this->needs(self::INT)) return false;
		
		return $this->_data--;
	}
	
	
	
	//Other
	private function needs(){
		if($type & $this->type()){
			return true;
		}
		
		switch($type){
			case self::NUMERIC:
				if($this->is_numeric()){
					return true;
				}
				break;
		}
		
		throw new Exception("Not right");
		
		return false;
	}
	
	private function modifies($method){
		return in_array($method, self::$_modifies);
	}
	
	private function get_raw_data($thingy){
		if($thingy instanceof Phury){
			return $thingy->_data;
		}
		
		return $thingy;
	}
	
	public function _(){
		return $this->_data;
	}
	
	public function __get($var){
		if(in_array($var, self::$_prop_methods)){
			return $this->$var();
		}
		
		return NULL;
	}
	
	
	
	public function offsetExists($offset){
		return isset($this->_data[$offset]);
	}
	
	public function offsetGet($offset){
		if(isset($this->_data[$offset])){
			return $this->_data[$offset];
		}
		
		return NULL;
	}
	
	public function offsetSet($offset, $value){
		return $this->_data[$offset] = $value;
	}
	
	public function offsetUnset($offset){
		unset($this->_data[$offset]);
		
		return true;
	}
}

$x = new variable('string');
var_dump($x->_);
?>