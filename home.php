<?php
$con = mysqli_connect("localhost","root","","play");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trang chủ</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
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
      <!-- main -->
      <div class="main">
          <div class="row" id="row-banner">
              <!-- Banner -->
              <div class="col-lg-8 title-item">
                  <div id="demo" class="carousel slide" data-ride="carousel" style="height:100%">
                      <!-- Indicators -->
                      <!-- <ul class="carousel-indicators">
                        <li data-target="#demo" data-slide-to="0" class="active"></li>
                        <li data-target="#demo" data-slide-to="1"></li>
                        <li data-target="#demo" data-slide-to="2"></li>
                        <li data-target="#demo" data-slide-to="3"></li>
                      </ul> -->
                      <!-- The slideshow -->
                      <div class="carousel-inner" style="height:100%">
                        <div class="carousel-item active" style="height:100%">
                          <img src="images/banner1.png" alt="Banner 1">
                        </div>
                        <div class="carousel-item" style="height:100%">
                          <img src="images/banner2.jpg" alt="Banner 2">
                        </div>
                        <div class="carousel-item" style="height:100%">
                          <img src="images/banner3.png" alt="Banner 3">
                        </div>
                        <div class="carousel-item" style="height:100%">
                          <img src="images/banner4.png" alt="Banner 4">
                        </div>
                      </div>
                  </div>
              </div>
              <!-- Search -->
              <div class="col-lg-3 title-item">
                  <div class="search">
                  <form action="search.php" method="GET" class="form-inline">
                    <h style="color: rgb(33, 202, 33); font-weight: bold; font-size:18px ; margin-bottom:8px">Bạn Cần Tìm Gì?</h>
                    <input class="form-control mr-sm-2" type="text" id="search" name="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" id="key" name="key" type="submit">Search</button>
                  </form>
                  </div>
                  <!-- hot keys -->
                  <div class="hot">
                      <a href="apps.php">Facebook</a>
                      <a href="apps.php">Messenger</a>
                      <a href="games.php">Brain Out</a>
                      <a href="games.php">Quizizz</a>
                      <a href="games.php">Clash of Clans</a>
                      <a href="apps.php">Camera 360</a>
                  </div>
                  <!-- banner QC -->
                  <div class="bannerQC" id="bannerQC">
                    <div class="flip-card">
                      <div class="flip-card-inner">
                        <div class="flip-card-front">
                          <img src="images/bannerQC.png" alt="Shopee">
                        </div>
                        <div class="flip-card-back">
                          <!-- <img src="images/bannerQC2.jpg" alt="Shopee2"> -->
                          <a href="https://shopee.vn"><img src="images/bannerQC2.jpg" alt="Shopee2"></a>
                        </div>
                      </div>
                    </div> 
                  </div>
              </div>
          </div>
           <!-- clear  -->
          <!-- <div class="clear"></div> -->
          <div class="row" id="row-apps">
             <!-- hot free Games -->
            <div class="col-lg-8 title-item">
                <!-- title Apps hot -->
                <div class="title">
                    <a href="">Hot Free Games >></a>
                </div>
                <!-- Apps hot list -->
                <div class="list-App">
                <?php
                $query = "SELECT * FROM game WHERE priceGame ='Free' ORDER BY soLuotXemGame DESC LIMIT 8";
                $result = mysqli_query($con,$query);
              
                    while($row = mysqli_fetch_array($result))
                    {?> 
                        
                        <!-- Apps hot list -->
                          
                                <div class="card">
                                    <img src="images/<?=$row['imageGame']?>" alt="<?=$row['imageGame']?>" >
                                    <h> <?=$row['nameGame']?> </h>  
                                    <p class="price"><?=$row['priceGame']?></p>
                                    <div class="card-star">
                                      <?php
                                        for($i=1;$i<=$row['starRate'];$i++){
                                          echo "<span class='fa fa-star checked'></span>";
                                        }
                                      ?>
                                    </div>
                                    <div class="btn">
                                        <div class="btn-view">
                                            <button type="button" data-toggle="modal" data-target="#<?=$row['idGame']?>">Xem chi tiết</button>
                                            <!-- The Modal -->
                                            <div class="modal fade" id="<?=$row['idGame']?>">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                      <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">  
                                                                <h5 class="modal-title">Thông tin ứng dụng</h5>
                                                                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <div class="modal-body-image">
                                                                  <img src="images/<?=$row['imageGame']?>" alt="<?=$row['imageGame']?>">
                                                                </div>
                                                                <div class="modal-body-title">
                                                                  <h1><?=$row['nameGame']?></h1>
                                                                </div>
                                                                <div class="modal-body-product">
                                                                  <span><?=$row['maNSXGame']?></span>
                                                                </div>
                                                                <div class="modal-body-star">
                                                                <?php
                                                                for($i=1;$i<=$row['starRate'];$i++){
                                                                  echo "<span class='fa fa-star checked'></span>";
                                                                }
                                                                  ?>
                                                                </div>
                                                                <div class="modal-body-fee">
                                                                  <h5>Giá: <?=$row['priceGame']?></h5>
                                                                </div>
                                                                <div class="modal-body-view">
                                                                  <span><i class="fas fa-eye"></i> <?=$row['soLuotXemGame'] ?></span>
                                                                  <span><i class="fa fa-download"></i> <?=$row['soNguoiTaiGame'] ?></span>
                                                                </div>
                                                                <div class="modal-body-download">
                                                                <a href="#"><button><i class="fa fa-download" aria-hidden="true"></i>Tải xuống</button></a>
                                                                </div>
                                                                <hr>
                                                                <div class="modal-body-des">
                                                                  <h5>Mô tả từ nhà sản xuất:</h5>
                                                                      <button type="button" data-toggle="collapse" data-target="#a<?=$row['idGame']?>">Bấm để đọc mô tả</button>
                                                                      <div id="a<?=$row['idGame']?>" class="collapse">
                                                                        <span><?=$row['descriptionGame']?></span>
                                                                      </div>
                                                                </div>
                                                                 
                                                            </div>
                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                                                            </div>
                                                      </div>
                                                </div>
                                            </div>
                                        </div>
                                      <?php
                                        if(!isset($_SESSION['email'])){
                                            echo("<div class='btn-download'>
                                            <a href='login.php'><button><i class='fa fa-download' aria-hidden='true'></i></button></a>
                                            </div>");
                                        }else{
                                                if($row['priceGame']=='Free'){
                                                  echo("<div class='btn-download'>
                                                  <a href='download.php'><button><i class='fa fa-download' aria-hidden='true'></i></button></a>
                                                  </div>");
                                                }else{
                                                    if($row['priceGame']<=$row2['money']){
                                                      echo("<div class='btn-download'>
                                                      <a href='download.php'><button><i class='fa fa-download' aria-hidden='true'></i></button></a>
                                                      </div>");
                                                    }else{
                                                      echo("<div class='btn-download'>
                                                      <a href='recharge.php'><button><i class='fa fa-download' aria-hidden='true'></i></button></a>
                                                      </div>");
                                                    }
                                                }
                                        }
                                      ?>                                                                
                                      </div>
                                </div>
                    <?php
                    }
                ?>
               </div>
            </div>
            <!-- hot fee Games      -->
            <div class="col-lg-3 title-item">
              <div class="title">
                <a href="">Top Games trả phí</a>
              </div>
              <?php
                $query = "SELECT * FROM game WHERE priceGame !='Free' ORDER BY soNguoiTaiGame DESC LIMIT 6";
                $result = mysqli_query($con,$query);
                
                    while($row = mysqli_fetch_array($result))
                    {?> 
                      <div class="new-apps">
                        <div class="flip-card">
                          <div class="flip-card-inner">
                            <div class="flip-card-front">
                            <img src="images/<?=$row['imageGame']?>" alt="<?=$row['imageGame']?>">
                            </div>
                            <div class="flip-card-back">
                            <h><?=$row['nameGame']?></h>
                            <p class="price"><?=$row['priceGame']?></p>
                            <div class="card-star">
                                      <?php
                                        for($i=1;$i<=$row['starRate'];$i++){
                                          echo "<span class='fa fa-star checked'></span>";
                                        }
                                      ?>
                            </div>
                            <div class="btn-view2">
                                            <button type="button" data-toggle="modal" data-target="#a<?=$row['idGame']?>">Xem chi tiết</button>
                                            <!-- The Modal -->
                                            <div class="modal fade" id="a<?=$row['idGame']?>">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                      <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">  
                                                                <h5 class="modal-title">Thông tin ứng dụng</h5>
                                                                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <div class="modal-body-image">
                                                                  <img src="images/<?=$row['imageGame']?>" alt="<?=$row['imageGame']?>">
                                                                </div>
                                                                <div class="modal-body-title">
                                                                  <h1><?=$row['nameGame']?></h1>
                                                                </div>
                                                                <div class="modal-body-product">
                                                                  <span><?=$row['maNSXGame']?></span>
                                                                </div>
                                                                <div class="modal-body-star">
                                                                <?php
                                                                  for($i=1;$i<=$row['starRate'];$i++){
                                                                    echo "<span class='fa fa-star checked'></span>";
                                                                  }
                                                                ?>
                                                                </div>
                                                                <div class="modal-body-fee">
                                                                  <h5>Giá: <?=$row['priceGame']?></h5>
                                                                </div>
                                                                <div class="modal-body-view">
                                                                  <span><i class="fas fa-eye"></i> <?=$row['soLuotXemGame'] ?></span>
                                                                  <span><i class="fa fa-download"></i> <?=$row['soNguoiTaiGame'] ?></span>
                                                                </div>
                                                                <hr>
                                                                <div class="modal-body-des">
                                                                  <h5>Mô tả từ nhà sản xuất:</h5>
                                                                      <button type="button" data-toggle="collapse" data-target="#a<?=$row['idGame']?>">Bấm để đọc mô tả</button>
                                                                      <div id="a<?=$row['idGame']?>" class="collapse">
                                                                      </div>
                                                                </div> 
                                                            </div>
                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                                                            </div>
                                                      </div>
                                                </div>
                                            </div>
                                        </div>
          
                            </div>
              
                          </div>
                        </div>           
                      </div>
              <?php
                    }
                ?>
            
            </div>
            <!-- hot free apps -->
            <div class="col-lg-8 title-item">
                <!-- title apps hot -->
                <div class="title">
                    <a href="">Hot Free Apps >></a>
                </div>
                <!-- apps hot list -->
                <div class="list-App">
                <?php
                $query = "SELECT * FROM app WHERE priceApp ='Free' ORDER BY soLuotXemApp DESC LIMIT 8";
                $result = mysqli_query($con,$query);
                
                    while($row = mysqli_fetch_array($result))
                    {?> 
                        
                        <!-- Apps hot list -->
                          
                                <div class="card">
                                    <img src="images/<?=$row['imageApp']?>" alt="<?=$row['imageApp']?>" >
                                    <h> <?=$row['nameApp']?> </h>  
                                    <p class="price"><?=$row['priceApp']?></p>
                                    <div class="card-star">
                                      <?php
                                        for($i=1;$i<=$row['starRate'];$i++){
                                          echo "<span class='fa fa-star checked'></span>";
                                        }
                                      ?>
                                    </div>
                                    <div class="btn">
                                        <div class="btn-view">
                                            <button type="button" data-toggle="modal" data-target="#<?=$row['idApp']?>">Xem chi tiết</button>
                                            <!-- The Modal -->
                                            <div class="modal fade" id="<?=$row['idApp']?>">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                      <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">  
                                                                <h5 class="modal-title">Thông tin ứng dụng</h5>
                                                                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <div class="modal-body-image">
                                                                  <img src="images/<?=$row['imageApp']?>" alt="<?=$row['imageApp']?>">
                                                                </div>
                                                                <div class="modal-body-title">
                                                                  <h1><?=$row['nameApp']?></h1>
                                                                </div>
                                                                <div class="modal-body-product">
                                                                  <span><?=$row['maNSXApp']?></span>
                                                                </div>
                                                                <div class="modal-body-star">
                                                                  <span class="fa fa-star checked"></span>
                                                                  <span class="fa fa-star checked"></span>
                                                                  <span class="fa fa-star checked"></span>
                                                                  <span class="fa fa-star checked"></span>
                                                                  <span class="fa fa-star "></span>
                                                                </div>
                                                                <div class="modal-body-fee">
                                                                  <h5>Giá: <?=$row['priceApp']?></h5>
                                                                </div>
                                                                <div class="modal-body-view">
                                                                  <span><i class="fas fa-eye"></i> <?=$row['soLuotXemApp'] ?></span>
                                                                  <span><i class="fa fa-download"></i> <?=$row['soNguoiTaiApp'] ?></span>
                                                                </div>
                                                                <div class="modal-body-download">
                                                                <a href="#"><button><i class="fa fa-download" aria-hidden="true"></i>Tải xuống</button></a>
                                                                </div>
                                                                <hr>
                                                                <div class="modal-body-des">
                                                                  <h5>Mô tả từ nhà sản xuất:</h5>
                                                                      <button type="button" data-toggle="collapse" data-target="#a<?=$row['idApp']?>">Bấm để đọc mô tả</button>
                                                                      <div id="a<?=$row['idApp']?>" class="collapse">
                                                                        <span><?=$row['descriptionApp']?></span>
                                                                      </div>
                                                                </div>
                                                                 
                                                            </div>
                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                                                            </div>
                                                      </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="btn-download">
                                        <a href="#"><button><i class="fa fa-download" aria-hidden="true"></i></button></a>
                                        </div>
                                      </div>
                                </div>
                    <?php
                    }
                ?>
               </div>
            </div>
            <!-- hot fee Apps      -->
            <div class="col-lg-3 title-item">
              <div class="title">
                <a href="">Top Apps trả phí</a>
              </div>
              <?php
                $query = "SELECT * FROM app WHERE priceApp !='Free' ORDER BY soNguoiTaiApp DESC LIMIT 6";
                $result = mysqli_query($con,$query);
                $query1 = "SELECT money FROM account WHERE email ='" . $_SESSION['email'] . "'";
                $result = mysqli_query($con,$query);

                
                    while($row = mysqli_fetch_array($result))
                    {?> 
                      <div class="new-apps">
                        <div class="flip-card">
                          <div class="flip-card-inner">
                            <div class="flip-card-front">
                            <img src="images/<?=$row['imageApp']?>" alt="<?=$row['imageApp']?>">
                            </div>
                            <div class="flip-card-back">
                            <h><?=$row['nameApp']?></h>
                            <p class="price"><?=$row['priceApp']?></p>
                            <div class="card-star">
                            <?php
                                        for($i=1;$i<=$row['starRate'];$i++){
                                          echo "<span class='fa fa-star checked'></span>";
                                        }
                            ?>
                            </div>
                            <div class="btn2">
                                        <div class="btn-view2">
                                            <button type="button" data-toggle="modal" data-target="#<?=$row['idApp']?>">Xem chi tiết</button>
                                            <!-- The Modal -->
                                            <div class="modal fade" id="<?=$row['idApp']?>">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                      <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">  
                                                                <h5 class="modal-title">Thông tin ứng dụng</h5>
                  
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <div class="modal-body-image">
                                                                  <img src="images/<?=$row['imageApp']?>" alt="<?=$row['imageApp']?>">
                                                                </div>
                                                                <div class="modal-body-title">
                                                                  <h1><?=$row['nameApp']?></h1>
                                                                </div>
                                                                <div class="modal-body-product">
                                                                  <span><?=$row['maNSXApp']?></span>
                                                                </div>
                                                                <div class="modal-body-star">
                                                                  <span class="fa fa-star checked"></span>
                                                                  <span class="fa fa-star checked"></span>
                                                                  <span class="fa fa-star checked"></span>
                                                                  <span class="fa fa-star checked"></span>
                                                                  <span class="fa fa-star "></span>
                                                                </div>
                                                                <div class="modal-body-fee">
                                                                  <h5>Giá: <?=$row['priceApp']?></h5>
                                                                </div>
                                                                <div class="modal-body-view">
                                                                  <span><i class="fas fa-eye"></i> <?=$row['soLuotXemApp'] ?></span>
                                                                  <span><i class="fa fa-download"></i> <?=$row['soNguoiTaiApp'] ?></span>
                                                                </div>
                                                                <hr>
                                                                <div class="modal-body-des">
                                                                  <h5>Mô tả từ nhà sản xuất:</h5>
                                                                      <button type="button" data-toggle="collapse" data-target="#a<?=$row['idApp']?>">Bấm để đọc mô tả</button>
                                                                      <div id="a<?=$row['idApp']?>" class="collapse">
                                                                      <span><?=$row['descriptionApp']?></span>
                                                                      </div>
                                                                </div> 
                                                            </div>
                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                                                            </div>
                                                      </div>
                                                </div>
                                            </div>
                                        </div>

            
                                      </div>
                            </div>
                          </div>
                          </div>           
                      </div>
              <?php
                    }
                ?>
            
            </div>		
		</div>
		<div class="clear"></div>
    <div class="footer">
        <p>
            Copyright by team D.A.T <br>
                    😘😘😘
                  </p>
       
    </div>
</body>
</html>