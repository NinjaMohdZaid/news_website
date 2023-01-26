<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['update'])) {
        $lang_code = $_SESSION['lang_code'];
        $id = $_GET['news_id'];
        $catid = $_POST['category_id'];
        $status = $_POST['status'];
        $PostTitle = $_POST['PostTitle'];
        $PostDetails = $_POST['PostDetails'];

        $PostImage = $_POST['img'];
        // Validation for allowed extensions .in_array() function searches an array for a specific value.
        if (!empty($_FILES["postimage"]["name"])) {
            $imgfile = $_FILES["postimage"]["name"];
            $extension = substr($imgfile, strlen($imgfile) - 4, strlen($imgfile));
            // allowed extensions
            $allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif");
            if (!in_array($extension, $allowed_extensions)) {
                echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
            } else {
                if (!empty($_POST['img'])) {
                    unlink("postimages/" . $_POST['img']);
                }
                // get the image extension
                $extension = substr($imgfile, strlen($imgfile) - 4, strlen($imgfile));
                //rename the image file
                $PostImage = $imgnewfile = time() . "_" . md5($imgfile) . $extension;
                // Code for move image into directory
                move_uploaded_file($_FILES["postimage"]["tmp_name"], "postimages/" . $imgnewfile);
            }
        }
        $query = mysqli_query($con, "UPDATE tblposts SET `CategoryId`='$catid',`status` = '$status',`PostImage`='$PostImage' WHERE id=$id");
        if (!empty($query)) {
            $_query = mysqli_query($con, "REPLACE INTO tblpost_descriptions(`id`,`PostTitle`,`PostDetails`,`lang_code`) VALUES('$id','$PostTitle','$PostDetails','$lang_code')");
            if (!empty($_query)) {
                $msg = "Post updated";
            }
        } else {
            $error = "Something went wrong . Please try again.";
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <!-- App title -->
        <title>Newsportal | Edit Advertisement</title>

        <!-- Summernote css -->
        <link href="../plugins/summernote/summernote.css" rel="stylesheet" />

        <!-- Select2 -->
        <link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

        <!-- Jquery filer css -->
        <link href="../plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
        <link href="../plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />

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
                                    <h4 class="page-title">Edit Advertisement </h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#"> Ads </a>
                                        </li>
                                        <li class="active">
                                            Edit Advertisement
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

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

                        <?php
                        $lang_code = $_SESSION['lang_code'];
                        $condition = $limit = $join = '';
                        $fields = "ads.*,ad_descriptions.title,ad_descriptions.description";
                        $condition .= " AND ad_descriptions.lang_code = '$lang_code'";
                        $condition .= " AND ads.ad_id = " . $_GET['ad_id'];
                        $join .= " LEFT JOIN ad_descriptions ON ad_descriptions.ad_id = ads.ad_id";
                        $query = mysqli_query($con, "Select $fields from ads $join where 1 $condition");
                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="p-6">
                                        <div class="">
                                            <form name="editpost" method="post" enctype="multipart/form-data">

                                                <div class="form-group m-b-20">
                                                    <label for="type">Ad Type</label>
                                                    <input type="hidden" value="<?php echo htmlentities($row['type']); ?>">
                                                    <select class="form-control" name="type" id="type" required disabled>
                                                        <option value="T" <?php if ($row['type'] == 'T') echo 'selected' ?> target_id="text_dependent_field">Text</option>
                                                        <option value="I" <?php if ($row['type'] == 'I') echo 'selected' ?> target_id="image_dependent_field">Image</option>
                                                        <option value="V" <?php if ($row['type'] == 'V') echo 'selected' ?> target_id="video_dependent_field">video</option>
                                                        <option value="M" <?php if ($row['type'] == 'M') echo 'selected' ?> target_id="mcq_dependent_field">Multiple choice quiz</option>
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group m-b-20">
                                                    <label for="title">Title</label>
                                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="<?php echo htmlentities($row['title']); ?>" required>
                                                </div>
                                               
                                                <?php
                                                if ($row['type'] == 'V') {
                                                    $dir = "ads/files/videos/" . $_REQUEST['ad_id'];
                                                    if (is_dir($dir)) {
                                                        $dir_data = scandir($dir, 1);
                                                        $video = reset($dir_data);
                                                    }
                                                ?>
                                                    <div class="form-group m-b-20">
                                                        <video width="320" height="240" controls>
                                                            <source src="<?php echo $dir . '/' . $video ?>">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                        <div class="row dependent_field" id="video_dependent_field">
                                                            <div class="col-sm-12">
                                                                <div class="card-box">
                                                                    <h4 class="m-b-30 m-t-0 header-title"><b>Update Video</b></h4>
                                                                    <input type="file" class="form-control" id="video" name="video" accept="video/*">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                <?php }elseif($row['type'] == 'I'){ 
                                                     $dir = "ads/files/images/" . $_REQUEST['ad_id'];
                                                     if (is_dir($dir)) {
                                                         $dir_data = scandir($dir, 1);
                                                         $image = reset($dir_data);
                                                     }
                                                    ?>
                                                    <div class="form-group m-t-0 m-b-30">
                                                        <img src="<?php echo $dir . '/' . $image ?>">
                                                        <div class="row dependent_field" id="video_dependent_field">
                                                            <div class="col-sm-12">
                                                                <div class="card-box">
                                                                    <h4 class="m-b-30 m-t-0 header-title"><b>Update Image</b></h4>
                                                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                <?php } ?>
                                            <div class="form-group m-b-20">
                                                <label for="start_date">Start Date</label>
                                                <input type="date" class="form-control" id="start_date" value="<?php echo date("Y-m-d",$row['start_date']); ?>" name="start_date" required>

                                            </div>

                                            <div class="form-group m-b-20">
                                                <label for="end_date">End Date</label>
                                                <input type="date" class="form-control" value="<?php echo date("Y-m-d",$row['end_date']); ?>" id="end_date" name="end_date" required>

                                            </div>


                                            <div class="form-group m-b-20">
                                                <label for="frequency">Ad Frequency</label>
                                                <input type="number" class="form-control" value="<?php echo htmlentities($row['frequency']); ?>" id="frequency" name="frequency" required>
                                            </div>

                                            <div class="form-group m-b-20">
                                                <label for="status">Status</label>
                                                <select class="form-control" name="status" id="status" required>
                                                    <option value="A">Active</option>
                                                    <option value="D">Disable</option>
                                                </select>
                                            </div>
                                            <button type="submit" name="update" class="btn btn-success waves-effect waves-light">Update </button>

                                        </div>
                                    </div> <!-- end p-20 -->
                                </div> <!-- end col -->
                            </div>
                            <!-- end row -->
                            <?php } ?>



                    </div> <!-- container -->

                </div> <!-- content -->

                <?php include('includes/footer.php'); ?>

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


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

        <!--Summernote js-->
        <script src="../plugins/summernote/summernote.min.js"></script>
        <!-- Select 2 -->
        <script src="../plugins/select2/js/select2.min.js"></script>
        <!-- Jquery filer js -->
        <script src="../plugins/jquery.filer/js/jquery.filer.min.js"></script>

        <!-- page specific js -->
        <script src="assets/pages/jquery.blog-add.init.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script>
            jQuery(document).ready(function() {

                $('.summernote').summernote({
                    height: 240, // set editor height
                    minHeight: null, // set minimum height of editor
                    maxHeight: null, // set maximum height of editor
                    focus: false // set focus to editable area after initializing summernote
                });
                // Select2
                $(".select2").select2();

                $(".select2-limiting").select2({
                    maximumSelectionLength: 2
                });
            });
        </script>
        <script src="../plugins/switchery/switchery.min.js"></script>

        <!--Summernote js-->
        <script src="../plugins/summernote/summernote.min.js"></script>



    </body>

    </html>
<?php } ?>