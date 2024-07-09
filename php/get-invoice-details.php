<?php
require 'db.php';

$invoiceId = isset($_GET['invoice_id']) ? $_GET['invoice_id'] : null;

if ($invoiceId) {
    $invoiceDetails = [];

    // Fetch invoice details
    $invoiceSql = "
        SELECT i.invoice_id, i.invoice_date, i.due_date, i.customer_id, 
               c.name as customer_name, c.address_line_1, c.address_line_2, c.city, c.state, c.pincode, c.gst, c.pan
        FROM Invoice i
        JOIN Customers c ON i.customer_id = c.customer_id
        WHERE i.invoice_id = $invoiceId";
    $invoiceResult = mysqli_query($conn, $invoiceSql);

    if (mysqli_num_rows($invoiceResult) > 0) {
        $invoiceDetails = mysqli_fetch_assoc($invoiceResult);

        // Fetch invoice items
        $itemsSql = "
            SELECT ii.product_id, p.name as product_name, ii.quantity, ii.unit_price, p.cgst, p.sgst, p.igst,ii.total_value,ii.cgst as cgst_amount,ii.sgst as sgst_amount,ii.igst as igst_amount, (ii.unit_price * ii.quantity) as Taxable
            FROM Invoice_item ii
            JOIN product p ON ii.product_id = p.product_id
            WHERE ii.invoice_id = $invoiceId";
        $itemsResult = mysqli_query($conn, $itemsSql);

        $invoiceItems = [];
        while ($row = mysqli_fetch_assoc($itemsResult)) {
            $row['cgst'] = $row['cgst'];
            $row['sgst'] = $row['sgst'];
            $row['igst'] = $row['igst'];
            $invoiceItems[] = $row;
        }

        $invoiceDetails['items'] = $invoiceItems;
    }

    echo json_encode($invoiceDetails);
} else {
    echo json_encode(['error' => 'Invalid invoice ID']);
}

mysqli_close($conn);
?>

