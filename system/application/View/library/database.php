<h2>Database</h2>
<p>
   Database class is using <a href="http://www.php.net/manual/en/pdo.installation.php" target="_blank">PDO</a> library. So, pdo extension should be enable in php.ini.
</p>

<h3>Config Database</h3>

    <p>You can reduce your database code in ava framework. First, you need to change database host, username, password and database name.</p>
    <p>Setup in /system/config/config.php</p>
    <pre class="brush:php">
        //Database setup
        const db_host="localhost";
        const db_name="avaframework_sample";
        const db_user="root";
        const db_password="root";
    </pre>

<a name="load"></a><h3>Load DB Class</h3>
    <p>You can load databaes class like following</p>
    <pre class="brush:php">
        $this->load->library("db");
    </pre>
    
<a name="get"></a><h3>Get Data</h3>

    <p>If you want to get the data from <code class="variable">foo</code> table , you can write like following.</p>

    <pre class="brush:php">
        //select * from foo
        $result=$this->db->get('foo');
        print_r($result); // print all result
        echo $result[0]->field; // field is a field name of table
    </pre>

    <code class="variable">$result</code> is a array.

<a name="select"></a><h3>Select Field</h3>

     <pre class="brush:php">
        //select `id` from foo
        $this->db->select('id');
        $result=$this->db->get('foo');
        print_r($result); // print all result
        echo $result[0]->id;
    </pre>

    <p>You can also make multi select like this</p>

    <pre class="brush:php">
        //select `id`,`name` from foo
        $this->db->select('id,name');
        $result=$this->db->get('foo');
        print_r($result); // print all result
        echo $result[0]->id;
    </pre>

<h3 id="whereand">Where With AND</h3>

    <pre class="brush:php">
        //select * from foo where id = 1 and name='foo'
        $this->db->where("id",1);
        $this->db->where("name","foo");
        $result=$this->db->get('foo');
    </pre>

    <pre class="brush:php">
        //select * from foo where id = 1 and name!='foo'
        $this->db->where("id",1);
        $this->db->where("name !=","foo");
        $result=$this->db->get('foo');
    </pre>
    
    <pre class="brush:php">
        //select * from foo where id = 1 and name!='foo' and field < 5
        $this->db->where("id",1);
        $this->db->where("name !=","foo");
        $this->db->where("name <","5");
        $result=$this->db->get('foo');
    </pre>

<h3 id="whereor">Where With OR</h3>

    <pre class="brush:php">
        //select * from foo where id = 1 or name='foo'
        $this->db->where("id",1);
        $this->db->where_or("name","foo");
        $result=$this->db->get('foo');
    </pre>

    <pre class="brush:php">
        //select * from foo where id = 1 or name!='foo'
        $this->db->where("id",1);
        $this->db->where_or("name !=","foo");
        $result=$this->db->get('foo');
    </pre>

    <pre class="brush:php">
        //select * from foo where id = 1 or name!='foo' or field < 5
        $this->db->where("id",1);
        $this->db->where_or("name <",5);
        $result=$this->db->get('foo');
    </pre>

<a name="wherelike"></a><h3>Where With AND Like</h3>


    <pre class="brush:php">
        //select * from foo where `id` =1 and `name` like '%foo%'
        $this->db->where('id','1');
        $this->db->where_like("name",'foo');
        $result=$this->db->get('foo');
    </pre>

    <pre class="brush:php">
        //select * from foo where `id` =1 and `name` like 'foo%'
        $this->db->where('id','1');
        $this->db->where_like("name",'foo','after');
        $result=$this->db->get('foo');
    </pre>

    <pre class="brush:php">
        //select * from foo where `id` =1 and `name` like '%foo'
        $this->db->where('id','1');
        $this->db->where_like("name",'foo','before');
        $result=$this->db->get('foo');
    </pre>

<a name="whereorlike"></a><h3>Where With OR Like</h3>

    <pre class="brush:php">
        //select * from foo where `id` =1 OR `name` like '%foo%'
        $this->db->where('id','1');
        $this->db->where_or_like("name",'foo');
        $result=$this->db->get('foo');
    </pre>

    <pre class="brush:php">
        //select * from foo where `id` =1 OR `name` like 'foo%'
        $this->db->where('id','1');
        $this->db->where_or_like("name",'foo','after');
        $result=$this->db->get('foo');
    </pre>

    <pre class="brush:php">
        //select * from foo where `id` =1 OR `name` like '%foo'
        $this->db->where('id','1');
        $this->db->where_or_like("name",'foo','before');
        $result=$this->db->get('foo');
    </pre>

<a name="order"></a><h3>Order</h3>
    
    <pre class="brush:php">
        //select * from foo where id = 1 ORDER BY `name` ASC'

        $order['name']='ASC';
        $this->db->where("id",1);
        $this->db->order($order);
        $result=$this->db->get('foo');
    </pre>

    <pre class="brush:php">
        //select * from foo where id = 1 ORDER BY `name` ASC' , `type DESC

        $order['name']='ASC';
        $order['type']='DESC';
        $this->db->where("id",1);
        $this->db->order($order);
        $result=$this->db->get('foo');
    </pre>
<h3 id="limit">Limit</h3>
    <p>$this->db->limit(TOTAL,[START = 0])</p>
    <pre class="brush:php">
        //select * from foo where id = 1 ORDER BY `name` ASC' , `type DESC

        $order['name']='ASC';
        $order['type']='DESC';
        $this->db->where("id",1);
        $this->db->order($order);
         $this->db->limit(4);
        //$this->db->limit(4,5); start from 5
        $result=$this->db->get('foo');
      </pre>
    
<h3 id="oneline">One Line</h3>
    <pre class="brush:php">
        $result= $this->db->selec('foo')->where("id",1)->get('table');
    </pre>
    
<h3 id="insert">Insert</h3>
    <pre class="brush:php">
        //INSERT INTO table(`name`,`field`) VALUE ('foo','bar')
        $data['name']="foo";
        $data['field']="bar";
        $this->db->insert("table",$data);
    </pre>

<h3 id="update">Update</h3>
    <pre class="brush:php">
        $data['name']='bar';
        $data['field']='foo';
        $this->db->where("id",4);
        $this->db->update("table",$data);
    </pre>

<h3 id="delete">Delete</h3>
    <pre class="brush:php">
        $this->db->where("id",4);
        $this->db->delete("table");
    </pre>

<h3 id="query">Query</h3>
<pre class="brush:php">
      $sql="SELECT * FROM `player` WHERE `name`=:username and `father`=:father";
      $arr[':username']='foo';
      $arr[':father']='bar';
      $result=$this->db->query($sql,$arr);
</pre>

<h3 id="error">Error Checking</h3>
<pre class="brush:php">
      $sql="SELECT * FROM `player` WHERE `name`=:username and `father`=:father";
      $arr[':username']='foo';
      $arr[':father']='bar';
      $result=$this->db->query($sql,$arr);
      if($this->db->err) {
         
         // return array , 
         //index 1 is error code number
         //index 2 is error string
         print_r($this->db->err);
         
      }
</pre>