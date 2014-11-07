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

    public function test($str, $flags = 0, $offset = 0){
        return (boolean)preg_match($this->_pattern, $str, $null);
    }

    public function match($str, $flags = 0, $offset = 0){
        $ret = array();

        preg_match($this->_pattern, $str, $ret, $flags, $offset);

        return new Phyre\variable($ret);
    }

    public function match_all($str, $flags = PREG_PATTERN_ORDER, $offset = 0){
        $ret = array();

        preg_match($this->_pattern, $str, $ret, $flags, $offset);

        return new Phyre\variable($ret);
    }

    public function split($str, $limit = -1, $flags = 0){
        return new Phyre\variable(preg_split($this->_pattern, $str, $limit, $flags));
    }

    public function _(){
        return $this->_pattern;
    }



    public function __get($var){
        if(in_array($var, self::$_prop_methods)){
            return $this->$var();
        }

        return NULL;
    }
}
?>
