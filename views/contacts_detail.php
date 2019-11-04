<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Contacts Detail</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
    <!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"-->
</head>

<body id="page-top">
<?php 
        include_once("../models/contacts.php");
        $id = $name = $phone = $email = "";

        if (isset($_REQUEST["id"])) {
            $id = $_REQUEST["id"];
            $contacts = Contacts::getContactsById($id);
            $name = $contacts[0]->name;
            $phone = $contacts[0]->phone;
            $email = $contacts[0]->email;
        }
        var_dump($id);
?>

    <!--Content-->
    <div class="modal-content">
    <!--Header-->
        <div class="modal-header">
            <h3 class="modal-title">Contacts</h3>
        </div>

        <!--Body-->
        <div class="modal-body">
            <form action="contacts_manager.php" method="POST" id="insert_form" enctype="multipart/form-data">
                <div >
                    <input type="hidden" name=id value="<?php echo $id ?>" />
                    <label>Tên</label>
                    <input type="text" name="txtName"  id="txtName"  class="form-control" value="<?php echo $name; ?>" />
                    <label>Số điện thoại</label>
                    <input type="text" name="txtPhone"  id="txtPhone" class="form-control" value="<?php echo $phone; ?>"/>
                    <label>Email</label>
                    <input type="text" name="txtEmail"  id="txtEmail" class="form-control" value="<?php echo $email; ?>" />
                    <br/>
                    <input type="submit" name="insert" id="insert" value="Lưu" class="btn btn-success" />
                </div>
            </form>
        </div>
    </div>

<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Page level plugin JavaScript-->
<script src="../vendor/chart.js/Chart.min.js"></script>
<script src="../vendor/datatables/jquery.dataTables.js"></script>
<script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

<!-- Custom scripts for all pages-->
<script src="../js/sb-admin.min.js"></script>

<!-- Demo scripts for this page-->
<script src="../js/demo/datatables-demo.js"></script>
<script src="../js/demo/chart-area-demo.js"></script>

<!-- Xử lý sự kiện Add-->
<!-- script src="../../vendor/jquery/event.js"></script -->

</body>

</html>