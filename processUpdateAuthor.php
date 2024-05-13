<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $authorId = $_POST['author_id'];
    $firstName = $_POST['a_first_name'];
    $lastName = $_POST['a_last_name'];
    $biography = $_POST['biography'];

    $updateAuthorQuery = "UPDATE author SET a_first_name = ?, a_last_name = ?, biography = ? WHERE author_id = ?";
    $stmt = mysqli_prepare($conn, $updateAuthorQuery);
    mysqli_stmt_bind_param($stmt, "sssi", $firstName, $lastName, $biography, $authorId);

    if (mysqli_stmt_execute($stmt)) {
        // echo "Author information of ".$firstName." ".$lastname. " updated successfully";
        echo '<script>
        
                alert("Author information of '.$firstName.' '.$lastname. ' updated successfully");
                
                setTimeout(function() {
                    window.location.href = "./manageAuthors.php";
                }, 1000);
              </script>';
        exit();
    } else {
        echo "Error updating author information: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo "Invalid request method";
}
?>
