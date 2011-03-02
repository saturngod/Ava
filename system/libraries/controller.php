<?php
/**
 * Controller Class
 * @package Ava
 * @since version 1.0
 * @author saturngod
 * @category controller
 */
class Controller extends Ava_Base {

    /**
     * @access public
     * @var Loader $load
     */
    public $load;
    /**
     * constructor
     * @return void
     */
	function Controller()
	{	
		parent::Ava_Base();
		$this->_initialize();

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
}
?>