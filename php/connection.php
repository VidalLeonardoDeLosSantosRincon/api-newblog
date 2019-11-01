<?php
 function toConnect(){
     $host = "localhost";
     $dbname="newBlog";
     $user="root";
     $password="";
    try{
        $conexion = new PDO("mysql:host=$host;dbname=$dbname",$user,$password);
        return $conexion;
    }catch(PDOException $e){
        echo "Error: ".$e->getMessage();
    }

 }
?>