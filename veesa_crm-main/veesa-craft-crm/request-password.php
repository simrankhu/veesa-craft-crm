
<?php
include("conn.php");
session_start();
if (!isset($_SESSION["user_name"]) && ($_SESSION['status']!==true)) {
    header('location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Veesa Craft - Password Reset</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            display: flex;
            align-items: center;
            justify-content: center;
      
        }
        .form-wrapper {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 50%;
            margin:10% auto;
            min-width: 320px;
        }
        .form-wrapper h2 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #003566;
        }
        .form-wrapper label {
            font-size: 14px;
            color: #333;
            margin-top:20px;
        }
        .form-wrapper input[type="email"] {
            width: 100%;
            padding: 15px 20px;
            margin-top: 8px;
            margin-bottom: 25px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 14px;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            border:none;
        }
        .form-wrapper input[type="submit"] {
            background-color:   #003566;
            color: white;
            padding: 10px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        .form-wrapper input[type="submit"]:hover {
            background-color: green;
        }
        .image-section {
            width: 50%;
            padding-right: 40px;
        }
        .image-section img {
            max-width: 100%;
        }
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            .image-section {
                display: none;
            }
            .form-wrapper {
                width: 80%;
            }
        }
    </style>
</head>
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
	<div class="d-flex flex-column flex-root">
	    	<div class="page d-flex flex-row flex-column-fluid">
	    	    	<!--begin::Aside-->
				<?php include 'sidebar.php'; ?>
				<!--end::Aside-->
	<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
				 <!--header-start-->
                <?php include("header.php");?>
                <!--header_end-->
					<!--begin::Content-->
    <div class="container">
        
        <div class="form-wrapper">
        <h2>Generate a Password</h2>
            <form action="" method="POST">
                <label for="email">Enter Email address</label>
                <input type="email" name="email" id="email" placeholder="example@gmail.com" required>
                <input type="submit" value="Generate">
            </form>
        </div>
    </div>
    </div>
    </div>
</div>

</body>
</html>


<?php
session_start();
require 'conn.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    $result = mysqli_query($conn, "SELECT * FROM login WHERE user_name = '$email'");

    if (mysqli_num_rows($result) === 1) {
        $password = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 10);

        $update_result = mysqli_query($conn, "UPDATE login SET password = '$password' WHERE user_name = '$email'");

        if ($update_result) {
            ob_start(); 
            include 'emailTemplate.php'; 
            $message = ob_get_clean(); 
            $subject = "Your Veesa Craft Crm Login Credentials"; 

            $subject = 'Your New Password';
            $headers = "From: no-reply@veesacraft.com\r\n" .
                       "Reply-To: no-reply@veesacraft.com\r\n" .
                       "MIME-Version: 1.0\r\n" .
                       "Content-Type: text/html; charset=UTF-8\r\n";

            if (mail($email, $subject, $message, $headers)) {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Password Reset!",
                        text: "A new password has been sent to your email.",
                        confirmButtonText: "OK"
                    }).then(function() {
                        window.location.href = "subadmin-list.php";
                    });
                </script>';
            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Email Error!",
                        text: "Failed to send the email. Please try again later.",
                        confirmButtonText: "OK"
                    });
                </script>';
            }
        } else {
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Database Error!",
                    text: "Could not update the password in the database.",
                    confirmButtonText: "OK"
                });
            </script>';
        }
    } else {
        $password = bin2hex(random_bytes(4)); 
        $insert_result = mysqli_query($conn, "INSERT INTO login (user_name, password) VALUES ('$email', '$password')");

        if ($insert_result) {
            
            ob_start(); 
            include 'emailTemplate.php'; 
            $message = ob_get_clean();

            $subject = 'Your Account and Password';
            $headers = "From: no-reply@veesacraft.com\r\n" .
                       "Reply-To: no-reply@veesacraft.com\r\n" .
                       "MIME-Version: 1.0\r\n" .
                       "Content-Type: text/html; charset=UTF-8\r\n";

            if (mail($email, $subject, $message, $headers)) {
                
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Account Created!",
                        text: "The account has been created and the password sent to the email.",
                        confirmButtonText: "OK"
                    }).then(function() {
                        window.location.href = "subadmin-list.php";
                    });
                </script>';
            } else {
                
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Email Failed!",
                        text: "There was an issue sending the password to the email.",
                        confirmButtonText: "OK"
                    });
                </script>';
            }
        } else {
            
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Database Error!",
                    text: "Could not create the new account.",
                    confirmButtonText: "OK"
                });
            </script>';
        }
    }
}
?>

