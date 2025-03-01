<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Lost and Found Items</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Lost and Found Items</h2>
    
    <form method="GET" action="index.php">
        <input type="text" name="search" placeholder="Search items...">
        <button type="submit">Search</button>
    </form>

    <div class="item-list">
        <?php
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $sql = "SELECT * FROM items WHERE name LIKE '%$search%' OR location LIKE '%$search%' ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='item'>";
                if ($row['image']) {
                    echo "<img src='" . $row['image'] . "' alt='Item Image'>";
                }
                echo "<p><strong>Item:</strong> " . $row['name'] . "</p>";
                echo "<p><strong>Location:</strong> " . $row['location'] . "</p>";
                echo "<p><strong>Contact:</strong> " . $row['contact'] . "</p>";
                echo "<p><strong>Status:</strong> " . $row['status'] . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No items found.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
