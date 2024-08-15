<?php
include $_SERVER['DOCUMENT_ROOT'] . '/jewellery-website/config/config.php';
include $_SERVER['DOCUMENT_ROOT'] . '/jewellery-website/admin/functions.php';

$tbl_name = 'tbl_testimonial';

try {
    $query = "SELECT * FROM $tbl_name";
    $result = $conn->query($query);

    if ($result) {
        $testimonials = [];
        while ($testimonial = $result->fetch_assoc()) {
            $testimonials[] = $testimonial;
        }
        echo json_encode($testimonials);
    } else {
        throw new Exception("Query failed: " . $conn->error);
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}