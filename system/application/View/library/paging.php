<h2>Paging</h2>
Paging for paging management.

<h3>Load</h3>
<pre class="brush:php">
    $this->load->library("paging");
</pre>

<h3>Init</h3>
<pre class="brush:php">
	$page=5;
	$total=100;
	$limit=10;
    print_r($this->paging->init($page,$total,$limit));

	/*
	Array
	(
    [current_page] => 5
    [total] => 100
    [limit] => 10
    [total_pages] => 10
    [start_point] => 41
    [end_point] => 50
    [next_page] => 6
    [prev_page] => 4
	)

	*/
</pre>