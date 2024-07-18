<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="css/user-dashboard.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="#">Case Management</a></li>
                <li><a href="#">Reports and Analytics</a></li>
                <li><a href="#">Security Settings</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="welcome-message">
            <h1>Welcome, <?php echo $_SESSION['username'];?></h1>
        </section>
        <section class="user-profile">
            <h2>User Profile</h2>
            <form>
                <label for="profile-picture">Profile Picture:</label>
                <input type="file" id="profile-picture" name="profile-picture">
                <br>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $_SESSION['name'];?>">
                <br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $_SESSION['email'];?>">
                <br>
                <label for="contact-info">Contact Information:</label>
                <input type="text" id="contact-info" name="contact-info" value="<?php echo $_SESSION['contact_info'];?>">
                <br>
                <button type="submit">Update Profile</button>
            </form>
        </section>
    </main>
    <script src="js/user-dashboard.js"></script>
</body>
</html>
