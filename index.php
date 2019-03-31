<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Enkripsi MikuMiku25</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h1>Enkripsi MikuMiku25</h1>
        <hr>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
        <form action="" method="post">
          <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <label for="number">Teks</label>
              <textarea class="form-control" name="plaintext" id="" cols="30" rows="7"></textarea>              
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-8 col-md-6 col-sm-7 col-xs-6">
              <label for="number">Kunci</label>
              <input class="form-control" type="text" name="key" id="" value="">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-5 col-xs-6">
              <label for="number">Jenis</label>
              <select class="form-control" name="type" id="">
                <option value="encrypt">Enkripsi</option>
                <option value="decrypt">Dekripsi</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <button class="btn btn-primary" type="submit">Proses</button>
            </div>
          </div>
        </form>
      </div>
      <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
        <div class="text-center">
          <img src="https://vignette.wikia.nocookie.net/vocaloid/images/5/57/Miku_v4_bundle_art.png/revision/latest?cb=20181006092728" class="rounded" alt="...">
        </div>
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
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
