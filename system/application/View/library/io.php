<h2>IO</h2>
IO for post , get and header value

<h3>Load</h3>

<pre class="brush:php">
$this->load->library('io');
</pre>

<h3>POST</h2>

<pre class="brush:php">
	//without xss clean
	$data=$this->io->post("post_name");

	//with xss clean
	$data=$this->io->post("post_name",true);	
</pre>

<h3>GET</h2>

<pre class="brush:php">
	//address?get_data=1
	//without xss clean
	$data=$this->io->get("get_data");

	//with xss clean
	$data=$this->io->get("get_data",true);	
</pre>

<h3>Header</h2>

<pre class="brush:php">
	//without xss clean
	$data=$this->io->header("header_name");

	//with xss clean
	$data=$this->io->header("header_name",true);	
</pre>