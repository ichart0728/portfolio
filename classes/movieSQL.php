<?php
require_once 'database.php';
class Movie extends Database{

        public function addMovie($title, $category, $country, $date, $summary, $performer, $director, $pic, $target_dir, $target_file, $temp, $userid){
            $sql = "INSERT INTO movie(title, category_id, country, playdate, summary, performer, director, picture, user_id) 
            VALUES ('$title', '$category', '$country', '$date', '$summary', '$performer', '$director', '$pic', '$userid')";
            if($this->conn->query($sql)){
                move_uploaded_file($temp,$target_file);
                header("Location: ../UI/adminAddMovie.php");
            }else{
                echo "Error in inserting to ITEM TABLE.".$this->conn->error;
                }
            }

        public function addCategory($category, $pic, $target_dir, $target_file, $temp){
            $sql = "INSERT INTO category(category_name, category_pic) VALUES ('$category'', '$pic')";
            if($this->conn->query($sql)){
                move_uploaded_file($temp,$target_file);
                header("Location: ../UI/adminAddCategory.php");
            }else{
                echo "Error";$this->conn->error;
            }
        }

        public function displayMovies(){
            $sql = "SELECT * FROM movie INNER JOIN category ON movie.category_id = category.category_id ORDER BY date_added DESC LIMIT 5";
            $result = $this->conn->query($sql);
            $rows = array();
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }
        }

        public function displayMoviesAdmin(){
            $sql = "SELECT * FROM movie INNER JOIN category ON movie.category_id = category.category_id ORDER BY date_added";
            $result = $this->conn->query($sql);
            $rows = array();
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }
        }

        public function displayMoviesDetail($movieid){
            $sql = "SELECT * FROM movie INNER JOIN category ON movie.category_id = category.category_id WHERE movie.movie_id = $movieid";
            $result = $this->conn->query($sql);
            $rows = array();
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }
        }

        public function displayCategoryMovies($category){
            $sql = "SELECT * FROM movie WHERE movie.category_id IN (SELECT category_id FROM category WHERE category_name = '$category')";
            $result = $this->conn->query($sql);
            $rows = array();
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }
        }

        public function displayAllreview($userid){
            $sql = "SELECT * FROM review INNER JOIN movie ON movie.movie_id = review.movie_id 
            INNER JOIN user ON review.user_id = user.user_id INNER JOIN category ON movie.category_id = category.category_id 
            WHERE review.user_id IN (SELECT target_id FROM follows WHERE source_id= $userid) ORDER BY review.review_date DESC";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }else{
                return false;
            }
        }

        public function adminDisplayAllreview(){
            $sql = "SELECT * FROM review INNER JOIN movie ON movie.movie_id = review.movie_id 
            INNER JOIN user ON review.user_id = user.user_id INNER JOIN category ON movie.category_id = category.category_id";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }
        }

        public function displayMyLike($userid){
            $sql = "SELECT * FROM review INNER JOIN movie ON movie.movie_id = review.movie_id 
            INNER JOIN user ON review.user_id = user.user_id 
            WHERE review.review_id IN (SELECT review_id FROM good WHERE user_id = $userid)";
            $result = $this->conn->query($sql);
            $rows = array();
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }else{
                return false;
            }
        }

        public function displayMyReview($userid){
            $sql = "SELECT * FROM review INNER JOIN movie ON review.movie_id = movie.movie_id 
            INNER JOIN category ON movie.category_id = category.category_id WHERE review.user_id = '$userid' ORDER BY review_date DESC";
            $result = $this->conn->query($sql);
            $rows = array();
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }else{
                return false;
            }
        }

        public function displayComment($reviewid){
            $sql = "SELECT * FROM comment INNER JOIN movie ON comment.movie_id = movie.movie_id 
            INNER JOIN review ON review.review_id = comment.review_id 
            INNER JOIN user ON comment.user_id = user.user_id WHERE comment.review_id = $reviewid";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }else{
                false;
            }
        }

        public function displaySpecificReview($reviewid){
            $sql = "SELECT * FROM review INNER JOIN movie ON movie.movie_id = review.movie_id 
            INNER JOIN user ON review.user_id = user.user_id WHERE review.review_id = $reviewid";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }
        }

        public function getSearchResult($keyword){
            $sql = "SELECT * FROM movie INNER JOIN category ON movie.category_id = category.category_id WHERE title LIKE '%$keyword%' OR performer LIKE '%$keyword%' OR director LIKE '%$keyword%'";
            $result = $this->conn->query($sql);
            $rows = array();
            if($result->num_rows >0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }
        }

        public function displayCategory(){
            $sql = "SELECT * FROM category";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
                $rows = array();
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }else{
                return "Error";
            }
        }

        public function reviewAvg($movieid){
            $sql = "SELECT AVG(rating_number) as average FROM review WHERE movie_id = $movieid";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
                $row= $result->fetch_assoc();
                return number_format($row['average'], 1);
            }
        }

        public function sendComment($comment, $movieid, $reviewid, $userid){
            $sql = "INSERT INTO comment(comment, user_id, movie_id, review_id) VALUES ('$comment', '$userid', '$movieid', '$reviewid')";
            if($this->conn->query($sql)){
                echo "<script>javascript:history.go(-1)</script>";
            }else{
                false;
            }
        }

        // public function good($movieid, $reviewid, $others){
        //     $sql = "INSERT INTO good(review_id, user_id, movie_id) VALUES ('$reviewid', '$others', '$movieid')";
        //     if($this->conn->query($sql)){
        //         $sql = "SELECT count(*) as total FROM good WHERE review_id = $reviewid";
        //         if($this->conn->query($sql)){
        //             if($result->num_rows > 0){
        //                 $row= $result->fetch_assoc();
        //                 return $row['total'];
        //             }
        //         }
        //         header("Location: ../UI/timeline.php");
        //     }else{
        //         echo $this->conn->error;
        //     }
        // }

        public function good($reviewid, $userid, $movieid){
                $sql = "INSERT INTO good(review_id, user_id, movie_id) VALUES ('$reviewid', '$userid', '$movieid')";
                if($this->conn->query($sql)){
                    echo "<script>javascript:history.go(-1)</script>";
                }else{
                    echo $this->conn->error;
                }
            }

        public function goodCount($reviewid){
            $sql = "SELECT count(*) as total FROM good WHERE review_id = $reviewid";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                return $row['total'];
            }
        }

        public function countComment($reviewid){
            $sql = "SELECT count(*) AS total FROM comment WHERE review_id = $reviewid";
            $result = $this->conn->query($sql);
            if($result->num_rows == 1){
                $row= $result->fetch_assoc();
                return $row['total'];
            }
        }

        public function myGoodCount($userid){
            $sql = "SELECT count(*) as total FROM good WHERE user_id = $userid";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
                $row= $result->fetch_assoc();
                return $row['total'];
            }
        }

        public function checkGood($reviewid, $userid){
            $sql = "SELECT * FROM good WHERE review_id = $reviewid AND user_id = $userid";
            if($this->conn->query($sql)){
                $result = $this->conn->query($sql);
                if($result->num_rows > 0){
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function ungood($reviewid, $userid, $movieid){
            $sql = "DELETE FROM good WHERE review_id = $reviewid AND user_id = $userid";
            if($this->conn->query($sql)){
                echo "<script>javascript:history.go(-1)</script>";
            }else{
                echo $this->conn->error;
            }
        }

        public function category(){
            $sql = "SELECT * FROM category";
            $result = $this->conn->query($sql);
            if($result->num_rows){
                $row = $result->fetch_assoc();
                $rows = $row;
            }
            return $rows;
        }

        public function getReviewid($movieid){
            $sql = "SELECT review_id FROM review WHERE movie_id = $movieid";
            $result = $this->conn->query($sql);
            $rows = array();
            while($row = $result->fetch_assoc()){
                $rows[] = $row;
            }
            return $rows;
        }

        public function checkReview($userid, $movieid){
            $sql = "SELECT * FROM review WHERE user_id = $userid AND movie_id = $movieid";
            if($this->conn->query($sql)){
                $result = $this->conn->query($sql);
                if($result->num_rows > 0){
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function checkWish($userid, $movieid){
            $sql = "SELECT * FROM wishlist WHERE user_id = $userid AND movie_id = $movieid";
            if($this->conn->query($sql)){
                $result = $this->conn->query($sql);
                if($result->num_rows > 0){
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function deleteWishlist($movieid, $userid){
            $sql = "DELETE FROM wishlist WHERE movie_id = $movieid AND user_id = $userid";
            if($this->conn->query($sql)){
                echo "<script>javascript:history.go(-1)</script>";
            }
        }

        public function deleteReview($reviewid){
            $sql = "DELETE FROM review WHERE review_id = $reviewid";
            if($this->conn->query($sql)){
                $sql = "DELETE FROM good WHERE review_id = $reviewid";
                if($this->conn->query($sql)){
                    $sql = "DELETE FROM comment WHERE review_id = $reviewid";
                if($this->conn->query($sql)){
                    echo "<script>javascript:history.go(-1)</script>";
                }
                }
            }
        }

        public function deleteComment($commentid){
            $sql = "DELETE FROM comment WHERE comment_id = $commentid";
            if($this->conn->query($sql)){
                echo "<script>javascript:history.go(-1)</script>";
            }else{
                return false;
            }
        }

        public function displayAllUsersRating($movieid){
            $sql = "SELECT * FROM review INNER JOIN movie ON movie.movie_id = review.movie_id INNER JOIN user ON review.user_id = user.user_id WHERE movie.movie_id = $movieid";
            $rows = array();
            if($result = $this->conn->query($sql)){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }
        }

    }
?>