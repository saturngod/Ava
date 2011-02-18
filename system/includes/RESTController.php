<?php

Abstract class RESTController extends Loader {

    /**
     * RESTController
     */
    public $load;
    private $_method;
    private $_format;

    private $_get_args = array();
    private $_put_args = array();
    private $_delete_args = array();
    private $_args = array();

    abstract function index();

     // List all supported methods, the first will be the default format
    private $_supported_formats = array(
		'xml' 		=> 'application/xml',
		'rawxml' 	=> 'application/xml',
		'json' 		=> 'application/json',
		'serialize' => 'application/vnd.php.serialized',
		'php' 		=> 'text/plain',
		'csv' 		=> 'application/csv'
	);
     // Constructor function
    function RESTController()
    {
        self::Loader();

        // How is this request being made? POST, DELETE, GET, PUT?
	    $this->_method = $this->_detect_method();

        switch($this->_method)
        {
        	case 'put':
		    	// Set up out PUT variables
		    	parse_str(file_get_contents('php://input'), $this->_put_args);
    		break;

        	case 'delete':
		    	// Set up out PUT variables
		    	parse_str(file_get_contents('php://input'), $this->_delete_args);
    		break;
        }

        $this->_get_args=$this->_get_args_method();

       
        // Merge both for one mega-args variable
    	$this->_args = array_merge($this->_get_args, $this->_put_args, $this->_delete_args);

    	// Which format should the data be returned in?
	    $this->_format = $this->_detect_format();
    }

     /*
     * response
     *
     * Takes pure data and optionally a status code, then creates the response
     */
    function response($data = array(), $http_code = 200)
    {
        if(empty($data))
    	{
    		$this->io->set_status_header(404);
    		return;
    	}


         // If the format method exists, call and return the output in that format
        if(method_exists($this, '_REST_'.$this->_format))
        {
	    	// Set the correct format header
	    	$this->io->set_status_header($http_code);
            header('Content-type: '.$this->_supported_formats[$this->_format]);
            echo $this->{'_REST_'.$this->_format}($data);

        }
        
    }
    private function _detect_format()
    {
        $pattern = '/(' . implode( '|', array_keys($this->_supported_formats) ) . ')$/';

       
		// Check if a file extension is used
		if(preg_match($pattern, end($this->_get_args), $matches))
        {

            // The key of the last argument
			$last_key = end($this->_get_args);
            return $last_key;

        }


    }
    private function _get_args_method()
    {
        //remove controller and function
        $slice_array= array_slice($this->segment->get_list(),2);
        $i=0;
        $return_array=array();
        $last_seg="";
        foreach($slice_array as $seg )
        {
            if($i%2==0)
            {
                $return_array[$seg]="";
                $last_seg=$seg;
            }
            else
            {
                $return_array[$last_seg]=$seg;
            }
            $i++;
        }

        return $return_array;
    }
     /*
     * Detect method
     *
     * Detect which method (POST, PUT, GET, DELETE) is being used
     */
    private function _detect_method()
    {
    	//$method = strtolower($this->input->server('REQUEST_METHOD'));
        $method=strtolower($_SERVER['REQUEST_METHOD']);
       	if(in_array($method, array('get', 'delete', 'post', 'put')))
    	{
	    	return $method;
    	}
    	return 'get';
    }

    /*
     * Output format function
     */

    // Encode as JSON
    // FORMATING FUNCTIONS ---------------------------------------------------------

    // Force it into an array
    private function _force_loopable($data)
    {
    	// Force it to be something useful
		if(!is_array($data) && !is_object($data))
		{
			$data = (array) $data;
		}

		return $data;
    }
    // Format XML for output
    private function _REST_xml($data = array(), $structure = NULL, $basenode = 'xml')
    {
    	// turn off compatibility mode as simple xml throws a wobbly if you don't.
		if (ini_get('zend.ze1_compatibility_mode') == 1)
		{
			ini_set ('zend.ze1_compatibility_mode', 0);
		}

		if ($structure == NULL)
		{
			$structure = simplexml_load_string("<?xml version='1.0' encoding='utf-8'?><$basenode />");
		}

		// loop through the data passed in.
		$data = $this->_force_loopable($data);
		foreach($data as $key => $value)
		{
			// no numeric keys in our xml please!
			if (is_numeric($key))
			{
				// make string key...
				//$key = "item_". (string) $key;
				$key = "item";
			}

			// replace anything not alpha numeric
			$key = preg_replace('/[^a-z]/i', '', $key);

			// if there is another array found recrusively call this function
			if (is_array($value) || is_object($value))
			{
				$node = $structure->addChild($key);
				// recrusive call.
				$this-> _REST_xml($value, $node, $basenode);
			}
			else
			{
				// add single node.

				$value = htmlentities($value, ENT_NOQUOTES, "UTF-8");

				$UsedKeys[] = $key;

				$structure->addChild($key, $value);
			}

		}

		// pass back as string. or simple xml object if you want!
		return $structure->asXML();
    }


    // Format Raw XML for output
    private function _REST_rawxml($data = array(), $structure = NULL, $basenode = 'xml')
    {
    	// turn off compatibility mode as simple xml throws a wobbly if you don't.
		if (ini_get('zend.ze1_compatibility_mode') == 1)
		{
			ini_set ('zend.ze1_compatibility_mode', 0);
		}

		if ($structure == NULL)
		{
			$structure = simplexml_load_string("<?xml version='1.0' encoding='utf-8'?><$basenode />");
		}

		// loop through the data passed in.
		$data = $this->_force_loopable($data);
		foreach( $data as $key => $value)
		{
			// no numeric keys in our xml please!
			if (is_numeric($key))
			{
				// make string key...
				//$key = "item_". (string) $key;
				$key = "item";
			}

			// replace anything not alpha numeric
			$key = preg_replace('/[^a-z0-9_-]/i', '', $key);

			// if there is another array found recrusively call this function
			if (is_array($value) || is_object($value))
			{
				$node = $structure->addChild($key);
				// recrusive call.
				$this->_REST_rawxml($value, $node, $basenode);
			}
			else
			{
				// add single node.

				$value = htmlentities($value, ENT_NOQUOTES, "UTF-8");

				$UsedKeys[] = $key;

				$structure->addChild($key, $value);
			}

		}

		// pass back as string. or simple xml object if you want!
		return $structure->asXML();
    }

    

    // Format HTML for output
    private function _REST_csv($data = array())
    {
    	// Multi-dimentional array
		if(isset($data[0]))
		{
			$headings = array_keys($data[0]);
		}

		// Single array
		else
		{
			$headings = array_keys($data);
			$data = array($data);
		}

		$output = implode(',', $headings)."\r\n";
		foreach($data as &$row)
		{
			$output .= '"'.implode('","',$row)."\"\r\n";
		}

		return $output;
    }

    // Encode as JSON
    private function _REST_json($data = array())
    {
    	return json_encode($data);
    }

    // Encode as Serialized array
    private function _REST_serialize($data = array())
    {
    	return serialize($data);
    }

    // Encode raw PHP
    private function _REST_php($data = array())
    {
    	return var_export($data, TRUE);
    }

 // INPUT FUNCTION --------------------------------------------------------------

    public function get($key, $xss_clean = TRUE)
    {
    	return array_key_exists($key, $this->_get_args) ? $this->_xss_clean( $this->_get_args[$key], $xss_clean ) : $this->io->get($key, $xss_clean) ;
    }

    public function post($key, $xss_clean = TRUE)
    {
    	return $this->io->post($key, $xss_clean);
    }

    public function put($key, $xss_clean = TRUE)
    {
    	return array_key_exists($key, $this->_put_args) ? $this->_xss_clean( $this->_put_args[$key], $xss_clean ) : FALSE ;
    }

    public function delete($key, $xss_clean = TRUE)
    {
    	return array_key_exists($key, $this->_delete_args) ? $this->_xss_clean( $this->_delete_args[$key], $xss_clean ) : FALSE ;
    }

    private function _xss_clean($val, $bool)
    {
    	return $bool ? $this->io->xss_clean($val) : $val;
    }
        
   
}

?>
