<h2>Controller</h2>

    <h3>Create Controller</h3>
    <p>In Ava, segment look like following.
        <blockquote>http://localhost/ava/controller/function</blockquote>
    controller is a controller name. function is a function in controller class.
    </p>

    <h4>Example</h4>
    <p>Create a file in /system/application/Controller/helloworld.php</p>
    <p>Add following code</p>
    <pre class="brush: php">
        &lt;?php
        class HelloworldController extends Controller {

            function HelloworldController()
            {
                parent::Controller();
            }

            function index()
            {
                //index page
                echo "Hello World";
            }
        }
        ?&gt;
    </pre>
    <p>Open http://localhost/ava/helloworld/</p>
    <blockquote>Filename should be small letter. All of the controller class start with capitical letter.</blockquote>

    <p>Now, we will add function in controller.</p>
    <pre class="brush: php">
        &lt;?php
        class HelloworldController extends Controller {

            function HelloworldController()
            {
                parent::Controller();
            }

            function index()
            {
                //index page
                echo "Hello World";
            }

            function myfun()
            {
                echo "Function";
            }
        }
        ?&gt;
    </pre>

    <p>Open http://localhost/ava/helloworld/myfun and you will see Function text in webpage.</p>


    
