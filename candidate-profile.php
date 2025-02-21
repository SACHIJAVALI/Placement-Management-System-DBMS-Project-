<?php
include './header.php';
require './src/Database.php';

$db = Database::getInstance();
$user = $_SESSION['user'];

$sql = "SELECT * FROM users WHERE id = '$user->id'";
$res = $db->query($sql);

$candidate = $res->fetch_object();


?>
<style>
    body {
        font-family: Arial, sans-serif;

    }

    .profile-container {
        width: 50%;
        margin: auto;
        border: 1px solid #ddd;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        margin-top: 50px;
        margin-bottom: 20px;
    }

    .profile-container h2 {
        text-align: center;
    }

    .profile-field {
        margin-bottom: 10px;
    }

    .resume-link {
        color: blue;
        text-decoration: none;
    }

    .resume-link:hover {
        text-decoration: underline;
    }
</style>

<div class="profile-container">
    <h2>Candidate Profile</h2>
    <p class="profile-field"><strong>Name:</strong> <?php echo htmlspecialchars($candidate->name); ?></p>
    <p class="profile-field"><strong>Email:</strong> <?php echo htmlspecialchars($candidate->email); ?></p>
    <p class="profile-field"><strong>Resume:</strong>
        <?php if (!empty($candidate->resume)): ?>
            <a class="resume-link" href="./resume/<?php echo htmlspecialchars($candidate->resume); ?>" target="_blank">View Resume</a>
        <?php else: ?>
            No resume uploaded
        <?php endif; ?>
    </p>
</div>

<?php include './footer.php' ?>