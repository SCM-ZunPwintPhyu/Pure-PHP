<?php  include('php_code.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Pure PHP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="js/index.js"></script>
</head>
<body>
    <?php if (isset($_SESSION['message'])): ?>
    <div id="message_alert">
        <?php
			echo $_SESSION['message']; 
            ini_set('max_execution_time', 100);
			unset($_SESSION['message']);
		?>
    </div>
    <?php endif ?>
    <?php $results = mysqli_query($db, "SELECT * FROM user"); ?>
    <?php 
        if (isset($_GET['edit'])) {
            $id = $_GET['edit'];
            $update = true;
            $record = mysqli_query($db, "SELECT * FROM user WHERE id=$id");

            if (count($record) == 1 ) {
                $n = mysqli_fetch_array($record);
                $name = $n['name'];
                $address = $n['address'];
            }
        }
    ?>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <?php while ($row = mysqli_fetch_array($results)) { ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td>
                <a href="index.php?edit=<?php echo $row['id']; ?>" class="edit_btn">Edit</a>
            </td>
            <td>
                <a href="php_code.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <form method="post" action="php_code.php">
        <div class="input-group">
            <?php if ($update == true): ?>
            <!-- newly added field -->
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <!-- modified form fields -->
            <input type="text" name="name" value="<?php echo $name; ?>">
            <input type="text" name="address" value="<?php echo $address; ?>">
            <button class="update_btn" type="submit" name="update" style="background: #556B2F;">update</button>
            <?php else: ?>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="input-group">
                <label>Name</label>
                <input type="text" name="name" value="">
            </div>
            <div class="input-group">
                <label>Address</label>
                <input type="text" name="address" value="">
            </div>
            <button class="save_btn" type="submit" name="save">Save</button>
            <?php endif ?>
        </div>
    </form>
</body>
</html>