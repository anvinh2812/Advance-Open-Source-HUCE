<!--  -->

<?php
    Class App {
        // public function index(): void{
        //     echo "dm con cho tu";
        // }
        //Xu ly url
        protected $controller;
        protected $arr;
        protected $action;
        protected $param;

        function index(): void{
            $arr = $this->urlProcess();
            
            var_dump(value:$arr);
        }
        function __construct() {
            $arr = $this->urlProcess();

            if(isset($arr[0])){
                // if(file_exists(filename:"../controller/sinhvien.php"));
                if(file_exists(filename:"../controller/" . $arr[0] . ".php"));{
                    echo "controller khong ton tai";
                    $this->controller = $arr[0];
                }
                unset($arr[0]);
            }
            require_once "../controller/" . $this->controller . ".php";
            $this->controller = new  $this->controller;
            if(isset($arr[1])){
                if(method_exists(object_or_class: $controller, method:$arr[1])){
                    echo "action co ton tai";
                    $this->action = $arr[1];
                }
                unset($arr[1]);
            }
            $this->param = $arr[1];
        }
        
        function urlProcess(): array|bool{
            if(isset($_GET['url'])){
                return explode(separator:"/", string:filter_var(value: trim(string: $_GET["url"], characters:"/")));
            }
        }
    }
?>