<h2>Paging</h2>
Paging for paging management.

<h3>Load</h3>
<pre class="brush:php">
    echo $this->session->library("paging");//return bar
</pre>

<h3>Init</h3>
<pre class="brush:php">
	$page=5;
	$rp=7;//$rp is a break
	$total=100;
	$limit=10;
    print_r($this->paging->init($page,$rp,$total,$limit));

	/*
	Array
	(
	    [first] => 1
	    [prev] => 4
	    [start] => 1
	    [end] => 10
	    [page] => 5
	    [next] => 6
	    [last] => 15
	    [total] => 100
	    [iend] => 35
	    [istart] => 29
	)
	*/
</pre>