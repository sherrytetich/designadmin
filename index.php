<?php
session_start();
$username = $_SESSION['username'];
if(! $_SESSION['auth']){
    header ("location:/admin/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USSD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
			background-color: #f5f5f5;
			font-family: Arial, sans-serif;
			font-size: 20px;
			line-height: 1.5;
			color: #333;
			margin: 0;
			padding: 0;
		}
        .table {
            border-collapse: collapse;
            width: 100%;
            background-color: #fff;
			box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .table th, .table td {
            text-align: center;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        .table tr:hover {
            background-color: #f5f5f5;
        }
        .table th {
            background-color: #004c6d;
            color: white;
        }
        .table td:first-child {
            font-weight: bold;
        }
        .table td:last-child {
            text-align: center;
        }
        #btn:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        #btn:active {
            background-color: #bd2130;
            border-color: #b21f2d;
        }
        #btn:focus {
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.5);
        }
        a {
			display: inline-block;
			padding: 5px 10px;
			border-radius: 3px;
			background-color: #007bff;
			color: #fff;
			text-decoration: none;
			transition: background-color 0.2s ease;
		}
        #btn {
            position: absolute;
            top: 10px;
            right: 10px;
        }
        #btn{
            background-color: #dc3545;
            border-color: #dc3545;
        }
		a:hover {
			background-color: #0069d9;
		}

    </style>
</head>
<body>
<a class='btn btn-danger float-left btn-sm' id="btn" href="logout.php">Log out</a>

<div class="container my-5">
    <h2>Registered Locations</h2>
    <table class="table">
        <thead>
            <tr>
                <th>LOCATION</th>
                <th>REGISTERED</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $serverName = "localhost";
        $user= 'root';
        $db = 'ussdsecontrial';
        $pass= "";
        $con = new mysqli($serverName,$user,$pass,$db);  

        if($con->connect_error){
            die("connection failed: " .$con->connect_error);
        }

        $stm = "SELECT location, COUNT(*) AS count FROM afterapproval GROUP BY location";
        $result = $con->query($stm);

        if(!$result){
            die ("invalid entry :" .$con->error);
        }

        while($row = $result->fetch_assoc()){
            echo "<tr>
                <td>{$row['location']}</td>
                <td>{$row['count']}</td>
                <td>
                        <a class='btn btn-success btn-sm' href='/admin/approve.php?location=$row[location]'>APPROVE</a>
                        <a class='btn btn-danger btn-sm' href='/admin/delete.php?location=$row[location]'>DELETE</a>
                    </td>
            </tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
