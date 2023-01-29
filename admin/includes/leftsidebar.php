            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <ul>


                            <li class="has_sub">
                                <a href="dashboard.php" class="waves-effect"><i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span> </a>

                            </li>

                                <li class="has_sub">
                                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-sticky-note-o"></i> <span> News </span> <span class="menu-arrow"></span></a>
                                    <ul class="list-unstyled">
                                        <li><a href="add-post.php">Add News</a></li>
                                        <li><a href="manage-news.php">Manage News</a></li>
                                        <li><a href="trash-news.php">Deleted News</a></li>
                                    </ul>
                                </li>




                                <li class="has_sub">
                                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-bars"></i> <span> Category </span> <span class="menu-arrow"></span></a>
                                    <ul class="list-unstyled">
                                        <li><a href="add-category.php">Add Category</a></li>
                                        <li><a href="manage-categories.php">Manage Category</a></li>
                                    </ul>
                                </li>
                            <?php if ($_SESSION['utype'] == 'A') : ?>
                                <li class="has_sub">
                                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-plus"></i> <span> Ads </span> <span class="menu-arrow"></span></a>
                                    <ul class="list-unstyled">
                                        <li><a href="add-new-ad.php">Create New Ad</a></li>
                                        <li><a href="manage-ads.php">Manage Ads</a></li>
                                    </ul>
                                </li>

                                <li class="has_sub">
                                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-user"></i> <span> Users </span> <span class="menu-arrow"></span></a>
                                    <ul class="list-unstyled">
                                        <li><a href="add-user.php">Add New User</a></li>
                                        <li><a href="approve-subadmins.php">Approve Users</a></li>
                                        <li><a href="manage-users.php">Manage Users</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>



                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-comment-o"></i> <span> Comments </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="unapprove-comment.php">Approve Comments </a></li>
                                    <li><a href="manage-comments.php">Approved Comments</a></li>
                                </ul>
                            </li>

                            </li>
                            <?php if ($_SESSION['utype'] == 'A') : ?>
                                <li class="has_sub">
                                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-money"></i> <span> Payments </span> <span class="menu-arrow"></span></a>
                                    <ul class="list-unstyled">
                                        <li><a href="add-payment.php">Add Payment</a></li>
                                        <li><a href="payment-history.php">Payment History</a></li>
                                    </ul>
                                </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-language"></i> <span>Languages </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="add-languages.php">Add Languages</a></li>
                                    <li><a href="manage-languages.php">Manage Languages</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="settings.php" class="waves-effect"><i class="fa fa-gear"></i> <span> Settings </span> </a>

                            </li>
                            <?php endif; ?>
                            <li class="has_sub">
                                <a href="logout.php" class="waves-effect"><i class="fa fa-arrow-circle-left"></i> <span> Logout </span> </a>

                            </li>

                        </ul>
                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>



                </div>
                <!-- Sidebar -left -->

            </div>