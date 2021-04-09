<?php

class Member {

  private $id;
  private $name;
  private $phonenum;
  private $email;
  private $status;
  private $siderow;
  private $bio;
  // Maybe don't need all of these?

  public function __construct() {
    $this->id = NULL;
    $this->name = NULL;
    $this->phonenum = NULL;
    $this->email = NULL;
    $this->status = "member";
    $this->siderow = NULL;
    $this->bio = NULL;
  }

  public function __destruct() {

  }

  public function addAccount(string $membername, string $memberphoneno, string $memberemail, string $memberstatus, string $membersiderow, string $memberbio, string $passwd, ): int {
    // connect to datbase
    $conn = mysqli_connect("localhost", "root", "root", "rowing");

    $passwd = trim($passwd);

    if (!this->isPasswordValid($passwd)) {
      throw new Exception('Invalid password!');
    }

    $hash = password_hash($passwd, PASSWORD_DEFAULT);

    $sql = "INSERT INTO member VALUES'(NULL,'$membername','$memberphoneno','$memberemail','$memberstatus','$membersiderow','$memberbio','$hash');"
    $insert = mysqli_query($conn, $sql);

    if(!$insert)
        {
            echo mysqli_error();
        }
        else
        {
            echo "Account created";
        }

    mysqli_close($conn);
  }

  public function accountLogin(string $email, string $password) {
     $conn = mysqli_connect("localhost", "root", "root", "rowing");
          $getdbPassword = mysqli_query($conn, 'SELECT memberpassword FROM member WHERE (memberemail = $inputemail)');
          echo $getdbPassword;
          $getuserid = mysqli_query($conn, 'SELECT memberid FROM member WHERE (memberemail = $inputemail)');
          echo $getuserid;
          if (password_verify($inputpassword, $getdbPassword)) {
            // global user ID = $getuserid;
            // register session (???)
            echo 'SUCCESS';
            return TRUE;
          }
          mysqli_close($conn);
  }


  // /* Check the password is valid */
  public function isPasswdValid(string $memberpasswd): bool {
    /* Initialize the return variable */
    $valid = TRUE;
    
    /* Example check: the length must be 8 characters or more */
    $len = mb_strlen($passwd);
    if ($len <= 8)
    { $valid = FALSE; }
    
    /* add more checks here */
    
    return $valid;
  }
}
?>