<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if ($_GET['action'] == 'res' && $_GET['news_id']) {
        $id = intval($_GET['news_id']);
        $query = mysqli_query($con, "update tblposts set is_deleted='N' where id='$id'");
        $msg = "News Has Been Recycled";
    }
    if ($_GET['action'] == 'del' && $_GET['news_id']) {
        $id = intval($_GET['news_id']);
        $query = mysqli_query($con, "DELETE FROM tblposts where id='$id'");
        if(!empty($query)){
            $_query = mysqli_query($con, "DELETE FROM tblpost_descriptions where id='$id'");
            if(!empty($_query)){
                if(!empty($_GET['img'])){
                    unlink("postimages/".$_GET['img']);
                }
            }
            $msg = "News Has Been Permanently deleted";
        }else{
            $msg = "News Has Not Been Permanently deleted";
        }
    }
    

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>In 360 News | Trashed News</title>
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

            <!-- ========== Left Sidebar Start ========== -->
            <?php include('includes/leftsidebar.php'); ?>
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">


                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Trashed News</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#">News </a>
                                        </li>
                                        <li class="active">
                                            Trashed News
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->


                        <div class="row">
                            <div class="col-sm-6">

                                <?php if ($msg) { ?>
                                    <div class="alert alert-success" role="alert">
                                        <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
                                    </div>
                                <?php } ?>

                                <?php if ($delmsg) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Oh snap!</strong> <?php echo htmlentities($delmsg); ?>
                                    </div>
                                <?php } ?>


                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="demo-box m-t-20">
                                        <div class="m-b-30">
                                            <a href="add-post.php">
                                                <button id="addToTable" class="btn btn-success waves-effect waves-light">Add <i class="mdi mdi-plus-circle-outline"></i></button>
                                            </a>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table m-0 table-colored-bordered table-bordered-primary">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Title</th>
                                                        <th>Posting Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $lang_code = $_SESSION['lang_code'];
                                                    $condition = $limit = $join = '';
                                                    $fields = "tblposts.*,tblpost_descriptions.PostTitle as PostTitle,tblpost_descriptions.PostDetails as PostDetails";
                                                    $condition .= " AND tblpost_descriptions.lang_code = '$lang_code'";
                                                    $condition .= " AND tblposts.is_deleted = 'Y'";
                                                    $join .= " LEFT JOIN tblpost_descriptions ON tblpost_descriptions.id = tblposts.id";
                                                    $query = mysqli_query($con, "Select $fields from tblposts $join where 1 $condition");
                                                    $cnt = 1;

                                                    while ($row = mysqli_fetch_array($query)) {
                                                    ?>

                                                        <tr>
                                                            <th scope="row"><?php echo htmlentities($cnt); ?></th>
                                                            <td><?php echo htmlentities($row['PostTitle']); ?></td>
                                                            <td><?php echo htmlentities($row['PostingDate']); ?></td>
                                                            <td><a href="trash-news.php?news_id=<?php echo htmlentities($row['id']); ?>&action=res">Restore</a>
                                                                &nbsp;<a href="trash-news.php?&img=<?php echo htmlentities($row['PostImage']); ?>&news_id=<?php echo htmlentities($row['id']); ?>&action=del">Permanently Deleted</a> </td>
                                                        </tr>
                                                    <?php
                                                        $cnt++;
                                                    } ?>
                                                </tbody>

                                            </table>
                                        </div>




                                    </div>

                                </div>


                            </div>
                            <!--- end row -->
                        </div> <!-- container -->

                    </div> <!-- content -->
                    <?php include('includes/footer.php'); ?>
                </div>

            </div>
            <!-- END wrapper -->



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