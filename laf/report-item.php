<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $status = $_POST['item-type'];
    $item_name = $_POST['item-name'];
    $category = $_POST['category'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $contact_info = $_POST['phone'];
    $image = $_POST['item-photo'];


    
    // '$item_name', '$category', '$location', '$description', '$contact_info', '$status', '$image'

    $sql = "INSERT INTO report (item_name, category, location, description, contact, status, image)
            VALUES (?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss",$item_name, $category,$location,$description,$contact_info,$status,$image);
    
    if ($stmt->execute()) {
        echo "<h1>Item record successfully created.</h1> <a href='index.html'>Home</a>";
        echo "<br></br>";
        echo "<a href='$image'>Image photo</a>";
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
}
else {
    echo "sorry no request method found";
}
?>
