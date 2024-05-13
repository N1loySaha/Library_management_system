<?php
include 'config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $bookId = $_POST['book_id'];
    $bookTitle = $_POST['book_title'];
    $description = $_POST['description'];
    $language = $_POST['language'];
    $yearOfPublication = $_POST['yearOfPublication'];
    $numOfCopies = $_POST['numofcopy'];
    $coverPage = $_POST['cover_page'];
    $publisherName = $_POST['publisher'];

    // Extract author information from the form
    $authorFirstNames = $_POST['a_first_name'];
    $authorLastNames = $_POST['a_last_name'];

    // Check if the publisher exists in the publisher table
    $selectPublisherQuery = "SELECT publishers_id FROM publisher WHERE pub_name = ?";
    $stmt = mysqli_prepare($conn, $selectPublisherQuery);
    mysqli_stmt_bind_param($stmt, "s", $publisherName);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    // If publisher does not exist, add it to the publisher table
    if (mysqli_stmt_num_rows($stmt) == 0) {
        $insertPublisherQuery = "INSERT INTO publisher (pub_name) VALUES (?)";
        $stmt_publisher = mysqli_prepare($conn, $insertPublisherQuery);
        mysqli_stmt_bind_param($stmt_publisher, "s", $publisherName);
        mysqli_stmt_execute($stmt_publisher);

        // Get the ID of the newly added publisher
        $publisherId = mysqli_insert_id($conn);
    } else {
        // If publisher already exists, retrieve its ID
        mysqli_stmt_bind_result($stmt, $publisherId);
        mysqli_stmt_fetch($stmt);
    }

    mysqli_stmt_close($stmt);

    // Insert book into the books table
    $insertBookQuery = "INSERT INTO book (book_id, book_name, description, language, year_of_publication, image_url, no_of_copies, publishers_id)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_book = mysqli_prepare($conn, $insertBookQuery);
    mysqli_stmt_bind_param($stmt_book, "isssisii", $bookId, $bookTitle, $description, $language, $yearOfPublication, $coverPage, $numOfCopies, $publisherId);


    if (mysqli_stmt_execute($stmt_book)) {
        // Insert authors into the authors table and book_author relationship table
        foreach ($authorFirstNames as $index => $firstName) {
            $lastName = $authorLastNames[$index];

            // Check if author exists in the database
            $selectAuthorQuery = "SELECT author_id FROM author WHERE a_first_name = ? AND a_last_name = ?";
            $stmt_author = mysqli_prepare($conn, $selectAuthorQuery);
            mysqli_stmt_bind_param($stmt_author, "ss", $firstName, $lastName);
            mysqli_stmt_execute($stmt_author);
            mysqli_stmt_store_result($stmt_author);

            // If author does not exist, add the author to the authors table
            if (mysqli_stmt_num_rows($stmt_author) == 0) {
                $insertAuthorQuery = "INSERT INTO author (a_first_name, a_last_name) VALUES (?, ?)";
                $stmt_insert_author = mysqli_prepare($conn, $insertAuthorQuery);
                mysqli_stmt_bind_param($stmt_insert_author, "ss", $firstName, $lastName);
                mysqli_stmt_execute($stmt_insert_author);
                $authorId = mysqli_insert_id($conn); // stores the last inserted author_id in this variable
            } else {
                // If author already exists, retrieve the author_id
                mysqli_stmt_bind_result($stmt_author, $authorId);
                mysqli_stmt_fetch($stmt_author);
            }

            // Insert book-author relationship into the book_author table
            $insertRelationshipQuery = "INSERT INTO writes (book_id, author_id) VALUES (?, ?)";
            $stmt_relationship = mysqli_prepare($conn, $insertRelationshipQuery);
            mysqli_stmt_bind_param($stmt_relationship, "ii", $bookId, $authorId);
            mysqli_stmt_execute($stmt_relationship);
        }

        
        echo "The book is successfully added to the database";
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close statements and connection
    mysqli_stmt_close($stmt_book);
    mysqli_close($conn);
} else {
    echo "Invalid request method";
}
?>
