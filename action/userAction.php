<?php
    session_start();
    require_once '../classes/userSQL.php';
    $user =new User;

    if(isset($_POST['register'])){
        $uname = $_POST['username'];
        $add = $_POST['address'];
        $num = $_POST['number'];
        $email = $_POST['email'];
        $pass = md5($_POST['pass']);
        $pic = $_FILES['pic']['name'];
        $loginid = $_SESSION['loginid'];

        $target_dir = "../img/portfolio/";
        $target_file = $target_dir.basename($_FILES['pic']['name']);
        $temp = $_FILES['pic']['tmp_name'];

        $user->InsertIntoUserTable($uname, $add, $num, $email, $pass, $pic, $target_dir, $target_file, $temp);

    }elseif(isset($_POST['login'])){
        $email = $_POST['email'];
        $pass = md5($_POST['pass']);

        $row = $user->login($email, $pass);

        if($row){
            $_SESSION['loginid'] = $row['loginid'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['pic'] = $row['pic'];
            $_SESSION['status'] = $row['status'];
            if($row['status'] == 'A'){
            header("Location: ../UI/adminEditTimeline.php");
            }else{
                header("Location: ../UI/index.php");
            }
        }else{
            echo "Email and Password are not found";
        }
    }elseif(isset($_GET['actiontype'])){
        if($_GET['actiontype'] == 'check'){
            $movieid = $_GET['id'];
            $userid = $_SESSION['user_id'];
    
            $user->checkReview($userid, $movieid);
        }elseif($_GET['actiontype'] == 'checkwishlist'){
            $movieid = $_GET['id'];
            $userid = $_SESSION['user_id'];
    
            $user->checkWishlist($userid, $movieid);
    
        }elseif($_GET['actiontype'] == 'wishlist'){
            $movieid = $_GET['id'];
            $userid = $_SESSION['user_id'];
    
            $user->addWishlist($userid, $movieid);
    
        }elseif($_GET['actiontype'] == 'follow'){
            $userid = $_SESSION['user_id'];
            $targetid = $_GET['id'];
    
            $user->followUsers($userid, $targetid);
    
        }elseif($_GET['actiontype'] == 'unfollow'){
            $userid = $_SESSION['user_id'];
            $targetid = $_GET['id'];
    
            $user->unfollowUsers($userid, $targetid);
    
        }elseif($_GET['actiontype'] == 'deleteUser'){
            $userid = $_GET['userid'];
            $loginid = $_GET['loginid'];
    
            $user->adminDeleteUser($userid, $loginid);
        }

    }elseif(isset($_POST['review'])){
        $score = $_POST['score'];
        $review = $_POST['reviewcontent'];
        $movieid = $_POST['movieid'];
        $userid = $_SESSION['user_id'];

        $user->addReview($review, $score, $movieid, $userid);

    }elseif(isset($_POST['update'])){
        $score = $_POST['score'];
        $review = $_POST['reviewcontent'];
        $movieid = $_POST['movieid'];
        $userid = $_SESSION['user_id'];

        $user->updateReview($review, $score, $movieid, $userid);

    }elseif(isset($_POST['deleteReview'])){
        $movieid = $_POST['movieid'];
        $userid = $_SESSION['user_id'];

        $user->deleteReview($movieid, $userid);

    }elseif(isset($_POST['searchName'])){
        $keyword = $_POST['result'];

        header("Location: ../UI/searchResultUI.php?keyword=$keyword&type=user");

    }elseif(isset($_POST['adminSearchName'])){
        $keyword = $_POST['result'];

        header("Location: ../UI/adminSearchResult.php?keyword=$keyword&type=user");

    }elseif(isset($_POST['searchReview'])){
        $keyword = $_POST['keyword'];

        header("Location: ../UI/searchResultUI.php?keyword=$keyword&type=timeline");

    }elseif(isset($_POST['adminSearchReview'])){
            $keyword = $_POST['keyword'];
    
            header("Location: ../UI/adminSearchResult.php?keyword=$keyword&type=timeline");
    
        }elseif(isset($_POST['updateProfile'])){
        $uname = $_POST['username'];
        $add = $_POST['address'];
        $num = $_POST['number'];
        $email = $_POST['email'];
        $pass = md5($_POST['pass']);
        $pic = $_FILES['pic']['name'];
        $loginid = $_SESSION['loginid'];

        $target_dir = "../img/portfolio/";
        $target_file = $target_dir.basename($_FILES['pic']['name']);
        $temp = $_FILES['pic']['tmp_name'];

        $user->updateUserTable($uname, $add, $num, $email, $pass, $pic, $target_dir, $target_file, $temp, $loginid);

        }
?>