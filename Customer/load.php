
<?php
session_start();


if(isset($_SESSION['IS_LOGIN']))
{
  $q=$_SESSION['IS_LOGIN'];

$con=mysqli_connect("localhost","root","","foodcourt");
}
   else{
header("location:login_register.php");

   }

if(isset($_GET['a']))
{
	$or=$_GET['a'];

}
else
{
	echo "error..... NOT FOUND";
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>loading</title>
	<style type="text/css">
		body{
			position: relative;
			width: 100%;
			
		}
		img{
            position: absolute;
           top: 50%;
            left: 50%;
           
            transform: translate(-50%,50%);

		}
	</style>
</head>
<body onLoad="myFunction()">

<!-- <img src="images/11.gif"> -->
<script>
function myFunction() {
  setTimeout(function(){ window.location.href="success2.php?or=<?php echo $or;?>"; }, 3000);
}
</script>

</body>
</html>