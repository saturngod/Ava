<?php
/**
 * segment
 * 
 * segment from website URI
 *
 * @since version 1.0
 * @author saturngod
 * @category Library
 */
 
 class Ava_segment
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
         $tmp_arr=preg_split('/\//',AvaConfig::base_url);
        
         //if user add / in the end, it will remove. 
         //Eg: http://localhost/test/ => localhost,test,
         //change to localhost,test
         
         if($tmp_arr[count($tmp_arr)-1]=="") {
             array_pop($tmp_arr);
         }

         $count=count($tmp_arr)-2; // http:// include // 2. So substract 2
         $this->list=preg_split('/\//',$_SERVER['REQUEST_URI']);
         
         if($this->list[count($this->list)-1]=="") {
             array_pop($this->list);
         }
                
         for($i=0;$i<=$count-1;$i++)
          {
            //shifting the uncessary array
            array_shift($this->list);
          }

         $arr_count=count($this->list);

        
         if($arr_count > 0) {
            if($this->list[$arr_count-1]=="")
            {
                array_pop($this->list);
            }
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
 	 
 	 /**
 	 */
 	 public function redirect($url)
 	 {
 	 	echo "<script>window.location='".$url."'</script>";
 	 }
 }
