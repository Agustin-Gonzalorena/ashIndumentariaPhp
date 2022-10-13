<?php

class productsTypeModel{
    private $db;

    function __construct(){
        $this->db=$this->connect();
    }

    private function connect() {
        $db = new PDO('mysql:host=localhost;'.'dbname=db_ash;charset=utf8', 'root', '');
        return $db;
    }

    function getTypeProducts() {
        $query = $this->db->prepare("SELECT * FROM type_products");
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }

    function getProductsAndTypes($products) {
        $db = $this->connect();
        $query = $db->prepare("SELECT * FROM type_products WHERE id=?");
        $arrayProducts=array();
        
        foreach($products as $product) {
            $p = new stdClass();
            $p->id = $product->id;
            $p->name = $product->name;
            $p->description = $product->description;
            $p->image= $product->image;
            $p->stock = $product->stock;
            $p->price= $product->price;
            
            $query->execute(array($product->id_types));
            $types = $query->fetchAll(PDO::FETCH_OBJ);
            foreach($types as $type){
            $p->brand= $type->brand;
            $p->type= $type->type;
            }
            array_push($arrayProducts, $p);
        }

        return $arrayProducts;
    }

    function updateCategory($id,$type,$brand){
        $query=$this->db->prepare("UPDATE type_products SET `type`=?,`brand`=? WHERE id=? ");
        $query->execute([$type,$brand,$id]);
    }

    function deleteCategory($id){
        try{
        $query = $this->db->prepare('DELETE FROM type_products WHERE id = ?');
        $query->execute([$id]);
        }
        catch(PDOException){
            $msg='error';
            header("Location: " . BASE_URL. 'editCategories/'.$msg);
            exit;
        }
    }
    
    function addCategory($type,$brand){
        $query = $this->db->prepare("INSERT INTO type_products (`type`, `brand`) VALUES (?, ?)");
        $query->execute([$type,$brand]);
    }



    
}