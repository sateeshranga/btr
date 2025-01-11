<style>        
.contact-comment-section h3{color:#03adf1 !important;}
</style>        
        <!--Header area start here-->
        <header>
			<div class="header-middle-area menu-sticky">
                <div class="container-fluid">
                    <div class="row alignCenter">
                        <div class="col-lg-1 col-md-12 col-sm-12 logo">
                            <a href="index.php"><img src="images/logo-one.jpeg" alt="logo"></a>
                        </div>
                        <div class="col-lg-9 col-md-12 col-sm-12 mobile-menu">
                            <h3 class="mainTitle headTitle">Welcome to Badminton Association of Telangana</h3>
                       </div>
                       <div class="col-lg-2 col-md-12 col-sm-12 logo">
                            <div class="main-menu">
                                <a class="rs-menu-toggle"><i class="fa fa-bars"></i>Menu</a>
                                <nav class="rs-menu">
                                    <ul class="nav-menu">                                  
                                        <li><a href="contact.php" class="singleMenu">Contact Us</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</header>
		<!--Header area end here-->
        <!--Header area start here-->
		<header>
			<div class="header-middle-area customSecondHeader" style="background: #fff;">
                <div class="container-fluid">
                    <div class="row menuBord">                       
                        <div class="col-lg-12 col-md-12 col-sm-12 mobile-menu">
                            <div class="main-menu">
                                <a class="rs-menu-toggle"><i class="fa fa-bars"></i>Menu</a>
                                <nav class="rs-menu">
                                    <ul class="nav-menu">
                                        <!-- Home -->
                                        <li class="current_page_item">
                                            <a href="index.php">Home</a>
                                        </li>
                                        <!-- End Home -->
                                        
                                        <!-- Drop Down -->
                                        <li class="menu-item-has-children">
                                            <a href="#">Tournaments</a>
                                            <ul class="sub-menu">
                                               <li><a href="active.php">Active</a></li> 
                                               <li><a href="past.php">Past</a></li> 
                                             </ul>
                                        </li>
                                         <!-- Drop Down -->
                                         <!-- Drop Down -->
                                         <li class="menu-item-has-children">
                                            <a href="#">BAT Details </a>
                                            <ul class="sub-menu">
                                               <li><a href="team.php">BAT Official</a></li> 
                                               <li><a href="districts.php">Affiliated Districts</a></li> 
                                               <li><a href="academies.php">Registered Academies</a></li> 
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="#">Players Arena</a>
                                            <?php if(isset($_SESSION['btr_user'])){?>
                                            <ul class="sub-menu">
                                               <li><a href="dashboard.php">My Profile</a></li> 
                                               <li><a href="logout.php">Logout</a></li> 
                                            </ul>
                                            <?php } else { ?>
                                                <ul class="sub-menu">
                                               <li><a href="player-registration.php">Player Registration</a></li> 
                                               <li><a href="login.php">Player Login</a></li> 
                                            </ul>
                                            <?php } ?>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="#">Downloads</a>
                                            <ul class="sub-menu">
                                               <li><a href="forms.php">Forms</a></li>  </ul>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="#">Important Information</a>
                                            <ul class="sub-menu">
                                               <li><a href="calendar.php">BAT Calendar</a></li> 
                                               <li><a href="rankings.php">BAT Rankings</a></li> 
                                            </ul>
                                        </li>                                      
                                    </ul>
                               </nav>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
		</header>
		<!--Header area end here-->