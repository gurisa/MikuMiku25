<html>
<head>
  <title>Enkripsi MikuMiku25</title>
</head>
<body>
  <h1>Enkripsi MikuMiku25</h1>
  <hr>
  
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
      <form action="" method="post">
        <textarea name="plaintext" id="" cols="30" rows="10"></textarea>
        <input type="number" name="key" id="" value="1">
        <button type="submit">Enkripsi</button>
      </form>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

    </div>
  </div>
  
  <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
  <?php require_once 'MikuMiku25.php'; ?>
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
      <pre>
        <?php var_dump($_POST['plaintext']); ?>
      </pre>
    </div>
  </div>
  <?php } ?>

</body>
</html>