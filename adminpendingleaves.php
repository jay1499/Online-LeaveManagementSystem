<?php
session_start();
include('mainserver.php');


if(strlen($_SESSION['emplogin'])==0)
    {   
header('location:adminlogin.php');
}
else
{	
$sql="SELECT users.id,users.First_Name,users.Last_Name,users.Loginid,tbleaves.id as lid,tbleaves.LeaveType,tbleaves.FromDate,tbleaves.ToDate,tbleaves.Description,tbleaves.PostingDate,tbleaves.Status,tbleaves.empid FROM tbleaves INNER JOIN users on tbleaves.empid=users.id AND tbleaves.Status=0";
	$r=mysqli_query($db,$sql);
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Page</title>
<link rel="stylesheet" type="text/css" href="mystyle.css"></link>
<style>
body{
	background-color:#ffffcc;
}
table{
	background-color:white;
	border-color:#ccc;
   border-style:outset;
   border-radius:4px;
   border-width:1px;
}
input[type=submit]{
	width:60%;
	background-color:blue;
	color:white;
	border: 1px outset grey;
    border-radius: 4px;
	padding: 5px 9px;
	 cursor: pointer;
}
input[type=submit]:hover {
    background-color: #787878;
}
</style>
</head>

<body>
<br/>
<img src="bmscelogonew.png" >
  
  <div class="topnav">
  <a  href="adminhome.php">Home</a>
   <a  href="adminuserdetails.php">Users Info</a>
    <a href="adminalleaves.php">All Leaves</a>
  <a  class="active" href="adminpendingleaves.php">Pending Leaves</a>
   <a  href="adminapprovedleaves.php">Approved Leaves</a>
    <a   href="admindisapprovedleaves.php">Disapproved Leaves</a>
  <a class="z" href="logout.php">Logout</a>
  
  
</div>

<h3>Pending Leaves</h3>

<br/><br/><br/><br/><br/>
<table  border='1' cellpadding='5'  align="center" width="1100px">
 <tr style="background-color:#ccc">
 <th width="65px"> Leave ID</th>
 <th width="150px">Student Name</th>
 <th >Login Id</th>
 <th >Leave Type</th>
 <th  width="80px">From Date</th>
 <th  width="80px">To Date</th>
 <th width="150px">Description </th>
 <th >Posting Date</th>
 <th width="150px">Take Action</th>
 </tr>
 
 <?php


   while($cols=mysqli_fetch_assoc($r)){
	echo "<td >".$cols['lid']."</td>";

	echo "<td >".$cols['First_Name']."  ".$cols['Last_Name']."</td>";
	
	echo "<td >".$cols['Loginid']."</td>";
	
	echo "<td >".$cols['LeaveType']."</td>";
	
	echo "<td >".$cols['FromDate']."</td>";
	
	echo "<td >".$cols['ToDate']."</td>";
	
	echo "<td >".$cols['Description']."</td>";
	
	echo "<td >".$cols['PostingDate']."</td>";
   ?>
 <td colspan='20'> 
 <form name="adminaction" action="adminpendingleaves.php" method="post">
 <?php $var=$cols['lid']; 
 include('takeaction.php');?>
  <input type="submit" value="Approve" name="approve" /> &nbsp;
  <input type="submit" value="Disapprove" name="disapprove"/>
  </form>
  </td>
     <?php
	echo "</tr>";
	
}
?>
 
 
</body>
</html>
<?php } ?> 