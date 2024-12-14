<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #e1e1e1;
        }
        .header {
            text-align: center;
            padding: 10px 0;
        }
        .header img {
            max-width: 200px;
        }
        .main-content {
            padding: 20px;
            text-align: center;
        }
        .main-content h2 {
            color: #d33;
            margin-bottom: 0;
        }
        .main-content p {
            font-size: 16px;
            margin: 20px 0;
            color: #333;
        }
        .credentials {
            background-color: #f4f4f4;
            border: 1px solid #ddd;
            padding: 15px;
            text-align: left;
            margin: 20px 0;
        }
        .credentials p {
            font-size: 16px;
            margin: 10px 0;
        }
        .credentials a {
            color: #0073aa;
            text-decoration: none;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: #666;
        }
        .footer img {
            width: 50px;
            height: auto;
            margin-top: 20px;
        }
        .footer h3 {
            color: #f6821f;
            font-weight: bold;
            font-size: 18px;
            margin: 15px 0;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Header Section -->
    <div class="header">
        <img src="https://web2tech.org/veesa-craft-crm/assests/uploads/logo2.png" alt="Veesa Craft Logo">
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h2>Thanks for Joining Veesa Craft Crm!</h2>
        <p>Hi <strong><?php echo $email; ?></strong>,</p>
        <p>We're excited for you to get started. Here are your login credentials:</p>

        <!-- Credentials Section -->
        <div class="credentials">
            <p><strong>User Name</strong>: <?php echo $email; ?></p>
            <p><strong>Password</strong>: <?php echo $password ?></p>
            <p><strong>Login Link</strong>: <a href="https://web2tech.org/veesa-craft-crm/login.php">Veesa-Craft-Crm/login</a></p>
        </div>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <h3>Connect with the Right People</h3>
        <p>Team <br><b>Veesa Craft Crm</b></p>
    </div>
</div>

</body>
</html>
