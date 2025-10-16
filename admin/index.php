<?php
include('../admin/lib/users_lib.php');
include('../admin/lib/permission.php');
onlyPosterAndAdmincanAccess();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/src/output.css">
    <link rel="stylesheet" href="/weshare/assets/css/style.css">
</head>

<body class="">
    <!-- header -->
    <?php
    include './include/navbar.php'
    ?>

    <!-- Sidebar -->
    <?php
    include './include/sidebar.php'
    ?>
    <!-- main content -->
    <main>
        <div class="table-container mt-8">
            <p>hi</p>
        </div>
    </main>
</body>

</html>