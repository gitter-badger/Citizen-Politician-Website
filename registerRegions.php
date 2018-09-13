<?php
$region=htmlspecialchars($_POST["region"]);
$id=htmlspecialchars($_POST["id"]);
$name=htmlspecialchars($_POST["name"]);
$leader=htmlspecialchars($_POST["leader"]);
if(isset($_POST["county"])){
	$county=htmlspecialchars($_POST["county"]);
}
require "Connection.php";

if($region==="counties"){
	$stmt=$connection->prepare("insert into counties(CountyID,County,Governor) values (?,?,?)");
	if($stmt){
		if($stmt->bind_param("iss",$id,$name,$leader)){
			if($stmt->execute()){
				echo "Successfully added county $name to database.";
				return;
			}
		}
	}
}else if($region==="constituencies"){
	$stmt=$connection->prepare("insert into constituencies(constituencyID,constituency,countyNo,MP) values (?,?,?,?)");
	if($stmt){
		if($stmt->bind_param("isis",$id,$name,$county,$leader)){
			if($stmt->execute()){
				echo "Successfully added constituency $name to database.";
				return;
			}
		}
	}
}else if($region==="wards"){
	$stmt=$connection->prepare("insert into wards(wardID,Ward,constituencyID,MCA) values (?,?,?,?)");
	if($stmt){
		if($stmt->bind_param("isis",$id,$name,$county,$leader)){
			if($stmt->execute()){
				echo "Successfully added ward $name to database.";
				return;
			}
		}
	}
}
echo $connection->error;
?>