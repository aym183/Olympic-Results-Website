<!doctype html>
<html lang="en">
<head>
    <!-- this is the file  where all the filter options implementation takes place-->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Access MySQL</title>
  <style>
	body{background-color:yellow;font-size:0.8em;text-align:center;}
	#jsonDiv{text-align:left;}

    table.table{
  font-size:1.5em;
  text-align:center;
  margin-left:auto;
  margin-right:auto;
  border-style:outset;
  border-width:0.3em;
  border-color:beige;}

  table.table2{
  font-size:1.5em;
  text-align:center;
  margin-left:auto;
  margin-right:auto;
  border-style:outset;
  border-width:0.3em;
  border-color:beige;}

  th.cell1{
  border-style:inset;
  border-width:0.15em;
  border-color:black;
  background-color:red;}

  h1{
    background-color: aquamarine;
   /*padding from all up down left right increases distance if you right just padding*/ 
    padding: 20px;
    border-width: 5px;
    border-color:azure;
    border-style:ridge;
    position: relative;
    left: 20px;
    text-align:center;
    position: relativel
    animation: bub;
    animation-duration: 2s;
}

h3{
    background-color: aquamarine;
   /*padding from all up down left right increases distance if you right just padding*/ 
    padding: 20px;
    border-width: 5px;
    border-color:azure;
    border-style:ridge;
    position: relative;
    left: 20px;
    text-align:center;
    position: relativel
    animation: bub;
    animation-duration: 2s;
}

  .NEW{
    background-color: aquamarine;
   /*padding from all up down left right increases distance if you right just padding*/ 
    padding: 20px;
    border-width: 5px;
    border-color:azure;
    border-style:ridge;
    position: relative;
    left: 20px;
    text-align:center;
    position: relativel
    animation: bub;
    animation-duration: 2s;
}
  .larger2{
            text-align:center;
            display: inline-block;
            color: 'aqua';
            text-decoration: none;
            padding: 1rem 2rem;
            border: black;
            
            animation-name: btn;
            opacity:0;
            margin-top:40px;
            animation-duration: 2s;
            animation-delay : 1s;
            animation-fill-mode: forwards;
            transition-property: transform;
            transition-duration:1s;

        }

        .larger2:hover{
            transform: rotateY(180deg);
        }
        @keyframes btn{
            0%{opacity:0}
            100%{opacity:1}
        }
  body{
            font-family: Arial;
            text-align: center;
            background-color:darkblue;
            color : black;
        }

  </style>

<body style="background-image: url('pexels-madison-inouye-1831234.jpg');">
<div> 
  <h1>THE DETAILS ARE LISTED BELOW</h1>
  <hr>
</div>
<form action = 'view4.php' method = 'get'>
            <h3 class = "NEW"><label for="filter" >Filter By:</label></h3>
                <select name="filter" class = "NEW" id="filter">
                <option value="None">None</option>
                <option value="Total Medals">Total Medals</option>
                <option value="Gold Medals">Gold Medals</option>
                <option value="Number of Cyclists">Number of Cyclists</option>
                <option value="Average age of cyclists">Average age of cyclists</option>
                </select>
                <br>
                <br>
                <input type="submit"  name="submit" id="submit" value="Submit" class="larger2" > 
                <br>
                <hr>
  </form>
           

  <!-- when the submit button of the dropdown list is submitted, the php file runs-->
<?php

if(isset($_REQUEST['submit'])){

    //The details for the connection to take place
    $servername = "localhost";
    $dbname = "coa123cdb";
    $username = "coa123cycle";
    $password = "bgt87awx";


$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


$filter = $_REQUEST['filter'];
$tablename1="Cyclist";
$tablename2="Country";



//this is the query which helps get the total medals won by each country

$sql = "SELECT  @a:=@a+1 Ranking ,ISO_id as Country, total as Total 
FROM  `Country`, 
(SELECT @a:= 0) AS a
where total!=0
ORDER BY total DESC"; 
$result = mysqli_query($conn, $sql);
$rank = 1;

//this is the query which helps get the total gold medals won by each country
$sql2 = "SELECT @a:=@a+1  Ranking ,ISO_id as Country, gold as Gold 
FROM `Country` ,
(SELECT @a:= 0) AS a
where gold != 0
ORDER BY gold desc";
$result2 = mysqli_query($conn, $sql2);

//this is the query which helps get the number of cyclists for each country
$sql3 = "SELECT ISO_id as Country , Count(name) as 'Number of Cyclists' 
FROM `Cyclist` 
Group by ISO_id 
ORDER BY Count(name) desc";
$result3 = mysqli_query($conn, $sql3);

//this is the query which helps get the average age of cyclists for each country
$sql4 = "SELECT  ISO_id as Country,YEAR('2012-07-27')-YEAR(dob) as Average FROM `Cyclist`
GROUP BY ISO_id
ORDER BY YEAR('2012-07-27')-YEAR(dob) asc";
$result4 = mysqli_query($conn, $sql4);


//this is the functionality where the displaying of the 'total medals' option takes place
if($filter == 'Total Medals'){

if (mysqli_num_rows($result) > 0){

    echo'<table class = "table">';
echo'<tr>';
echo'<th class = "cell1">'."RANKING".'</th>';
echo'<th class = "cell1">'."COUNTRY".'</th>';
echo'<th class = "cell1">'."TOTAL MEDALS".'</th>';

echo'</tr><tr>';

    while ($row = mysqli_fetch_array($result)){
      echo '<td>'.$row[0].'</td>';
      echo '<td>'.$row[1].'</td>';
      echo '<td>'.$row[2].'</td>';
      echo'</tr>';
    }
  
    
  }
  else{
    echo"NO VALID OUTPUT";
}
 
  echo'</table>';

 
  
 
}

//this is the functionality where the displaying of the 'gold medals' option takes place
else if($filter=="Gold Medals"){

    if (mysqli_num_rows($result2) > 0){
        echo'<table class = "table">';
    echo'<tr>';
    echo'<th class = "cell1">'."RANKING".'</th>';
    echo'<th class = "cell1">'."COUNTRY".'</th>';
    echo'<th class = "cell1">'."GOLD MEDALS".'</th>';
    
    echo'</tr><tr>';
     
        while ($row = mysqli_fetch_array($result2)){
          echo '<td>'.$row[0].'</td>';
          echo '<td>'.$row[1].'</td>';
          echo '<td>'.$row[2].'</td>';
          echo'</tr>';
        }
    }
        
      
echo'</table>';
}

//this is the functionality where the displaying of the 'number of cyclists' option takes place
else if($filter == 'Number of Cyclists'){


    
    if (mysqli_num_rows($result3) > 0){
        echo'<table class = "table">';
    echo'<tr>';
    
    echo'<th class = "cell1">'."COUNTRY".'</th>';
    echo'<th class = "cell1">'."NUMBER OF CYCLISTS".'</th>';
   
    echo'</tr><tr>';
      
        while ($row = mysqli_fetch_array($result3)){
          echo '<td>'.$row[0].'</td>';
          echo '<td>'.$row[1].'</td>';
          
          echo'</tr>';
        }
        
      }
      else{
        echo"NO VALID OUTPUT";
    }
     
      echo'</table>';
    
    }
    
    //this is the functionality where the displaying of the 'average age of cyclists' option takes place
  else  if($filter == 'Average age of cyclists'){


        if (mysqli_num_rows($result4) > 0){
            echo'<table class = "table">';
        echo'<tr>';
        
        echo'<th class = "cell1">'."COUNTRY".'</th>';
        echo'<th class = "cell1">'."AVERAGE AGE OF CYCLISTS".'</th>';
        
        echo'</tr><tr>';
          
            while ($row = mysqli_fetch_array($result4)){
              echo '<td>'.$row[0].'</td>';
              echo '<td>'.$row[1].'</td>';
           
              echo'</tr>';
            }
          
          }
          else{
            echo"NO VALID OUTPUT";
        }
         
          echo'</table>';
        
        }

        else{
          echo'<script>alert("No Values For This Filter")</script>';
        }
  
        echo"<br><br><br><br><br><br><br><br><br><br><hr>";
        echo"<h3>COPYRIGHTS RESERVED</h3>";
}
mysqli_close($conn);
?>
</body>
</html>