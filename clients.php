<?php
include 'resources/templates/header.php';
include 'resources/templates/navbar.php';
?>
 <div class="container">
  <div class="row">
     <div class="col-md-10 col-md-offset-1">
       <table class="table table-striped table-bordered">
             <thead>
               <tr>
                 <th># ID</th>
                 <th>Mac Address</th>
                 <th>Device ID</th>
                 <th>Http Link</th>
                 <th>Action</th>
               </tr>
             </thead>
             <tbody>
       <?php
        include 'resources/library/database.php';
        $pdo = Database::connect();
        $sql = 'SELECT * FROM clients ORDER BY id DESC';
        foreach ($pdo->query($sql) as $row) {
        echo "<tr>";
        echo '<td>'. $row['id'] . '</td>';
        echo '<td>'. $row['mac_adress'] . '</td>';
        echo '<td>'. $row['device_id'] . '</td>';
        echo '<td>'. $row['http'] . '</td>';
        echo '<td width=250>';
        echo '<a class="btn btn-info" href="read.php?id='.$row['id'].'">Read</a>';
        echo ' ';
        echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Update</a>';
        echo ' ';
        echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Delete</a>';
        echo '</td>';
        echo "</tr>";
        }
        Database::disconnect();
       ?>
     </tbody>
    </table>
     </div>
   </div>
 </div>


 <?php
 include 'resources/templates/footer.php';
  ?>
