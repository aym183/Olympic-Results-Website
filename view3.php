<!doctype html>
<html lang="en">
<head>
    <!-- This php file where the overall comparison of the 2 countries takes place-->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Access MySQL</title>
  <style>
	body{background-color:yellow;font-size:0.8em;text-align:center;}
	#jsonDiv{text-align:left;}



  table.table{
            text-align:center;
            margin-left:auto;
            margin-right:auto;
            border-style:outset;
            border-width:0.3em;
            border-color:beige;
            font-size:1.5em;
            width:48%;
  }

 

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

  table.table2{
  font-size:1.5em;
  text-align:left;
  
  width:48%;
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



           
<!-- This is the php file where when the submit button in the previous file is clicked, the php command runs the sql queries to return the full tables for both the countries-->
<?php
if(isset($_REQUEST['submit'])){
    //These are the details required to cause a connectiom to the database
    $servername = "localhost";
    $dbname = "coa123cdb";
    $username = "coa123cycle";
    $password = "bgt87awx";


$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
//The country_id1 and country_id2 are requested from the input field to run in the sql queries to return the desired output
$countryid1 = $_REQUEST['country_id1'];
$countryid2 = $_REQUEST['country_id2'];
$name = $_REQUEST["country_id1"];
$review = $_REQUEST["country_id2"];
$tablename1="Cyclist";
$tablename2="Country";

$filter = $_REQUEST['filter'];

// This code checks if any of the inputs is empty. If it is, the user gets an alert message and a black page is shown. When shown, please click the back button and enter the valid input.
if(!isset($countryid1) || trim($countryid1) == '' || !isset($countryid2) || trim($countryid2) == '' )
{
  echo '<script>alert("Empty Input Field")</script>';

}

 // This code checks if any of the inputs is not a number. If it is, the user gets an alert message and a black page is shown. When shown, please click the back button and enter the valid input.
else if (is_numeric($countryid1)==1 || is_numeric($countryid1)==1 || is_numeric($countryid2)==1 || is_numeric($countryid2)==1  ) {
  echo '<script>alert("Please enter only string")</script>';
}

else{
echo "<h3 class = 'NEW'>The countries that are being compared are $name and $review</h3>";

// query which shows the base details of the 2 countries

$sql = "SELECT * FROM Country 
where ISO_id = '$countryid1'  or Country.ISO_id = '$countryid2'  ";
$result = mysqli_query($conn, $sql);


// query which does the implementation for the total medals
$sql3 = "SELECT (SELECT COUNT(DISTINCT total) FROM `Country` c1 where c1.total>=  c.total) as 'RANK' , c.ISO_id ,c.total

                        FROM `Country` c
                        where (ISO_id = '$countryid1' or ISO_id = '$countryid2')
                        ORDER by c.total desc";

$result3 = mysqli_query($conn, $sql3);


// query which does the implementation for the total medals
$sql5 = "SELECT (SELECT COUNT(DISTINCT gold) FROM `Country` c1 where c1.gold>=  c.gold) as 'RANK' , c.ISO_id ,c.gold

FROM `Country` c
where (ISO_id = '$countryid1' or ISO_id = '$countryid2')
ORDER by c.gold desc";

$result5 = mysqli_query($conn, $sql5);


// The query which gives the user the names of all the cyclists from both the countries which is displayed below the base details of the 2 countries
$sql4 = "SELECT Cyclist.ISO_id , Cyclist.name 
FROM `Cyclist` 
where Cyclist.ISO_id = '$countryid1'  or Cyclist.ISO_id = '$countryid2'
ORDER by Cyclist.ISO_id";
$result4 = mysqli_query($conn, $sql4);

//this is the query which helps get the number of cyclists for each country
$sql6 = "SELECT ISO_id as Country , Count(name) as 'Number of Cyclists' 
FROM `Cyclist` 
where ISO_id = '$countryid1' or ISO_id = '$countryid2'
Group by ISO_id 
ORDER BY Count(name) desc";
$result6 = mysqli_query($conn, $sql6);

//this is the query which helps get the average age of cyclists for each country
$sql7 = "SELECT  ISO_id as Country,YEAR('2012-07-27')-YEAR(dob) as Average
 FROM `Cyclist` 
 where ISO_id = '$countryid1' or ISO_id = '$countryid2'
GROUP BY ISO_id
ORDER BY YEAR('2012-07-27')-YEAR(dob) asc";
$result7 = mysqli_query($conn, $sql7);




//this is the functionality where the displaying of the base values takes place as no filter is added
  if($filter == 'None'){
    if (mysqli_num_rows($result) > 0){
      echo'<table class = "table">';
  echo'<tr>';
  echo'<th class = "cell1">'."NAME".'</th>';
  echo'<th class = "cell1">'."COUNTRY".'</th>';
  echo'<th class = "cell1">'."BRONZE".'</th>';
  echo'<th class = "cell1">'."SILVER".'</th>';
  echo'<th class = "cell1">'."GOLD".'</th>';
  echo'<th class = "cell1">'."TOTAL".'</th>';
  
  echo'</tr><tr>';
     
      while ($row = mysqli_fetch_array($result)){
        echo '<td>'.$row[0].'</td>';
        echo '<td>'.$row[3].'</td>';
        echo '<td>'.$row[4].'</td>';
        echo '<td>'.$row[5].'</td>';
        echo '<td>'.$row[6].'</td>';
        echo '<td>'.$row[7].'</td>';
        echo'</tr>';
      }
      
      
    }
    else{
      echo"<script>alert('NO VALID OUTPUT FOR $name')</script>";
  }
   
    echo'</table>';

    if (mysqli_num_rows($result4) > 0){
    
        echo'<table class = "table2">';
    echo'<tr>';
    echo'<th class = "cell1">'."COUNTRY".'</th>';
    echo'<th class = "cell1">'."NAME".'</th>';
   
    
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



  //this is the functionality where the displaying of the 'total medals' option takes place
else if($filter == 'Total Medals'){

  if (mysqli_num_rows($result3) > 0){
  
      echo'<table class = "table">';
  echo'<tr>';
  echo'<th class = "cell1">'."WORLD RANKING".'</th>';
  echo'<th class = "cell1">'."COUNTRY".'</th>';
  echo'<th class = "cell1">'."TOTAL MEDALS".'</th>';
  
  echo'</tr><tr>';
  
      while ($row = mysqli_fetch_array($result3)){
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

  if (mysqli_num_rows($result5) > 0){
      echo'<table class = "table">';
  echo'<tr>';
  echo'<th class = "cell1">'."WORLD RANKING".'</th>';
  echo'<th class = "cell1">'."COUNTRY".'</th>';
  echo'<th class = "cell1">'."GOLD MEDALS".'</th>';
  
  echo'</tr><tr>';
   
      while ($row = mysqli_fetch_array($result5)){
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


    
  if (mysqli_num_rows($result6) > 0){
      echo'<table class = "table">';
  echo'<tr>';
  
  echo'<th class = "cell1">'."COUNTRY".'</th>';
  echo'<th class = "cell1">'."NUMBER OF CYCLISTS".'</th>';
 
  echo'</tr><tr>';
    
      while ($row = mysqli_fetch_array($result6)){
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
 else if($filter == 'Average age of cyclists'){


      if (mysqli_num_rows($result7) > 0){
          echo'<table class = "table">';
      echo'<tr>';
      
      echo'<th class = "cell1">'."COUNTRY".'</th>';
      echo'<th class = "cell1">'."AVERAGE AGE OF CYCLISTS".'</th>';
      
      echo'</tr><tr>';
        
          while ($row = mysqli_fetch_array($result7)){
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

  
  echo"<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><hr>";
  echo"<h3>COPYRIGHTS RESERVED</h3>";

}
  

}
mysqli_close($conn);
?>

</body>
</html>