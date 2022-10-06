<?php 
	
	require_once('config.php');
	ob_start();
    session_start();
	if(isset($_POST['register_form'])){

		$name = $_POST['name'];
		$id_no = $_POST['id_no'];
		$dept = $_POST['dept'];
		$blood_group = $_POST['blood_group'];
		$s_session = $_POST['s_session'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$condition_1 = $_POST['condition_1'];

		$statement = $pdo->prepare("INSERT INTO 
			tbl_registration(
			name,
			id_no,
			dept,
			blood_group,
			s_session,
			address,
			phone,
			email,
			password,
			condition_1)

			VALUES(?,?,?,?,?,?,?,?,?,?) ");

		$statement->execute(array(
			$name,
			$id_no,
			$dept,
			$blood_group,
			$s_session,
			$address,
			$phone,
			$email,
			$password,
			$condition_1));

		$success_message = "Registration Successfully!!";

	}

	// login form
	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['passowrd'];

		$statement=$pdo->prepare("SELECT * FROM tbl_registration WHERE id_no=?");
		$statement->execute(array($username));
		$count = $statement->rowCount();
		if(!$count){
			$error_message ="User Name Not Found!";
		}
		else{
			
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                foreach ($result as $row) {
                	
                    if($_POST['password']== $row['password']){
                        
                        $_SESSION['admin'] = $row;
                        header('location:data.php');
                    }else{
                        $error_message = "Password Don't Match!";
                    }
                }

		}
	}

?>


<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>GUB Blood Club</title>
	
	<link rel="icon" type="image" href="img/fav.jpg" />
	<link rel="stylesheet" href="style.css" />
	
	<style type="text/css">
		body{
			color: white;
		}
	</style>
</head>
<body>

	<section class="header_area">
		<div class="header">
			<div class="logo">
				<h1>GUB Blood Club</h1>
			</div>
			
			<div class="login">

				<form action="" method="POST">
					<table>
					<tr>
						<td><label for="username"> </label></td>
						<td><input placeholder="Your ID" id="username" type="text" name="username"></td>
						
						<td><label for="password"> </label></td>
						<td><input placeholder="Password" id="password" type="password" name="password"></td>
						
						<td><input type="submit" value="Log In" name="login"></td>
					</tr>
					</table>
				
				</form>
				
				<p>
					<?php
					if(isset($error_message)){
						echo $error_message;
					}
					?>
				</p>
				
			</div>
		</div>
	</section>
	

	
	<section class="registraion_area">
	
		<div class="reg_content">
			<div class="reg_left">
				<h2>Welcome to GUB Blood Club</h2>
				<img src="img/well.jpeg" alt="pic" />
			</div>
			
			<div class="reg_right">
			
			
				<h2>Registration Form:</h2>
				
				<p style="color: green;
					background: #FFF;
					margin-bottom: 10px;
					display: inline-block;">
					<?php
					if(isset($success_message)){
						echo $success_message;
					}
					?>
				</p>
			
				<form method="post" action="">
				<table>
					<tr>
						<td><label for="name">Name</label></td>
						<td>:<input id="name" type="text" required="true" name="name"></td>
					</tr>
					
					<tr>
						<td><label for="id_no">Id No</label></td>
						<td>:<input id="id_no" type="number" required="true" name="id_no"></td>
					</tr>
					
					<tr>
						<td><label for="bl_gl">Department</label></td>
						<td>:<select name="dept" required="true" class="form-control">
                                <option value="CSE">CSE</option>
                                <option value="EEE">EEE</option>
                                <option value="LLB">LLB</option>
                                <option value="BBA">BBA</option>
                                <option value="MBA">MBA</option>
                                
                            </select>
						</td>
					</tr>
					
					<tr>
						<td><label for="bl_gl">Blood Group</label></td>
						<td>:<select name="blood_group" required="true" class="form-control">
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
						</td>
					</tr>
					
					<tr>
						<td><label for="session">Session</label></td>
						<td>:<input id="session" type="text" name="s_session"></td>
					</tr>
					
					<tr>
						<td><label for="address">Address</label></td>
						<td>&nbsp;<textarea id="address" type="text" required="true" name="address" cols="21" rows="4"></textarea></td>
					</tr>
					
					<tr>
						<td><label for="phone">Phone No</label></td>
						<td>:<input id="phone" type="number" required="true" name="phone"></td>
					</tr>
					
					<tr>
						<td><label for="email">Email</label></td>
						<td>:<input id="email" type="email" required="true" name="email"></td>
					</tr>
					
					<tr>
						<td><label for="pass">Password</label></td>
						<td>:<input id="pass" type="password" required="true" name="password"></td>
					</tr>
					<tr>
						<td><label for="pass">Confirm Password</label></td>
						<td>:<input id="pass" type="password" required="true" name="password"></td>
					</tr>
				</table>
				<br />
				
				
				<input id="chekd" name="condition_1" type="checkbox" required="true" value="yes">
				<label for="chekd">Term's and Condition....</label><br />
				<br />
				<input type="submit" value="Registration" name="register_form">
				</form>
			</div>
			
		</div>
	</section>
	
	<section class="footer_area">
		<p>Design by ES Group</p>
	</section>
</body>
</html>