<?php
  require_once('../classes/admin-class.php');
  $loggedIn = $ac->checklogin();
  $title = 'Blog Login Page';
  require_once('admin-header.php');  
  $ac->login();

?>
  <h2 class="mb-3">Sign In</h2>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="login">
      <?php //echo $_FILES['portrait']['type'];//print_r($_POST);?>
      <p><input name="username" placeholder="Username" type="text" value="<?php if(!empty($_POST['username'])) echo $_POST['username'] ?>"></p>
      <p><input name="password" placeholder="Password" type="password"></p>


      <div class='submit'>
        <input class='mb-2' type='submit' name='submit' value='Login'>
      </div>
      
    </div>  
  </form>
<?php  require_once('admin-footer.php');  ?>