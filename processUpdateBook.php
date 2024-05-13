<?php
include 'config.php'; // Include your database configuration file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $bookId = $_POST['book_id'];
    $bookTitle = $_POST['book_title'];
    $authorFirstName = $_POST['a_first_name'];
    $authorLastName = $_POST['a_last_name'];
    // $publisher = $_POST['publisher'];
    $yearOfPublication = $_POST['yearOfPublication'];
    $numOfCopies = $_POST['numofcopy'];
    $coverPage = $_POST['cover_page'];
    $description = $_POST['description'];
    $language = $_POST['language'];

    // Check if the author exists in the authors table
    $selectAuthorQuery = "SELECT author_id FROM author WHERE a_first_name = ? AND a_last_name = ?";
    $stmt = mysqli_prepare($conn, $selectAuthorQuery);
    mysqli_stmt_bind_param($stmt, "ss", $authorFirstName, $authorLastName);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    // If author does not exist, add the author to the authors table
    if (mysqli_stmt_num_rows($stmt) == 0) {
        // Inserting new author
        $insertAuthorQuery = "INSERT INTO author (a_first_name, a_last_name) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $insertAuthorQuery);
        mysqli_stmt_bind_param($stmt, "ss", $authorFirstName, $authorLastName);
        mysqli_stmt_execute($stmt);
        $authorId = mysqli_insert_id($conn); // Get the newly inserted author ID
    } else {
        // If author already exists, retrieve the author_id
        mysqli_stmt_bind_result($stmt, $authorId);
        mysqli_stmt_fetch($stmt);
    }

    // Update book information in the database
    $updateBookQuery = "UPDATE book SET book_name = ?, author_id = ?, year_of_publication = ?, no_of_copies = ?, image_url = ?, description = ?, language = ? WHERE book_id = ?";
    $stmt = mysqli_prepare($conn, $updateBookQuery);
    mysqli_stmt_bind_param($stmt, "siiisssi", $bookTitle, $authorId, $yearOfPublication, $numOfCopies, $coverPage, $description, $language, $bookId);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // echo "Book information updated successfully";
        echo '<script>
        
                alert("Book information of '.$bookTitle. ' updated successfully");
                
                setTimeout(function() {
                    window.location.href = "./manageBooks.php";
                }, 1000);
              </script>';
        exit();
    } else {
        echo "Error updating book information: " . mysqli_error($conn);
        echo '<script>
        
                alert("Error updating information.'.mysqli_error($conn);
              '</script>';
    }

    // Close statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo "Invalid request method";
}
?>
