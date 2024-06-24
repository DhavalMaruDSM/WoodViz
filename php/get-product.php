<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $query = "SELECT p.name,p.product_id,s.description as s_description,c.description,p.inventory,p.igst,p.cgst,p.sgst,p.price,p.sub_category_id,p.category_id FROM product p 
        inner join SubCategory s on p.sub_category_id=s.sub_category_id 
        inner join Category c on c.category_id=p.category_id where s.sub_category_id=p.sub_category_id and c.category_id=p.category_id;";
        $result = $conn->query($query);
        $subcategories = [];
        while ($row = $result->fetch_assoc()) {
            $subcategories[] = $row;
        }
        echo json_encode($subcategories);
    } else {
        echo json_encode(['error' => 'Invalid request type']);
    }

?>