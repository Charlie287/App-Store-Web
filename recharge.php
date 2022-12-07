<?php
session_start();
require_once('db.php');
if (isset($_SESSION['email'])) {
    $query = "SELECT * FROM account WHERE email ='" . $_SESSION['email']."'";
    $result = mysqli_query($con,$query);
    $row = mysqli_fetch_array($result);
    $email = $_SESSION['email'];
    $pass = $row['password'];
    $token = $row['activate_token'];
    $mon_st = $row['money'];
    if (isset($_POST['recharge'])){
        $password = $_POST['password'];
        $mon =$_POST['mon'];
        $pass_hash = md5($password .'+'. $token);
        $today = new Datetime();
        $td_now = $today ->getTimestamp();  
        $year_td=date('Y-m-d',$td_now);
        if($pass != $pass_hash){
            $error='Mật khẩu hiện tại không đúng!';
        }else if($password==''||$mon==''){
            $error='Vui lòng điền đầy đủ thông tin';
        }
        else{
            $money = $mon_st + $mon;
            $query    ="INSERT INTO `naptien`(`ngayNap`, `menhgia`, `user`) VALUES ('$year_td', '$mon', '" . $_SESSION['email']."')";
            $query2   ="UPDATE `account` SET `money`= '$money' WHERE email ='". $_SESSION['email']."' ";
            $result = mysqli_query($con,$query);
            $result2 = mysqli_query($con,$query2);
            if ($result) {
                $_SESSION['money'] = $money;
                echo "<div class='alert alert-success'>Bạn đã nạp tiền thành công</div>";
                sleep(2);
                header('Location: update.php');
            }  
        }
    }  
   }else
   {
       header('Location: login.php');
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nạp tiền</title>
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
                                  if(isset($_SESSION['firstName'])){
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
               <h2>Giao dịch</h2>
           </div>
           <div class="form">
            <form method="post" action="recharge.php" class="border rounded w-100 mb-5 mx-auto px-3 pt-3 bg-light">
                <div class="form-group-name">          
                <label for="mon">Chọn mệnh giá</label>
                <select id="mon" name = "mon" class="form-control" style="width:12%; margin-left: 155px;background: #f1f1f1;">
                        <option value="10000">10000 VND</option>            
                        <option value="20000">20000 VND</option> 
                        <option value="50000">50000 VND</option>
                        <option value="100000">100000 VND</option>
                        <option value="200000">200000 VND</option>   
                        <option value="500000">500000 VND</option>
                </select>
                </div>
                <div class="form-group-name">
                  <label for="password">Nhập mật khẩu:</label>
                  <input name='password' id='password' type='password' class='form-control'>
                </div>
                    <?php
                            if (!empty($error)) {
                                echo  "<div class='alert alert-danger'>$error</div>";
                            }              
                    ?>
                <div class="form-group">
                  <button name="recharge" type="submit" class="btn btn-success px-5">Thanh Toán</button>
                </div>
              </form>
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