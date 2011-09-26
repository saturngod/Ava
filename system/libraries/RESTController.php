<?php
/**
 * RESTController Class
 * @package Ava
 * @since version 1.0
 * @author saturngod
 * @category controller
 */
class Ava_RESTController extends Ava_Base {

    /**
     * @access public
     * @var Loader $load
     */
    public $load;

    public $method;
    public $get= array();
    public $post= array();
    public $put = array();
    /**
     * constructor
     * @return void
     */
    function __construct()
    {   
        parent::Ava_Base();
        $this->_initialize();
        $this->_processRequest();

    }


    private function _processRequest() {
        $request_method = strtolower($_SERVER['REQUEST_METHOD']);
        $this->method=$request_method;
        
        switch ($request_method) {
            case 'get':
                $this->get = $this->arrayToObject($_GET);
                break;
            case 'post':
                $this->post = $this->arrayToObject($_POST);
            case 'put':
                parse_str(file_get_contents('php://input'), $put_vars);
                $this->put = $this->arrayToObject($put_vars);
                break;
        }
    }


    /**
     * Initialize the autoload and class
     * @return void
     */
    function _initialize()
    {

        //initalize Loader
        $auto_load=array("io","segment","router");
        
        foreach($auto_load as $library)
        {
            $this->$library=& load_class($library);
        }
        //load loader class
        $this->load =& load_class('Loader');

        //call auto load from config file
        $this->load->_auto_load();
    }

    /**
     * Array to the object
     * http://stackoverflow.com/questions/1869091/convert-array-to-object-php/1869569#1869569
    */
    function array_to_obj($array, &$obj)
    {
        foreach ($array as $key => $value)
        {
          if (is_array($value))
          {
            $obj->$key = new stdClass();
            array_to_obj($value, $obj->$key);
          }
          else
          {
            $obj->$key = $value;
          }
        }
        return $obj;
    }

    function arrayToObject($array)
    {
        $object= new stdClass();
        return $this->array_to_obj($array,$object);
    }

    /**
     * Get Status Code To Message
     * @param int status
     * @return string
    */
    function getStatusCodeMessage($status)
    {
            $codes = Array(
                100 => 'Continue',
                101 => 'Switching Protocols',
                200 => 'OK',
                201 => 'Created',
                202 => 'Accepted',
                203 => 'Non-Authoritative Information',
                204 => 'No Content',
                205 => 'Reset Content',
                206 => 'Partial Content',
                300 => 'Multiple Choices',
                301 => 'Moved Permanently',
                302 => 'Found',
                303 => 'See Other',
                304 => 'Not Modified',
                305 => 'Use Proxy',
                306 => '(Unused)',
                307 => 'Temporary Redirect',
                400 => 'Bad Request',
                401 => 'Unauthorized',
                402 => 'Payment Required',
                403 => 'Forbidden',
                404 => 'Not Found',
                405 => 'Method Not Allowed',
                406 => 'Not Acceptable',
                407 => 'Proxy Authentication Required',
                408 => 'Request Timeout',
                409 => 'Conflict',
                410 => 'Gone',
                411 => 'Length Required',
                412 => 'Precondition Failed',
                413 => 'Request Entity Too Large',
                414 => 'Request-URI Too Long',
                415 => 'Unsupported Media Type',
                416 => 'Requested Range Not Satisfiable',
                417 => 'Expectation Failed',
                500 => 'Internal Server Error',
                501 => 'Not Implemented',
                502 => 'Bad Gateway',
                503 => 'Service Unavailable',
                504 => 'Gateway Timeout',
                505 => 'HTTP Version Not Supported'
            );

            return (isset($codes[$status])) ? $codes[$status] : '';
    }

    function respond($status=200,$message='',$content_type='application/json') {
        
        $status_header='HTTP/1.1 '.$status.' '.$this->getStatusCodeMessage($status);
        header($status_header);
        header('Content-type: '.$content_type);

        if($message!='') {
            if(is_array($message)){
                echo json_encode($message);
            }
            else {
                echo $message;
            }
        }
    }






}
?>