<?php
    class Post{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getPosts(){
            $this->db->query('SELECT * , category.category_name as categoryname , staff.firstname as authorfname , staff.lastname as authorlname , staff.profileImage as authorImage
            FROM petcare_blogs
            JOIN petcare_blogs_category category ON petcare_blogs.category = category.id
            JOIN petcare_staff staff ON petcare_blogs.author = staff.staff_id ORDER BY publishdate DESC
            ');

            $results = $this->db->resultSet();
            return $results;
        }

        public function getPostById($id){

            $this->db->query('SELECT * , staff.firstname as authorfname , staff.lastname as authorlname , staff.profileImage as authorImage
                              FROM petcare_blogs
                              JOIN petcare_staff staff ON petcare_blogs.author = staff.staff_id
                              WHERE blogID = :id');

            $this->db->bind(':id' , $id);
            $row = $this->db->single();
            return $row;
        }

        public function getRecentPost(){
            $this->db->query('SELECT * FROM petcare_blogs ORDER BY publishdate DESC LIMIT 3');
            $result = $this->db->resultSet();
            return $result;
        }

        public function addBlog($data){

                //insert data with image
                $this->db->query('INSERT INTO petcare_blogs (title,category,content,thumbnail ,author) 
                                VALUES (:title  , :category , :content , :filename , :author )');

                //bind valuess
                $this->db->bind(':title' , $data['title']);
                $this->db->bind(':content' , $data['content']);
                $this->db->bind(':category' , $data['category']);
                $this->db->bind(':author' , $_SESSION['user_id']);  /* important update this to $_session['user_id']*/ 
                // $this->db->bind(':user_id' , $_SESSION['user_id']);  //remove this  
                $this->db->bind(':filename',$data['uniqueImgFileName']);


                // Specify the source directory (temporary location)
                $sourceDir = $data['img']['tmp_name'];

                // Specify the destination directory using __DIR__
                $destinationDir = __DIR__ . '/../../public/storage/uploads/blog/';
                // $destinationDir = '/Applications/xampp/xamppfiles/htdocs/petcare/public/storage/uploads/blog/';
                
                // Set the path to move the uploaded file to
                $uploadPath = $destinationDir . $data['uniqueImgFileName'];



                if (move_uploaded_file($sourceDir, $uploadPath)) {

                    $imageType = exif_imagetype($uploadPath);
                // die("success");

                    switch ($imageType) {
                            case IMAGETYPE_JPEG:
                                
                                $source = imagecreatefromjpeg($uploadPath);

                                // Save the compressed image to the same file
                                imagejpeg($source, $uploadPath,30);  //can adjust the compression level (0-100)
                            
                                // Free up resources
                                imagedestroy($source);

                            

                                break;

                            case IMAGETYPE_PNG:
                            $source = imagecreatefrompng($uploadPath);

                                // Save the compressed image to the same file
                                imagepng($source, $uploadPath, 5); // You can adjust the compression level (0-9)

                                // Free up resources
                                imagedestroy($source);
                                break;
                        
                            default:
                                echo "Unsupported image format.";
                                break;
                        }
            
                } else {
                        // Error moving the file
                    // $data['img_err'] = 'Error moving the file.';
                    //  die("Misson failed img not moved");
                }


                        //execute
                if($this->db->execute()){
                    return true;

                }else{
                    return false;
                }



            

        }

        public function updateBlog($data){

            //get image name from database
           
            // $oldImgFileName = $this->getPetProfileImageByID($data['id']);
// ned to chang
 

            $this->db->query('UPDATE petcare_blogs  SET title = :title , thumbnail = :filename , content = :content ,
            category = :category , author = :author   WHERE blogID = :id');
            $this->db->bind(':id' , $data['id']);
            $this->db->bind(':title' , $data['title']);
            $this->db->bind(':filename',$data['uniqueImgFileName']);
            $this->db->bind(':content' , $data['content']);
            $this->db->bind(':category' , $data['category']);
            $this->db->bind(':author' , $_SESSION['user_id']);
            // $this->db->bind(':user_id' , $data['user_id']);

            // Specify the source directory (temporary location)
                    $sourceDir = $data['img']['tmp_name'];

                    // Specify the destination directory using __DIR__
                    $destinationDir = __DIR__ . '/../../public/storage/uploads/blog/';
                    // Set the path to move the uploaded file to
                    $uploadPath = $destinationDir . $data['uniqueImgFileName'];



                    if (move_uploaded_file($sourceDir, $uploadPath)) {

                        $imageType = exif_imagetype($uploadPath);
                       // die("success");

                       switch ($imageType) {
                        case IMAGETYPE_JPEG:
                            
                            $source = imagecreatefromjpeg($uploadPath);

                            // Save the compressed image to the same file
                            imagejpeg($source, $uploadPath,30);  //can adjust the compression level (0-100)
                        
                            // Free up resources
                            imagedestroy($source);

                           

                            break;

                        case IMAGETYPE_PNG:
                           $source = imagecreatefrompng($uploadPath);

                            // Save the compressed image to the same file
                            imagepng($source, $uploadPath, 5); // You can adjust the compression level (0-9)

                            // Free up resources
                            imagedestroy($source);
                            break;
                       
                        default:
                            echo "Unsupported image format.";
                            break;
                        }

                    } else {
                        // Error moving the file
                    // $data['img_err'] = 'Error moving the file.';
                    // die("Misson failed");
                    }

                if($this->db->execute()){
                    return true;
                }else{
                    return false;
                }

        }

        public function deleteBlog($id){
            $this->db->query('DELETE FROM petcare_blogs WHERE blogID = :id');

            $this->db->bind(':id' , $id);
            


           if($this->db->execute()){
            return true;
           }else{
            return false;
           }
        }

        

    }