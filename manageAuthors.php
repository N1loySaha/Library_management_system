<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search and Manage Authors</title>
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="./styles/manageAuthors.css">
</head>

<body>


    <header>
        <?php include "adminNav.php" ?>
    </header>

    <body>

        <h2>Search and Manage Authors</h2>
        <form action="" method="POST">
            <label for="authorName">Author Name:</label>
            <input type="text" id="authorName" name="authorName" placeholder="Enter author's name">
            <button type="submit" name="search">Search</button>
        </form>
    </body>

    <?php
    include 'config.php';

    if (isset($_POST['search'])) {
        $authorName = $_POST['authorName'];

        // Search for authors based on name
        $searchAuthorQuery = "SELECT author_id, a_first_name, a_last_name FROM author WHERE CONCAT(a_first_name, ' ', a_last_name) LIKE ?";
        $stmt = mysqli_prepare($conn, $searchAuthorQuery);
        $searchParam = "%$authorName%";
        mysqli_stmt_bind_param($stmt, "s", $searchParam);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $authorId, $firstName, $lastName);


        // update/delete authrs
        echo "<h3>Author's List:</h3>";
        echo "<ul>";
        while (mysqli_stmt_fetch($stmt)) {
            echo "<li>$firstName $lastName - 
            <a href='updateAuthor.php?id=$authorId'>Update</a> | 
            <a href='processRemoveAuthor.php?id=$authorId' onclick='return confirm(\"Are you sure you want to delete this author?\")'>Remove</a></li>";
        }
        echo "</ul>";

        mysqli_stmt_close($stmt);
    }
    ?>

    <footer>
        <p>&copy; 2024 | 370 Project of Group 9. All rights reserved.</p>
    </footer>
</body>

</html>