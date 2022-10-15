<?php

class categoriesModel{
    private $db;

    function __construct(){
        $this->db=$this->connect();
    }

    private function connect() {
        $db = new PDO('mysql:host=localhost;'.'dbname=db_ash;charset=utf8', 'root', '');
        return $db;
    }

    function getAll() {
        $query = $this->db->prepare("SELECT * FROM categories");
        $query->execute();
        $categories = $query->fetchAll(PDO::FETCH_OBJ);
        return $categories;
    }

    function getCategory($id){
        $query = $this->db->prepare("SELECT * FROM categories WHERE id=?");
        $query->execute([$id]);
        $category=$query->fetch(PDO::FETCH_OBJ);
        return $category;
    }

    function getProductsAndCategories($products) {
        $query = $this->db->prepare("SELECT * FROM categories WHERE id=?");
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
            $categories = $query->fetchAll(PDO::FETCH_OBJ);

            foreach($categories as $category){
                $p->brand= $category->brand;
                $p->type= $category->type;
            }
            array_push($arrayProducts, $p);
        }
        return $arrayProducts;
    }

    function updateCategory($id,$type,$brand){
        $query=$this->db->prepare("UPDATE categories SET `type`=?,`brand`=? WHERE id=? ");
        $query->execute([$type,$brand,$id]);
    }

    function deleteCategory($id){
        try{
            $query = $this->db->prepare('DELETE FROM categories WHERE id = ?');
            $query->execute([$id]);
        }
        catch(PDOException){
            $msg='error';
            header("Location: " . BASE_URL. 'editCategories/'.$msg);
            exit;
        }
    }
    
    function addCategory($type,$brand){
        $query = $this->db->prepare("INSERT INTO categories (`type`, `brand`) VALUES (?, ?)");
        $query->execute([$type,$brand]);
    }
}