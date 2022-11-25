<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="styles.css">
  <title>Student ID Form</title>
</head>

<body>

  <?php
    include 'functions.php';
    $pdo = pdo_connect_mysql();
    $msg = '';
    
    if (!empty($_POST)) {
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $fname = isset($_POST['fname']) ? $_POST['fname'] : '';
    $lname = isset($_POST['lname']) ? $_POST['lname'] : '';
    $mi = isset($_POST['mi']) ? $_POST['mi'] : '';
    $deptname = isset($_POST['deptname']) ? $_POST['deptname'] : '';
    $yr = isset($_POST['yr']) ? $_POST['yr'] : '';
    $addrss = isset($_POST['addrss']) ? $_POST['addrss'] : '';
    $bday = isset($_POST['bday']) ? $_POST['bday'] : date('Y-m-d H:i:s');
    $cont = isset($_POST['cont']) ? $_POST['cont'] : '';
    $num = isset($_POST['num']) ? $_POST['num'] : '';
    
    $stmt = $pdo->prepare('INSERT INTO students VALUES (?, ?, ?, ?, ?, ?,?,?,?,?)');
    $stmt->execute([$id, $fname, $lname, $mi, $deptname, $yr, $addrss, $bday, $cont, $num]);
    // Output message
    $msg = 'Created Successfully!';
}
  ?>
  <?php if ($msg): ?>
        <p class="text-center"><?=$msg?></p>
        <?php endif; ?>

  <?=template_header('Create')?>

  <div class="container">
    <header class="header">
      <h1 id="title" class="text-center">Student ID Form</h1>
    </header>

    <form id="student-form" action="create.php" method="post">
      <div class="form-group">
        <label id="number-label" for="number">
          Student I.D. number:<span class="clue"></span>
        </label>
      
      <input
      type="text"
      name="id"
      id="number"
      maxlength="9"
      size="20"
      class="form-control"
      placeholder="Enter your I.D. number here"
      required
      />
    </div>

    <div class="form-group">
      <label id="name-label" for="name">Last Name</label>
      <input
      type="text"
      name="lname"
      id="name"
      maxlength="20"
      class="form-control"
      placeholder="Enter your last name here"
      required
      />
    </div>

    <div class="form-group">
      <label id="name-label" for="name">First Name</label>
      
      <input
      type="text"
      name="fname"
      id="name"
      maxlength="30"
      class="form-control"
      placeholder="Enter your first name here"
      required
      />
    </div>

    <div class="form-group">
      <label id="name-label" for="name">Middle Initial</label>
      
      <input
      type="text"
      name="mi"
      id="name"
      maxlength="1"
      class="form-control"
      placeholder="Enter your middle initial here"
      required
      />
    </div>
    
    <div class="form-group">
      <p>Which College department are you in?</p>
      <select id="dropdown" name="deptname" class="form-control" required>
        <option disabled selected value>Select department</option>
        <option>CCJE</option>
        <option>CTE</option>
        <option>CAS</option>
        <option>CEA</option>
        <option>CON</option>
        <option>CITCS</option>
        <option>COA</option>
        <option>CBA</option>
        <option>CHTM</option>
        <option>COL</option>
      </select>
    </div>

    <div class="form-group">
      <p>Year Level:</p>
      <label>
        <input
        name="yr"
        value="first"
        type="radio"
        maxlength="3"
        class="input-radio"
        />1st Year</label>
        
        <label>
          <input
          name="yr"
          value="second"
          type="radio"
          class="input-radio"
          />2nd Year</label>

          <label>
            <input
            name="yr"
            value="third"
            type="radio"
            class="input-radio"
            />3rd Year</label>
          </div>

          <label id="name-label" for="name">Infomation &#38; Emergency Contact
          </label>

          <div class="form-group">
            <label id="number-label" for="number">
              Address:<span class="clue"></span>
            </label>
            <input
            type="text"
            name="addrss"
            id="name"
            maxlength="80"
            class="form-control"
            placeholder="Enter your address here"
            required
            />
          </div>

          <div class="form-group">
            <label id="number-label" for="number">
              Birthday:<span class="clue"></span>
            </label>

            <input
            type="date"
            name="bday"
            id="name"
            class="form-control"
            required
            />
          </div>

          <div class="form-group">
            <label id="number-label" for="number">
              Emergency Contact:<span class="clue"></span>
            </label>

            <input
            type="text"
            name="cont"
            id="name"
            maxlength="50"
            class="form-control"
            placeholder="Enter name here"
            required
            />
          </div>

          <div class="form-group">
            <label id="number-label" for="number">
              Contact Number<span class="clue"></span>
            </label>

            <input
            type="text"
            name="num"
            id="number"
            maxlength= "11"
            class="form-control"
            placeholder="Enter Mobile number here"
            required
            />
          </div>
          <div class="form-group">
            <button type="submit" id="submit" class="submit-button">
              Submit
            </button>
          </div>
        </form>
        
      </div>
     
</body>
</html>