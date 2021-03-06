<?php
namespace core\lib;

class GET extends Request
{

    private static $_instance;

    public static final function getInstance ()
    {
        if (! self::$_instance) {
            self::$_instance = new self();
        }
        
        return self::$_instance;
    }

    public function get ($index)
    {
        if ($this->Type === false)
            $type = (isset($this->TypeArray[$this->MyCounter]) ? $this->TypeArray[$this->MyCounter ++] : 's');
        else
            $type = $this->Type;
        $res = parent::getvar($index, 'g', $type, $this->Required, $this->Clean, $this->Length, $this->Range, $this->Cases);
        $this->Range = false;
        $this->Cases = false;
        $this->Length = false;
        return $res;
    }

    public function getSegment ($segmentNumber)
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $url = str_ireplace(array(__REQ__METHOD__,__REQ__CLASS__,__Dynamic_PATH__), '', urldecode($url));
        $url = ltrim($url, '/');
        
        if ($this->Required && $url == '') {
            $this->PrintLast(Messages::get('CheckInput'));
        }
        if ($this->Type === false)
            $type = (isset($this->TypeArray[$this->MyCounter]) ? $this->TypeArray[$this->MyCounter ++] : 's');
        else
            $type = $this->Type;
        $url = explode('/', $url);
        $data = $url[$segmentNumber - 1];
        $res = $this->CheckSegment($data, $type);
        $this->Range = false;
        $this->Cases = false;
        $this->Length = false;
        return $res;
    }

    private function CheckSegment ($data, $VarType)
    {
        $response = true;
        
        if (! is_array($data) && trim($data) == '') {
            $response = false;
        }
        if ($this->Required && trim($data) == ''){
            $this->PrintLast ( Messages::get('checkinput') );
        }
        if ($response){
            if (Security::CheckType($data, $VarType) === false) {
                $response = false;
            }
            if ($this->Length !== false){
                if ((is_string ( $data ) && (strlen ( $data ) > $this->Length [1] || strlen ( $data ) < $this->Length [0])))
                    $response = false;
            }
            if ($this->Range !== false) {
                if ($data < $this->Range [0] || $data > $this->Range [1])
                    $response = false;
            }
            if ($this->Cases !== false) {
                if (! in_array ( $data, $this->Cases ))
                    $response = false;
            }
        }
        if ($response === false) {
            $this->PrintLast(Messages::get('CheckInput'));
        }
        if ($this->Clean === true && $response === true) {
            return Security::CleanXssString($data);
        }
        return $data;
    }

    public function isSeted ()
    {
        return parent::CheckisSeted('g');
    }
}
