<h2>Session</h2>
<p>
   It's like normal php session.
</p>

<h3>Load</h3>
    <pre class="brush:php">
        $this->load->library("session")
    </pre>
<h3>Save</h3>
    <pre class="brush:php">
        $dat["foo"]="bar";
        $this->load->session($data);
    </pre>
<h3>Get</h3>
    <pre class="brush:php">
        $dat["foo"]="bar";
        $this->session($data);
        echo $this->session->get("foo");//return bar
    </pre>
<h3>Destory</h3>
	<pre class="brush:php">
        $this->session->destory();
    </pre>
<h3>_unset</h3>
	<pre class="brush:php">
		$this->session->_unset("foo");
	</pre>