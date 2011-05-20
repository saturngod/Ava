<h2>View</h2>
    <p>View is a template for website. It's just html and you can pass varaible when you load</p>

<h3>Sample</h3>
 In controller
 <pre class="brush: php">
     $data['title']="Ava Framework Documentation";
     $this->load->view('header',$data);
     $this->load->view('home');
     $this->load->view('footer');
 </pre>

    <p>You need to create header.php , home.php and footer.php in /system/application/View/ folder.</p>

    header.php
    <pre class="brush: php">
        &lt;html&gt;
            &lt;head&gt;
                &lt;title&gt;&lt;php echo $title &gt;&lt;/title&gt;
            &lt;/head&gt;
        &lt;/html&gt;
        &lt;body&gt;
    </pre>

    home.php
     <pre class="brush: xml">
         Helloworld
     </pre>

    footer.php
        <pre class="brush: xml">
            &lt;/body&gt;
            &lt;/html&gt;
        </pre>
