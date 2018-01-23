<?php
include 'resources/templates/header.php';
include 'resources/templates/navbar.php';
?>
<?php
 include 'resources/library/database.php';

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
         $patjError = 'Path not correct';
         $valid = true;
     }

     if ($valid) {
         $pdo = Database::connect();
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $sql = "INSERT INTO clients (mac_adress,device_id,http) values(?, ?, ?)";
         $q = $pdo->prepare($sql);
         $q->execute(array($mac,$device,$http));
         Database::disconnect();
         header("Location: index.php");
     }
 }
?>
<!-- Content -->
<div class="container">
  <div class="row">
    <div class="col-lg-8">
      <h1>Upload your M3U List</h1>
      <br>
      <div class="panel panel-default">
        <div class="panel-body">
          <form class="form-horizontal" id="form" method="POST" enctype="multipart/form-data" formaction="index.php">
            <legend>
              <i class="fa fa-upload" aria-hidden="true"> <strong> UPLOAD NOW </strong> </i>
             </legend>
             <div class="form-group <?php echo !empty($macError)?'error':'';?> ">
               <label for="MacAdress" class="col-lg-2 control-label">
                 <i class="fa fa-sitemap" aria-hidden="true"> Mac Adress</i>
               </label>
               <div class="col-lg-10">
                <input class="form-control" id="mac_adress" name="mac_adress" placeholder="00:00:00:a1:2b:cc" value="<?php echo !empty($mac)?$mac:'';?>">
                <?php if (!empty($macError)): ?>
                  <span class="help-inline"><?php echo $macError;?></span>
                <?php endif; ?>
              </div>
             </div>
             <div class="form-group <?php echo !empty($deviceError)?'error':'';?>">
               <label for="DeviceID" class="col-lg-2 control-label">
                 <i class="fa fa-android" aria-hidden="true"> Device ID</i>
               </label>
               <div class="col-lg-10">
                <input class="form-control" id="device_id" name="device_id" placeholder="yx2Ry7726T2k3g" value="<?php echo !empty($device)?$device:'';?>">
                <?php if (!empty($deviceError)): ?>
                    <span class="help-inline"><?php echo $deviceError;?></span>
                <?php endif;?>
              </div>
             </div>
             <ul class="nav nav-tabs" style="margin:25px 0">
               <li class="active"><a href="#internet" data-toggle="tab" aria-expanded="true"><i class="fa fa-globe" aria-hidden="true"> From Internet </i></a></li>
               <li class=""><a href="#pc" data-toggle="tab" aria-expanded="false"><i class="fa fa-folder-open" aria-hidden="true"> From PC </i></a></li>
             </ul>
             <div id="myTabContent" class="tab-content">
               <div class="tab-pane fade active in" id="internet">
                 <input class="form-control input" id="http" name="http" value="<?php echo !empty($http)?$http:'';?>" placeholder="http://">
                 <br>
                 <?php if (!empty($httpError)): ?>
                   <span class="help-inline"><?php echo $httpError;?></span>
                 <?php endif; ?>
               </div>
               <div class="tab-pane fade" id="pc">
                 <?php  include 'resources/library/upload.php';?>
                 <div class="well well-sm">
                   <input type="file" name="fileToUpload" id="fileToUpload" value="">
                 </div>
               </div>
             </div>
             <button type="submit" name="submit" class="btn btn-success" style="margin:10px 0;"> <i class="fa fa-paper-plane" aria-hidden="true" onclick="javascript: form.action='index.php';"> Create </i></button>
            <!-- <legend>
              <i class="fa fa-handshake-o" aria-hidden="true"> <strong> FREE TV CHANNELS </strong> </i>
             </legend>
             <div class="form-group">
               <label for="MacAdress" class="col-lg-2 control-label">
                 <i class="fa fa-sitemap" aria-hidden="true"> Mac Adress</i>
               </label>
               <div class="col-lg-10">
                <input class="form-control" id="MacAdress" placeholder="00:00:00:a1:2b:cc" type="text">
              </div>
             </div>
             <div class="form-group">
               <label for="DeviceID" class="col-lg-2 control-label">
                 <i class="fa fa-android" aria-hidden="true"> Device ID</i>
               </label>
               <div class="col-lg-10">
                <input class="form-control" id="DeviceID" placeholder="yx2Ry7726T2k3g" type="text">
              </div>
             </div>
             <ul class="nav nav-tabs" style="margin:25px 0">
               <li class="active"><a href="#free-internet" data-toggle="tab" aria-expanded="true"><i class="fa fa-globe" aria-hidden="true"> From Internet </i></a></li>
               <li class=""><a href="#free-pc" data-toggle="tab" aria-expanded="false"><i class="fa fa-folder-open" aria-hidden="true"> From PC </i></a></li>
             </ul>
             <div id="myTabContent" class="tab-content">
               <div class="tab-pane fade active in" id="free-internet">
                 <input class="form-control input" id="http" name="http" value="" placeholder="http://">
               </div>
               <div class="tab-pane fade" id="free-pc">
                 <form action="upload.php" method="post" enctype="multipart/form-data">
                     Select file to upload:
                     <input type="file" name="fileToUpload" id="fileToUpload">
                     <input type="submit" value="Upload" class="btn btn-default" name="submit">
                 </form>
               </div>
             </div>
             <button type="submit" name="submit" class="btn btn-success" style="margin:10px 0;"> <i class="fa fa-paper-plane" aria-hidden="true"> Create </i></button> -->
          </form>
        </div>
      </div>
  </div>

<?php
include 'resources/templates/sidebar.php';
include 'resources/templates/footer.php';
 ?>
