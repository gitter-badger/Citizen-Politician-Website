<?php
	$action=htmlspecialchars($_POST["action"]);
	$user=htmlspecialchars($_POST["user"]);
	require "Connection.php";
	if($action==="delete"){
		$sql = "insert into deactivated_accounts(userName,email,emailVerified,phone,phoneVerified,gender,accountType,countyNo,photo,Password) select * from citizen_profile where UserName='$user';insert into deactivated_accounts(userName,email,emailVerified,phone,phoneVerified,gender,accountType,countyNo,photo,Password) select userName,email,emailVerified,phone,phoneVerified,gender,accountType,countyNo,photo,password from politician_profile where userName='$user';insert into deactivated_politics(userName,FullNames,DateOfBirth,PoliticalSeat,PoliticalYears,CreationTime,Vying,ConstituencyNo,WardNo) select * from politician_politics where userName='$user';insert into deactivated_education(userName,bachelors,primarySchool,secondarySchool,university,masters,phd,schoolCertificates,display,mastersCourse,phdCourse,otherCourses) select * from politician_education where userName='$user'; delete from citizen_profile where userName='$user';delete from politician_profile where userName='$user'";
	 	if(mysqli_multi_query($connection,$sql)){
	 		echo "Successfully deactivated user account with username $user.";
	 	}else{
	 		echo "Failed to deactivated user account with username $user. $connection->error";
	 	}
	}else if($action==="reactivate"){
		$sql = "insert into citizen_profile(UserName,Email,verifyEmail,phone,verifyPhone,gender,type,County,photo,Secret) select * from deactivated_accounts where userName='$user' and accountType='citizen';insert into politician_profile(userName,email,emailVerified,phone,phoneVerified,gender,accountType,countyNo,photo,password) select * from deactivated_accounts where userName='$user' and accountType='politician';insert into politician_politics(userName,FullNames,DateOfBirth,PoliticalSeat,PoliticalYears,CreationDate,Vying,ConstituencyNo,WardNo) select * from deactivated_politics where userName='$user';insert into politician_education(userName,bachelors,primarySchool,secondarySchool,university,masters,phd,schoolCertificates,display,mastersCourse,phdCourse,otherCourses) select * from deactivated_education where userName='$user';update politician_profile set accountVerified=1 where userName='$user';delete from deactivated_accounts where userName='$user';delete from deactivated_politics where userName='$user';delete from deactivated_education where userName='$user';";
		if(mysqli_multi_query($connection,$sql)){
	 		echo "Successfully reactivated user account with username $user.";
	 	}else{
	 		echo "Failed to reactivated user account with username $user. $connection->error";
	 	}
 	}
?>