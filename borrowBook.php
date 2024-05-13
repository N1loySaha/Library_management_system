<?php
include ("./config.php");
// Retrieve data from the HTML form
$borrowed_date = $_POST['borrowed_date'];
$return_date = $_POST['return_date'];
$member_id = $_POST['member_id'];
$book_id = $_POST['book_id'];

// Ensure there are copies available before borrowing
$check_copies_sql = "SELECT no_of_copies FROM book WHERE book_id = ?";
$stmt = $conn->prepare($check_copies_sql);
$stmt->bind_param("i", $book_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $copy_data = $result->fetch_assoc();
    $result->close(); // Close the result set
    if ($copy_data['no_of_copies'] > 0) {
        // Insert data into the borrows table
        $sql = "INSERT INTO borrows (borrowed_date, return_date, member_id) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $borrowed_date, $return_date, $member_id);
        if ($stmt->execute()) {
            // Get the last inserted borrow_id
            $borrowed_id = $conn->insert_id;

            // Insert data into the borrow_info table
            $sql = "INSERT INTO borrow_info (borrowed_id, book_id) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $borrowed_id, $book_id);
            if ($stmt->execute()) {
                // Decrement no_of_copies in the book table
                $sql = "UPDATE book SET no_of_copies = no_of_copies - 1 WHERE book_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $book_id);
                if ($stmt->execute()) {
                    echo "Book borrowed successfully.";
                } else {
                    echo "Error updating book copies: " . $stmt->error;
                }
            } else {
                echo "Error inserting into borrow_info: " . $stmt->error;
            }
        } else {
            echo "Error inserting into borrows: " . $stmt->error;
        }
    } else {
        echo "No copies available for borrowing.";
    }
} else {
    echo "Error checking available copies: " . $stmt->error;
}

// Close prepared statements and database connection
$stmt->close();
$conn->close();
?>
