<?php
    require_once 'database.php';
    class User extends Database{

        public function InsertIntoUserTable($uname, $add, $num, $email, $pass, $pic, $target_dir, $target_file, $temp){
            $sql = "INSERT INTO login(email, password) VALUES ('$email','$pass')";

            if($this->conn->query($sql)){
                $id = mysqli_insert_id($this->conn);

                $sql = "INSERT INTO user(username, address, number, loginid, icon) VALUES ('$uname','$add', '$num', '$id', '$pic')";

                if($this->conn->query($sql)){
                    move_uploaded_file($temp,$target_file);
                    header("Location: ../UI/login.php");
                }else{
                    echo "Error in inserting to USER TABLE.".$this->conn->error;
                }
            }else{
                echo "Error in inserting to LOGIN TABLE.".$this->conn->error;
            }
        }

        public function login($email, $pass){
            $sql = "SELECT * FROM login INNER JOIN user ON login.loginid = user.loginid WHERE email = '$email' AND password = '$pass'";
            $result = $this->conn->query($sql);

            if($result->num_rows == 1){
               $row = $result->fetch_assoc();
               return $row;
            }else{
                echo "<script>javascript:history.go(-1)</script>";
            }
        }

        public function checkReview($userid, $movieid){
            $sql = "SELECT * FROM review WHERE user_id = $userid AND movie_id = $movieid";
            $result = $this->conn->query($sql);
            if($result->num_rows == 0){
                header("Location: ../UI/review.php?id=$movieid");
            }else{
                header("Location: ../UI/updateReview.php?id=$movieid");
            }
        }

        public function addReview($review, $score, $movieid, $userid){
            $sql = "INSERT INTO review(review_content, rating_number, movie_id, user_id) VALUES ('$review', '$score', '$movieid', '$userid')";
            if($this->conn->query($sql)){

                echo "<script>javascript:history.go(-2)</script>";
            }else{
                echo "Error in inserting to REVIEW TABLE.".$this->conn->error;
            }
        }

        public function updateReview($review, $score, $movieid, $userid){
            $sql ="UPDATE review 
            SET review_content = '$review',
                rating_number = '$score'
                WHERE user_id = $userid AND movie_id = $movieid";
                if($this->conn->query($sql)){
                    echo "<script>javascript:history.go(-2)</script>";
                }else{
                    echo "Error in updating to REVIEW TABLE.".$this->conn->error;
                }
            }

        public function addWishlist($userid, $movieid){
            $sql = "INSERT INTO wishlist(user_id, movie_id) VALUES ('$userid', '$movieid')";
            if($this->conn->query($sql)){
                echo "<script>javascript:history.go(-1)</script>";
            }else{
                echo "<script>javascript:history.go(-1)</script>";
            }
        }

        public function checkWishlist($userid, $movieid){
            $sql = "SELECT * FROM wishlist WHERE user_id = $userid AND movie_id = $movieid";
            $result = $this->conn->query($sql);
            if($result->num_rows == 0){
                header("Location: ../action/userAction.php?actiontype=wishlist&id=$movieid");
            } else{
                echo "<script>javascript:history.go(-1)</script>";
            }
        }

        public function displayWishlist($userid){
            $sql = "SELECT * FROM wishlist INNER JOIN movie ON wishlist.movie_id = movie.movie_id WHERE wishlist.user_id = '$userid'";
            $result = $this->conn->query($sql);
            if($result->num_rows >0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }else{
                return false;
            }
        }

        public function countMyAlreadyWatched($userid){
            $sql = "SELECT count(*) as total FROM review WHERE user_id = $userid";
            $result = $this->conn->query($sql);
            if($result){
                $row= $result->fetch_assoc();
                return $row['total'];
            }
        }

        public function countMyWishlist($userid){
            $sql = "SELECT count(*) as total FROM wishlist WHERE user_id = $userid";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                return $row['total'];
            }
        }

        public function countAllAlreadyWatched($movieid){
            $sql = "SELECT count(*) as total FROM review WHERE movie_id = $movieid";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
                $row= $result->fetch_assoc();
                return $row['total'];
            }
        }

        public function countAllWish($movieid){
            $sql = "SELECT count(*) as total FROM wishlist WHERE movie_id = $movieid";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
                $row= $result->fetch_assoc();
                return $row['total'];
            }
        }

        public function followUsers($userid, $targetid){
            if($userid != $targetid){
                $sql = "INSERT INTO follows(source_id,target_id) VALUES ('$userid', '$targetid')";
                if($this->conn->query($sql)){
                    echo "<script>javascript:history.go(-1)</script>";
                }
            }else{
                return false;
            }
        }

        public function unfollowUsers($userid, $targetid){
            $sql = "DELETE FROM follows WHERE source_id = $userid AND target_id = $targetid";
            if($this->conn->query($sql)){
                echo "<script>javascript:history.go(-1)</script>";
            }else{
                return false;
            }
        }


        public function displayFollowers($userid){
            $sql = "SELECT * FROM follows WHERE target_id = $userid";
            $result = $this->conn->query($sql);
            if($result->num_rows >= 0){
                return $result->num_rows;
            }
        }

        public function displayFollowing($userid){
            $sql = "SELECT * FROM follows WHERE source_id = $userid";
            $result = $this->conn->query($sql);
            if($result->num_rows >= 0){
                return $result->num_rows;
            }
        }

        public function userInfo($userid){
            $sql = "SELECT * FROM user INNER JOIN login ON login.loginid = user.loginid WHERE user_id = $userid";
            $result = $this->conn->query($sql);
            $rows = array();
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }
        }

        public function countReview($movieid){
            $sql = "SELECT count(*) as total FROM review WHERE movie_id = $movieid";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
                $row= $result->fetch_assoc();
                return $row['total'];
            }
        }

        public function countWishlist($movieid){
            $sql = "SELECT count(*) as total FROM wishlist WHERE movie_id = $movieid";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
                $row= $result->fetch_assoc();
                return $row['total'];
            }
        }

        public function checkFollow($userid, $othersid){
            $sql = "SELECT * FROM follows WHERE source_id = $userid AND target_id = $othersid";
            if($this->conn->query($sql)){
                $result = $this->conn->query($sql);
                if($result->num_rows > 0){
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function getSearchUserResult($keyword, $userid){
            $sql = "SELECT * FROM user WHERE username LIKE '%$keyword%' AND user_id != $userid";
            $result = $this->conn->query($sql);
            $rows = array();
            if($result->num_rows >0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }
        }

        public function getSearchReviewResult($keyword){
            $sql = "SELECT * FROM review INNER JOIN user ON review.user_id = user.user_id INNER JOIN movie ON review.movie_id = movie.movie_id 
            WHERE user.username LIKE '%$keyword%' OR movie.title LIKE '%$keyword%' OR movie.director LIKE '%$keyword%' OR movie.performer LIKE '%$keyword%'";
            $result = $this->conn->query($sql);
            $rows = array();
            if($result->num_rows >0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }else{
                return false;
            }
        }

        public function displayFollowersList($userid, $othersid){
            $sql = "SELECT * FROM follows WHERE source_id = $othersid AND target_id = $userid";
            $result = $this->conn->query($sql);
            $rows = array();
            if($result->num_rows >0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }
        }

        public function countFollowing($userid){
            $sql = "SELECT count(*) as total FROM follows WHERE source_id = $userid";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
                $row= $result->fetch_assoc();
                return $row['total'];
            }
        }

        public function countFollowers($userid){
            $sql = "SELECT count(*) as total FROM follows WHERE target_id = $userid";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
                $row= $result->fetch_assoc();
                return $row['total'];
            }
        }

        public function efitProfile($userid){
            $sql = "SELECT * FROM user WHERE user_id = $userid";
            $result = $conn->query($sql);
            $rows = array();
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
            }
            return $rows;
            }
        }

        public function updateUserTable($uname, $add, $num, $email, $pass, $pic, $target_dir, $target_file, $temp, $loginid){
            $sql ="UPDATE login SET email = '$email', password = '$pass' WHERE loginid = $loginid";
            if($this->conn->query($sql)){
                $sql = "UPDATE user SET username = '$uname', address = '$add', number = '$num', icon = '$pic' WHERE loginid = '$loginid'";
                if($this->conn->query($sql)){
                    move_uploaded_file($temp,$target_file);
                    header("Location: ../UI/mypage.php");
                }
            }
        }

        public function followerDisplay($userid){
            // $sql = "SELECT * FROM follows INNER JOIN user ON user.user_id = follows.user_id WHERE target_id = $userid";
            $sql = "SELECT * FROM user WHERE user_id IN (SELECT source_id FROM follows WHERE target_id= $userid)";
            $result = $this->conn->query($sql);
            $rows = array();
            if($result->num_rows >0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }else{
                return false;
            }
        }

        public function followingDisplay($userid){
            // $sql = "SELECT * FROM follows INNER JOIN user ON user.user_id = follows.user_id WHERE target_id = $userid";
            $sql = "SELECT * FROM user WHERE user_id IN (SELECT target_id FROM follows WHERE source_id= $userid)";
            $result = $this->conn->query($sql);
            $rows = array();
            if($result->num_rows >0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }else{
                return false;
            }
        }

        public function displayPopularUser($userid){
            $sql = "SELECT * FROM user";
            $result = $this->conn->query($sql);
            $rows = array();
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $userid = $row['user_id'];
                    // echo $userid;
                    $sql = "SELECT count(*) as total FROM follows WHERE target_id=$userid";
                    $result2 = $this->conn->query($sql);
                    $row2 = $result2->fetch_assoc();
                    $row['total'] = $row2['total'];
                    // array_push($row, $total);
                    $rows[] = $row;
                }
            }
            
            foreach($rows as $key => $row) {
                $new_array[$key] = $row['total'];
            }
            
            // array_multisort(array_name1, sorting_order, sorting_type, array_name2, array_name3...)
            array_multisort($new_array, SORT_DESC, $rows);
            
            $rows = array_slice($rows, 0, 4);

            return $rows;
        }

        public function adminDeleteUser($userid, $loginid){
            $sql = "DELETE FROM user WHERE user_id = $userid";
            if($this->conn->query($sql)){
                $sql = "DELETE FROM login WHERE loginid = $loginid";
                if($this->conn->query($sql)){
                    $sql = "DELETE FROM user WHERE user_id = $userid";
                    if($this->conn->query($sql)){
                        $sql = "DELETE FROM follows WHERE source_id = $userid OR target_id = $userid";
                        if($this->conn->query($sql)){
                            $sql = "DELETE FROM review WHERE user_id = $userid";
                            if($this->conn->query($sql)){
                                $sql = "DELETE FROM wishlist WHERE user_id = $userid";
                                if($this->conn->query($sql)){
                                    $sql = "DELETE FROM good WHERE user_id = $userid";
                                    if($this->conn->query($sql)){
                                        $sql = "DELETE FROM comment WHERE user_id = $userid";
                                        echo "<script>javascript:history.go(-1)</script>";
                                }
                            }
                        }
                    }
                    }

                }
            }
        }

        public function adminDisplayAllUser(){
            $sql = "SELECT * FROM user";
            $result = $this->conn->query($sql);
            $rows = array();
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }
        }

        public function getRandomMoviePicture($userid){
            $sql = "SELECT * FROM movie INNER JOIN review ON review.movie_id = movie.movie_id
            WHERE review.user_id = $userid ORDER BY RAND() LIMIT 3";
            $result = $this->conn->query($sql);
            $rows = array();
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                // print_r($rows);
                return $rows;
            } else {
                return false;
            }
        }

        public function deleteReview($movieid, $userid){
            $sql = "DELETE FROM review WHERE movie_id = $movieid AND user_id = $userid";
            if($this->conn->query($sql)){
                echo "<script>javascript:history.go(-2)</script>";
            }else{
                return false;
            }
        }

    }
    
?>
