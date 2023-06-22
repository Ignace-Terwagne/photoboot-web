<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <div class="container">
    <div class="card mx-auto mt-5">
      <div class="card-header">
        <h3 class="text-center">Login</h3>
      </div>
      <div class="card-body">
        <form action="" method="post" name="Login_Form">
          <?php if (isset($msg)) { ?>
            <div class="alert alert-danger">
              <?php echo $msg; ?>
            </div>
          <?php } ?>
          <div class="form-group">
            <label for="Username">Username</label>
            <input name="Username" type="text" class="form-control">
          </div>
          <div class="form-group">
            <label for="Password">Password</label>
            <input name="Password" type="password" class="form-control">
          </div>
          <div class="text-center">
            <input name="Submit" type="submit" value="Login" class="btn btn-primary">
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

<?php
session_start(); /* Starts the session */

/* Check Login form submitted */
if (isset($_POST['Submit'])) {
  /* Define username and associated password array */
  $logins = json_decode(file_get_contents("../secure/users.json"), true);

  /* Check and assign submitted Username and Password to new variable */
  $Username = isset($_POST['Username']) ? $_POST['Username'] : '';
  $Password = isset($_POST['Password']) ? $_POST['Password'] : '';

  /* Check Username and Password existence in defined array */
  if (isset($logins[$Username]) && $logins[$Username] == $Password) {
    /* Success: Set session variables and redirect to Protected page  */
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $Username;
    header("location:../dashboard");
    exit;
  } else {
    /* Unsuccessful attempt: Set error message */
    $msg = "<span style='color:red'>Invalid Login Details</span>";
  }
}
?>
