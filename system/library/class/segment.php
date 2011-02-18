<?php
/**
 * segment
 * 
 * segment from website URI
 *
 * @author saturngod
 * @package Nifty
 * @category URI
 */
 
 class segment
 {
 	private $list;
 	
 	/**
 	 * construct
 	 * 
 	 * constructor of class and assign segment in $list
 	 *
 	 * @author saturngod
 	 */
 	public function __construct()
 	{
         $tmp_arr=preg_split('/\//',AWConfig::base_url);
         $count=count($tmp_arr)-2; // http:// include // 2. So substract 2
         $this->list=preg_split('/\//',$_SERVER['REQUEST_URI']);

         for($i=0;$i<=$count-1;$i++)
          {
 			//shifting the uncessary array
            array_shift($this->list);
          }


         $arr_count=count($this->list);

         if($this->list[$arr_count-1]=="")
         {
            array_pop($this->list);
         }
 		
 	}
 	
 	/**
 	 * get_list
 	 * 
 	 * return segement list array
 	 *
 	 * @author saturngod
 	 * @return array $this->list
 	 */
 	
 	public function get_list()
 	{	
 		return $this->list;
 	}
 	
 	/**
 	 * get
 	 * 
 	 * get number of segment from uri
 	 *
 	 * @author saturngod
     * @param int $room
 	 * @return string 
 	 */
 	 
 	 public function get($room)
 	 {
 	 	if(isset($this->list[$room])) return urldecode($this->list[$room]);
 	 	else return "";
 	 }
 }
?>