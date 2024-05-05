<?php
    class userRegister {
        private $conn;
        private $name;
        private $email;
        private $password;
        private $user_type;
    
        public function __construct($conn, $name, $email, $password, $user_type) {
            $this->conn = $conn;
            $this->name = mysqli_real_escape_string($conn, $name);
            $this->email = mysqli_real_escape_string($conn, $email);
            $this->password = mysqli_real_escape_string($conn, md5($password));
            $this->user_type = $user_type;
        }
    
        public function register() {
            $select_users = mysqli_query($this->conn, "SELECT * FROM `users` WHERE email = '$this->email' AND password = '$this->password'") or die('query failed');
    
            if(mysqli_num_rows($select_users) > 0){
                return 'user already exist!';
            } else {
                mysqli_query($this->conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$this->name', '$this->email', '$this->password', '$this->user_type')") or die('query failed');
                return 'registered successfully!';
            }
        }
    }

?>