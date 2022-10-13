<?php

class productsModel{
    private $db;

    function __construct(){
        $this->db=$this->connect();
    }

    private function connect() {
        $db = new PDO('mysql:host=localhost;'.'dbname=db_ash;charset=utf8', 'root', '');
        return $db;
    }

    function getAll() {
        $query = $this->db->prepare("SELECT * FROM products");
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }
    function update($id,$name,$description,$stock,$price,$type,$item,$image=null){
        $pathImg = null;
        if ($image)
            $pathImg = $this->uploadImage($image);
        else{
            $pathImg=$item;
        }
        if($type==null){
            $query=$this->db->prepare("UPDATE products SET `name`=?,`description`=?,`image`=?,`price`=?, `stock`=? WHERE id=? ");
            $query->execute([$name,$description,$pathImg,$price,$stock,$id]); 
        }else{
            $query=$this->db->prepare("UPDATE products SET `name`=?,`description`=?,`image`=?,`price`=?, `stock`=?, `id_types`=? WHERE id=? ");
            $query->execute([$name,$description,$pathImg,$price,$stock,$type,$id]);
        }
    }

    private function uploadImage($image){
        $target = 'img-products/users/' . uniqid() . '.jpg';
        move_uploaded_file($image, $target);
        return $target;

    }

    function addProduct($name,$description,$stock,$price,$type,$image=null){
        $pathImg = null;
        $pathImg='img-products/test.png';
        if ($image)
            $pathImg = $this->uploadImage($image);
        $query = $this->db->prepare("INSERT INTO products (`name`, `description`,`image`,`price`, `stock`,`id_types`) VALUES (?, ?, ?, ?, ?,?)");
        $query->execute([$name,$description,$pathImg,$price,$stock,$type]);
    }
    
    function deleteProduct($id){
        $query = $this->db->prepare('DELETE FROM products WHERE id = ?');
        $query->execute([$id]);
    }
    
}