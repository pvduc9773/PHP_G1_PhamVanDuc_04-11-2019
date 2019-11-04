<?php 
    class User {
        var $id;
        var $userName;
        var $password;

        function __construct($_id, $_userName, $_pass) {
            $this->id = $_id;
            $this->userName = $_userName;
            $this->password = $_pass;
        }

        static function login($_user, $_password) {
            // Mở kết nối với DB
            // localhost - userName - password- name DB
            $conn = new mysqli("localhost", "root", "", "contacts");
            $conn->set_charset("utf8");
            if ($conn->connect_error)
                die("Kết nối thất bại: " . $conn->connect_error);
            // Thao tác với DB: CRUD
            $query = "SELECT * FROM user WHERE username='$_user' AND password='$_password'";
            $result = $conn->query($query);
            $accounts = array();
            if ($result->num_rows != null) {
                while ($row = $result->fetch_assoc()) {
                    array_push($accounts, new User(
                        $row["id"],
                        $row["username"],
                        $row["password"]
                    ));
                }
            }
            // Đóng kết nối với DB
            $conn->close();
            return $accounts;
        }
    }
?>