<?php
include 'resources/templates/header.php';
include 'resources/templates/navbar.php';
?>

<?php
    require 'resources/library/database.php';
    $id = 0;

    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

    if ( !empty($_POST)) {

        $id = $_POST['id'];


        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM clients  WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header("Location: clients.php");

    }
?>

<div class="container">
  <div class="span10 offset1">
      <div class="row">
          <h3>Delete a Client</h3>
      </div>
      <form class="form-horizontal" action="delete.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id;?>"/>
        <h4 class="alert alert-error"><strong>Are you sure</strong></h4>
        <div class="form-actions">
            <button type="submit" class="btn btn-danger">Yes</button>
            <a class="btn btn-default" href="clients.php">No</a>
          </div>
      </form>
  </div>
</div>

<?php include 'resources/templates/footer.php'; ?>
