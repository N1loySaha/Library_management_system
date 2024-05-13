<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Book</title>
    <link rel="stylesheet" href="./styles/main.css">
    <link rel="stylesheet" href="./styles/add_books.css">
</head>

<body>
    <?php include 'adminNav.php'; ?>
    <main>
    <div class="main">
        <h2>Update Book Information</h2>
        <?php
        include 'config.php';

        if (isset($_GET['book_id'])) {
            $bookId = $_GET['book_id'];

            // Fetch existing book details based on book ID
            $selectBookQuery = "SELECT b.book_id, b.book_name, b.description, b.language, b.image_url, b.no_of_copies, b.year_of_publication, a.a_first_name, a.a_last_name
                    FROM book b
                    JOIN author a ON b.author_id = a.author_id
                    WHERE b.book_id = ?";
            $stmt = mysqli_prepare($conn, $selectBookQuery);
            mysqli_stmt_bind_param($stmt, "i", $bookId);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $bookId, $bookTitle, $description, $language, $imageUrl, $numOfCopies, $yearOfPublication, $authorFirstName, $authorLastName);
            mysqli_stmt_fetch($stmt);
            echo $imageUrl;
            
            ?>
          
            <form action="./processUpdateBook.php" method="post">
                <input type="hidden" name="book_id" value="<?php echo $bookId; ?>">
                <label for="bookTitle">Book Title:</label>
                <input id="bookTitle" type="text" placeholder="Book's title" name="book_title"
                    value="<?php echo $bookTitle;?>">
                <label for="Author's First Name">Author's First Name:</label>
                <input id="Author's First Name:" type="text" placeholder="Author's First Name" name="a_first_name"
                    value="<?php echo $authorFirstName; ?>">
                <label for="Author's Last Name">Author's Last Name:</label>
                <input id="Author's Last Name" type="text" placeholder="Author's Last Name" name="a_last_name"
                    value="<?php echo $authorLastName; ?>">
                <!-- <label for="publisher">Publisher:</label>
                <input id="publisher" type="text" placeholder="Publisher's Name" name="publisher"
                    value="<?php echo $publisher; ?>"> -->
                <label for="yop">Year of Publication:</label>
                <input id="yop" type="year" placeholder="Year of Publication" name="yearOfPublication"
                    value="<?php echo $yearOfPublication; ?>">
                <label for="lang">Language:</label>
                <input id="lang" type="text" placeholder="Language" name="language" value="<?php echo $language; ?>">
                <label for="numofcopy">Number of copies:</label>
                <input type="number" id='numofcopy' placeholder="Number of copy" name='numofcopy'
                    value="<?php echo $numOfCopies; ?>"> <BR>
                <label for="linkofcover">Book Cover Page Location:</label>
                <input id="linkofcover" type="text" name="cover_page" id="book_cover" placeholder='Link of the cover page'
                    value="<?php echo $imageUrl; ?>">
                <label id="description_label" for="description">Book description:</label>
                <textarea name="description" style="wi" id="description" rows="4" cols="15"
                    placeholder="Describe this book"><?php echo $description; ?></textarea>
                <button type="submit" style="margin: 0 auto;">Update Book Information</button>
            </form>
            <?php
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
        ?>
    </div>
    </main>
    <footer>
        <p>&copy; 2024 370 Project. Group 9.</p>
    </footer>
</body>

</html>