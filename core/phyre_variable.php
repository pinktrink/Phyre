<?php
/*
pad > array, string
length > array, string
count > array, string
sizeof > array, string
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

replace needs to hold preg_replace, str_replace, str_ireplace, and array_replace
*/

namespace Phyre;

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
	
	const SCALAR = 31;
	const NONSCALAR = 992;
	const ALL = 2047;
	
	protected $_data = NULL;
	protected static $_strict_types = array(
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
	protected static $_prop_methods = array(  //If a method can work with zero arguments, its name should be placed in here
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
		'i',
		
		'change_key_case',
		'count_values',
		'filter',
		'flip',
		'implode', 'join',
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
		'base64_decode', 'base64_encode',
		'bin2hex', 'hexdec', 'octdec',
		'chunk_split',
		'convert_uudecode', 'convert_uuencode', 'uudecode', 'uuencode',
		'count_chars',
		'crc32',
		'crypt',
		'explode', 'split',
		'hebrev', 'hebrevc',
		/*'hex2bin',*/
		'html_entity_decode', 'htmlentities',
		'htmlspecialchars_decode', 'htmlspecialchars',
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
		'bindec', 'decbin', 'dechex', 'decoct',
		'ceil', 'floor', 'round',
		'deg2rad', 'rad2deg',
		'exp', 'expm1',
		'is_finite', 'is_infinite', 'is_nan',
		'log10', 'log1p', 'log',
		'sqrt',
		'up', 'dn',
		
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
		settype($this->_data, self::$_strict_types[$type]);
		
		return $this;
	}
	
	
	
	//Array functions
	public function change_key_case($case = CASE_LOWER){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(array_change_key_case($this->_data, $case));
	}
	
	public function chunk($size, $preserve_keys = false){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(array_chunk($this->_data, $size, $preserve_keys));
	}
	
	public function combine_as_keys(array $values){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(array_combine($this->_data, $values));
	}
	
	public function combine_as_values(array $keys){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(array_combine($keys, $this->_data));
	}
	
	public function kcombine(array $values){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(array_combine($this->_data, $values));
	}
	
	public function vcombine(array $keys){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(array_combine($keys, $this->_data));
	}
	
	public function count_values(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(array_count_values($this->_data));
	}
	
	public function diff_assoc(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(call_user_func_array('array_diff_assoc', array_merge(array($this->_data), func_get_args())));
	}
	
	public function diff_key(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(call_user_func_array('array_diff_key', array_merge(array($this->_data), func_get_args())));
	}
	
	public function diff_uassoc(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(call_user_func_array('array_diff_uassoc', array_merge(array($this->_data), func_get_args())));
	}
	
	public function diff_ukey(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(call_user_func_array('array_diff_ukey', array_merge(array($this->_data), func_get_args())));
	}
	
	public function diff(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(call_user_func_array('array_diff', array_merge(array($this->_data), func_get_args())));
	}
	
	public function fill_keys($value){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(array_fill_keys($this->_data, $value));
	}
	
	public function filter($callback = NULL){
		if(!$this->needs(self::ARR)) return false;
		
		$fargs = array($callback);
		
		if(!is_null($callback)){
			$fargs[] = $callback;
		}
		
		return new self(call_user_func_array('array_filter', $fargs));
	}
	
	public function flip(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(array_flip($this->_data));
	}
	
	public function intersect_assoc(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(call_user_func_array('array_intersect_assoc', array_merge(array($this->_data), func_get_args())));
	}
	
	public function intersect_key(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(call_user_func_array('array_intersect_key', array_merge(array($this->_data), func_get_args())));
	}
	
	public function intersect_uassoc(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(call_user_func_array('array_intersect_uassoc', array_merge(array($this->_data), func_get_args())));
	}
	
	public function intersect_ukey(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(call_user_func_array('array_intersect_ukey', array_merge(array($this->_data), func_get_args())));
	}
	
	public function intersect(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(call_user_func_array('array_intersect', array_merge(array($this->_data), func_get_args())));
	}
	
	public function key_exists($key){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(array_key_exists($key, $this->_data));
	}
	
	public function has_key($key){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(array_key_exists($key, $this->_data));
	}
	
	public function contains_key($key){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(array_key_exists($key, $this->_data));
	}
	
	public function keys($search_value = NULL, $strict = false){
		if(!$this->needs(self::ARR)) return false;
		
		$fargs = array($this->_data);
		$values = array(
			array($search_value, NULL),
			array($strict, false)
		);
		
		foreach($values as $val){
			if($val[1] !== $val[2]){
				$fargs[] = $val[1];
			}else{
				break;
			}
		}
		
		return new self(call_user_func_array('array_keys', $fargs));
	}
	
	public function map($callback, array $args = array()){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(array_map($callback, $this->_data, $args));
	}
	
	public function merge_recursive(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(call_user_func_array('array_merge_recursive', array_merge(array($this->_data), func_get_args())));
	}
	
	public function merge(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(call_user_function('array_merge', array_merge(array($this->_data), func_get_args())));
	}
	
	public function multisort(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(call_user_func_array('array_multisort', array_merge(array($this->_data), func_get_args())));
	}
	
	public function pop(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(array_pop($this->_data));
	}
	
	public function product(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(array_product($this->_data));
	}
	
	public function push(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(call_user_func_array('array_push', array_merge(array($this->_data), func_get_args())));
	}
	
	public function rand($num_req = 1){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(array_rand($this->_data, $num_req));
	}
	
	public function reduce($callback, $initial = NULL){
		if(!$this->needs(self::ARR)) return false;

		$fargs = array($this->_data, $callback);
		if(!is_null($initial)){
			array_push($fargs, $initial);
		}
		
		return new self(call_user_func_array('array_reduce', $fargs));
	}
	
	public function replace_recursive(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(call_user_func_array('array_replace_recursive', array_merge(array($this->_data), func_get_args())));
	}
	
	public function reverse($preserve_keys = false){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(array_reverse($this->_data, $preserve_keys));
	}
	
	public function search($needle, $strict = false){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(array_search($needle, $this->_data, $strict));
	}
	
	public function shift(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(array_shift($this->_data));
	}
	
	public function slice($offset, $length = NULL, $preserve_keys = false){
		if(!$this->needs(self::ARR)) return false;

		$fargs = array($this->_data);
		$values = array(
			array($length, NULL),
			array($preserve_keys, false)
		);
		
		foreach($values as $val){
			if($val[1] !== $val[2]){
				$fargs[] = $val[1];
			}else{
				break;
			}
		}
		
		return new self(call_user_func_array('array_slice', $fargs));
	}
	
	public function splice($offset, $length = 0, $replacement = NULL){
		if(!$this->needs(self::ARR)) return false;

		$fargs = array($this->_data, $offset, $length);

		if($replacement !== NULL){
			$fargs[] = $replacement;
		}
		
		return new self(call_user_func_array('array_splice', $fargs));
	}
	
	public function sum(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(array_sum($this->_data));
	}
	
	public function udiff_assoc(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(call_user_func_array('array_udiff_assoc', array_merge(array($this->_data), func_get_args())));
	}
	
	public function udiff_uassoc(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(call_user_func_array('array_udiff_uassoc', array_merge(array($this->_data), func_get_args())));
	}
	
	public function udiff(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(call_user_func_array('array_udiff', array_merge(array($this->_data), func_get_args())));
	}
	
	public function uintersect_assoc(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(call_user_func_array('array_uintersect_assoc', array_merge(array($this->_data), func_get_args())));
	}
	
	public function uintersect_uassoc(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(call_user_func_array('array_uintersect_uassoc', array_merge(array($this->_data), func_get_args())));
	}
	
	public function uintersect(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(call_user_func_array('array_uintersect', array_merge(array($this->_data), func_get_args())));
	}
	
	public function unique($sort_flags = SORT_STRING){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(array_unique($this->_data, $sort_flags));
	}
	
	public function unshift(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(call_user_func_array('array_unshift', array_merge(array($this->_data), func_get_args())));
	}
	
	public function values(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(array_values($this->_data));
	}
	
	public function walk_recursive($funcname, $userdata = NULL){
		if(!$this->needs(self::ARR)) return false;

		$fargs = array($this->_data, $funcname);

		if($userdata !== NULL){
			$fargs[] = $userdata;
		}
		
		return new self(call_user_func_array('array_walk_recursive', $fargs));
	}
	
	public function walk($funcname, $userdata = NULL){
		if(!$this->needs(self::ARR)) return false;

		$fargs = array($this->_data, $funcname);
		
		if($userdata !== NULL){
			$fargs[] = $userdata;
		}
		
		return new self(call_user_func_array('array_walk', $fargs));
	}
	
	public function arsort($sort_flags = SORT_REGULAR){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(arsort($this->_data, $sort_flags));
	}
	
	public function asort($sort_flags = SORT_REGULAR){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(asort($this->_data, $sort_flags));
	}
	
	public function current(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(current($this->_data));
	}
	
	public function each(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(each($this->_data));
	}
	
	public function end(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(end($this->_data));
	}
	
	public function extract($x_975fb664ba3a8450968b9daf0e6f8ec9 = EXTR_OVERWRITE, $x_851f5ac9941d720844d143ed9cfcf60a = NULL){  //XXX This method probably takes a damn long time to process, but it's the only way that I could think of doing it, and honestly, I though it was pretty clever myself =P
		if(!$this->needs(self::ARR)) return false;
		
		extract($GLOBALS);  //Extract the global symbol table into this scope

		$x_13bbacf888ef2758e2a4d2fec38d475f = array($this->_data, $x_975fb664ba3a8450968b9daf0e6f8ec9);

		if($x_851f5ac9941d720844d143ed9cfcf60a !== NULL){
			$x_13bbacf888ef2758e2a4d2fec38d475f[] = $x_851f5ac9941d720844d143ed9cfcf60a;
		}

		$x_e70c4df10ef0983b9c8c31bd06b2a2c3 = call_user_func_array('extract', $x_13bbacf888ef2758e2a4d2fec38d475f);  //Extract variables from $this->_data into the current scope
		$x_787ef08a9498c6398a41148ca8c276fe = get_defined_vars();  //Get all the defined vars in this scope (to include extracted globals)
		
		$GLOBALS = array_diff_key($x_787ef08a9498c6398a41148ca8c276fe, array('x_975fb664ba3a8450968b9daf0e6f8ec9' => '', 'x_851f5ac9941d720844d143ed9cfcf60a' => '', 'x_787ef08a9498c6398a41148ca8c276fe' => '', 'x_e70c4df10ef0983b9c8c31bd06b2a2c3' => '', 'x_13bbacf888ef2758e2a4d2fec38d475f' => ''));  //Remove variables set in this scope
		
		return new self($x_e70c4df10ef0983b9c8c31bd06b2a2c3);
	}
	
	public function has($needle, $strict = false){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(in_array($needle, $this->_data, $strict));
	}
	
	public function contains($needle, $strict = false){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(in_array($needle, $this->_data, $strict));
	}
	
	public function implode($glue = ''){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(implode($glue, $this->_data));
	}
	
	public function in_array($needle, $strict = false){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(in_array($needle, $this->_data, $strict));
	}
	
	public function join($glue = ''){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(join($glue, $this->_data));
	}
	
	public function key(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(key($this->_data));
	}
	
	public function krsort($sort_flags = SORT_REGULAR){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(krsort($this->_data, $sort_flags));
	}
	
	public function ksort($sort_flags = SORT_REGULAR){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(ksort($this->_data, $sort_flags));
	}
	
	public function natcasesort(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(natcasesort($this->_data));
	}
	
	public function natsort(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(natsort($this->_data));
	}
	
	public function next(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(next($this->_data));
	}
	
	public function prev(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(prev($this->_data));
	}
	
	public function reset(){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(reset($this->_data));
	}
	
	public function rsort($sort_flags = SORT_REGULAR){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(rsort($this->_data, $sort_flags));
	}
	
	public function sort($sort_flags = SORT_REGULAR){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(sort($this->_data, $sort_flags));
	}
	
	public function uasort($cmp_function){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(uasort($this->_data, $cmp_function));
	}
	
	public function uksort($cmp_function){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(uksort($this->_data, $cmp_function));
	}
	
	public function usort($cmp_function){
		if(!$this->needs(self::ARR)) return false;
		
		return new self(usort($this->_data, $cmp_function));
	}
	
	
	
	//String functions
	public function addcslashes($charlist){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(addcslashes($this->_data, $charlist));
	}
	
	public function addslashes(){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(addslashes($this->_data));
	}
	
	public function base64_decode($strict = false){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(base64_decode($this->_data, $strict));
	}
	
	public function base64_encode(){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(base64_encode($this->_data));
	}
	
	public function bin2hex(){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(bin2hex($this->_data));
	}
	
	public function chop($charlist = NULL){
		if(!$this->needs(self::SCALAR)) return false;
		
		$fargs = array($this->_data);

		if($charlist !== NULL){
			$fargs[] = $charlist;
		}

		return new self(call_user_func_array('chop', $fargs));
	}
	
	public function chunk_split($chunklen = 76, $end = "\r\n"){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(chunk_split($this->_data));
	}
	
	public function convert_cyr($from, $to){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(convert_cyr_string($this->_data, $from, $to));
	}
	
	public function convert_uudecode(){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(convert_uudecode($this->_data));
	}
	
	public function convert_uuencode(){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(convert_uuencode($this->_data));
	}
	
	public function uudecode(){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(convert_uudecode($this->_data));
	}
	
	public function uuencode(){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(convert_uuencode($this->_data));
	}
	
	public function count_chars($mode = 0){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(count_chars($this->_data, $mode));
	}
	
	public function crc32(){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(crc32($this->_data));
	}
	
	public function crypt($salt = NULL){
		if(!$this->needs(self::SCALAR)) return false;
		
		$fargs = array($this->_data);

		if($salt !== NULL){
			$fargsp[] = $salt;
		}

		return new self(call_user_func_array('crypt', $fargs));
	}
	
	public function explode($delimiter = 1, $limit = NULL, $flags = 0){
		if(!$this->needs(self::SCALAR)) return false;
		
		if(is_integer($delimiter)){ //str_split
			return new self(str_split($this->_data, $delimiter));
		}elseif($delimiter instanceof Phyre\regex){  //preg_split
			if($limit === NULL){
				$limit = -1;
			}
			
			return new self(preg_split($delimiter->_(), $this->_data, $limit, $flags));
		}
		
		$fargs = array($delimiter, $this->_data);

		if($limit !== NULL){
			$fargs[] = $limit;
		}

		return new self(call_user_func_array('explode', $fargs));  //explode
	}
	
	public function fprintf(){
		if(!$this->needs(self::SCALAR)) return false;
		
		$args = func_get_args();
		$handle = array_shift($args);
		
		return new self(call_user_func_array('fprintf', array_merge(array($handle, $this->_data), $args)));
	}
	
	public function hebrev($max_chars_per_line = 0){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(hebrev($this->_data, $max_chars_per_line));
	}
	
	public function hebrevc($max_chars_per_line = 0){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(hebrevc($this->_data, $max_chars_per_line));
	}
	
	/*public function hex2bin(){
		if(!$this->needs(self::SCALAR)) return false;
		
		
	}*/  //Why is this function in the documentation?
	
	public function hexdec(){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(hexdec($this->_data));
	}
	
	public function html_entity_decode($quote_style = ENT_COMPAT, $charset = 'UTF-8'){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(html_entity_decode($this->_data, $quote_style, $charset));
	}
	
	public function htmlentities($flags = ENT_COMPAT, $charset = NULL, $double_encode = true){
		if(!$this->needs(self::SCALAR)) return false;
		
		$fargs = array($this->_data, $flags);
		$values = array(
			array($charset, NULL),
			array($double_encode, true)
		);

		foreach($values as $val){
			if($val[1] !== $val[2]){
				$fargs[] = $val[1];
			}else{
				break;
			}
		}

		return new self(call_user_func_array('htmlentities', $fargs));
	}
	
	public function htmlspecialchars_decode($quote_style = ENT_COMPAT){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(htmlspecialchars_decode($this->_data, $quote_style));
	}
	
	public function htmlspecialchars($flags = ENT_COMPAT, $charset = NULL, $double_encode = true){
		if(!$this->needs(self::SCALAR)) return false;

		$fargs = array($this->_data, $flags);
		$values = array(
			array($charset, NULL),
			array($double_encode, true)
		);

		foreach($values as $val){
			if($val[1] !== $val[2]){
				$fargs[] = $val[1];
			}else{
				break;
			}
		}
		
		return new self(call_user_func_array('htmlspecialchars', $fargs));
	}
	
	public function lcfirst(){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(lcfirst($this->_data));
	}
	
	public function levenshtein($str2, $cost_ins = NULL, $cost_rep = NULL, $cost_del = NULL){
		if(!$this->needs(self::SCALAR)) return false;

		$fargs = array($this->_data, $str2);
		$values = array(
			array($cost_ins, NULL),
			array($cost_rep, NULL),
			array($cost_del, NULL)
		);

		foreach($values as $val){
			if($val[1] !== $val[2]){
				$fargs[] = $val[1];
			}else{
				break;
			}
		}
		
		return new self(call_user_func_array('levenshtein', $fargs));
	}
	
	public function ltrim($charlist = NULL){
		if(!$this->needs(self::SCALAR)) return false;
		
		$fargs = array($this->_data);

		if($charlist !== NULL){
			$fargs[] = $charlist;
		}

		return new self(call_user_func_array('ltrim', $fargs));
	}
	
	public function md5($raw_output = false){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(md5($this->_data, $raw_output));
	}
	
	public function metaphone($phonemes = 0){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(metaphone($this->_data, $phonemes));
	}
	
	public function money_format($format){
		if(!$this->needs(self::NUMERIC)) return false;
		
		return new self(money_format($format, $this->_data));
	}
	
	public function nl2br($is_xhtml = true){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(nl2br($this->_data, $is_xhtml));
	}
	
	public function number_format($decimals = 0, $dec_point = '.', $thousands_sep = ','){
		if(!$this->needs(self::NUMERIC)) return false;
		
		return new self(number_format($this->_data, $decimals, $dec_point, $thousands_sep));
	}
	
	public function octdec(){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(octdec($this->_data));
	}
	
	public function ord(){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(ord($this->_data));
	}
	
	public function parse_str(&$arr = NULL){  //TODO check this
		if(!$this->needs(self::SCALAR)) return false;
		
		parse_str($this->_data, $arr);
		
		return $this;
	}
	
	public function printf(){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(call_user_func_array('printf', array_merge(array($this->_data), func_get_args())));
	}
	
	public function quoted_printable_decode(){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(quoted_printable_decode($this->_data));
	}
	
	public function quoted_printable_encode(){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(quoted_printable_encode($this->_data));
	}
	
	public function qpdecode(){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(quoted_printable_decode($this->_data));
	}
	
	public function qpencode(){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(quoted_printable_encode($this->_data));
	}
	
	public function quotemeta(){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(quotemeta($this->_data));
	}
	
	public function rtrim($charlist = NULL){
		if(!$this->needs(self::SCALAR)) return false;

		$fargs = array($this->_data);

		if($charlist !== NULL){
			$fargs[] = $charlist;
		}
		
		return new self(call_user_func_array('rtrim', $fargs));
	}
	
	public function sha1($raw_output = false){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(sha1($this->_data, $raw_output));
	}
	
	public function similar_text($second, &$percent = NULL){  //TODO test this
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(similar_text($this->_data, $second, $percent));
	}
	
	public function soundex(){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(soundex($this->_data));
	}
	
	public function sprintf(){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(call_user_func_array('sprintf', array_merge(array($this->_data), func_get_args())));
	}
	
	public function sscanf($format){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(sscanf($this->_data, $format));
	}
	
	public function getcsv($delimiter = ',', $enclosure = '"', $escape = '\\'){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(str_getcsv($this->_data, $delimiter, $enclosure, $escape));
	}
	
	public function repeat($multiplier){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(str_repeat($this->_data, $multiplier));
	}
	
	public function rot13(){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(str_rot13($this->_data));
	}
	
	public function word_count($format = 0, $charlist = NULL){
		if(!$this->needs(self::SCALAR)) return false;

		$fargs = array($this->_data, $format);

		if($charlist !== NULL){
			$fargs[] = $charlist;
		}
		
		return new self(call_user_func_array('str_word_count', $fargs));
	}
	
	public function casecmp($str2){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(strcasecmp($this->_data, $str2));
	}
	
	public function chr($needle, $before_needle = false){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(strchr($this->_data, $needle, $before_needle));
	}
	
	public function cmp($str2){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(strcmp($this->_data, $str2));
	}
	
	public function coll($str2){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(strcoll($this->_data, $str2));
	}
	
	public function cspn($str2, $start = NULL, $length = NULL){
		if(!$this->needs(self::SCALAR)) return false;

		$fargs = array($this->_data, $str2);
		$values = array(
			array($start, NULL),
			array($length, NULL)
		);

		foreach($values as $val){
			if($val[1] !== $val[2]){
				$fargs[] = $val[1];
			}else{
				break;
			}
		}
		
		return new self(call_user_func_array('strcpsn', $fargs));
	}
	
	public function strip_tags($allowable_tags = NULL){
		if(!$this->needs(self::SCALAR)) return false;
		
		$fargs = array($this->_data);

		if($allowable_tags !== NULL){
			$fargs[] = $allowable_tags;
		}

		return new self(call_user_func_array('strip_tags', $fargs));
	}
	
	public function stripcslashes(){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(stripcslashes($this->_data));
	}
	
	public function ipos($needle, $offset = 0){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(stripos($this->_data, $needle, $offset));
	}
	
	public function stripslashes(){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(stripslashes($this->_data));
	}
	
	public function istr($needle, $before_needle = false){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(stristr($this->_data, $needle, $before_needle));
	}
	
	public function natcasecmp($str2){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(strnatcasecmp($this->_data, $str2));
	}
	
	public function natcmp($str2){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(strnatcmp($this->_data, $str2));
	}
	
	public function ncasecmp($str2, $len){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(strncasecmp($this->_data, $str2, $len));
	}
	
	public function ncmp($str2, $len){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(strncmp($str2, $len));
	}
	
	public function pbrk($char_list){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(strpbrk($this->_data, $char_list));
	}
	
	public function rchr($needle){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(strrchr($this->_data, $needle));
	}
	
	public function rev(){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(strrev($this->_data));
	}
	
	public function ripos($needle, $offset = 0){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(strripos($this->_data, $needle, $offset));
	}
	
	public function rpos($needle, $offset = 0){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(strrpos($this->_data, $needle, $offset));
	}
	
	public function split($delimiter = 1, $limit = NULL, $flags = 0){
		if(!$this->needs(self::SCALAR)) return false;
		
		if(is_integer($delimiter)){ //str_split
			return new self(str_split($this->_data, $delimiter));
		}elseif($delimiter instanceof Phyre\regex){  //preg_split
			if($limit === NULL){
				$limit = -1;
			}
			
			return new self(preg_split($delimiter->_(), $this->_data, $limit, $flags));
		}
		
		$fargs = array($delimiter, $this->_data);

		if($limit !== NULL){
			$fargs[] = $limit;
		}

		return new self(call_user_func_array('explode', $fargs));  //explode
	}
	
	public function spn($mask, $start = NULL, $length = NULL){
		if(!$this->needs(self::SCALAR)) return false;

		$fargs = array($this->_data, $mask);
		$values = array(
			array($start, NULL),
			array($length, NULL)
		);
		
		return new self(call_user_func_array('strspn', $fargs));
	}
	
	public function str(){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(strstr($this->_data, $needle, $before_needle));
	}
	
	public function tok($token){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(strtok($this->_data, $token));
	}
	
	public function tolower(){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(strtolower($this->_data));
	}
	
	public function toupper(){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(strtoupper($this->_data));
	}
	
	public function tr($from, $to){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(strtr($this->_data, $from, $to));
	}
	
	public function substr_compare($str, $offset, $length = NULL, $case_insensitivity = false){
		if(!$this->needs(self::SCALAR)) return false;

		$fargs = array($this->_data, $str, $offset);
		$values = array(
			array($length, NULL),
			array($case_insensitivity, false)
		);

		foreach($values as $val){
			if($val[1] !== $val[2]){
				$fargs[] = $val[1];
			}else{
				break;
			}
		}
		
		return new self(call_user_func_array('substr_compare', $fargs));
	}
	
	public function substr_count($needle, $offset = 0, $length = NULL){
		if(!$this->needs(self::SCALAR)) return false;

		$fargs = array($this->_data, $needle, $offset);

		if($length !== NULL){
			$fargs[] = NULL;
		}
		
		return new self(call_user_func_array('substr_count', $fargs));
	}
	
	public function substr_replace($replacement, $start, $length = NULL){
		if(!$this->needs(self::SCALAR)) return false;

		$fargs = array($this->_data, $replacement, $start);

		if($length !== NULL){
			$fargs[] = $length;
		}
		
		return new self(call_user_func_array('substr_replace', $fargs));
	}
	
	public function substr($start, $length = NULL){
		if(!$this->needs(self::SCALAR)) return false;
		
		$fargs = array($this->_data, $start);
		
		if($length !== NULL){
			$fargs[] = $length;
		}
		
		return new self(call_user_func_array('substr', $fargs));
	}
	
	public function trim($charlist = NULL){
		if(!$this->needs(self::SCALAR)) return false;

		$fargs = array($this->_data);

		if($charlist !== NULL){
			$fargs[] = $charlist;
		}
		
		return new self(call_user_func_array('trim', $fargs));
	}
	
	public function ucfirst(){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(ucfirst($this->_data));
	}
	
	public function ucwords(){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(ucwords($this->_data));
	}
	
	public function vfprintf($handle, $args){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(vfprintf($handle, $this->_data, $args));
	}
	
	public function vprintf($args){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(vprintf($this->_data, $args));
	}
	
	public function vsprintf($args){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(vsprintf($this->_data, $args));
	}
	
	public function wordwrap($width = 75, $break = "\n", $cut = false){
		if(!$this->needs(self::SCALAR)) return false;
		
		return new self(wordwrap($this->_data, $width, $break, $cut));
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
	
	public function len(){
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
	
	public function sizeof(){
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
	
	
	
	//Object functions
	public function get_class(){
		if(!$this->needs(self::OBJECT)) return false;
		
		return get_class($this->_data);
	}
	
	
	
	//Integer functions
	public function abs(){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(abs($this->_data));
	}
	
	public function acos(){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(acos($this->_data));
	}
	
	public function acosh(){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(acosh($this->_data));
	}
	
	public function asin(){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(asin($this->_data));
	}
	
	public function asinh(){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(asinh($this->_data));
	}
	
	public function atan2($x){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(atan2($this->_data, $x));
	}
	
	public function atan(){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(atan($this->_data));
	}
	
	public function atanh(){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(atanh($this->_data));
	}
	
	public function base_convert($frombase, $tobase){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(base_convert($this->_data, $frombase, $tobase));
	}
	
	public function ceil(){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(ceil($this->_data));
	}
	
	public function cos(){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(cos($this->_data));
	}
	
	public function cosh(){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(cosh($this->_data));
	}
	
	public function decbin(){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(decbin($this->_data));
	}
	
	public function dechex(){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(dechex($this->_data));
	}
	
	public function decoct(){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(decoct($this->_data));
	}
	
	public function deg2rad(){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(deg2rad($this->_data));
	}
	
	public function exp(){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(exp($this->_data));
	}
	
	public function expm1(){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(expm1($this->_data));
	}
	
	public function floor(){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(floor($this->_data));
	}
	
	public function fmod($y){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(fmod($this->_data, $y));
	}
	
	public function hypot($y){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(hypot($this->_data, $y));
	}
	
	public function is_finite(){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(is_finite($this->_data));
	}
	
	public function is_infinite(){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(is_infinite($this->_data));
	}
	
	public function is_nan(){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(is_nan($this->_data));
	}
	
	public function log10(){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(log10($this->_data));
	}
	
	public function log1p(){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(log1p($this->_data));
	}
	
	public function log($base = M_E){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(log($this->_data, $base));
	}
	
	public function pow($exp){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(pow($this->_data, $exp));
	}
	
	public function rad2deg(){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(rad2deg($this->_data));
	}
	
	public function round($precision = 0, $mode = PHP_ROUND_HALF_UP){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(round($this->_data, $precision, $mode));
	}
	
	public function sin(){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(sin($this->_data));
	}
	
	public function sinh(){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(sinh($this->_data));
	}
	
	public function sqrt(){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(sqrt($this->_data));
	}
	
	public function tan(){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(tan($this->_data));
	}
	
	public function tanh(){
		if(!$this->needs(self::NUMERIC | self::BOOLEAN)) return false;
		
		return new self(tanh($this->_data));
	}
	
	public function up($amount = 1){
		if(!$this->needs(self::ALL)) return false;
		
		$this->_data += $amount;
		
		return $this;
	}
	
	public function dn($amount = 1){
		if(!$this->needs(self::ALL)) return false;
		
		$this->_data -= $amount;
		
		return $this;
	}
	
	
	
	//Custom
	public function i($index = NULL){
		if($index !== NULL){
			if(isset($this->_data[$index])){
				return new self($this->_data[$index]);
			}
			
			return NULL;
		}
		
		return $this;
	}
	
	public function cat($data){
		if(!$this->needs(self::SCALAR)) return false;
		
		$this->_data .= $data;
		
		return $this;
	}
	
	public function append($data){
		if(!$this->needs(self::SCALAR)) return false;
		
		$this->_data .= $data;
		
		return $this;
	}
	
	public function prepend($data){
		if(!$this->needs(self::SCALAR)) return false;
		
		$this->_data = $data . $this->_data;
		
		return $this;
	}
	
	
	
	//Other
	protected function needs($type){
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
		
		throw new \Exception("Not right");
		
		return false;
	}
	
	protected function modifies($method){
		return in_array($method, self::$_modifies);
	}
	
	protected function get_raw_data($thingy){
		if($thingy instanceof Phyre){
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
	
	public function __invoke(){
		if(!$this->needs(self::CLOSURE)) return false;
		
		return $this->apply(func_get_args());
	}
	
	public function __toString(){
		if(!$this->needs(self::ALL ^ self::OBJECT ^ self::CLOSURE)) return false;
		
		if($this->is_array()){
			return implode(',', $this->_data);
		}else{
			return $this->_data;
		}
	}
	
	
	
	public function offsetExists($offset){
		return isset($this->_data[$offset]);
	}
	
	public function offsetGet($offset){
		if(isset($this->_data[$offset])){
			return new self($this->_data[$offset]);
		}else{
			if(!($this->type() & (self::OBJECT | self::CLOSURE))){
				return NULL;
			}
			
			if(property_exists($this->_data, $offset)){
				return new self($this->_data->$offset);
			}
		}
		
		return NULL;
	}
	
	public function offsetSet($offset, $value){
		if(!$this->is_scalar()){
			return $this->_data[$offset] = $value;
		}else{
			if(!is_int($offset)){
				return false;
			}
			
			$len = strlen($this->_data);
			
			if($offset <= $len){
				return $this->_data = substr_replace($this->_data, $value, $offset, 1);
			}
		}
		
		return NULL;
	}
	
	public function offsetUnset($offset){
		if(!$this->is_scalar()){
			unset($this->_data[$offset]);
		}else{
			if(!is_int($offset)){
				return false;
			}
			
			$len = strlen($this->_data);
			
			if($offset < $len){
				$this->_data = substr_replace($this->_data, $offset);
			}else{
				return false;
			}
		}
		
		return true;
	}
}
?>