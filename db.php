<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'vendor/autoload.php';
    
    $host = "localhost"; 
    $user = "root"; /* User */
    $password = ""; /* Password */
    $dbname = "database"; /* Database name */

    $con = mysqli_connect($host, $user, $password, $dbname);

    if(mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    function is_email_exists($email){
        $sql = 'select * from account where email = ?';
        $con = mysqli_connect('localhost','root','','database');

        $stm = $con->prepare($sql);
        $stm->bind_param('s',$email);
        if(!$stm->execute()){
            die('Query error: ' . $stm->error);
            //echo 'fxhc'; 
        }

        $result = $stm->get_result();
        //$count = $result->fetch_assoc();
        if($result->num_rows > 0){
            //echo 'ddgf';
            return true;

        }else{
            return false;
        }
    }
    
    function activateAccount($email, $token){
        $sql = 'select * from account where email = ? and activate_token = ? and activated = 0';

        $con = mysqli_connect('localhost','root','','database');
        $stm = $con->prepare($sql);
        $stm->bind_param('ss', $email, $token);

        if(!$stm->execute()){
            return array('code' => 1, 'error' => 'Can you execute command');
        }
        $result = $stm->get_result();
        if($result->num_rows == 0){
            return array('code' => 2, 'error' => 'Email address or token not found');
        }

        $sql = "update account set activated = 1, activate_token =''where email =?";
        $stm = $con->prepare($sql);
        $stm->bind_param('s',$email);

        if(!$stm->execute()){
            return array('code' => 1, 'error' => 'Can you execute command');
        }

        return array('code' => 1, 'message' => 'Account activated');
    }
    function reset_password($email){
        if(!is_email_exists($email)){
            return array('code' => 1, 'error' => 'Email does not exist');
        }
        $token = md5($email . '+' . random_int(0, 1000));
        $sql = 'update account set activate_token = ? where email = ?';
        $con = mysqli_connect('localhost','root','','database');
        
        $stm = $con->prepare($sql);
        $stm->bind_param('ss', $token, $email);

        if(!$stm->execute()){
            return array('code' => 2, 'error' => 'Can not execute command');
        }
        if($stm->affected_rows == 0){
            
            $exp = time() + 120;   //hết hạn sau 2'
            //chưa có dòng nào của email này, ta sẽ thêm vào dòng mới
            $sql = 'insert into account values(?,?)';
            $stm = $con->prepare($sql);
            $stm->bind_param('ss', $email, $token, $exp);

            if(!$stm->execute()){
                return array('code' => 1, 'error' => 'Can not execute command');
            }
        }
        $success = sendResetEmail($email, $token);
        return array('code' => 0, 'success' => $success);
    }
    function sendResetEmail($email, $token){

        //Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->CharSet = 'UTF-8';
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'thienanprodl123@gmail.com';                     //SMTP username
            $mail->Password   = 'gtvhdcpdkgghylsr';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('thienanprodl123@gmail.com', 'Admin web bán hàng');
            $mail->addAddress($email, 'người nhận');     //Add a recipient
            /*$mail->addAddress('ellen@example.com');               //Name is optional
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');*/

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Khôi phục mật khẩu của bạn';
            $mail->Body    = "Click <a href='https://localhost/reset.php?email=$email&token=$token'>vào đây</a> để khôi phục mật khẩu của bạn";
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo true;   
        } catch (Exception $e) {
            echo $e;
        }
    }
?>