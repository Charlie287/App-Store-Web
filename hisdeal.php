<?php
 session_start();
 require_once('db.php');
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
                        <!-- <li class="nav-item" id ="users" style="padding-right: 20px;"> -->
    
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
                        </li>
                    </ul>
                </div>
            </nav> 
      </div>
    <div class="table" style="width:fit-content; margin:auto;text-align:center;margin-bottom:100px">        
                        <h2 style="margin-top:100px;margin-bottom:50px">Lịch sử giao dịch</h2>
                        <?php
                            if (isset($_SESSION['email'])) {
                            $que = "SELECT ngayNap,menhgia FROM naptien WHERE user ='" . $_SESSION['email'] . "'";
                            $re = mysqli_query($con,$que);
                            $row = mysqli_fetch_array($re);
                            $date = $row['ngayNap'];
                            $money = $row['menhgia'];
                            $i = 0;
                            echo("<table style='width:100% ;border: solid 1px #black;'>
                                    <tr>
                                        <th>STT</th>
                                        <th>Ngày nạp</th>
                                        <th>Mệnh giá</th>
                                    </tr>");
                                while($row = mysqli_fetch_array($re)){
                                    $i++;
                                echo("<table style='width:100% border: solid 1px #black'>
                                    <tr>
                                        <td>$i</td>
                                        <td>$row[ngayNap]</td>
                                        <td>$row[menhgia]</td>
                                    </tr>
                                    </table>");
                                }
                                
                            }else{
                                header('Location: login.php');
                            }
            ?>
        </div>
    <div class="footer">
        <p>
            Copyright by team D.A.T <br>
                    😘😘😘
        </p>
    </div>
</body>
</html>