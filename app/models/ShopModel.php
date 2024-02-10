<?php
    class ShopModel{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getProductInfo($catId){
            $this->db->query('SELECT * ,
                            petcare_product_category.categoryname as namee
                            FROM  petcare_product_category
                            INNER JOIN petcare_inventory
                            ON petcare_inventory.category = petcare_product_category.id
                            WHERE category = :catId' );
            $this->db->bind(':catId' , $catId);
            $result = $this->db->resultSet();
            return $result;
        }

        public function getProductById($id){
            $this->db->query('SELECT * FROM petcare_inventory WHERE id = :id');
            $this->db->bind(':id' , $id);
            $row = $this->db->single();
            return $row;
        }

    }