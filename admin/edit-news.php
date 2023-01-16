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
        if(!empty($_FILES["postimage"]["name"])) {
            $imgfile = $_FILES["postimage"]["name"];
            $extension = substr($imgfile, strlen($imgfile) - 4, strlen($imgfile));
            // allowed extensions
            $allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif");
            if (!in_array($extension, $allowed_extensions)) {
                echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
            }else{
                if(!empty($_POST['img'])){
                    unlink("postimages/".$_POST['img']);
                }
                // get the image extension
                $extension = substr($imgfile, strlen($imgfile) - 4, strlen($imgfile));
                //rename the image file
                $PostImage = $imgnewfile = time()."_".md5($imgfile) . $extension;
                // Code for move image into directory
                move_uploaded_file($_FILES["postimage"]["tmp_name"], "postimages/" . $imgnewfile);
            }
           
        }
        $query = mysqli_query($con,"UPDATE tblposts SET `CategoryId`='$catid',`status` = '$status',`PostImage`='$PostImage' WHERE id=$id");
        if (!empty($query)) {
            $_query = mysqli_query($con,"REPLACE INTO tblpost_descriptions(`id`,`PostTitle`,`PostDetails`,`lang_code`) VALUES('$id','$PostTitle','$PostDetails','$lang_code')");
            if(!empty($_query)){
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
        <title>Newsportal | Add Post</title>

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
                                    <h4 class="page-title">Edit Post </h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#"> Posts </a>
                                        </li>
                                        <li class="active">
                                            Add Post
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
                         $fields = "tblposts.*,tblpost_descriptions.PostTitle as PostTitle,tblpost_descriptions.PostDetails as PostDetails";
                         $condition .= " AND tblpost_descriptions.lang_code = '$lang_code'";
                         $condition .= " AND tblposts.is_deleted = 'N'";
                         $condition .= " AND tblposts.id = ".$_GET['news_id'];
                         $join .= " LEFT JOIN tblpost_descriptions ON tblpost_descriptions.id = tblposts.id";
                         $query = mysqli_query($con, "Select $fields from tblposts $join where 1 $condition");
                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="p-6">
                                        <div class="">
                                            <form name="editpost" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="img" value="<?php echo htmlentities($row['PostImage']); ?>">
                                                <div class="form-group m-b-20">
                                                    <label for="PostTitle">Post Title</label>
                                                    <input type="text" class="form-control" id="PostTitle" value="<?php echo htmlentities($row['PostTitle']); ?>" name="PostTitle" placeholder="Enter title" required>
                                                </div>



                                                <div class="form-group m-b-20">
                                                    <label for="category_id">Category</label>
                                                    <select class="form-control" name="category_id" id="category" onChange="getSubCat(this.value);" required>
                                                        <option value="">Select Category </option>
                                                        <?php
                                                        // Feching active categories
                                                        $lang_code = $_SESSION['lang_code'];
                                                        $condition = $limit = $join = '';
                                                        $fields = "tblcategory.*,tblcategory_descriptions.CategoryName as CategoryName,tblcategory_descriptions.Description as Description";
                                                        $condition .= " AND tblcategory_descriptions.lang_code = '$lang_code' AND tblcategory.Is_Active=1";
                                                        $join .= " LEFT JOIN tblcategory_descriptions ON tblcategory_descriptions.id = tblcategory.id";
                                                        $ret = mysqli_query($con, "Select $fields from tblcategory $join where 1 $condition");
                                                        while ($result = mysqli_fetch_array($ret)) {
                                                        ?>
                                                            <option value="<?php echo htmlentities($result['id']); ?>" <?php if($result['id'] == $row['CategoryId']) echo 'selected'; ?>><?php echo htmlentities($result['CategoryName']); ?></option>
                                                        <?php } ?>

                                                    </select>
                                                </div>
                                                <div class="form-group m-b-20">
                                                    <label for="status">Status</label>
                                                    <select class="form-control" name="status" id="status" required>
                                                        <option value="A" <?php if($row['status'] == 'A') echo 'selected'; ?>>Approved</option>
                                                        <option value="D" <?php if($row['status'] == 'D') echo 'selected'; ?>>Disapproved</option>
                                                    </select>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="card-box">
                                                            <h4 class="m-b-30 m-t-0 header-title"><b>Post Details</b></h4>
                                                            <textarea class="summernote" name="PostDetails" required><?php echo htmlentities($row['PostDetails']); ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="card-box">
                                                            <h4 class="m-b-30 m-t-0 header-title"><b>Post Image</b></h4>
                                                            <img src="postimages/<?php echo htmlentities($row['PostImage']); ?>" width="300" />
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="card-box">
                                                                        <h4 class="m-b-30 m-t-0 header-title"><b>Update Image</b></h4>
                                                                        <input type="file" class="form-control" id="postimage" name="postimage">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php } ?>

                                            <button type="submit" name="update" class="btn btn-success waves-effect waves-light">Update </button>

                                        </div>
                                    </div> <!-- end p-20 -->
                                </div> <!-- end col -->
                            </div>
                            <!-- end row -->



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