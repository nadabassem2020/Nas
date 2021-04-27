<?php

  $profile="";
  $pageTitle = "NIL - Profile";
  include 'init.php' ;
  session_start();
  if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit();
  }

  $owner=$_SESSION['username'];
  $stmt=$con->prepare("SELECT shares FROM account WHERE username = '$owner'");
  $stmt->execute();
  $arr=$stmt->fetch();
  include $tp1.'header.php';
?>

  <!-- Start Home -->
  <div class="profile">
    <div class="container">
      <!-- Start Body -->
      <div class="content">
        <div class="head text-center">
          <h2 class="h1">Your Profile</h2>
        </div>
        <?php include 'true.php'; ?>
        <div class="user-posts head">
            <h2>Posts</h2>
            <div class="inner">
            <div class="row">
              <?php
                $ids = explode(" ", $arr['shares']);
                for ($i=0; $i < sizeof($ids); $i++) {
                  if(strlen($arr['shares'])==0){
                    break;
                  }
                  $postID=$ids[$i];
                  $stmt=$con->prepare("SELECT * FROM post WHERE postID = '$postID'");
                  $stmt->execute();
                  $row=$stmt->fetch();
                  echo'
                  <div class="col-md-12">
                    <div class="user-post">
                      <div class="item">
                        <div class="image">
                          <img src="'.$design.'/images/items/'.$row['photoPath'].'" alt="">
                        </div>
                        <div class="text">
                          <h5 class="name">Name: '.$row['name'].'</h5>
                          <h5 class="date">Date: '.$row['date'].'</h5>
                          <h5 class="desc">Description: '.$row['description'].'</h5>
                        </div>
                      </div>
                    </div>
                  </div>
                  ';
                }
               ?>
               <div class="match head text-center col-md-12">
                 <h2 class="h1">You Don't Have Any Posts</h2>
               </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Body -->
  </div>
  <!-- End Home -->

<?php include $tp1.'/footer.php'; ?>
