<h2>Cache</h2>
Ava is using file cache.

<h3>Load</h3>

<pre class="brush:php">
$this->load->library('cache');
</pre>

<h3>Store</h3>

<pre class="brush:php">
$Serializing=true;
//default Serializing is false
$key="foo";
$value="bar";
$this->cache->store($key,$value,$Serializing);
</pre>

<h3>Exist</h3>

<pre class="brush:php">

if($this->cache->exist($key)) {
	//key exist
}
</pre>

<h3>Fetch</h3>

<pre class="brush:php">

$value=$this->cache->fetch($key);
</pre>

<h3>Delete</h3>

<pre class="brush:php">

$this->cache->delete($key);
</pre>