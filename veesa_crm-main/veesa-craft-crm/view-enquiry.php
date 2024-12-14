<?php



if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


include("conn.php");


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']); 

 
    $query = "SELECT * FROM enquiry WHERE id = $id";
    $result = mysqli_query($conn, $query);

 
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Enquiry not found.";
        exit();
    }
} else {
    echo "Invalid enquiry ID.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Enquiry</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h3>Enquiry Details</h3>
        <table class="table table-bordered">
            <tr>
                <th>Customer Name</th>
                <td><?php echo htmlspecialchars($row['c_name']); ?></td>
            </tr>
            <tr>
                <th>Customer Contact</th>
                <td><?php echo htmlspecialchars($row['c_contact']); ?></td>
            </tr>
            <tr>
                <th>Inquired Product</th>
                <td><?php echo htmlspecialchars($row['i_product']); ?></td>
            </tr>
            <tr>
                <th>Priority</th>
                <td><?php echo htmlspecialchars($row['priority']); ?></td>
            </tr>
            <tr>
                <th>Advance Payment</th>
                <td><?php echo htmlspecialchars($row['advance_payment']); ?></td>
            </tr>
            <tr>
                <th>Balance Payment</th>
                <td><?php echo htmlspecialchars($row['balance_payment']); ?></td>
            </tr>
            <tr>
                <th>Total Payment</th>
                <td><?php echo htmlspecialchars($row['total_payment']); ?></td>
            </tr>
            <tr>
                <th>Payment Mode</th>
                <td><?php echo htmlspecialchars($row['payment_mode']); ?></td>
            </tr>
            <tr>
                <th>Remark</th>
                <td><?php echo htmlspecialchars($row['remark']); ?></td>
            </tr>
        </table>

        <a href="order.php" class="btn btn-secondary">Back to Orders</a>
        <a href="add-new-enquiry.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
