<!DOCTYPE html>

<html>
	<head>
		<title>Home | Division Office</title>
		<?php include '../include/applicant-header-content.php';?>
	</head>
	<body>
		<section class= "applicant-header-container">
			<?php include '../include/applicant-header-container.php';?>
		</section>
		<section class= "applicant-content-container">
			<section class= "body-container">
				<section class= "slider-container">
						<section class= "slider">
						<div class= "slide"><img src= "../img/2.jpg"></div>
						<div class= "slide"><img src= "../img/3.jpg"></div>
						<div class= "slide"><img src= "../img/4.jpg"></div>
						<div class= "slide"><img src= "../img/5.png"></div>
					</section>
				</section>
				<section class= "news-container">
					<section class= "main-info">
						<h1>News</h1>
						<div class= "line"></div>
						<section class= "info-latest">
							<img src= "../img/news1.jpg" id= "news-img">
							<h1 id= "title">Dissemination of Presidential Proclamation No. 269</h1>
							<p id= "author">Roy L. Ilustre, August 10, 2017</p>
							<h3 id= "subtitle">Declaring the Regular Holidays and Special (Non-working Days for the year 2018)</h3>
							<p id= "memo-title">Division Memorandum No. 105, s. 2017</p>
							<a href= "#" id= "view-memo">View Memorandum</a>
							<p id= "info-content">For the information and guidance of all concerned, enclosed is a copy of DepEd Memorandum no. 127 s. 2017, from the Undersecretary, Officer In-Charge, Department of Education, dated July 31, 2017 entitled Declaring the Regular Holidays and Special (Non-working) Days for the year 2018, which is selfexplanatory. </p>
						</section>
					</section>
					<section class= "past-info">
						<section class= "past-content">
							<h2 id= "past-title">Division No. 187, s. 2019</h2>
							<p id= "past-info">Info Content</p>
							<a href= "#" id= "past-memo">View Memorandum</a>
						</section>
						<section class= "past-content">
							<h2 id= "past-title">Division No. 187, s. 2019</h2>
							<p id= "past-info">Info Content</p>
							<a href= "#" id= "past-memo">View Memorandum</a>
						</section>
						<section class= "past-content">
							<h2 id= "past-title">Division No. 187, s. 2019</h2>
							<p id= "past-info">Info Content</p>
							<a href= "#" id= "past-memo">View Memorandum</a>
						</section>
						<section class= "past-content">
							<h2 id= "past-title">Division No. 187, s. 2019</h2>
							<p id= "past-info">Info Content</p>
							<a href= "#" id= "past-memo">View Memorandum</a>
						</section>
					</section>
				</section>
				<section class= "applicant-container">
					<h1>List Qualified Teachers</h1>
					<div class= "line"></div>
					<input type= "text" placeholder= "Search...">
					<section class= "applicant-table">
						<section class= "applicant-table-header">
							<section class= "header">
								<p>Rank</p>
							</section>
							<section class= "header">
								<p>Teacher`s Name</p>
							</section>
							<section class= "header">
								<p>Age</p>
							</section>
							<section class= "header">
								<p>Grade</p>
							</section>
						</section>
						<section class= "applicant-table-content">
							<?php
			                    $cnt='';
			                    $sql = "SELECT DISTINCT LASTNAME, FIRSTNAME, MIDDLENAME, TOTALPOINTS FROM view_rank";
			                    $query = $conn->query($sql);
			                    while($row = $query->fetch_assoc()){
			                      $cnt += 1;
		                    ?>
							<section class= "content-info">
								<section class= "info">
									<p><?php echo $cnt ?></p>
								</section>
								<section class= "info">
									<p><?php echo $row['LASTNAME']; ?>, <?php echo $row['FIRSTNAME']; ?> <?php echo $row['MIDDLENAME']; ?></p>
								</section>
								<section class= "info">
									<p>21</p>
								</section>
								<section class= "info">
									<p><?php echo $row['TOTALPOINTS']; ?></p>
								</section>
							</section>
							<?php
								}
                  			?>
						</section>
					</section>
				</section>
			</section>
		</section>
		<?php include '../include/user-info-modal.php';?>
		<?php include '../include/applicant-image-modal.php';?>
		<?php include '../include/applicant-pds-modal.php';?>
		<?php include '../include/applicant-files-modal.php';?>
		<?php include '../include/applicant-error-modal.php';?>
		<?php include '../include/applicant-success-modal.php';?>
	</body>
</html>