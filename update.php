<?php
session_start();
require_once('db.php');
if (isset($_SESSION['email'])) {
 $que = "SELECT firstName,lastName,ngaysinh FROM account WHERE email ='" . $_SESSION['email'] . "'";
 $re = mysqli_query($con,$que);
 $row = mysqli_fetch_array($re);
 $_SESSION['firstname']= $row['firstName']; 
 $_SESSION['lastname']= $row['lastName'];
 $_SESSION['ngaysinh'] = $row['ngaysinh'];
    if (isset($_POST['update'])) {
    $error = '';
    $first_name =$_POST['firstname'];
    $last_name =$_POST['lastname'];
    $date =$_POST['birthdate'];

    $bt_date= new Datetime($date);
    $y_btdate = $bt_date ->getTimestamp();
    $year_bt=date('Y',$y_btdate);
    
    $today = new Datetime();
    $td_now = $today ->getTimestamp();  
    $year_td=date('Y',$td_now);

    $cal=(int)$year_td-$year_bt;
        if(empty($first_name)||empty($last_name)){
            $error = 'Vui lòng nhập họ và tên';   
        }
        else if(is_numeric($first_name)||is_numeric($last_name)) {
            $error = 'Vui lòng nhập đúng tên';
        }
        // else if() {
        //     $error = 'Vui lòng nhập đúng tên';
        // }
        else if($date==null) {
            $error = 'Vui lòng nhập ngày sinh';
        }
        else if($cal < 0 || $cal > 100) {
            $error = 'Vui lòng nhập đúng ngày sinh';
        }
        else{
            $query = "UPDATE `account` SET firstName='$first_name', lastName='$last_name', ngaysinh='$date' WHERE email ='" . $_SESSION['email'] . "'";
            $result   = mysqli_query($con, $query);
            if($result){
                $_SESSION['firstName'] = $first_name;
                $_SESSION['lastName'] = $last_name;
                echo "<div class='alert alert-success'>Bạn đã cập nhật thông tin thành công</div>";
                header('Location: update.php');
            }
        } 
    }else{

    }
}else{
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật mật khẩu</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <!-- header -->
    <div class="header">
        <!-- logo -->
        <nav class="navbar navbar-expand-md bg-white navbar-light">
            <!-- Brand -->
            <a class="navbar-brand" href="home.php">
                <img src="images/logo.PNG" width="200" height="50" style="padding-left: 50px;">
            </a>
            
            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
            </button> 
        
            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item" id="games" style="padding-top: 8px">       
                        <a class="nav-link" href="games.php"> <img src="images/Game icon.png" style="width:50px"> Trò Chơi</a>
                    </li>
                    <li class="nav-item" id = "apps">
                        <a class="nav-link" href="apps.php"> <img src="images/android icon.png" style="width:50px">Ứng dụng</a>
                    </li>
                    <!-- <li class="nav-item" id ="users" style="padding-right: 20px;">
                        <a class="nav-link" href="login.php"> <img src="images/user icon.png" style="width:50px">Đăng nhập</a>
                    </li> -->
                    <?php 
                            if(isset($_SESSION['email'])){
                                  if(isset($_SESSION['firstname'])){
                                  echo("<li class='nav-item' id = 'users'>
                                  <a class='nav-link' id='users' href='update.php'> <img src='images/user icon.png' style='width:50px'>Xin chào $_SESSION[firstname]</a>
                                  </li>");               
                                  }
                                  else{
                                    echo("<li class='nav-item' id = 'users'>
                                    <a class='nav-link' id='users' href='update.php'> <img src='images/user icon.png' style='width:50px'>Xin chào</a>
                                    </li>"); 
                                  }
                            }else{
                              echo("<li class='nav-item' id = 'users'>
                                  <a class='nav-link' id='users' href='login.php'> <img src='images/user icon.png' style='width:50px'>Đăng nhập</a>
                                  </li>");       
                            }                        
                          ?>         
                </ul>
            </div>
        </nav> 
    </div>
    <div class="row" id="row-apps">
        <!-- hot free Games -->
       <div class="col-lg-10 title-item">
           <!-- title Apps hot -->
           <div class="title">
               <h2>Cập nhật thông tin cá nhân</h2>
           </div>
           <div class="form">
            <form method="post" action="update.php" class="border rounded w-100 mb-5 mx-auto px-3 pt-3 bg-light">
                <div class="form-group-name">
                  <label for="firstname">Nhập Họ của bạn:</label>
                  <?php
                    if(isset($_SESSION['firstname'])){
                      echo( "<input name='firstname' value='$_SESSION[firstname]' id='firstname' type='text' class='form-control' >");
                    }else{
                      echo( "<input name='firstname' value='' type='text' class='form-control' placeholder='Họ'>");
                    }
                  ?>
                </div>
                <div class="form-group-name">
                  <label for="lastname">Nhập Tên của bạn:</label>
                  <?php
                   if(isset($_SESSION['lastname'])){
                    echo( "<input name='lastname' value='$_SESSION[lastname]' id='lastname' type='text' class='form-control'>");
                    }else{
                    echo( "<input name='lastname' value='' type='text' class='form-control' placeholder='Tên'>");
                    }
                  ?>
                </div>
                <div class="form-group-name">
                    <label for="birthdate">Ngày sinh:</label>
                    <?php
                        if(isset($_SESSION['ngaysinh'])){
                        echo( "<input name='birthdate' value='$_SESSION[ngaysinh]' id='birthdate' type='date' class='form-control'>");
                        }else{
                        echo( "<input name='birthdate' value='' type='date' class='form-control'>");
                        }
                    ?>
                  </div>
                    <?php
                            if (!empty($error)) {
                                echo  "<div class='alert alert-danger'>$error</div>";
                            }              
                    ?>
                <div class="form-group">
                  <button name="update" type="submit" class="btn btn-success px-5">Cập nhật</button>
                </div>
              </form>
           </div>
           <div class="info-user">
                    <?php              
                        echo("<h>Tài khoản hiện tại: $_SESSION[money] VND</h>");
                    ?>
           </div>
           <div class="btn-gr" style="width: fit-content;margin: auto;">
                    <button type="button" class="btn btn-danger"><a href="logout.php" style="text-decoration:none;color:white">
                    Đăng xuất</button>                    
                    <button type="button" class="btn btn-warning" style="color:white"><a href="resetpass.php" style="text-decoration:none;color:white">
                    Đổi mật khẩu</button>        
                    <button type="button" class="btn btn-primary"><a href="recharge.php" style="text-decoration:none;color:white">
                        Nạp tiền</button>
                    <button type="button" class="btn btn-success"><a href="hisdeal.php" style="text-decoration:none;color:white;">
                        Lịch sử giao dịch</button>
            </div>
       </div>
    
    </div>
    <div class="footer">
        <p>
            Copyright by team D.A.T <br>
                    😘😘😘
        </p>
    </div>
</body>
</html>