<?php
    class ShopModel{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

       public function getProductsByKeyword($keyword){
        $this->db->query('SELECT petcare_inventory.*, 
        category.categoryname AS categoryname,
        min_max_prices.min_price,
        min_max_prices.max_price
        FROM petcare_inventory 
        JOIN petcare_product_category category ON petcare_inventory.category = category.id
        JOIN (
            SELECT category.id AS category_id,
                    MIN(petcare_inventory.price) AS min_price,
                    MAX(petcare_inventory.price) AS max_price
            FROM petcare_inventory 
            JOIN petcare_product_category category ON petcare_inventory.category = category.id
            WHERE petcare_inventory.name LIKE :keyword
            GROUP BY category.id
        ) AS min_max_prices ON category.id = min_max_prices.category_id
        WHERE petcare_inventory.name LIKE :keyword;
        ;
        ;
        ');

        $this->db->bind(':keyword' , '%'.$keyword.'%');

        $results = $this->db->resultSet();
        return $results;

       }



       public function getProductsByKeywordANDFilter($data) {
        $category = $data['GETCategory'] ?? null;
        $minprice = $data['GETMinPrice'] ?? null;
        $maxprice = $data['GETMaxPrice'] ?? null;
        $brand = $data['GETBrand'] ?? null;
    
       /* $query = 'SELECT petcare_inventory.*, 
            category.categoryname AS categoryname,
            min_max_prices.min_price,
            min_max_prices.max_price
            FROM petcare_inventory 
            JOIN petcare_product_category category ON petcare_inventory.category = category.id
            JOIN (
                SELECT category.id AS category_id,
                        MIN(petcare_inventory.price) AS min_price,
                        MAX(petcare_inventory.price) AS max_price
                FROM petcare_inventory 
                JOIN petcare_product_category category ON petcare_inventory.category = category.id
                WHERE petcare_inventory.name LIKE :keyword
                GROUP BY category.id
            ) AS min_max_prices ON category.id = min_max_prices.category_id
            WHERE petcare_inventory.name LIKE :keyword';*/

            $query = 'SELECT petcare_inventory.*,
            category.categoryname AS categoryname
            FROM petcare_inventory
            JOIN petcare_product_category category ON petcare_inventory.category = category.id
            WHERE petcare_inventory.name LIKE :keyword';

        
    
        // Include category values
        if (!empty($category)) {
            $query .= ' AND category.id IN (';
            foreach ($category as $index => $cat) {
                if ($index > 0) {
                    $query .= ', ';
                }
                $query .= $cat;
            }
            $query .= ')';
        }
    
        // Include brand values
        if (!empty($brand)) {
            $query .= ' AND petcare_inventory.brand IN (';
            foreach ($brand as $index => $br) {
                if ($index > 0) {
                    $query .= ', ';
                }
                $query .= '"' . $br . '"';
            }
            $query .= ')';
        }

        
    
        
    
        // Bind minprice parameter if provided
        if ($minprice !== null) {
            $query .= ' AND petcare_inventory.price >= :minprice';
           // $this->db->bind(':minprice', $minprice);
        }
    
        // Bind maxprice parameter if provided
        if ($maxprice !== null) {
            $query .= ' AND petcare_inventory.price <= :maxprice';
          //  $this->db->bind(':maxprice', $maxprice);
        }

        $this->db->query($query);

        // Bind keyword parameter
        $this->db->bind(':keyword', '%' . $data['keyword'] . '%');
    
        // Execute the query
        if($minprice !== null && $maxprice !== null){
            $this->db->bind(':minprice', $minprice);
            $this->db->bind(':maxprice', $maxprice);
        }
        
        
    
        $results = $this->db->resultSet();
        return $results;
    }

    public function returnMinandMaxprice(){
        $query ='SELECT MIN(price) AS min_price, MAX(price) AS max_price FROM petcare_inventory';
        
        $this->db->query($query);


        
        $result = $this->db->single(); // Assuming single() fetches a single row
       
        return $result;
    }
    
    
    

       public function getProductsCategories(){
        $this->db->query('SELECT * FROM petcare_product_category');

        $results = $this->db->resultSet();
        return $results;
       }

       public function getProductPrice($productID){

        $this->db->query('SELECT price FROM petcare_inventory WHERE id = :id');
        $this->db->bind(':id' , $productID);

        $results = $this->db->single();
        return $results->price;

       }

       public function getProductsByCart($productID){

            $query ='SELECT * FROM petcare_inventory WHERE id IN (';
        
            foreach ($productID as $index => $id) {
                if ($index > 0) {
                    $query .= ', ';
                }
                $query .= $id;
            }
            $query .= ')';


            $this->db->query($query);

        $results = $this->db->resultSet(); 
        return $results;

       
       }

       public function addToCart(){
        $this->db->query('INSERT INTO petcare_carts (user_id) VALUES (:user_id)');

        $this->db->bind(':user_id' , $_SESSION['user_id']);
        

        if($this->db->execute()){
            return true;
        }else{
            die('Something went wrong in adding to cart');
        }

       }



         public function getCartID(){
          $this->db->query('SELECT cart_id FROM petcare_carts WHERE user_id = :user_id ORDER BY cart_id DESC LIMIT 1');

            $this->db->bind(':user_id' , $_SESSION['user_id']);

            $result = $this->db->single();
            return $result->cart_id;
         }

         public function addToCartItems($cart_id, $product_id, $quntity, $price){
            $this->db->query('INSERT INTO petcare_cart_items (cart_id, product_id, quantity, price) VALUES (:cart_id, :product_id, :quantity, :price)');

            $this->db->bind(':cart_id' , $cart_id);
            $this->db->bind(':product_id' , $product_id);
            $this->db->bind(':quantity' , $quntity);
            $this->db->bind(':price' , $price);

            if($this->db->execute()){
                return true;
            }else{
                die('Something went wrong in adding to cart items');
            }
         }


         public function removeStock($product_id,$quntity){
            $this->db->query('UPDATE petcare_inventory SET stock = stock - :quantity WHERE id = :id');

            $this->db->bind(':id' , $product_id);
            $this->db->bind(':quantity' , $quntity);

            if($this->db->execute()){
                return true;
            }else{
                die('Something went wrong in removing stock');
            }

         }

         public function generateInvoiceAndReturnId($cart_id,$total){
            $this->db->query('INSERT INTO petcare_shop_invoices(cart_id, total_amount,user_id) VALUES (:cart_id, :total, :user_id)');

            $this->db->bind(':cart_id' , $cart_id);
            $this->db->bind(':total' , $total);
            $this->db->bind(':user_id' , $_SESSION['user_id']);

            if($this->db->execute()){
                $this->db->query('SELECT invoice_id FROM petcare_shop_invoices WHERE cart_id = :cart_id');
                $this->db->bind(':cart_id' , $cart_id);
                $result = $this->db->single();
                return $result->invoice_id;
            }else{
                die('Something went wrong in generating invoice');
            }
         }

       

        

    }