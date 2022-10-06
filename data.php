<?php 
require_once('config.php');
	ob_start();
    session_start();
	
	if(!isset($_SESSION['admin'])){
		header('location:index.php');
	}
?>



<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Data Of Blood Bank</title>
	<link rel="stylesheet" href="style.css" />
	<style type="text/css">
		body{
			background:#E21500;
		}
		.login{
		float:right;
		}
		table {
			
				font-family: arial, sans-serif;
				border-collapse: collapse;
				width: 100%;
				color:white;
			}

			td, th {
				border: 1px solid #dddddd;
				text-align: left;
				padding: 8px;
			}

			tr:nth-child(even) {
				background:#DD5044;
			}
	</style>
</head>
<body>
	<section class="header_area">
		<div class="header">
			<div class="logo">
				<h1>GUB Blood Club</h1>
			</div>
			
			<div class="login" >
				<a style="color: white; background: blue; padding: 2px 10px; text-decoration: none; border: 1px solid white; float: right;" href="logout.php">Log Out</a>
			</div>
		</div>
	</section>
	
	<section class="Data_area">
		<table>
			  <tr>
				<th>S.L</th>
				<th>Name</th>
				<th>ID No</th>
				<th>Department</th>
				<th>Blood Group</th>
				<th>Session</th>
				<th>Address</th>
				<th>Phone No</th>
				<th>Email</th>
			  </tr>
			  
			  <?php
				$statement =$pdo->prepare("SELECT * FROM tbl_registration");
				$statement->execute();
				$result = $statement->fetchAll(PDO::FETCH_ASSOC);
				foreach($result as $row):;
				?>

			  <tr>
				<td><?php echo $row['id'];?></td>
				<td><?php echo $row['name'];?></td>
				<td><?php echo $row['id_no'];?></td>
				<td><?php echo $row['dept'];?></td>
				<td><?php echo $row['blood_group'];?></td>
				<td><?php echo $row['s_session'];?></td>
				<td><?php echo $row['address'];?></td>
				<td><?php echo $row['phone'];?></td>
				<td><?php echo $row['email'];?></td>
			  </tr>
			 <?php endforeach;?>
			 
		</table>
	</section>
	
	<section style="margin-top: 56vh;" class="footer_area">
		<p>Design By ES Group</p>
	</section>
</body>
</html>