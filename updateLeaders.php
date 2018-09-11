<?php
	$table=htmlspecialchars($_POST["table"]);
	$id=htmlspecialchars($_POST["id"]);
	$governor=htmlspecialchars($_POST["governor"]);
	require "Connection.php";

	if($table==="counties"){
		$stmt=$connection->query("update counties set Governor='$governor' where CountyID='$id'");
		if($stmt){
			echo "Successfully updated the governor of county $id to $governor";
		}else{
			echo $connection->error;
		}
	}else if($table==="constituencies"){
		$stmt=$connection->query("update constituencies set MP='$governor' where constituencyID='$id'");
		if($stmt){
			echo "Successfully updated the MP of constituency $id to $governor";
		}else{
			echo $connection->error;
		}
	}else if($table==="wards"){
		$stmt=$connection->query("update wards set MCA='$governor' where wardID='$id'");
		if($stmt){
			echo "Successfully updated the MCA of Ward $id to $governor";
		}else{
			echo $connection->error;
		}
	}
?>