<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $item_name = $_POST['item_name'];
    $category = $_POST['category'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $contact_info = $_POST['contact_info'];
    $status = $_POST['status'];

    // Handle image upload
    $image = "";
    if (!empty($_FILES['image']['name'])) {
        $image = "uploads/" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }

    $sql = "INSERT INTO items (name, category, location, description, contact, status, image)
            VALUES ('$item_name', '$category', '$location', '$description', '$contact_info', '$status', '$image')";

    if ($conn->query($sql) === TRUE) {
        echo "Item reported successfully.";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
