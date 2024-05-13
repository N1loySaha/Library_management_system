<?php
 include("./config.php");

// Retrieve data from the HTML form
$borrowed_id = $_POST['borrowed_id'];
$return_date = $_POST['return_date'];

// Get the borrowed date from the borrows table
$sql_borrowed_date = "SELECT borrowed_date, member_id FROM borrows WHERE borrowed_id = '$borrowed_id'";
$result_borrowed_date = $conn->query($sql_borrowed_date);
if ($result_borrowed_date->num_rows > 0) {
    $row = $result_borrowed_date->fetch_assoc();
    $borrowed_date = $row['borrowed_date'];
    $member_id = $row['member_id'];

    // Calculate the number of days late
    $borrowed_date_timestamp = strtotime($borrowed_date);
    $return_date_timestamp = strtotime($return_date);
    $days_late = ($return_date_timestamp - $borrowed_date_timestamp) / (60 * 60 * 24);

    // Calculate the fine amount (assuming $1 fine per day)
    $fine_amount = max(0, $days_late); // Ensures no negative fines

    // Check if the member_id exists in the member table
    $sql_check_member = "SELECT * FROM member WHERE member_id = '$member_id'";
    $result_check_member = $conn->query($sql_check_member);
    if ($result_check_member->num_rows > 0) {
        // Update the return_date and fine_amount in the borrows table
        $sql_update_borrows = "UPDATE borrows SET return_date = '$return_date' WHERE borrowed_id = '$borrowed_id'";
        if ($conn->query($sql_update_borrows) === TRUE) {
            // Get the book_id from borrow_info for updating copies
            $sql_get_book_id = "SELECT book_id FROM borrow_info WHERE borrowed_id = '$borrowed_id'";
            $book_result = $conn->query($sql_get_book_id);
            if ($book_result->num_rows > 0) {
                $book_data = $book_result->fetch_assoc();
                $book_id = $book_data['book_id'];

                // Increment the no_of_copies in the book table
                $sql_update_book = "UPDATE book SET no_of_copies = no_of_copies + 1 WHERE book_id = '$book_id'";
                $conn->query($sql_update_book);
            }

            // Insert a record into the fine table if there is a fine
            if ($fine_amount > 0) {
                $sql_insert_fine = "INSERT INTO fine (borrowed_id, member_id, fine_amount) VALUES ('$borrowed_id', '$member_id', '$fine_amount')";
                $conn->query($sql_insert_fine);
            }

            echo "Book returned successfully. Fine amount: $fine_amount";
        } else {
            echo "Error updating record in borrows table: " . $conn->error;
        }
    } else {
        echo "Member ID does not exist.";
    }
} else {
    echo "Borrowed ID not found.";
}

// Close database connection
$conn->close();
?>