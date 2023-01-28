<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if ($_GET['action'] == 'del' && $_GET['ad_id'] && $_GET['ad_type']) {
        $ad_id = intval($_GET['ad_id']);
        $query = mysqli_query($con, "DELETE FROM ads where ad_id='$ad_id'");
        if(!empty($query)){
            $_query = mysqli_query($con, "DELETE FROM ad_descriptions where ad_id='$ad_id'");
            if(!empty($_query)){
                if($_GET['ad_type'] == 'M'){
                    $query = mysqli_query($con, "Select option_id from mcq_options where ad_id = $ad_id");
                    $option_ids = Array();
                    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                        $option_ids[] =  $row['option_id'];  
                    }
                    $option_ids=implode(',',$option_ids);
                    $query = mysqli_query($con, "DELETE FROM mcq_options where option_id IN($option_ids)");
                    $_query = mysqli_query($con, "DELETE FROM mcq_option_descriptions where option_id IN($option_ids)");
                }elseif($_GET['ad_type'] == 'I'){
                    $target_dir = "ads/files/images/$ad_id";
                    if (is_dir($target_dir)){
                        $files = glob($target_dir.'/*'); 
                        // Deleting all the files in the list
                        foreach($files as $file) {
                        if(is_file($file)) 
                            // Delete the given file
                            unlink($file); 
                        }                            
                    }
                }elseif($_GET['ad_type'] == 'V'){
                    $target_dir = "ads/files/videos/$ad_id";
                    if (is_dir($target_dir)){
                        $files = glob($target_dir.'/*'); 
                        // Deleting all the files in the list
                        foreach($files as $file) {
                        if(is_file($file)) 
                            // Delete the given file
                            unlink($file); 
                        }                            
                    }
                }
            }
        }
        $msg = "Ad has been deleted succesfully";
    }
    // Code for restore
    if ($_GET['action'] == 'change_status' && !empty($_GET['ad_id']) && !empty($_GET['status'])) {
        $ad_id = intval($_GET['ad_id']);
        $status = $_GET['status'];
        $query = mysqli_query($con, "update ads set status='$status' where ad_id='$ad_id'");
        if($status == 'A'){
            $msg = "Ad Activated";
        }else{
            $msg = "Ad Deactivated";
        }
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>In 360 News | Manage Advertisements</title>
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
                                    <h4 class="page-title">Manage Advertisements</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#">Ads </a>
                                        </li>
                                        <li class="active">
                                            Manage Advertisements
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
                                                        <th>Details</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $lang_code = $_SESSION['lang_code'];
                                                    $condition = $limit = $join = '';
                                                    $fields = "ads.*,ad_descriptions.title,ad_descriptions.description";
                                                    $condition .= " AND ad_descriptions.lang_code = '$lang_code'";
                                                    $join .= " LEFT JOIN ad_descriptions ON ad_descriptions.ad_id = ads.ad_id";
                                                    $query = mysqli_query($con, "Select $fields from ads $join where 1 $condition");
                                                    $cnt = 1;

                                                    while ($row = mysqli_fetch_array($query)) {
                                                    ?>

                                                        <tr>
                                                            <th scope="row"><?php echo htmlentities($cnt); ?></th>
                                                            <td><?php 
                                                            if($row['type'] == 'I'){
                                                                $type = 'Image';
                                                            }elseif($row['type'] == 'V'){
                                                                $type = 'Video';
                                                            }elseif($row['type'] == 'T'){
                                                                $type = 'Text';
                                                            }elseif($row['type'] == 'M'){
                                                                $type = 'MCQ';
                                                            }
                                                            echo $row['title'].'<br> Type:'.$type.'<br> Start Date:'.date('m/d/Y',$row['start_date']).'<br> End Date:'.date('m/d/Y',$row['end_date']); 
                                                            ?></td>
                                                            <td><?php if($row['status'] == 'D'){
                                                                        $id=$row['id'];
                                                                        
                                                                        echo "Disabled<a href='manage-ads.php?ad_id=".$row['ad_id']."&action=change_status&status=A' class='btn btn-success waves-effect waves-light'>Make Active</a>";
                                                                    }
                                                                    elseif($row['status'] == 'A'){
                                                                        echo "Active<a href='manage-ads.php?ad_id=".$row['ad_id']."&action=change_status&status=D' class='btn btn-danger waves-effect waves-light'>Make Disable</a>";
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td><a href="edit-ad.php?ad_id=<?php echo htmlentities($row['ad_id']); ?>"><i class="fa fa-pencil" style="color: #29b6f6;"></i></a>
                                                                &nbsp;<a href="manage-ads.php?ad_id=<?php echo htmlentities($row['ad_id']); ?>&action=del&ad_type=<?php echo htmlentities($row['type'])?>"> <i class="fa fa-trash-o" style="color: #f05050"></i></a> </td>
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