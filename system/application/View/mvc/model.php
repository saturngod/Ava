<h2>Model</h2>

    Sometime model is optional but it's essential for development.
    <h3>Create Model</h3>

    <p>create php file in /system/appliction/Model/helloworld.php and write following</p>
    <pre class="brush: php">
        &lt;?php
        class helloworldModel extends Model {


            function helloworldModel()
            {
                parent::Model();
            }
            function get_txt()
            {
                return "Hello World";
            }
        }
        ?&gt;
    </pre>

    <p>get_txt is a function. You need extends Model class and Model text in class name. Now, you can load model from controll like following.</p>

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
                $this->load->model('helloworld');
                $this->helloworld->get_txt();
            }
        }
        ?&gt;
    </pre>
