<?php 
    class userLogin {
        private $conn;
        private $email;
        private $password;
    
        public function __construct($conn, $email, $password) {
            $this->conn = $conn;
            $this->email = mysqli_real_escape_string($conn, $email);
            $this->password = mysqli_real_escape_string($conn, md5($password));
        }
    
        public function login() {
            $select_users = mysqli_query($this->conn, "SELECT * FROM `users` WHERE email = '$this->email' AND password = '$this->password'") or die('query failed');
    
            if(mysqli_num_rows($select_users) > 0){
                $row = mysqli_fetch_assoc($select_users);
    
                if($row['user_type'] == 'admin'){
                    $_SESSION['admin_name'] = $row['name'];
                    $_SESSION['admin_email'] = $row['email'];
                    $_SESSION['admin_id'] = $row['id'];
                    header('location:admin_page.php');
                }elseif($row['user_type'] == 'user'){
                    $_SESSION['user_name'] = $row['name'];
                    $_SESSION['user_email'] = $row['email'];
                    $_SESSION['user_id'] = $row['id'];
                    header('location:home.php');
                }
            } else {
                return 'incorrect email or password!';
            }
        }
    }

?>