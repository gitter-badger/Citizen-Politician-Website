<?php
$user=htmlspecialchars($_POST['user']);
require 'Connection.php';
$stmt=$connection->prepare("select adminUserName from admin_profile where adminUserName=?");

if($stmt){
	if($stmt->bind_param("s",$user)){
		if($stmt->execute()){
			if($result=$stmt->get_result()){
				if(mysqli_num_rows($result)===0){
					$stmt=$connection->prepare("select Email from citizen_profile where UserName=? union all select email from politician_profile where userName=?");
					if($stmt){
						if($stmt->bind_param("ss",$user,$user)){
							if($stmt->execute()){
								if($result=$stmt->get_result()){
									if(mysqli_num_rows($result)>0){
										$stmt=$connection->prepare("select Email from citizen_profile where UserName=? and verifyEmail=1 union all select email from politician_profile where userName=? and emailVerified=1");
										if($stmt){
											if($stmt->bind_param("ss",$user,$user)){
												if($stmt->execute()){
													if($result=$stmt->get_result()){
														if(mysqli_num_rows($result)>0){
															echo "true";
															return;
														}else{
															echo "That User's email has not yet been verified.";
															return;
														}
													}
												}
											}
										}
									}else{
										echo "That User cannot be found in database.";
										return;
									}
								}
							}
						}
					}
				}else{
					echo "Emails cannot be sent to administrators since system does not have their email addresses.";
					return;
				}
			}
		}
	}
}
echo $connection->error;
?>