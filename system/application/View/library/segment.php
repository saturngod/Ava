<h2>Segment</h2>
<p>
   Segment is a URI segment from address bar. example: <br/>
    <code class="comment">
        http://www.example.com/controller/action/segment3
    </code><br/>
    segment room 0 is a controller and 1 is a action. Segment is very useful for passing data like $_GET value. example:<br/>
    <code class="comment">
        http://www.example.com/profile/user/saturngod
    </code><br/>
    You can get username easily with segment library like
    <pre class="brush:php">
        echo $this->segment->get(2);//saturngod
    </pre>
</p>

<h3>Get Segment</h3>

    <pre class="brush:php">
        //http://www.example.com/controller/action/segment3
        echo $this->segment->get(0);//controller
        echo $this->segment->get(1);//action
        echo $this->segment->get(2);//segment3
    </pre>

<h3>Get All Segments</h3>

    <pre class="brush:php">
        print_r($this->segment->get_list());
    </pre>

<h3>Redirect</h3>

    <pre class="brush:php">
        //redirect to the www.google.com
        $this->segment->redirect("http://www.google.com");
    </pre>