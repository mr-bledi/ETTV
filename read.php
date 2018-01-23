<?php
include 'resources/templates/header.php';
include 'resources/templates/navbar.php';
?>

<?php
    include 'resources/library/database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

    if ( null==$id ) {
        header("Location: index.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM clients where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }
?>

<div class="container">
  <div class="col-md-8 col-md-offset-2">
   <div class="row">
     <h3>Read a Client</h3>
   </div>
   <div class="form-horizontal well">
     <div class="form-group">
       <label class="control-label"><strong>Mac Adress</strong></label>
       <div class="controls">
         <label class="checkbox">
           <?php echo $data['mac_adress']; ?>
         </label>
       </div>
     </div>
     <div class="form-group">
       <label class="control-label"><strong>Device ID</strong></label>
       <div class="controls">
         <label class="checkbox">
           <?php echo $data['device_id']; ?>
         </label>
       </div>
     </div>
     <div class="form-group">
       <label class="control-label"><strong>Http Link</strong></label>
       <div class="controls">
         <label class="checkbox">
           <?php echo $data['http']; ?>
         </label>
       </div>
     </div>
   </div>

 </div>
 <div class="col-md-8 col-md-offset-2">
   <a href="clients.php" class="btn btn-default"> Back </a>
</div> 
</div>
<?php include 'resources/templates/footer.php';?>
