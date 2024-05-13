<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Books</title>

    <link rel="stylesheet" href="./styles/main.css">
    <link rel="stylesheet" href="./styles/add_books.css">
    

    <script>
        function addAuthorField() {
            const authorFields = document.getElementById('authorFields');
            const authorFieldTemplate = `
                <div class="author-field">
                    <label>Author's First Name:</label>
                    <input type="text" name="a_first_name[]">
                    <label>Author's Last Name:</label>
                    <input type="text" name="a_last_name[]">
                </div>
            `;
            authorFields.insertAdjacentHTML('beforeend', authorFieldTemplate);
        }
    </script>
</head>

<body>
    <?php include 'adminNav.php'; ?>

    <main>
        <div class="main">
            <h2>Add A book</h2>
            <form action="./processAddBooks.php" method="post">
                <label for="bookid">Book ID:</label>
                <input id='bookid' type="text" placeholder="Book ID" name='book_id'>
                <label for="bookTitle">Book Title:</label>
                <input id="bookTitle" type="text" placeholder="Book's title" name="book_title">
                <div id="authorFields">
                    <div class="author-field">
                        <label for="authorFirstName">Author's First Name:</label>
                        <input id="authorFirstName" type="text" placeholder="Author's First Name" name="a_first_name[]">
                        <label for="authorLastName">Author's Last Name:</label>
                        <input id="authorLastName" type="text" placeholder="Author's Last Name" name="a_last_name[]">
                    </div>
                </div>
                <button type="button" id="addAuthor" onclick="addAuthorField()">Add Another Author</button><br>
                <label for="publisher">Publisher:</label>
                <input id="publisher" type="text" placeholder="Publisher's Name" name='publisher'>
                <label for="yop">Year of Publication:</label>
                <input id="yop" type="year" placeholder="Year of Publication" name='yearOfPublication'>
                <label for="lang">Language:</label>
                <input id="lang" type="text" placeholder="Language" name="language">
                <label for="numofcopy">Number of copies:</label>
                <input type="number" id='numofcopy' placeholder="Number of copy" name='numofcopy' value="0"> <BR>
                <label for="linkofcover">Book Cover Page Location:</label>
                <input id="linkofcover" type="text" name="cover_page" id="book_cover"
                    placeholder='Link of the cover page'>
                <label id="description_label" for="description">Book description:</label>
                <textarea name="description" id="description" rows="4" cols="15"
                    placeholder="Describe this book"></textarea>
                <button type="submit" style="margin: 0 auto;">Add Book</button>
            </form>
        </div>


        <div class="main">
            <h2>Update Book Information</h2>
            <form action="newUpdateBook.php" method="get">
                <label for="book_id">Book ID:</label>
                <input type="text" name="book_id">
                <button type="submit">Update info for this book</button>
            </form>
        </div>

        <div class="main">
            <h2 color="red">Remove Book</h2>
            <form action="newProcessRemoveBook.php" method="post">
                <label for="removeBook">Enter Book ID to <B>REMOVE</B> Book:</label>
                <input type="text" id="removeBook" name="book_id">
                <button type="submit" id="removeButton">Remove this Book</button>
            </form>

        </div>
    </main>

    <footer>
        <p>&copy; 2024 370 Project. Group 9.</p>
    </footer>

</body>

</html>