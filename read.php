<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<title></title>
</head>
<body>

<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;

// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM students ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_students = $pdo->query('SELECT COUNT(*) FROM students')->fetchColumn();

?>

<div class="content read">
	<h2>List of Students</h2>
	<a href="create.php" class="create-contact">Register</a>
	<table>
        <thead>
            <tr>
                <td>ID #</td>
                <td>Last Name</td>
                <td>First Name</td>
                <td>Middle Initial</td>
                <td>Department</td>
                <td>Year</td>
                <td>Address</td>
                <td>Birthday</td>
                <td>Contact Name</td>
                <td>Contact Number</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
            <tr>
                <td><?=$student['ID']?></td>
                <td><?=$student['LN']?></td>
                <td><?=$student['FN']?></td>
                <td><?=$student['MI']?></td>
                <td><?=$student['Department']?></td>
                <td><?=$student['Year']?></td>
                <td><?=$student['Address']?></td>
                <td><?=$student['Bday']?></td>
                <td><?=$student['ContName']?></td>
                <td><?=$student['ContNum']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$student['ID']?>" class="edit">Update</a>
                    <a href="delete.php?id=<?=$student['ID']?>" class="trash">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_students): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>



</body>
</html>