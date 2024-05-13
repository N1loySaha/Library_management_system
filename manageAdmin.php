<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Member</title>
    <link rel="stylesheet" href="./styles/addMember.css">
    <link rel="stylesheet" href="./styles/main.css">
    <script>
        function clearForm() {
            document.getElementById("form1").reset();
            document.getElementById("form2").reset();
        }
        window.onload = clearForm;
    </script>
</head>
<body>
    <?php
    session_start();
    include 'adminNav.php';
    ?>
    <main><div>
        <h2>Add New Admin</h2>
        <form id="form1" action="./processAddAdmin.php" method="post">
            <label for="member_id">Admin ID: <span class="required">*</span></label>
            <input type="text" id="member_id" name="admin_id" required><br>
            <label for="member_password">Password: <span class="required">*</span></label>
            <input type="password" id="member_password" name="admin_password" required><br>
            <label for="f_name">First Name: <span class="required">*</span></label>
            <input type="text" id="f_name" name="f_name" required><br>
            <label for="l_name">Last Name: <span class="required">*</span></label>
            <input type="text" id="l_name" name="l_name" required><br>
            <label for="email">Email: <span class="required">*</span></label>
            <input type="email" id="email" name="email" required><br>
            <!-- <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone"><br> -->
            <button type="submit">Add Admin</button>
        </form>
    </div>
    <div>
        <h2>Remove Admin</h2>
        <form id="form2" action="./processRemoveAdmin.php" method="post">
            <label for="member_id">Admin ID: <span class="required">*</span></label>
            <input type="text" id="member_id" name="admin_id" required><br>
            <button type="submit">Remove Admin</button>
        </form>
    </div>
</main>
    <footer>
        <p>&copy; 2024 370 Project. Group 9.</p>
    </footer>
</body>

</html>


<!-- sabid -->