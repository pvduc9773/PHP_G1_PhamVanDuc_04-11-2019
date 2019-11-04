<?php 
    class Contacts {
        var $id;
        var $name;
        var $phone;
        var $email;
        var $idUser;

        function __construct($_id, $_name, $_phone, $_email, $_idUser) {
            $this->id = $_id;
            $this->name = $_name;
            $this->phone = $_phone;
            $this->email = $_email;
            $this->idUser = $_idUser;
        }

        static function getContactsFromDatabase($id_user) {
            // Mở kết nối với DB
            // localhost - userName - password- name DB
            $conn = new mysqli("localhost", "root", "", "contacts");
            $conn->set_charset("utf8");
            if ($conn->connect_error)
                die("Kết nối thất bại: " . $conn->connect_error);
            // Thao tác với DB: CRUD
            $query = "SELECT * FROM contacts WHERE iduser=$id_user";
            $result = $conn->query($query);
            $rs = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                        array_push($rs, new Contacts(
                            $row["id"],
                            $row["name"],
                            $row["phone"],
                            $row["email"],
                            $row["iduser"]
                        ));
                    
                }
            }
            // Đóng kết nối với DB
            $conn->close();
            return $rs;
        }

        static function getContactsByKeySearch($id_user, $key) {
            // Mở kết nối với DB
            // localhost - userName - password- name DB
            $conn = new mysqli("localhost", "root", "", "contacts");
            $conn->set_charset("utf8");
            if ($conn->connect_error)
                die("Kết nối thất bại: " . $conn->connect_error);
            // Thao tác với DB: CRUD
            $query = "SELECT * FROM contacts WHERE iduser=$id_user AND name LIKE '%$key%'";
            $result = $conn->query($query);
            $rs = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                        array_push($rs, new Contacts(
                            $row["id"],
                            $row["name"],
                            $row["phone"],
                            $row["email"],
                            $row["iduser"]
                        ));
                    
                }
            }
            // Đóng kết nối với DB
            $conn->close();
            return $rs;
        }

        static function getContactsById($id) {
            // Mở kết nối với DB
            // localhost - userName - password- name DB
            $conn = new mysqli("localhost", "root", "", "contacts");
            $conn->set_charset("utf8");
            if ($conn->connect_error)
                die("Kết nối thất bại: " . $conn->connect_error);
            // Thao tác với DB: CRUD
            $query = "SELECT * FROM contacts WHERE id=$id";
            $result = $conn->query($query);
            $rs = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($rs, new Contacts(
                        $row["id"],
                        $row["name"],
                        $row["phone"],
                        $row["email"],
                        $row["iduser"]
                    ));
                }
            }
            // Đóng kết nối với DB
            $conn->close();
            return $rs;
        }

        static function addContactsFromDatabase($_name, $_phone, $_email, $_iduser) {
            $conn = new mysqli("localhost", "root", "", "contacts");
            $conn->set_charset("utf8");
            if ($conn->connect_error)
                die("Kết nối thất bại: " . $conn->connect_error);
            $query = "INSERT INTO contacts (name, phone, email, iduser) VALUES ('$_name', '$_phone', '$_email', '$_iduser')";
            $result = $conn->query($query);
            $conn->close();
        }

        static function updateContactsFromDatabase($_id, $_name, $_phone, $_email) {
            $conn = new mysqli("localhost", "root", "", "contacts");
            $conn->set_charset("utf8");
            if ($conn->connect_error)
                die("Kết nối thất bại: " . $conn->connect_error);
            $query = "UPDATE contacts SET name='$_name', phone='$_phone', email='$_email' WHERE id='$_id'";
            $result = $conn->query($query);
            var_dump($result);
            $conn->close();
        }

        static function deleteContactsFromDatabase($_idContacts) {
            $conn = new mysqli("localhost", "root", "", "contacts");
            $conn->set_charset("utf8");
            if ($conn->connect_error)
                die("Kết nối thất bại: " . $conn->connect_error);
            $query = "DELETE FROM contacts WHERE id='$_idContacts'";
            $result = $conn->query($query);
            $conn->close();
        }
    }
?>