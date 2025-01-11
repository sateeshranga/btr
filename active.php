<?php
include_once("evadmin/config.php");

$q="select `Tournament_Name`, `Location`, `Limit`, `Start_Date`, `End_Date`, `Last_Date_Ent`, `Tourney_ID`, `Status` from tourney_m where `Status` = 1 and Last_Date_Ent >= '".date('Y-m-d')."' order by Tournament_Name";
$result = $dbConn->query($q);
?>
<!doctype html>
<html class="no-js" lang="zxx">
	<?php include("head.php"); ?>
	<body class="home-two">
        <?php include("header.php"); ?>
			
		<!-- All news area Start Here-->
		<div class="all-news-area sec-spacer">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
                        <div class="row">
							<div class="col-12 match-view-tite">
								<h3 class="title-bg">Active Tournaments</h3>
							</div>
						</div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="match-list mmb-45">
                                    <div class="overly-bg"></div>
                                    <table class="match-table">
                                        <tbody>
                                            <tr>
                                                <td class="big-font">Tournament</td>
                                                <td class="medium-font">Location</td>
                                                <td>Start Date</td>
                                                <td>End Date</td>
                                                <td>Last Day For Registration</td>
                                                <td>View Events</td>
                                            </tr>
                                            <?php 
                                            if ($result->num_rows >= 1 ) {
                                                while ($tournamentEach = $result->fetch_assoc()) {
                                                    // print_r($tournamentEach);
                                            ?>
                                            <tr>
                                                <td class="medium-font"><?php echo $tournamentEach['Tournament_Name']; ?></td>
                                                <td class="medium-font"><?php echo $tournamentEach['Location']; ?></td>
                                                <td class="medium-font"><?php echo date('d-m-Y', strtotime($tournamentEach['Start_Date'])); ?></td>
                                                <td class="medium-font"><?php echo date('d-m-Y', strtotime($tournamentEach['End_Date'])); ?></td>
                                                <td class="medium-font"><?php echo date('d-m-Y', strtotime($tournamentEach['Last_Date_Ent'])); ?></td>
                                                <td class="medium-font"><a href="events.php?tid=<?php echo $tournamentEach['Tourney_ID']; ?>">Events</a></td>
                                            </tr>
                                            <?php 
                                                }
                                            } else { 
                                            ?>
                                            <tr>
                                                <td class="medium-font" colspan="6">No data found.</td>
                                            </tr>
                                            <?php    
                                            }
                                            ?>                                                
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
					</div>					
				</div>
           </div>
		</div>
		<!-- All news area end Here-->
		
        <?php include("footer.php"); ?>