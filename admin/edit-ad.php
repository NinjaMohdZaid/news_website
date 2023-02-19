<?php
session_start();
include('includes/config.php');
error_reporting(0);
$_languages = mysqli_query($con, "SELECT * FROM languages");
$languages = mysqli_fetch_all($_languages, MYSQLI_ASSOC);
$lang_code = $_SESSION['lang_code'];
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if (!empty($_REQUEST['delete_option']) && !empty($_REQUEST['option_id'])) {
        $option_id = $_REQUEST['option_id'];
        $query = mysqli_query($con, "delete from  mcq_options  where option_id='$option_id'");
        if (!empty($query)) {
            $query = mysqli_query($con, "delete from  mcq_option_descriptions  where option_id='$option_id'");
        }
    }
    // For adding post 
    $ad_id = $_GET['ad_id'];
    if (isset($_POST['update']) && !empty($_POST['ad_id'])) {

        $type = $_POST['type'];
        $ad_id = $_POST['ad_id'];
        $start_date = strtotime($_POST['start_date']);
        $end_date = strtotime($_POST['end_date']);
        $frequency = $_POST['frequency'];
        $status = $_POST['status'];
        $title = $_POST['title'];
        $is_error = false;
        if ($type != 'T') {
            $description = '';
        } else {
            $description = $_POST['description'];
        }
        if ($type == 'I' && !empty($_FILES["image"]["name"])) {
            $imgfile = $_FILES["image"]["name"];
            // get the image extension
            $extension = substr($imgfile, strlen($imgfile) - 4, strlen($imgfile));
            // allowed extensions
            $allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif");
            // Validation for allowed extensions .in_array() function searches an array for a specific value.
            if (!in_array($extension, $allowed_extensions)) {
                $is_error = true;
                $error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
            }
        } elseif ($type == 'V' && !empty($_FILES["video"]["name"])) {
            $videoFile = $_FILES["video"]["name"];
            // get the image extension
            $extension = substr($videoFile, strlen($videoFile) - 4, strlen($videoFile));
            // allowed extensions
            $allowed_extensions = array(".WEBM", ".MPG", ".MP2", ".MPEG", ".MPE", ".MPV", ".OGG", ".MP4", ".M4P", ".M4V", ".AVI", ".WMV", ".MOV", ".QT", ".FLV", ".SWF", ".webm", ".mpg", ".mp2", ".mpeg", ".mpe", ".mpv", ".ogg", ".mp4", ".m4p", ".m4v", ".avi", ".wmv", ".mov", ".qt", ".flv", ".swf", ".3gp");
            // Validation for allowed extensions .in_array() function searches an array for a specific value.
            if (!in_array($extension, $allowed_extensions)) {
                $is_error = true;
                $error = "Invalid format of the video";
            }
        }

        if ($is_error) {
            echo $error_txt;
        } else {
            function upload_image($target_dir){
                // die(var_dump($_FILES));
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if($check !== false) {
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif" ) {
                        return false;
                        $uploadOk = 0;
                    }else{
                        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                        return true;
                        $uploadOk = 1;
                    }
                    
                } else {
                    return false;
                    $uploadOk = 0;
                }
            }
            function upload_video($target_dir){
                // die(var_dump($_FILES));
                $target_file = $target_dir . basename($_FILES["video"]["name"]);
                $uploadOk = 1;
                $videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                if($videoFileType != "mp4" && $videoFileType != "mpv" && $videoFileType != "avi"
                    && $videoFileType != "3gp" ) {
                    return false;
                    $uploadOk = 0;
                }else{
                    move_uploaded_file($_FILES["video"]["tmp_name"], $target_file);
                    return true;
                    $uploadOk = 1;
                } 
            }
            $query = mysqli_query($con, "UPDATE ads SET `start_date` = '$start_date',`end_date`='$end_date',`frequency`='$frequency',`status` = '$status' WHERE ad_id=$ad_id");
            if (!empty($query)) {
                $_query = mysqli_query($con, "REPLACE INTO ad_descriptions(`ad_id`,`title`,`description`,`lang_code`) VALUES('$ad_id','$title','$description','$lang_code')");

                if (!empty($_query)) {
                    if ($type == 'I' && !empty($_FILES["image"]["name"])) {
                        if (!empty($_FILES['image']['name'])) {
                            //image upload
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
                            upload_image($target_dir . '/');
                        }
                    } elseif ($type == 'V' && !empty($_FILES["video"]["name"])) {
                        if (!empty($_FILES['video']['name'])) {
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
                            
                            upload_video($target_dir . '/');
                        }
                    } elseif ($type == 'M' && !empty($_REQUEST['options'])) {
                        if (!empty($_REQUEST['options']['to_add'])) {
                            foreach ($_REQUEST['options']['to_add'] as $option) {
                                $query = mysqli_query($con, "insert into mcq_options(ad_id) values('$ad_id')");
                                $option_id = $con->insert_id; //option_id
                                if (!empty($query)) {
                                    foreach ($languages as $key => $language) {
                                        $_lang_code = $language['code'];
                                        $_query = mysqli_query($con, "insert into mcq_option_descriptions(option_id,option_text,lang_code) values('$option_id','$option','$_lang_code')");
                                    }
                                }
                            }
                        }
                        if (!empty($_REQUEST['options']['to_update'])) {
                            foreach ($_REQUEST['options']['to_update'] as $option_id => $option) {
                                $_query = mysqli_query($con, "REPLACE INTO mcq_option_descriptions(`option_id`,`option_text`,`lang_code`) VALUES('$option_id','$option','$lang_code')");
                            }
                        }
                    }
                    $msg = "Ad has been updated ";
                }
            } else {
                $error = "Something went wrong . Please try again.";
            }
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
        <div id="overlay">
            <div class="cv-spinner">
                <span class="spinner"></span>
            </div>
        </div>
        <style>
            #button {
                display: block;
                margin: 20px auto;
                padding: 10px 30px;
                background-color: #eee;
                border: solid #ccc 1px;
                cursor: pointer;
            }

            #overlay {
                position: fixed;
                top: 0;
                z-index: 100;
                width: 100%;
                height: 100%;
                display: none;
                background: rgba(0, 0, 0, 0.6);
            }

            .cv-spinner {
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .spinner {
                width: 40px;
                height: 40px;
                border: 4px #ddd solid;
                border-top: 4px #2e93e6 solid;
                border-radius: 50%;
                animation: sp-anime 0.8s infinite linear;
            }

            @keyframes sp-anime {
                100% {
                    transform: rotate(360deg);
                }
            }

            .is-hide {
                display: none;
            }
        </style>
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
                                                <input type="hidden" name="ad_id" value="<?php echo $row['ad_id']; ?>">
                                                <div class="form-group m-b-20">
                                                    <label for="type">Ad Type</label>
                                                    <input type="hidden" name="type" value="<?php echo htmlentities($row['type']); ?>">
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
                                                <?php } elseif ($row['type'] == 'I') {
                                                    $dir = "ads/files/images/" . $_REQUEST['ad_id'];
                                                    if (is_dir($dir)) {
                                                        $dir_data = scandir($dir, 1);
                                                        $image = reset($dir_data);
                                                    }
                                                ?>
                                                    <div class="form-group m-t-0 m-b-30">
                                                        <img width="200px;" src="<?php echo $dir . '/' . $image ?>">
                                                        <div class="row dependent_field" id="video_dependent_field">
                                                            <div class="col-sm-12">
                                                                <div class="card-box">
                                                                    <h4 class="m-b-30 m-t-0 header-title"><b>Update Image</b></h4>
                                                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                <?php } elseif ($row['type'] == 'M') {
                                                    $condition = $limit = $join = '';
                                                    $fields = "mcq_options.*,mcq_option_descriptions.option_text";
                                                    $condition .= " AND mcq_option_descriptions.lang_code = '$lang_code'";
                                                    $condition .= " AND mcq_options.ad_id = " . $_GET['ad_id'];
                                                    $join .= " LEFT JOIN mcq_option_descriptions ON mcq_option_descriptions.option_id = mcq_options.option_id";
                                                    $query = mysqli_query($con, "Select $fields from mcq_options $join where 1 $condition");
                                                ?>
                                                    <div class="row dependent_field" id="mcq_dependent_field">
                                                        <div class="col-sm-12">
                                                            <div class="card-box">
                                                                <h4 class="m-b-30 m-t-0 header-title"><b>MCQ Answers</b></h4>
                                                                <div class="appending_div">
                                                                    <?php
                                                                    $option_value = 1;
                                                                    while ($mcq_options = mysqli_fetch_array($query)) {

                                                                    ?>
                                                                        <div class="form-group m-b-20 ">
                                                                            <label for="options[to_update][<?php echo $mcq_options['option_id'] ?>]">Option <?php echo $option_value; ?></label>
                                                                            <div class="option_div"><input type="text" class="form-control" name="options[to_update][<?php echo $mcq_options['option_id'] ?>]" value="<?php echo $mcq_options['option_text'] ?>" required><i class="fa fa-trash" data-option-id="<?php echo $mcq_options['option_id']; ?>" data-ad-id="<?php echo $ad_id; ?>" aria-hidden="true"></i></div>
                                                                        </div>
                                                                    <?php $option_value++;
                                                                    }
                                                                    echo '<span id="last_option" data-last-option = "' . $option_value . '"></span>'; ?>
                                                                </div>
                                                                <span id="add_more_mcq">Add More +</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <div class="form-group m-b-20">
                                                    <label for="start_date">Start Date</label>
                                                    <input type="date" class="form-control" id="start_date" value="<?php echo date("Y-m-d", $row['start_date']); ?>" name="start_date" required>

                                                </div>

                                                <div class="form-group m-b-20">
                                                    <label for="end_date">End Date</label>
                                                    <input type="date" class="form-control" value="<?php echo date("Y-m-d", $row['end_date']); ?>" id="end_date" name="end_date" required>

                                                </div>


                                                <div class="form-group m-b-20">
                                                    <label for="frequency">Ad Frequency</label>
                                                    <input type="number" class="form-control" value="<?php echo htmlentities($row['frequency']); ?>" id="frequency" name="frequency" required>
                                                </div>

                                                <div class="form-group m-b-20">
                                                    <label for="status">Status</label>
                                                    <select class="form-control" name="status" id="status" required>
                                                        <option value="A" <?php if ($row['status'] == 'A') echo 'selected' ?>>Active</option>
                                                        <option value="D" <?php if ($row['status'] == 'D') echo 'selected' ?>>Disable</option>
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
        <style>
            #add_more_mcq {
                color: gray;
            }

            #add_more_mcq:hover {
                color: black;
                cursor: pointer;
            }

            .option_div {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .option_div i:hover {
                cursor: pointer;
                color: red;
            }
        </style>

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

                var i = parseInt($('#last_option').attr('data-last-option'));
                $('#add_more_mcq').on('click', function() {
                    var field = '<div class="form-group m-b-20"><label for="options[to_add][' + i + ']">Option ' + i + '</label><input type="text" class="form-control" name="options[to_add][' + i + ']" required></div>';
                    $('.appending_div').append(field);
                    i = i + 1;
                })
                $('.option_div i').click(function() {
                    var option_id = $(this).attr("data-option-id");
                    var ad_id = $(this).attr("data-ad-id");
                    $.ajax({
                        url: 'edit-ad.php?ad_id=' + ad_id + '&option_id=' + option_id + '&delete_option=' + true,
                        type: 'GET',
                        beforeSend: function(){
                            $('#overlay').show()
                        },
                        complete: function(){
                            $('#overlay').hide();
                        },
                        success: function(data) {
                            $("body").html(data)
                        }
                        
                    });
                });
            });
        </script>
        <script src="../plugins/switchery/switchery.min.js"></script>

        <!--Summernote js-->
        <script src="../plugins/summernote/summernote.min.js"></script>



    </body>

    </html>
<?php } ?>