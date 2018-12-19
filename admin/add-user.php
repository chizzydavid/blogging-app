<?php

  require_once('../classes/admin-class.php');
  $loggedIn = $ac->checklogin();
  $title = 'Add User';
  $page_title = 'add-user';  
  require_once('admin-header.php');  
  $ac->signup();

?>
  <h2 class="mb-3">Fill the form below</h2>
  <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="login">

      <p><input name="fullname" placeholder="Full name" type="text" value="<?php if(!empty($_POST['fullname'])) echo $_POST['fullname'] ?>"></p>
      <p><input name="username" placeholder="Username" type="text" value="<?php if(!empty($_POST['username'])) echo $_POST['username'] ?>"></p>
      <p><input name="password" placeholder="Password" type="password"></p>
      <p><input name="password2" placeholder="Confirm Password" type="password"></p>
      <p><input name="phone" placeholder="Phone number" type="text" value="<?php if(!empty($_POST['phone'])) echo $_POST['phone']?>"> </p>     
      <p><input name="email" placeholder="E-Mail Address" type="email" value="<?php if(!empty($_POST['email'])) echo $_POST['email'] ?>"></p>
      <p><label>Gender</label>  
        <select name="gender">
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>

      <p><textarea id="message" name="bio" placeholder="Say something about yourself" rows="7" cols="35"><?php if(!empty($_POST['bio'])) echo $_POST['bio'] ?></textarea><br /></p>
      <p><label for="portrait">Portrait:</label>
      <input type="file" id="portrait" name="portrait"/></p>
      <input name="date" type="hidden" value="<?php echo time(); ?>">

      <div class='submit'>
        <input class='mb-2' type='submit' name='submit' value='Register'>
        <p style="font-size:14px">Already a user?<a href='login.php'> Login Here</a></p>
      </div>
      
    </div>  
  </form>

<?php
  require_once('admin-footer.php');
?>