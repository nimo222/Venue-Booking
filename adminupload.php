<?php



		if (isset($_FILES["fileToUpload"])) 
		{
				$name=$_POST["ProName"];
				$questionCover = $_FILES["fileToUpload"];
				$mng=new MongoDB\Driver\Manager("mongodb://localhost:27017");
				$bulk = new MongoDB\Driver\BulkWrite;
				$data =[
					"PTName" => $name,
					"PTimage" => new MongoDB\BSON\Binary(file_get_contents($questionCover["tmp_name"]), MongoDB\BSON\Binary::TYPE_GENERIC),
					];
				$bulk->insert($data);
				if( $mng->executeBulkWrite('VenueBooking.Image', $bulk))
				{
					header("Location:admin_home.php");
				}
				else
				{
				echo "Unsuccessful";
				}
		}
		

?>
