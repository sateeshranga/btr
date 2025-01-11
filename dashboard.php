<!doctype html>
<html class="no-js" lang="zxx">
	<?php include("head.php"); ?>
	<body class="home-two">
        <?php include("header.php"); ?>       
      <style>
        .sidebar {
            height: 100vh;
            /* position: fixed;
            left: 0;
            top: 0; */
            padding-top: 20px;
            background-color: #343a40;
            color: #fff;
            width: 250px;
        }
        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #495057;
            color: #fff;
        }
        .content {
            
            padding: 20px;
        }
        .breadcrumb {
            background-color: transparent;
            padding: 0;
        }
    </style>
        <!-- Contact Section Start -->
        <div class="contact-page-section sec-spacer">
        	<div class="container">
        		<div class="contact-comment-section">
                        <div class="container row col-md-12">
                              <!-- Sidebar -->
                              <div class="sidebar col-md-2 pull-left">
                                    <hr class="text-secondary">
                                    <a href="#">Home</a>
                                    <a href="#">Profile</a>
                                    <a href="#">Settings</a>
                                    <a href="#">Messages</a>
                                    <a href="#">Logout</a>
                              </div>
                              <div class="content col-md-10">
                                    <!-- Breadcrumb -->
                                    <nav aria-label="breadcrumb">
                                          <ol class="breadcrumb">
                                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                                          <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                          </ol>
                                    </nav>

                                    <!-- Main Content -->
                                    <h2>Welcome to the Dashboard</h2>
                                    <p>This is your main content area.</p>
                                    <div class="row">
                                          <div class="col-md-4">
                                          <div class="card mb-3">
                                                <div class="card-header bg-primary text-white">Card 1</div>
                                                <div class="card-body">
                                                      <p>This is card content.</p>
                                                </div>
                                          </div>
                                          </div>
                                          <div class="col-md-4">
                                          <div class="card mb-3">
                                                <div class="card-header bg-success text-white">Card 2</div>
                                                <div class="card-body">
                                                      <p>This is card content.</p>
                                                </div>
                                          </div>
                                          </div>
                                          <div class="col-md-4">
                                          <div class="card mb-3">
                                                <div class="card-header bg-warning text-dark">Card 3</div>
                                                <div class="card-body">
                                                      <p>This is card content.</p>
                                                </div>
                                          </div>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
      <!-- Contact Section End -->
      <?php include("footer.php"); ?>