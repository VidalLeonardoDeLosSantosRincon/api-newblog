<?php 
    require("connection.php");
    class Post{
        public function __construct($connection){
            $this -> connection = $connection;
        }

        public function addPost($text,$imageUrl,$idUser){
            $st = $this-> connection->prepare("insert into posts(texts,imageUrl,idUser) values (:text,:imageUrl,:idUser)");
            $st-> execute([":text"=>$text,":imageUrl"=>$imageUrl,":idUser"=>$idUser]);
        }

        public function updatePost($id,$text,$imageUrl,$idUser){
            $st = $this-> connection->prepare("update posts set texts=:text, imageUrl=:imageUrl where id = :id and idUser = :idUser");
            $st-> execute([":id"=>$id,":text"=>$text,":imageUrl"=>$imageUrl,":idUser"=>$idUser]);
        }

        public function deletePost($id,$idUser){
            $st = $this-> connection->prepare("delete from posts where id = :id and idUser = :idUser");
            $st-> execute([":id"=>$id,":idUser"=>$idUser]);
        }

        public function getPosts(){
            $st = $this-> connection->prepare("select * from posts");
            $st-> execute();
            $results = $st->fetchAll();
            $response = [];
            foreach($results as $fila){
                $response["posts"][]=["id"=>$fila[0],"text"=> $fila[1],"imageUrl"=> $fila[2],"idUser"=> $fila[3]];
            }
            echo json_encode($response);
        }

        public function getPost($id){
            $st = $this-> connection->prepare("select * from posts where id = :id");
            $st-> execute([":id"=>$id]);
            $results = $st->fetchAll();
            $response = [];
            foreach($results as $fila){
                $response["posts"][]=["id"=>$fila[0],"text"=> $fila[1],"imageUrl"=> $fila[2],"idUser"=> $fila[3]];
            }
            echo json_encode($response);
        }
    }
    $con = toConnect();
    $post = new Post($con);
    //$post->addPost("Adios","adios.jpg",1);

    /*if($_SERVER["REQUEST_METHOD"]=="GET"){
        $post->getPosts();
    }*/

    echo json_encode("estoy llegando");
?>