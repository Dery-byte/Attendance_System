<?php
include("controller.php");
require_once('../normal_user/auth_user.php');

global $db;





// ADD POSITION
if(isset($_POST['add_position']))
{
    $title = $_POST['position_title'];
    $rate = $_POST['position_rate'];

    $chkquery = "SELECT * FROM senate_position WHERE position_title = '$title' AND position_rate = '$rate'";
    $chkresult = mysqli_query($db, $chkquery);

    if(!$row = $chkresult->fetch_assoc()) {
        $sql = "INSERT INTO senate_position (position_title, position_rate) VALUES ('$title', '$rate')";
        $result = mysqli_query($db, $sql);

//    $_SESSION['success'] = "New position has been added ! ";
//    $_SESSION['expire'] =  date("H:i:s", time() + 1);

        echo '<script>
            setTimeout(function() {
                Swal.fire({
                    title: "Success !",
                    text: "position  has been added !",
                    type: "success"
                  }).then(function() {
                      window.location = "senate_positions.php";
                  });
            }, 30);
        </script>';

    }
//    else {
//        $_SESSION['error'] = "Failed to add new position ! ";
//        $_SESSION['expire'] =  date("H:i:s", time() + 1);
//    }
//    header('location: senate_positions.php');
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Positions</title>
    <link rel="icon" type="image/png" href="img/Logo.png">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="dist/js/1.js"></script>
    <script src="dist/js/2.js"></script>
    <script src="dist/js/3.js"></script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <form class="form-inline ml-3">
            <div class="input-group input-group-sm">

            </div>
        </form>

        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-user"></i>
                    <span class="hidden-xs"><?php echo $_SESSION['senator_fname']; ?> <?php echo $_SESSION['senator_lname']?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header" style="max-height: 150px; overflow:hidden; background:#222d32;">
                            <div class="image">
                                <img src="<?php echo   $_SESSION['senator_photo'];?>" style="border-radius: 50%; width:100px;height: 100px;" alt="User Image">
                            </div>
                        </span>

                    <form method="POST">
                        <button type="submit" name="logout" class="dropdown-item dropdown-footer">Logout</button>
                    </form>
                </div>
            </li>

        </ul>
    </nav>



    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: #222d32;">

        <a href="home.php" class="brand-link">
            <img src="img/Logo.png" alt="Senate Logo" class="brand-image img-circle elevation-3">
            <span class="brand-text font-weight-light">Senate Attendance</span>
        </a>


        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-flat nav-legacy nav-compact" data-widget="treeview" role="menu" data-accordion="false">

                    <li class="nav-item">
                        <a href="home.php" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="senate_attendance.php" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>
                                Attendance
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Senators
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="senate_list.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Senators</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="senate_sched.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Schedules</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!--                        <li class="nav-item">-->
                    <!--                            <a href="senate_deduction.php" class="nav-link">-->
                    <!--                                <i class="nav-icon fas fa-sticky-note"></i>-->
                    <!--                                <p>-->
                    <!--                                    Deduction-->
                    <!--                                </p>-->
                    <!--                            </a>-->
                    <!--                        </li>-->
                    <li class="nav-item">
                        <a href="senate_positions.php" class="nav-link active">
                            <i class="nav-icon fas fa-id-badge"></i>
                            <p>
                                Positions
                            </p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="senate_minutes.php" class="nav-link">
                            <i class="nav-icon fas fa-clipboard"></i>
                            <p>
                                Minutes
                            </p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Commitee
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="comm_names.php" class="nav-link">
                                    <i class="fas fa-circle nav-icon"></i>
                                    <p>Name</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="comm_members.php" class="nav-link">
                                    <i class="fas fa-circle nav-icon"></i>
                                    <p>Members</p>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="nav-item">
                        <a href="request.php" class="nav-link">
                            <i class="nav-icon fas fa-exclamation-circle"></i>
                            <p>
                                Requests
                            </p>
                        </a>
                    </li>
                    <!--                        <li class="nav-item">-->
                    <!--                            <a href="print_payroll.php" class="nav-link">-->
                    <!--                                <i class="nav-icon fas fa-money-bill-alt"></i>-->
                    <!--                                <p>Payroll</p>-->
                    <!--                            </a>-->
                    <!--                        </li>-->
                    <!--                        <li class="nav-item">-->
                    <!--                            <a href="print_sched.php" class="nav-link">-->
                    <!--                                <i class="nav-icon far fa-clock"></i>-->
                    <!--                                <p>Schedules</p>-->
                    <!--                            </a>-->
                    <!--                        </li>-->
                </ul>
            </nav>


        </div>

    </aside>

    <div class="content-wrapper">
        <div class="content-header">
            <!--                <div style="padding-top: 10px;">-->
            <!--                    <marquee onMouseOver="this.stop()" onMouseOut="this.start()"> <a href="https://www.youtube.com/@codecampbdofficial">Code Camp BD</a> is the sole owner of this script. It is not suitable for personal use. And releasing it in demo version. Besides, it is being provided for free only from <a href="https://www.youtube.com/@codecampbdofficial">Code Camp BD</a>. For any of your problems contact us on <a href="https://www.youtube.com/@codecampbdofficial">Code Camp BD</a> facebook group / page or message <a href="https://www.facebook.com/dev.mhrony">MH RONY</a> on facebook. Thanks for staying with <a href="https://www.youtube.com/@codecampbdofficial">Code Camp BD</a>.</marquee>-->
            <!--                </div>-->
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Positions</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active">Positions</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <section class="content">
            <!--                --><?php
            //      ini_set('display_errors', 0);
            //      ini_set('display_errors', false);
            //      $dd = date("H:i:s");
            //      if(isset($_SESSION['success'])) {
            //        echo "
            //          <div class='alert alert-success alert-dismissible'>
            //            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            //            <h4><i class='icon fa fa-check'></i> Success!</h4>
            //            ".$_SESSION['success']."
            //          </div>
            //        ";
            //      }
            //      if(isset($_SESSION['error'])) {
            //        echo "
            //          <div class='alert alert-danger alert-dismissible'>
            //            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            //            <h4><i class='icon fa fa-times'></i> Failed !</h4>
            //            ".$_SESSION['error']."
            //          </div>
            //        ";
            //      }
            //      if($dd == $_SESSION['expire'])
            //      {
            //        session_unset();
            //      }
            //      //session_unset();
            //      ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div align="right">
                                <button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-default"><i class="fas fa-plus"></i> New</button>
                            </div><br>
                            <table id="example1" class="table table-bordered dataTable no-footer" role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr>
                                    <!--<th>Id</th>-->
                                    <th>Position Title</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql = "SELECT * FROM senate_position";
                                $result = mysqli_query($db, $sql);
                                while($row = mysqli_fetch_array($result))
                                {
                                    ?>
                                    <tr>
                                        <!--<td><?php echo $row['pos_id']; ?></td>-->
                                        <td><?php echo $row['position_title']; ?></td>
                                        <td>
                                            <button class="btn btn-success btn-flat pos_edit" id="<?php echo $row['pos_id']; ?>"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-danger btn-flat pos_delete" id="<?php echo $row['pos_id']; ?>"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

</div>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Position</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST">

                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label"></label>
                        <label class="col-sm-3 col-form-label">Position Title</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="position_title" placeholder="" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-7">
                            <input type="number" class="form-control" name="position_rate" value="0" placeholder="" required hidden>
                        </div>
                    </div>

            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                <button type="submit" class="btn btn-primary btn-flat" name="add_position"><i class="fas fa-save"></i> Save</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div id="pos_edit_modal" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Position</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body" id="pos_edit_details">
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-primary btn-flat" name="pos_update"><i class="fas fa-check"></i> Update</button>
            </form>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        $('.pos_edit').click(function() {
            var pos_id = $(this).attr("id");
            $.ajax({
                url: "controller.php",
                method: "post",
                data: {
                    pos_id: pos_id
                },
                success: function(data) {
                    $('#pos_edit_details').html(data);
                    $('#pos_edit_modal').modal("show");
                }
            });
        });
    });
</script>
<!--==================================DELETE POSITION========================================================-->
<div id="pos_delete_modal" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Deleting...</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body" id="pos_delete_details">
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-danger btn-flat" name="pos_delete"><i class="fas fa-trash"></i> Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.pos_delete').click(function() {
            var pos_del_id = $(this).attr("id");
            $.ajax({
                url: "controller.php",
                method: "post",
                data: {
                    pos_del_id: pos_del_id
                },
                success: function(data) {
                    $('#pos_delete_details').html(data);
                    $('#pos_delete_modal').modal("show");
                }
            });
        });
    });
</script>

<script src="plugins/toastr/toastr.min.js"></script>
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<script>
    $(function() {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    });
</script>
</body>

</html>




