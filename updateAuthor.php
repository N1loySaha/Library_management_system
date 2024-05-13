<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Author</title>
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="./styles/updateAuthor.css">
</head>

<body>
    <?php include 'adminNav.php'; ?>
    <div class="main">
        <h2>Update Author Information</h2>
        <?php
        include 'config.php';

        // Check if author ID is provided
        if (isset($_GET['id'])) {
            $authorId = $_GET['id'];

            // Fetch author details based on author ID
            $selectAuthorQuery = "SELECT a_first_name, a_last_name, biography FROM author WHERE author_id = ?";
            $stmt = mysqli_prepare($conn, $selectAuthorQuery);
            mysqli_stmt_bind_param($stmt, "i", $authorId);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $firstName, $lastName, $biography);
            mysqli_stmt_fetch($stmt);
            ?>

            <form action="processUpdateAuthor.php" method="POST">
                <input type="hidden" name="author_id" value="<?php echo $authorId; ?>">
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="a_first_name" value="<?php echo $firstName; ?>" required>
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="a_last_name" value="<?php echo $lastName; ?>" required>
                <label for="biography">Biography:</label>
                <textarea id="biography" name="biography" rows="4" cols="50" required><?php echo $biography; ?></textarea>
                <button type="submit">Update Author Information</button>
            </form>

            <?php
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        } else {
            echo "Author ID not found";
        }
        ?>
    </div>
</body>

</html>
