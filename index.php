<?php
require 'action/functions.php';
?><!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom.css">

    <meta charset="utf-8">
</head>
<body>

<div id="wrapper">
    <div class="overlay"></div>

    <!-- Sidebar -->
    <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
        <ul class="nav sidebar-nav">
            <li class="sidebar-brand">
                <a href="#">
                    Plugin Generator
                </a>
            </li>
            <li>
                <a href="#"><i class="fa fa-fw fa-home"></i> Home</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-fw fa-folder"></i> Plugins</a>
            </li>

        </ul>
    </nav>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <button type="button" class="hamburger is-closed animated fadeInLeft" data-toggle="offcanvas">
            <span class="hamb-top"></span>
            <span class="hamb-middle"></span>
            <span class="hamb-bottom"></span>
        </button>
        <div class="container">
            <form id="contact" action="action/action.php" method="post">
                <h3 style="text-align: center;">Wordpress Plugin Form</h3>

                <div class="col-sm-6">
                    <fieldset>
                        <input placeholder="Plugin Name" type="text" tabindex="1" required autofocus name="plugin_name">
                    </fieldset>
                    <fieldset>
                        <input placeholder="Plugin URI" type="url" tabindex="2" required name="plugin_uri">
                    </fieldset>
                    <fieldset>
                        <textarea style="height:131px;" placeholder="Description" tabindex="3" required
                                  name="description"></textarea>
                    </fieldset>

                    <fieldset>
                        <input placeholder="Version" type="text" tabindex="4" required name="version">
                    </fieldset>
                    <fieldset>
                        <input placeholder="Class Prefix" type="text" tabindex="9" required name="class_prefix">
                    </fieldset>
                </div>
                <div class="col-sm-6">
                    <fieldset>
                        <input placeholder="Author" type="text" tabindex="5" required name="author">
                    </fieldset>
                    <fieldset>
                        <input placeholder="Author URI" type="url" tabindex="6" required name="author_uri">
                    </fieldset>
                    <fieldset>
                        <input placeholder="Requires at least" type="text" tabindex="7" required
                               name="require_at_least">
                    </fieldset>
                    <fieldset>
                        <input placeholder="Tested up to" type="text" tabindex="8" required name="tested_up_to">
                    </fieldset>
                    <fieldset>
                        <input placeholder="Text Domain" type="text" tabindex="9" required name="text_domain">
                    </fieldset>
                    <fieldset>
                        <input placeholder="Domain Path" type="text" tabindex="9" required name="domain_path">
                    </fieldset>


                    <fieldset>
                        <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
                    </fieldset>
                </div>
                <div style="clear:both"></div>
            </form>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery library -->
<script type="text/javascript" src="js/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>