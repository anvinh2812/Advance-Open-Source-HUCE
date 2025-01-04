<!--  -->

<?php
    Class App {
        protected $controller;
        protected $arr;
        protected $action;
        protected $params = [];

        // Hàm này chỉ để kiểm tra và hiển thị các giá trị
        function index(): void {
            $arr = $this->urlProcess();
            echo "<br>";
            echo "Controller: " . get_class($this->controller) . "<br>";
            echo "Action: " . $this->action . "<br>";
            echo "Params: ";
            var_dump($this->params);
        }
        function __construct() {
            $arr = $this->urlProcess();

            // Kiểm tra và xử lý controller
            if (isset($arr[0])) {
                if (file_exists("../app/controller/" . $arr[0] . ".php")) {
                    $this->controller = $arr[0];
                } else {
                    echo "Controller không tồn tại";
                    exit;
                }
                unset($arr[0]);
            }

            // Yêu cầu file controller
            require_once "../app/controller/" . $this->controller . ".php";
            $this->controller = new $this->controller;
            
            // Kiểm tra và xử lý action
            if (isset($arr[1])) {
                if (method_exists($this->controller, $arr[1])) {
                    $this->action = $arr[1];
                } else {
                    echo "Action không tồn tại!";
                    exit;
                }
                unset($arr[1]);
            }

            // Lấy các tham số
            $this->params = $arr ? array_values($arr) : [];

            // Gọi phương thức action
            call_user_func_array([$this->controller, $this->action], $this->params);
        }
        
        function urlProcess(){
            if(isset($_GET['url'])){
                return explode(separator:"/", string:filter_var(value: trim(string: $_GET["url"], characters:"/"), filter: FILTER_SANITIZE_URL));
            }
        }
    }
?>