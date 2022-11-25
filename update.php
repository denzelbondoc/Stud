<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Update</title>
</head>
<body>

<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $ln = isset($_POST['ln']) ? $_POST['ln'] : '';
        $fn = isset($_POST['fn']) ? $_POST['fn'] : '';
        $mi = isset($_POST['mi']) ? $_POST['mi'] : '';
        $department = isset($_POST['department']) ? $_POST['department'] : '';
        $year = isset($_POST['year']) ? $_POST['year'] : '';
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        $bday = isset($_POST['bday']) ? $_POST['bday'] : date('Y-m-d H:i:s');
        $contname = isset($_POST['contname']) ? $_POST['contname'] : '';
        $contnum = isset($_POST['contnum']) ? $_POST['contnum'] : '';
        // Update the record
        $stmt = $pdo->prepare('UPDATE students SET ID = ?, LN = ?, FN = ?, MI = ?, Department = ?, Year = ?, Address = ?, Bday = ?, ContName = ?, ContNum = ? WHERE ID = ?');
        $stmt->execute([$id, $ln, $fn, $mi, $department, $year, $address, $bday, $contname, $contnum, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM students WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $students = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$students) {
        exit('Student doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>

<?=template_header('Read')?>
<?php if ($msg): ?>
    <p class="text-center"><?=$msg?></p>
    <?php endif; ?>

<div class="content update">
    <h2>Update Contact #<?=$students['ID']?></h2>
    <form action="update.php?id=<?=$students['ID']?>" method="post">
        <label for="id">ID</label>
        <label for="name">First Name</label>
        <input type="text" name="id" placeholder="183251626" value="<?=$students['ID']?>" id="id" maxlength="9">
        <input type="text" name="fn" placeholder="Juan" value="<?=$students['FN']?>" id="fn">
        <label for="fn">Last Name</label>
        <label for="mi">Middle Initial</label>
        <input type="text" name="ln" placeholder="Dela Cruz" value="<?=$students['LN']?>" id="ln">
        <input type="text" name="mi" placeholder="A" value="<?=$students['MI']?>" id="mi">
        <label for="department">Department</label>
        <label for="year">Year</label>
        <input type="text" name="department" placeholder="CITCS" value="<?=$students['Department']?>" id="department">
        <input type="text" name="year" placeholder="Second" value="<?=$students['Year']?>" id="year">
        <label for="address">Address</label>
        <label for="birthday">Birthday</label>
        <input type="text" name="address" placeholder="Aurora Hill" value="<?=$students['Address']?>" id="address">
        <input type="date" name="bday" value="<?=date($students['Bday'])?>" id="bday">
        <label for="contname">Contact Name</label>
        <label for="contnum">Contact Number</label>
        <input type="text" name="contname" placeholder="Nena Dela Cruz" value="<?=$students['ContName']?>" id="contname">
        <input type="text" name="contnum" placeholder="09563365284" value="<?=$students['ContNum']?>" id="contnum">
        <input type="submit" value="Update" href="read.php">
    </form>
</div>

</body>
</html>