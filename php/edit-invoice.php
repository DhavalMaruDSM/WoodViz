<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $invoice_id = $_POST['invoice_id']; 
    $customer_id = $_POST['customer_id'];
    $invoice_date = $_POST['invoice_date'];
    $due_date = $_POST['due_date'];
    $note = $_POST['note'];

    $sql_update_invoice = "UPDATE Invoice SET 
                            customer_id = '$customer_id',
                            invoice_date = '$invoice_date',
                            due_date = '$due_date'
                          WHERE invoice_id = '$invoice_id'";

    if ($conn->query($sql_update_invoice) === TRUE) {
        $sql_delete_items = "DELETE FROM Invoice_item WHERE invoice_id = '$invoice_id'";
        if ($conn->query($sql_delete_items) === TRUE) {
            // Insert new invoice items and calculate total invoice value and total GST
            $total_invoice_value = 0;
            $total_cgst_amount = 0;
            $total_sgst_amount = 0;
            $total_igst_amount = 0;

            foreach ($_POST['items'] as $item) {
                $product_id = $item['product_id'];
                $product_name = $item['product_name'];
                $quantity = $item['quantity'];
                $unit_price = $item['unit_price'];
                $cgst_percent = $item['cgst'];
                $sgst_percent = $item['sgst'];
                $igst_percent = $item['igst'];
                $total_value = $item['total_value'];
                $cgst_amount = $item['cgst_amount'];
                $sgst_amount = $item['sgst_amount'];
                $igst_amount = $item['igst_amount'];
                $taxable = $item['Taxable'];

                $total_invoice_value += $total_value;
                $total_cgst_amount += $cgst_amount;
                $total_sgst_amount += $sgst_amount;
                $total_igst_amount += $igst_amount;

                $sql_insert_item = "INSERT INTO Invoice_item (invoice_id, product_id, quantity, unit_price, cgst, sgst, igst, total_value)
                                    VALUES ('$invoice_id', '$product_id', '$quantity', '$unit_price', '$cgst_amount', '$sgst_amount', '$igst_amount', '$total_value')";
                if ($conn->query($sql_insert_item) !== TRUE) {
                    echo "Error inserting item: " . $conn->error;
                }
            }

            // Calculate total GST
            $total_gst = $total_cgst_amount + $total_sgst_amount + $total_igst_amount;

            // Update invoice_value and total GST in Invoice table
            $sql_update_invoice_value = "UPDATE Invoice SET 
                                         invoice_value = '$total_invoice_value',
                                         gst = '$total_gst'
                                         WHERE invoice_id = '$invoice_id'";

            if ($conn->query($sql_update_invoice_value) === TRUE) {
                echo "<script>
                        alert('Invoice updated successfully!');
                        window.location.href = 'invoicelist.php';
                      </script>";
                      exit();
            } else {
                echo "Error updating invoice value and total GST: " . $conn->error;
            }
        } else {
            echo "Error deleting existing items: " . $conn->error;
        }
    } else {
        echo "Error updating invoice: " . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
