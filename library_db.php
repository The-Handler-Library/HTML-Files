<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title> The Capstone Libray > Catalog</title>
    <link rel="shortcut icon" type="image/png" href="images/tcl_aqua_logo.jpg"
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">

  <link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
  <h5> Catalog </h5>


<html>
<style>
    table, th, td {
        border: 1px solid #00FFFF;
        }
    table {
        border-collapse: collapse;
        width: 100%;
        color: black;
    }
    th {
        background-color: black;
        color: #00FFFF;
    }
    th, td {
        padding: 5px;
    }
    
    </style>    
<table>
    <tr>
        <th> ISBN </th>
        <th> Title </th> 
        <th> Edition </th>
        <th> Author Last Name </th>  
        <th> Author First Name </th>
        <th> Publisher </th>  
        <th> Published Year </th>    
        <th> Subject</th>
    </tr>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "loginsystem");

    if(! $conn){
        die("Connection failed:". mysqli_connect_error());
    }
    
    $sql = "SELECT isbn, title, edition, authLast, authFirst, pub, year, subject FROM books";
    $result = $conn-> query($sql);
    
    if ($result-> num_rows > 0) {
        while ($row = $result-> fetch_assoc()) {
            echo "<tr><td>". $row["isbn"] ."</td><td>". $row["title"] ."</td><td>". $row["edition"] ."</td><td>". $row["authLast"] ."</td><td>". $row["authFirst"] ."</td><td>". $row["pub"] ."</td><td>". $row["year"] ."</td><td>". $row["subject"] ."</td><tr>";
        }
        echo "</table>";
    }
    else{
        echo "0 results to show.";
    }
    $conn-> close();
    ?>    
    </table>
    </html>    
        
    
</body>
</html>