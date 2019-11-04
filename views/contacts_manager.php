<?php
    session_start();
    include_once("../models/user.php");
    include_once("../models/contacts.php");
    $user = unserialize($_SESSION["user"]);
    
    $action = $id = $name = $phone = $email = $iduser = "";
    
    if ($user == null) {
        header("location:login.php");
    } else {
        $iduser = $user[0]->id;
    }

    if (isset($_REQUEST["id"])) {
        $id = $_REQUEST["id"];
        // Xóa
        if ($id != "") {
            if (isset($_REQUEST["action"])) {
                $action = $_REQUEST["action"];
                Contacts::deleteContactsFromDatabase($id);
                header("location: index.php");
            } else {
                // Sửa
                $name = $_REQUEST["txtName"];
                $phone = $_REQUEST["txtPhone"];
                $email = $_REQUEST["txtEmail"];
                Contacts::updateContactsFromDatabase($id, $name, $phone, $email);
                header("location: index.php");
            }
        } else {
            // Thêm
            $name = $_REQUEST["txtName"];
            $phone = $_REQUEST["txtPhone"];
            $email = $_REQUEST["txtEmail"];
            Contacts::addContactsFromDatabase($name, $phone, $email, $iduser);
            header("location: index.php");
        }
    }
?>