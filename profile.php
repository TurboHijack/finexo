<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $contact = $_POST['contact'];

    // Handle profile picture upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
        move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file);
    } else {
        $target_file = $user['profile_picture'];
    }

    $stmt = $pdo->prepare("UPDATE users SET name = ?, contact = ?, profile_picture = ? WHERE id = ?");
    $stmt->execute([$name, $contact, $target_file, $user_id]);
    header("Location: profile.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile - Finexo</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <div class="container">
        <h2>Profile</h2>
        <form method="POST" action="profile.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $user['name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="contact">Contact</label>
                <input type="text" name="contact" class="form-control" value="<?php echo $user['contact']; ?>" required>
            </div>
            <div class="form-group">
                <label for="profile_picture">Profile Picture</label>
                <input type="file" name="profile_picture" class="form-control">
                <?php if ($user['profile_picture']): ?>
                    <img src="<?php echo $user['profile_picture']; ?>" alt="Profile Picture" style="width:100px;">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
</body>
</html>
