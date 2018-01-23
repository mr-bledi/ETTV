<?php
include 'resources/templates/header.php';
include 'resources/templates/navbar.php';
?>
<?php
require 'resources/library/database.php';

$id = null;
if ( !empty($_GET['id'])) {
  $id = $_REQUEST['id'];
}

if ( null==$id ) {
  header("Location: clients.php");
}

if ( !empty($_POST)) {
$macError = null;
$deviceError = null;
$httpError = null;
$pathError = null;


$mac = $_POST['mac_adress'];
$device = $_POST['device_id'];
$http = $_POST['http'];
$valid = true;

if (empty($mac)) {
    $macError = 'Please enter a Mac adress';
    $valid = false;
}

if (empty($device)) {
    $deviceError = 'Please enter Device ID';
    $valid = false;
}

if (!empty($http)) {
    $httpError = 'Please enter a http link';
    $valid = true;
}

if (!empty($path)) {
    $pathError = 'Path not correct';
    $valid = true;
}
if ($valid) {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE clients  set mac_adress = ?, device_id = ?, http =? WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($mac,$device,$http,$id));
    Database::disconnect();
    header("Location: clients.php");
}} else {
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM clients where id = ?";
$q = $pdo->prepare($sql);
$q->execute(array($id));
$data = $q->fetch(PDO::FETCH_ASSOC);
$mac = $data['mac_adress'];
$device = $data['device_id'];
$http = $data['http'];
Database::disconnect();
}
?>

<div class="container">
  <div class="span10 offset1">
      <div class="row">
          <h3>Update a Client</h3>
      </div>
      <form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
        <div class="form-group <?php echo !empty($macError)?'error':'';?>">
          <label class="control-label">Mac adress</label>
          <div class="controls">
              <input name="mac_adress" type="text" class="form-control" placeholder="mac adress" value="<?php echo !empty($mac)?$mac:'';?>">
              <?php if (!empty($macError)): ?>
                  <span class="help-inline"><?php echo $macError;?></span>
              <?php endif; ?>
          </div>
        </div>
        <div class="form-group <?php echo !empty($deviceError)?'error':'';?>">
          <label class="control-label">Device ID</label>
          <div class="controls">
              <input name="device_id" class="form-control" type="text" placeholder="Device ID" value="<?php echo !empty($device)?$device:'';?>">
              <?php if (!empty($deviceError)): ?>
                  <span class="help-inline"><?php echo $deviceError;?></span>
              <?php endif;?>
          </div>
        </div>
        <div class="form-group <?php echo !empty($httpError)?'error':'';?>">
          <label class="control-label">Http Link</label>
          <div class="controls">
              <input name="http" type="text" class="form-control" placeholder="Http Link" value="<?php echo !empty($http)?$http:'';?>">
              <?php if (!empty($httpError)): ?>
                  <span class="help-inline"><?php echo $httpError;?></span>
              <?php endif;?>
          </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success">Update</button>
            <a class="btn btn-default" href="clients.php">Back</a>
          </div>
      </form>
  </div>
</div>
<?php include 'resources/templates/footer.php';?>
