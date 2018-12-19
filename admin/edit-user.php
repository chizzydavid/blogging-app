<?php
  require_once('../classes/admin-class.php');
  $loggedIn = $ac->checklogin();
  $title = 'Edit User Profile';
  require_once('admin-header.php');  
  $user = $ac->edit_user_profile();

?>
  <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="login">

      <p><input name="fullname" placeholder="Full name" type="text" value="<?php if(!empty($user['fullname'])) echo $user['fullname'] ?>"></p>
      <p><input name="username" placeholder="Username" type="text" value="<?php if(!empty($user['username'])) echo $user['username'] ?>"></p>
      <p><input name="password" placeholder="Password" type="password"></p>
      <p><input name="password2" placeholder="Confirm Password" type="password"></p>
      <p><input name="phone" placeholder="Phone number" type="text" value="<?php if(!empty($user['phone'])) echo $user['phone']?>"> </p>     
      <p><input name="email" placeholder="E-Mail Address" type="email" value="<?php if(!empty($user['email'])) echo $user['email'] ?>"></p>
      <p><label>Gender</label>  
        <select name="gender">
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>

      <p><textarea id="message" name="bio" placeholder="Say something about yourself" rows="7" cols="35"><?php if(!empty($user['bio'])) echo $user['bio'] ?></textarea><br /></p>
      <p><label for="portrait">Portrait:</label>
      <input type="file" id="portrait" name="portrait"/></p>
      <input name="date" type="hidden" value="<?php echo time(); ?>">

      <div class='submit'>
        <input class='mb-2' type='submit' name='submit' value='Save Changes'>
        <a class='submit' href="index.php">Cancel</a>
      </div>
      
    </div>  
  </form>
<?php
  require_once('admin-footer.php');
?>