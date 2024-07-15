<?php
include 'db.php';
    // Get the current year and month
    $year = date('y');
    $month = date('m');

    // Check if the invoice number already exists in the database
    $query = "SELECT COUNT(*) FROM Invoice WHERE invoice_id LIKE '$year$month%'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_fetch_row($result)[0];

    // If the invoice number already exists, increment the last 3 digits
    if ($count > 0) {
        $query = "SELECT MAX(invoice_id) FROM Invoice WHERE invoice_id LIKE '$year$month%'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_row($result);
        $last_inv_no = $row[0];
        $new_inv_no = $last_inv_no + 1;
        $inv_no = substr($new_inv_no, 0, 4). sprintf('%03d', substr($new_inv_no, 6));
    } else {
        // Generate the invoice number with the prefix year+month
        $prefix = $year . $month;
        $prefix;
        $inv_no = $prefix . '001';
    }
    echo $inv_no;
?>