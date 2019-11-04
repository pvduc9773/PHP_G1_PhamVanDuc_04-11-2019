<?php
session_start();
include_once("../models/user.php");
include_once("../models/contacts.php");

?>
<?php
    $user = unserialize($_SESSION["user"]);
    if ($user == null) {
        header("location:login.php");
    }
    $contacts = array();
    $key = "";
    if (isset($_REQUEST["key_search"])) {
        $key = $_REQUEST["key_search"];
        $contacts = Contacts::getContactsByKeySearch($user[0]->id, $key);
    } else {
        $contacts = Contacts::getContactsFromDatabase($user[0]->id);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Contacts Manager</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">

    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body id="page-top">
    
    <div class="logout">
        <button type="button" class="btn btn-outline-primary">
            <a href="logout.php">Logout</a>
        </button>
    </div>
    

    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>List <b>Contacts</b></h2></div>
                    <div class="col-sm-1">
                        <button type="button" class="btn btn-outline-primary">
                            <a href="contacts_detail.php">Add Contacts</a>
                        </button>
                    </div>
                    <div class="col-sm-3">
                        <div class="search-box">
                            <form action="index.php">
                                <i class="material-icons">&#xE8B6;</i>
                                <input type="text" class="form-control" placeholder="Search&hellip;" name="key_search" value="<?php echo $key?>">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($contacts as $key => $value) {
                    ?>
                        <tr>
                            <td><?php echo $value->id?></td>
                            <td><?php echo $value->name?></td>
                            <td><?php echo $value->phone?></td>
                            <td><?php echo $value->email?></td>
                            <td>
                                <a href="contacts_detail.php?id=<?php echo $value->id?>" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                <a href="contacts_manager.php?action=delete&id=<?php echo $value->id?>" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                            </td>
                        </tr> 
                    <?php 
                        }
                    ?>       
                </tbody>
            </table>
            
        </div>
    </div>     
	<!-- Bootstrap core JavaScript-->
	<script src="../vendor/jquery/jquery.min.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- Core plugin JavaScript-->
	<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
</body>
</html>