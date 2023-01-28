<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    $query = "SELECT * FROM users where userType = 'C'";
    if (mysqli_query($con, $query)) {
        $result = mysqli_query($con, $query);
        $users = mysqli_fetch_all($result,MYSQLI_ASSOC);
    }
    if (isset($_POST['submit'])) {
        $category = $_POST['category'];
        $description = $_POST['description'];
        $status = 1;
        $query = mysqli_query($con, "insert into tblcategory(CategoryName,Description,Is_Active) values('$category','$description','$status')");
        if ($query) {
            $msg = "Category created ";
        } else {
            $error = "Something went wrong . Please try again.";
        }
    }


?>


    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>In 360 news | Add Payment</title>

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
        <script src="assets/js/modernizr.min.js"></script>

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php include('includes/topheader.php'); ?>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
            <?php include('includes/leftsidebar.php'); ?>
            <!-- Left Sidebar End -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">


                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Add Payment</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Home</a>
                                        </li>
                                        <li>
                                            <a href="#">Payments </a>
                                        </li>
                                        <li class="active">
                                            Add Payment
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <h4 class="m-t-0 header-title"><b>Add Payment </b></h4>
                                    <hr />



                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!---Success Message--->
                                            <?php if ($msg) { ?>
                                                <div class="alert alert-success" role="alert">
                                                    <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
                                                </div>
                                            <?php } ?>

                                            <!---Error Message--->
                                            <?php if ($error) { ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                                </div>
                                            <?php } ?>


                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <form class="form-horizontal" name="payments" method="post">

                                                <div class="form-group m-b-20">
                                                    <label for="exampleInputEmail1">Select User</label>
                                                    <select class="form-control" name="user_id" id="user_id" required>
                                                        <?php 
                                                            foreach ($users as $user) {
                                                        ?>
                                                        <option value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="form-group m-b-20">
                                                    <label for="exampleInputEmail1">Payment Amount</label>
                                                    <input type="text" class="form-control" value="" name="category" required>

                                                </div>



                                                <div class="form-group m-b-20">
                                                    <label for="exampleInputEmail1">Payment Date</label>
                                                    <input type="date" class="form-control" id="postimage" name="postimage" required>

                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">&nbsp;</label>
                                                    <div class="col-md-10">

                                                        <button type="submit" class="btn btn-custom waves-effect waves-light btn-md" name="submit">
                                                            Submit
                                                        </button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>


                                    </div>











                                </div>
                            </div>
                        </div>
                        <!-- end row -->


                    </div> <!-- container -->

                </div> <!-- content -->

                <?php include('includes/footer.php'); ?>

            </div>
        </div>

        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="../plugins/switchery/switchery.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>

    </html>
<?php } ?>