<?php
    session_start();
    require_once '../classes/movieSQL.php';
    $movie = new Movie;

    if(isset($_POST['add'])){
        $title = $_POST['title'];
        $category = $_POST['category'];
        $country = $_POST['country'];
        $date = $_POST['date'];
        $summary = $_POST['summary'];
        $performer = $_POST['performer'];
        $director = $_POST['director'];
        $pic = $_FILES['pic']['name'];
        $userid = $_SESSION['user_id'];

        $target_dir = "../img/portfolio/";
        $target_file = $target_dir.basename($_FILES['pic']['name']);
        $temp = $_FILES['pic']['tmp_name'];

        $movie->addMovie($title, $category, $country, $date, $summary, $performer, $director, $pic, $target_dir, $target_file, $temp, $userid);

    }elseif(isset($_POST['search'])){
        $result = $_POST['result'];

        header("Location: ../UI/searchResultUI.php?keyword=$result&type=movies");

    }elseif(isset($_POST['addCategory'])){
        $category = $_POST['category'];
        $pic = $_FILES['pic']['name'];
        $target_dir = "../img/portfolio/";
        $target_file = $target_dir.basename($_FILES['pic']['name']);
        $temp = $_FILES['pic']['tmp_name'];
        $movie->addCategory($category, $pic, $target_dir, $target_file, $temp);

    }elseif(isset($_POST['send'])){
        $comment = $_POST['comment'];
        $movieid = $_POST['movieid'];
        $reviewid = $_POST['reviewid'];
        $userid = $_POST['userid'];

        $movie->sendComment($comment, $movieid, $reviewid, $userid);
    }elseif(isset($_GET['type'])){
        if($_GET['type'] == 'ungood'){
        $movieid = $_GET['movieid'];
        $reviewid = $_GET['reviewid'];
        $userid = $_GET['userid'];

        $movie->ungood($reviewid, $userid, $movieid);
        }elseif($_GET['type'] == 'good'){
            $movieid = $_GET['movieid'];
            $reviewid = $_GET['reviewid'];
            $userid = $_GET['userid'];
    
            $movie->good($reviewid, $userid, $movieid);
        }
    }elseif(isset($_POST['searchLatest'])){
        $keyword = $_POST['keyword'];

        header("Location: ../UI/searchResultUI.php?keyword=$keyword&type=latest");
    }elseif(isset($_GET['actiontype'])){
        if($_GET['actiontype'] == 'delete'){
            $movieid = $_GET['id'];
            $userid = $_SESSION['user_id'];
    
            $movie->deleteWishlist($movieid, $userid);
        }elseif($_GET['actiontype'] == 'deleteReview'){
                $reviewid = $_GET['id'];
        
                $movie->deleteReview($reviewid);
            }elseif($_GET['actiontype'] == 'deleteComment'){
                $commentid = $_GET['id'];

                $movie->deleteComment($commentid);
            }elseif($_GET['actiontype'] == 'detail'){
            $movieid = $_GET['id'];
    
            header("Location: ../UI/movieDetail.php?id=$movieid");
            }elseif($_GET['actiontype'] == 'adminMovieDetail'){
                $movieid = $_GET['id'];

            header("Location: ../UI/adminMovieDetail.php?id=$movieid");
        }
    }

?>