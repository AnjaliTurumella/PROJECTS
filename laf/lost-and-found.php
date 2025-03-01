<?php
include "db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost and Found Items</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="lost-and-found">
    <header>
        <h1>Lost and Found Items</h1>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="report-item.html">Report Item</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="items-section form-section">
            <!-- <h2>Currently Reported Items</h2>
            <div class="item-list">
                <div class="item">
                    <img src="item.jpg" alt="Item Image">
                    <p><strong>Item:</strong> Lost Wallet</p>
                    <p><strong>Location:</strong> Park</p>
                    <p><strong>Contact:</strong> 123-456-7890</p>
                    <p><strong>Status:</strong> Lost</p>
                </div>
            </div>
        </section> -->
    <h2>Latest Lost and Found Entries</h2>
    <?php
    $sql = "SELECT * from report";
    $result = $conn->query($sql);

    if ($result->num_rows > 0):  
        while ($row = $result->fetch_assoc()): ?>
            <div class="item-list">
                <div class="item">
                    <img src="<?= htmlspecialchars($row['image']) ?>" alt="Item Image">
                    <p><strong>Item:</strong><?php echo htmlspecialchars($row['item_name']); ?></p>
                    <p><strong>Location:</strong><?php echo htmlspecialchars($row['location']); ?></p>
                    <p><strong>Contact:</strong><?php echo htmlspecialchars($row['contact']); ?></p>
                    <p><strong>Status:</strong><?php echo htmlspecialchars($row['status']); ?></p>
                </div>
            </div>
        <?php endwhile;
    else:
        echo "<p>No blog posts available.</p>";
    endif;
    ?>
    </section>
    </main>

    <footer>
        <p>&copy; 2024 Lost and Found Management | All Rights Reserved</p>
    </footer>
</body>
</html>
