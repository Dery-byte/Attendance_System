<?php
include("../admin/controller.php");
require_once('../normal_user/auth_user.php');
ini_set('display_errors', 0);
ini_set('display_errors', false);
date_default_timezone_set('Africa/Accra');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- META SECTION -->
    <title>GRASSAG Senate</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <!-- END META SECTION -->

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
    <!-- EOF CSS INCLUDE -->
</head>

<style>
    .btn-logout{
        margin-left: 9px;
    }
</style>
<body>
<!-- START PAGE CONTAINER -->
<div class="page-container">

    <!-- START PAGE SIDEBAR -->
    <div class="page-sidebar">
        <!-- START X-NAVIGATION -->
        <ul class="x-navigation">
            <!--            <li class="xn-logo">-->
            <li class="xn-logo">
                <a href="home.php">SENATE</a>
                <a href="#" class="x-navigation-control"></a>
                <!--                        PROFILE STARTS-->

            </li>
            <li class="xn-profile">
                <!--                <a href="#" class="profile-mini">-->
                <!--                    <img src="assets/images/users/avatar.jpg" alt="John Doe"/>-->
                <!--                </a>-->
                <div class="profile">
                    <div class="profile-image">
                        <img src="<?php echo   $_SESSION['senator_photo'];?>" style="border-radius: 50%;width: 95px;height: 95px;" alt="User Image">
                    </div>
                    <div class="profile-data">
                        <div class="profile-data-name"><?php echo $_SESSION['senator_fname']; ?> <?php echo $_SESSION['senator_lname']?></div>
                        <div class="profile-data-title"><?php echo $_SESSION['senator_program']; ?></div>
                    </div>
                    <div class="profile-controls">
                        <a href="Profile.php" class="profile-control-left"><span class="fa fa-info"></span></a>
                        <!--                        <a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a>-->
                    </div>
                </div>
            </li>



            <!--                        PROFILE ENDS-->



            <li class="xn-title">Navigation</li>
            <ul>

                <li><a href="home.php"><span class="fa fa-book"></span> Dashboard</a></li>
                <li><a href="minutes.php"><span class="fa fa-folder"></span> Minutes</a></li>

                <li class="xn-icon-button pull-left last">

                    <form method="POST">
                        <button type="submit"   class="btn  btn-flat btn-logout" name="logout"><i class="fas fa-sign-in-alt"><span class="fa fa-sign-out"></span>Logout</button>
                    </form
                </li>
            </ul>

            <!-- END X-NAVIGATION -->
    </div>
    <!-- END PAGE SIDEBAR -->


















    <!-- PAGE CONTENT -->
    <div class="page-content">

        <!-- START X-NAVIGATION VERTICAL -->
        <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
            <!-- TOGGLE NAVIGATION -->
            <li class="xn-icon-button">
                <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
            </li>
            <!-- END TOGGLE NAVIGATION -->
            <!-- SEARCH -->
            <!--            <li class="xn-search">-->
            <!--                <form role="form">-->
            <!--                    <input type="text" name="search" placeholder="Search..."/>-->
            <!--                </form>-->
            <!--            </li>-->
            <!-- END SEARCH -->


            <!-- POWER OFF -->

            <!--<li class="xn-icon-button pull-right last">-->

            <!--    <form method="POST">-->
            <!--        <button type="submit"   class="btn  btn-flat" name="logout"><i class="fas fa-sign-in-alt"><span class="fa fa-sign-out"></span>Logout</button>-->
            <!--    </form-->
            <!--</li>-->
        </ul>
        <!-- END X-NAVIGATION VERTICAL -->

        <!-- START BREADCRUMB -->
        <ul class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">Dashboard</li>
        </ul>

        <!---->
        <!--        --><?php
        //        if (isset($_GET['search']) && !empty($_GET['search'])) {
        //        // Sanitize the input to prevent SQL injection
        //        $search_query = mysqli_real_escape_string($db, $_GET['query']);
        //        $sql = "SELECT * FROM sched_minutes WHERE description LIKE '%$search_query%'";
        //        $result = mysqli_query($db, $sql);
        //            if ($result->num_rows > 0) {
        //
        //            while ($row = $result->fetch_assoc()) {
        //                echo "ID: " . $row["minutes_id"] . " - description: " . $row["description"] . "<br>";
        //                // Display other relevant information from the database
        //            }
        //            }
        //     else {
        //        echo "No results found.";
        //    }
        //        }
        //
        //
        //        ?>


        <ul class="x-navigation x-navigation-horizontal x-navigation-panel">


            <li class="xn-search">
                <form role="form">
                    <input type="text" name="search" placeholder="Search..."/>
                </form>
            </li>

        </ul>



        <div class="row">
            <!--            ===================QUERY DISPLAY NONE QUERY DISPLAY================================-->
            <?php
            if (isset($_GET['search']) && !empty($_GET['search'])) {
                // Sanitize the input to prevent SQL injection
                $search_query = mysqli_real_escape_string($db, $_GET['search']);

                $sqls = "SELECT * FROM sched_minutes 
INNER JOIN senate_sched ON senate_sched.sched_id = sched_minutes.schedule_id WHERE senate_sched.meeting_name  LIKE '%$search_query%'";

                $results = mysqli_query($db, $sqls);
                if ($results->num_rows > 0) {
                    while ($row = $results->fetch_assoc()) {

                        $filename = $row['file'];
//    $file_id=$row['minutes_id'];
//    $filename = basename($pdf_data);
                        $file_path = "../admin/minutesFiles/".$filename;
                        $munites_id = $row["minutes_id"];

                        ?>
                        <div class="col-md-3">

                            <div class="widget widget-default widget-item-icon">
                                <div class="widget-item-left">
                                    <img src="./pdfimage/pdfImage.png"  width="60" height="90">

                                    <!--                            <span class="fa fa-envelope"></span>-->
                                </div>
                                <div class="widget-data">
                                    <div class="widget-title"><?php echo $row['meeting_name']; ?></div>
                                    <div class="widget-subtitle"><?php echo $row['description']; ?></div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <a  class="btn btn-primary  download-btn" style="margin-bottom: -20px; margin-left: -10px" href="download.php?filename=<?php echo $filename; ?>">Download</a>
                                        </div>


                                    </div>


                                </div>
                            </div>
                        </div>
                        <?php
                        // Display other relevant information from the database
                    }
                }
                else {
                    echo "No results found.";
                }

            }else
//============================show without search==============================================
            {
                $sql = "SELECT * FROM sched_minutes, senate_sched where senate_sched.sched_id = sched_minutes.schedule_id;";
                $result = mysqli_query($db, $sql);
// $row = mysqli_fetch_array($result);
// $pdf_data = $row['file'];

                while($row = mysqli_fetch_array($result))
                {
                    $filename = $row['file'];
                    $file_path = "../admin/minutesFiles/".$filename;

                    ?>
                    <div class="col-md-3">

                        <div class="widget widget-default widget-item-icon">
                            <div class="widget-item-left">
                                <img src="./pdfimage/pdfImage.png"  width="60" height="90">

                                <!--                            <span class="fa fa-envelope"></span>-->
                            </div>
                            <div class="widget-data">
                                <div class="widget-title"><?php echo $row['meeting_name']; ?></div>
                                <div class="widget-subtitle"><?php echo $row['description']; ?></div>
                            </div>
                            <div class="row">
                                <div class="form-group " >

                                    <div class="col-md-6">

                                        <a  class="btn btn-primary  download-btn" style="margin-bottom: -30px; margin-left: -10px" href="download.php?filename=<?php echo $filename; ?>">Download</a>

                                        <!--                                    <button type="submit" id="downloadBtn" name="download" class="btn btn-primary" style="margin-bottom: -90px; margin-left: -10px">Download</button>-->

                                        <!--<button type="button" style="margin-bottom: -90px; margin-left: -10px" class="btn btn-primary download-btn" data-file="<?php echo $filename; ?>">Download</button>-->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }

                ?>
                <?php
            }
            ?>

            <!-- END PAGE CONTENT WRAPPER -->
        </div>
        <!-- END PAGE CONTENT -->
    </div>

    <?php
    // echo $_SESSION['mess'];
    // echo $_SESSION['success'];

    $dd = date("H:i:s");

    if($dd == $_SESSION['expire'])
    {
        session_unset();
    }
    ?>
    <script>
        document.getElementById("log_attendance").addEventListener("submit", function(event) {
            var selectElement = document.getElementById("senate_schedule").value;
            var errorElement = document.getElementById("scheduleError");

            // console.log(selectElement);
            if (selectElement === "0") {
                errorElement.textContent = "Please select a schedule";
                // alert("Please select a schedule");
                event.preventDefault(); // Prevent form submission
            }
            // else {
            //     errorElement.textContent = ""; // Clear error message if there's no error
            // }
        });
    </script>

    <!--        <script>-->
    <!--            document.getElementById("downloadBtn").addEventListener("click", function() {-->
    <!--            window.location.href = "download.php";-->
    <!--        });-->
    <!--    </script>-->

    <script>
        document.querySelectorAll('.download-btn').forEach(button => {
            button.addEventListener('click', function() {
                const file_path = this.getAttribute('data-file');
                window.location.href = 'download.php?file=' + encodeURIComponent(file_path);
            });
        });
    </script>



    <script type="text/javascript">
        var interval = setInterval(function() {
            var momentNow = moment();
            $('#date').html(momentNow.format('dddd').substring(0, 3).toUpperCase() + ' - ' + momentNow.format('MMMM DD, YYYY'));
            $('#time').html(momentNow.format('hh:mm:ss A'));
        }, 100);
    </script>






    <!-- START SCRIPTS -->
    <!-- START PLUGINS -->
    <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>
    <!-- END PLUGINS -->

    <!-- START THIS PAGE PLUGINS-->
    <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
    <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
    <script type="text/javascript" src="js/plugins/scrolltotop/scrolltopcontrol.js"></script>

    <script type="text/javascript" src="js/plugins/morris/raphael-min.js"></script>
    <script type="text/javascript" src="js/plugins/morris/morris.min.js"></script>
    <script type="text/javascript" src="js/plugins/rickshaw/d3.v3.js"></script>
    <script type="text/javascript" src="js/plugins/rickshaw/rickshaw.min.js"></script>
    <script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
    <script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>
    <script type='text/javascript' src='js/plugins/bootstrap/bootstrap-datepicker.js'></script>
    <script type="text/javascript" src="js/plugins/owl/owl.carousel.min.js"></script>

    <script type="text/javascript" src="js/plugins/moment.min.js"></script>
    <script type="text/javascript" src="js/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- END THIS PAGE PLUGINS-->

    <!-- START TEMPLATE -->
    <!--<script type="text/javascript" src="js/settings.js"></script>-->

    <script type="text/javascript" src="js/plugins.js"></script>
    <script type="text/javascript" src="js/actions.js"></script>

    <script type="text/javascript" src="js/demo_dashboard.js"></script>
    <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->
</body>
</html>






