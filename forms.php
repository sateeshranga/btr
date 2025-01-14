<?php
include_once("evadmin/config.php");

$q="select * from info_screens where `Status` = 1 and pid=3";
$result = $dbConn->query($q);
$rowRs = $result->fetch_assoc();
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
								<h3 class="title-bg"><?php echo $rowRs['page_name'];?></h3>
							</div>
						</div>
					</div>					
				</div>
				<div class="row">
					<div class="col-lg-12">
                        <div class="row">
						<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
						<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
							<div class="col-12 "  id="editor-container" style="height: 300px;">
								<?php echo (!empty($rowRs['content'])) ? htmlspecialchars_decode($rowRs['content']) : "";?>
							</div>
						<script>
							var quill = new Quill('#editor-container');
						</script>
						</div>
					</div>					
				</div>
           </div>
		</div>
		<!-- All news area end Here-->
		
        <?php include("footer.php"); ?>