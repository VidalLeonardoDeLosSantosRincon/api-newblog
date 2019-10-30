<?php 
    require("connection.php");
    class User{
        public function __construct($connection){
            $this -> connection = $connection;
        }
        public function addUser($email,$password){
            $st = $this-> connection->prepare("insert into users(email,pass) values (:email, :password)");
            $st-> execute([":email"=> $email, ":password"=> $password]);
        }

        public function updateUser($id,$email,$password){
            $st = $this-> connection->prepare("update users set email= :email, pass= :password where id = :id");
            $st-> execute([":id"=>$id,":email"=>$email,":password"=>$password]);
        }

        public function deleteUser($id){
            $st = $this-> connection->prepare("delete from users where id = :id");
            $st-> execute([":id"=>$id]);
        }

        public function getUsers(){
            $st = $this-> connection->prepare("select * from users");
            $st-> execute();
            $results = $st->fetchAll();
            $response = [];
            foreach($results as $fila){
                $response["users"][]=["id"=>$fila[0],"email"=>$fila[1], "pass"=> $fila[2]];
            }
            echo json_encode($response);
        }

        public function getUser($id){
            $st = $this-> connection->prepare("select * from users where id = :id");
            $st-> execute([":id"=>$id]);
            $results = $st->fetchAll();
            $response = [];
            foreach($results as $fila){
                $response["users"][]=["id"=>$fila[0],"email"=>$fila[1], "pass"=> $fila[2]];
            }
            echo json_encode($response);
        }
    }

$con = toConnect();
$user = new User($con);
//$user-> addUser("vidal@gmail.com","12345");
$user->getUsers();


?>