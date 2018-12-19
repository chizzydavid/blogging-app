<?php
  require_once('config.php');

  class DATABASE {
    public function __construct() {
      $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
      $this->conn = $mysqli;
      if(!$mysqli) echo 'Failed to connect '. $mysqli->error;
    }

    public function clean($string) {
      $trimstring = trim($string);
      $string = $this->conn->real_escape_string($trimstring);
      return $string; 
    }

    public function pass_secure($password, $nonce) {
      $securepass = hash_hmac('sha512', $password.$nonce, SALT);
      return $securepass;
    }

    public function insert($table, $fields, $values) {
      $fields = implode(", ", $fields);
      $values = implode(", ", $values);

      $query = "INSERT INTO $table ($fields) VALUES($values)";
      $insert = $this->conn->query($query);
      if ($insert) return $insert;
      else 
        echo '<pre>' . $this->conn->error;
        return false;
    }

    public function update($query) {
      $result = $this->conn->query($query);
      return $result;
    }

    public function select($query) {
      $result = $this->conn->query($query);
      if($result) {
      }
      return $result;
    }

    public function slug($text) {
      $text = preg_replace('~[^pLD]+~u', '-', $text);
      $text = trim($text, '-');
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
      $text = strtolower($text);
      $text = preg_replace('~[^-w]+~', '', $text);
      if (empty($text)) return 'n-a';
      return $text;
    }
  }

  $db = new DATABASE;

  /*function match_phone($str) {
    $regx_two = "/^0[7-9][01]\d{1}(\s)?\d{3}(\s)?\d{4}|(\+234)(\s)?[7-9][01]\d{1}(\s)?\d{3}(\s)?\d{4}$/";

    if(preg_match($regx_two, $str)) {
      echo "match successful";
      $newstr = preg_replace('/\s/', '', $str);
      echo "<br>". $newstr;
    } else {
      echo "string doesn't match";
    }    
    //echo $result;
    //return $result;
  }

  function match_email($email) {
    $regx_two = "/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/";

    if(preg_match($regx_two, $email)) {

      $domain = preg_replace('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/', '', $email);
      if(!checkdnsrr($domain)) {
        echo "Please enter a valid email address.";
      } 
    } else {
      echo "Invalid email address.";
    }    
  }
INSERT INTO blog_posts (ID, postTitle, postSlug, postAuthor, postDesc, featuredImage, postContent, postDate) VALUES(0, 'new title', 'n-a', 'eee', 'aweta', 'http://localhost/Projects/Blog_Application/images/portraitone.jpg', '<section class="blog-container" id="blog-container"><p>srtataw</p></section>', now())

  */

?>



