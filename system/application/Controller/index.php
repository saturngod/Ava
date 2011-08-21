<?php

class IndexController extends Ava_Controller {
	
	function index()
	{
        $this->load->library("cache");
        if($this->cache->exist("foo"))
        {
            //echo $this->cache->fetch("foo");
            $this->cache->delete("foo");
        }
//        else
//        {
//            $this->cache->store("foo","bar",3600);
//        }

		$count = 1000000;
		$phrase = 'Foo!';
		
		ob_start();
		$start = microtime(true);
		for ($i = 0; $i < $count; $i++)
		{
				echo 'Hello World! '.$phrase;
		}
		$concat_total = microtime(true) - $start;
		ob_end_clean();
		
		ob_start();
		$start = microtime(true);
		for ($i = 0; $i < $count; $i++)
		{
				echo 'Hello World! ', $phrase;
		}
		$param_total = microtime(true) - $start;
		ob_end_clean();
		
		ob_start();
		$start = microtime(true);
		for ($i = 0; $i < $count; $i++)
		{
				echo "Hello World! {$phrase}";
		}
		$interpol_total = microtime(true) - $start;
		ob_end_clean();
		
		echo 'Echoed to buffer '.number_format($count).' times per test<br /><br />';
		
		echo 'Param Total Time: '.$param_total.' seconds<br />';
		echo 'Param Avg Time: '.($param_total / $count).' seconds<br /><br />';
		
		echo 'Concat Total Time: '.$concat_total.' seconds<br />';
		echo 'Concat Avg Time: '.($concat_total / $count).' seconds<br /><br />';
		
		echo 'Interpolation Total Time: '.$interpol_total.' seconds<br />';
		echo 'Interpolation Avg Time: '.($interpol_total / $count).' seconds<br /><br />';
		
		echo 'start sessio';
		$this->session->set(array('same'=>5));
	}
	
    function helloworld()
    {
        $this->load->model('helloworld');
        echo $this->helloworld->get_txt();
        print_r($this->helloworld->form_db());
        
    }

	function test_session()
	{
		echo "SESSION :";
		if($this->session->get('same'))
		{
			echo $this->session->get('same');
		}
		else
		{
			echo "TIME OUT";
		}
	}
    function myview()
    {
    	$data['base']='HI';
    	$data['public']=AvaConfig::base_url;
    	$data['txt']='This is testing';
    	$this->load->view('home',$data);
    }

	function db()
	{
		print_r($this->db->select("CHARACTER_SET_NAME")->where_like("DEFAULT_COLLATE_NAME","latin")->limit(5)->get("CHARACTER_SETS"));

	}
}
?>