<?php
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
        }else{
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            return true;
        }
        
    } else {
        return false;
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
    }else{
        move_uploaded_file($_FILES["video"]["tmp_name"], $target_file);
        return true;
    } 
}
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {

    // For adding post  
    if (isset($_POST['submit'])) {
        $type = $_POST['type'];
        $start_date = strtotime($_POST['start_date']);
        $end_date = strtotime($_POST['end_date']);
        $frequency = $_POST['frequency'];
        $status = $_POST['status'];
        $title = $_POST['title'];
        $is_error = false;
        if($type != 'T'){
            $description = '';
        }else{
            $description = $_POST['description'];
        }
        if($type == 'I' && !empty($_FILES["image"]["name"])){
            $imgfile = $_FILES["image"]["name"];
            // get the image extension
            $extension = substr($imgfile, strlen($imgfile) - 4, strlen($imgfile));
            // allowed extensions
            $allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif");
            // Validation for allowed extensions .in_array() function searches an array for a specific value.
            if(!in_array($extension, $allowed_extensions)){
                $is_error = true;
                $error = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
            }
        }elseif($type == 'V' && !empty($_FILES["video"]["name"])){
            $videoFile = $_FILES["video"]["name"];
            // get the image extension
            $extension = substr($videoFile, strlen($videoFile) - 4, strlen($videoFile));
            // allowed extensions
            $allowed_extensions = array(".WEBM",".MPG",".MP2",".MPEG", ".MPE", ".MPV",".OGG",".MP4", ".M4P", ".M4V" ,".AVI" ,".WMV" ,".MOV", ".QT",".FLV",".SWF",".webm",".mpg",".mp2",".mpeg", ".mpe", ".mpv",".ogg",".mp4", ".m4p", ".m4v" ,".avi" ,".wmv" ,".mov", ".qt",".flv",".swf",".3gp");
            // Validation for allowed extensions .in_array() function searches an array for a specific value.
            if(!in_array($extension, $allowed_extensions)){
                $is_error = true;
                $error = "Invalid format of the video";
            }
        }
        
        if($is_error) {
            echo $error_txt;
        }else{
            $query = mysqli_query($con, "insert into ads(type,start_date,end_date,frequency,status) values('$type','$start_date','$end_date','$frequency','$status')");
            $ad_id = $con->insert_id; //ad_id
            if (!empty($query)) {
                $_languages = mysqli_query($con, "SELECT * FROM languages");
                $languages = mysqli_fetch_all($_languages, MYSQLI_ASSOC);
                foreach ($languages as $key => $language) {
                    $lang_code = $language['code'];
                    $_query = mysqli_query($con, "insert into ad_descriptions(ad_id,title,description,lang_code) values('$ad_id','$title','$description','$lang_code')");
                }
                if (!empty($_query)) {
                    if($type == 'I' && !empty($_FILES["image"]["name"])){
                        if(!empty($_FILES['image']['name'])){
                            //image upload
                            $target_dir = "ads/files/images/$ad_id";
                            if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
                            upload_image($target_dir.'/');
                        }
                    }elseif($type == 'V' && !empty($_FILES["video"]["name"])){
                        if(!empty($_FILES['video']['name'])){
                            //video upload
                            $target_dir = "ads/files/videos/$ad_id";
                            if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
                            upload_video($target_dir.'/');
                        }
                    }elseif($type == 'M' && !empty($_REQUEST['options'])){
                        
                        foreach ($_REQUEST['options'] as $option) {
                            
                            $query = mysqli_query($con, "insert into mcq_options(ad_id) values('$ad_id')");
                            $option_id = $con->insert_id; //ad_id
                            if (!empty($query)) {
                                foreach ($languages as $key => $language) {
                                    $lang_code = $language['code'];
                                    $_query = mysqli_query($con, "insert into mcq_option_descriptions(option_id,option_text,lang_code) values('$option_id','$option','$lang_code')");
                                }
                            }
                        }
                    }
                    $msg = "Ad has been created ";
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
        <meta name="author" content="Coderthemes">

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <!-- App title -->
        <title>In360 News | Create New Ad</title>

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
                                    <h4 class="page-title">Create New Ad </h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Home</a>
                                        </li>
                                        <li>
                                            <a href="#">Ads </a>
                                        </li>
                                        <li class="active">
                                            Create New Ad
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


                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="p-6">
                                    <div class="">
                                        <form name="post_ad_form" method="post" enctype="multipart/form-data">
                                            
                                            <div class="form-group m-b-20">
                                                <label for="type">Ad Type</label>
                                                <select class="form-control" name="type" id="type" required>
                                                    <option value="T" target_id="text_dependent_field">Text</option>
                                                    <option value="I" target_id="image_dependent_field">Image</option>
                                                    <option value="V" target_id="video_dependent_field">video</option>
                                                    <option value="M" target_id="mcq_dependent_field">Multiple choice quiz</option>
                                                </select>
                                            </div>
                                            <div class="form-group m-b-20">
                                                <label for="title">Title</label>
                                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
                                            </div>
                                            <div class="row dependent_field" id="text_dependent_field">
                                                <div class="col-sm-12">
                                                    <div class="card-box">
                                                        <h4 class="m-b-30 m-t-0 header-title"><b>Ad Content</b></h4>
                                                        <textarea class="summernote" name="description" required></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row dependent_field hidden" id="image_dependent_field">
                                                <div class="col-sm-12">
                                                    <div class="card-box">
                                                        <h4 class="m-b-30 m-t-0 header-title"><b>Attach Image</b></h4>
                                                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row dependent_field hidden" id="video_dependent_field">
                                                <div class="col-sm-12">
                                                    <div class="card-box">
                                                        <h4 class="m-b-30 m-t-0 header-title"><b>Attach Video</b></h4>
                                                        <input type="file" class="form-control" id="video" name="video" accept="video/*">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row dependent_field hidden" id="mcq_dependent_field">
                                                <div class="col-sm-12">
                                                    <div class="card-box">
                                                        <h4 class="m-b-30 m-t-0 header-title"><b>MCQ Answers</b></h4>
                                                        <div class="appending_div">
                                                            <div class="form-group m-b-20 ">
                                                                <label for="options[1]">Option 1</label>
                                                                <div class="option_div"><input type="text" class="form-control" name="options[1]"><i class="fa fa-trash" aria-hidden="true"></i></div>
                                                            </div>
                                                        </div>
                                                        <span id="add_more_mcq">Add More +</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group m-b-20">
                                                <label for="start_date">Start Date</label>
                                                <input type="date" class="form-control" id="start_date" name="start_date" required>

                                            </div>

                                            <div class="form-group m-b-20">
                                                <label for="end_date">End Date</label>
                                                <input type="date" class="form-control" id="end_date" name="end_date" required>

                                            </div>


                                            <div class="form-group m-b-20">
                                                <label for="frequency">Ad Frequency</label>
                                                <input type="number" class="form-control" id="frequency" name="frequency" required>
                                            </div>

                                            <div class="form-group m-b-20">
                                                <label for="status">Status</label>
                                                <select class="form-control" name="status" id="status" required>
                                                    <option value="A">Active</option>
                                                    <option value="D">Disable</option>
                                                </select>
                                            </div>
                                            <button type="submit" name="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                                            <button type="button" class="btn btn-danger waves-effect waves-light">Discard</button>
                                        </form>
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

                //onchange dev start for type of ad
                $("#type").change(function() {
                    var target_id = $('option:selected', this).attr('target_id');
                    $(".dependent_field").addClass("hidden");
                    $('.dependent_field input').removeAttr('required');
                    $('.dependent_field textarea').removeAttr('required');
                    $("#" + target_id).removeClass("hidden");
                    $("#" + target_id + ' input').attr("required", true);
                    $("#" + target_id + ' textarea').attr("required", true);
                });
                //add more mcq
                var i = 2;
                $('#add_more_mcq').on('click', function() {
                    var field = '<div class="form-group m-b-20"><label for="options['+i+']">Option '+i+'</label><div class="option_div"><input type="text" class="form-control" id="options['+i+']" name="options['+i+']" required><i class="fa fa-trash" aria-hidden="true"></i></div></div>';
                    $('.appending_div').append(field);
                    i = i+1;
                });
                //remove div of delete option 
                $('.option_div i').on('click',function() {
                    $(this).closest('.form-group').remove();
                });
            });
        </script>
        <style>
            #add_more_mcq{
                color:gray;
            }
            #add_more_mcq:hover{
                color:black;
                cursor: pointer;
            }
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
        <script src="../plugins/switchery/switchery.min.js"></script>

        <!--Summernote js-->
        <script src="../plugins/summernote/summernote.min.js"></script>
        



    </body>

    </html>
<?php } ?>