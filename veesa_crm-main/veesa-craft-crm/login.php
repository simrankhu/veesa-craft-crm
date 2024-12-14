<?php
include("conn.php");
session_start();
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Login - Glassmorphism</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- Bootstrap CSS v5.3.2 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
        />
        
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

        <!-- Custom CSS for Glassmorphism -->
        <style>
            body {
                background: url("https://images.unsplash.com/photo-1477346611705-65d1883cee1e?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D") no-repeat center center fixed;
                background-size: cover;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                font-family: 'Poppins', sans-serif;
                margin: 0;
            }

             .form_container {
                backdrop-filter: blur(10px);
                background: rgba(255, 255, 255, 0.1);
                border-radius: 15px;
                padding: 40px;
                max-width: 400px;
                width: 100%;
                box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.2);
                transform: scale(0.8);
                animation: scaleIn 1s ease-in-out forwards;
                opacity: 0;
                animation: appear 1.5s ease-in-out forwards;
            }
      @keyframes scaleIn {
                to { transform: scale(1); }
            }

            @keyframes appear {
                0% { opacity: 0; transform: scale(0.8); }
                100% { opacity: 1; transform: scale(1); }
            }

            .form_container .logo img {
                width: 150px;
                margin-bottom: 15px;
                animation: bounceIn 1.5s;
            }

           
            @keyframes bounceIn {
                0% { transform: scale(0); }
                60% { transform: scale(1.2); }
                100% { transform: scale(1); }
            }

            .form_container p {
                color: #fff;
                font-size: 14px;
                text-align: center;
                letter-spacing: 2px;
            }

            .form_container input{
                 background: rgba(255, 255, 255, 0.3);
                border: none;
                outline: none;
                color: black;
                margin-bottom: 15px;
                padding: 15px;
                font-size: 14px;
                border-radius: 10px;
                width: 100%;
                transition: all 0.3s ease-in-out;
            }
            .form_container select {
                background: rgba(255, 255, 255, 0.3);
                border: none;
                outline: none;
                color: #fff;
                margin-bottom: 15px;
                padding: 15px;
                font-size: 14px;
                border-radius: 10px;
                width: 100%;
                transition: all 0.3s ease-in-out;
            }

            .form_container input::placeholder {
                color: rgba(255, 255, 255, 0.7);
            }

            .form_container input:focus,
            .form_container select:focus {
                background: rgba(255, 255, 255, 0.5);
                box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
                transform: scale(1.05);
                color:black;
            }

            .form_container .btn {
                background: linear-gradient(90deg, #ff007f, #63c5da);
                color: #fff;
                border: none;
                width: 100%;
                padding: 10px;
                border-radius: 10px;
                font-size: 16px;
                cursor: pointer;
                transition: background 0.3s ease-in-out, transform 0.3s;
            }

            .form_container .btn:hover {
                background: linear-gradient(90deg, green, #00ff6a);
                transform: scale(1.05);
            }

            .form_container select option {
                padding-block-end: 1px;
                min-block-size: 1.2em;
                padding-inline: 2px;
                white-space: nowrap;
                color: black;
            }

            .form_container input:focus {
                background-color: rgba(255, 255, 255, 0.7);
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            }
            .form_container select option{
                padding-block-end: 1px;
    min-block-size: 1.2em;
    padding-inline: 2px;
    white-space: nowrap;
    color :black;
}
        </style>
    </head>

    <body>
        <main>
            <div class="container form_container">
                <div class="logo text-center">
                    <img src="assests/uploads/logo2.png" alt="logo">
                    <p>Sign in for dashboard</p>
                </div>
                <form action="" method="post">
                    <input type="text" name="user_name" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <select name="type" required>
                        <option value="" disabled selected>Select your role</option>
                        <option value="admin">Admin</option>
                        <option value="subadmin">Subadmin</option>
                    </select>
                    <button type="submit" name="submit" class="btn mt-4">Submit</button>
                </form>
            </div>
        </main>

        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            crossorigin="anonymous">
        </script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            crossorigin="anonymous">
        </script>
    </body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $selected_role = $_POST['type'];

    $check_query = "SELECT * FROM `login` WHERE `user_name`='$user_name' AND `password`='$password'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $row = mysqli_fetch_assoc($check_result);

        if ($selected_role === $row['type']) {
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['role'] = $row['type']; 
            $_SESSION['status'] = true;

            header('Location: index.php');
            exit(); 
        } else {
            echo '<script>alert("Role mismatch! Please select the correct role based on your account.")</script>';
        }
    } else {
        echo '<script>alert("Username or password is invalid")</script>';
    }
}
?>
