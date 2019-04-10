<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Kriptografi MikuMiku25</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style>
    .text-wrap {
      word-wrap: break-word;
    }
  </style>
</head>
<body>
	<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
		<?php require_once 'MikuMiku25.php'; ?>
		<?php $miku = new MikuMiku25(); ?>
		<?php 
			if (array_key_exists('generate_key', $_POST)) {
				$_POST['key'] = $miku->getRandomString();
			}	  	
		?>
	<?php } ?>
  <div class="container">
    <div class="row mt-3">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h1>Kriptografi MikuMiku2<sup>5</sup> </h1>
        <hr>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
        <form action="" method="post">
          <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <label for="number">Teks</label>
              <textarea class="form-control" name="text" id="text" cols="30" rows="7"><?php echo isset($_POST['text']) ? $_POST['text'] : ''; ?></textarea>
            </div>
          </div>
          <div class="form-group row">
		  	<div class="col-lg-3 col-md-5 col-sm-4 col-xs-5">
				<label for="number">Jenis</label>
				<select class="form-control" name="type" id="type">
					<option value="encrypt" <?php echo ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['type']) && $_POST['type'] == 'encrypt') ? 'selected' : '' ?>>Enkripsi</option>
					<option value="decrypt" <?php echo ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['type']) && $_POST['type'] == 'decrypt') ? 'selected' : '' ?>>Dekripsi</option>
				</select>
            </div>
            <div class="col-lg-7 col-md-5 col-sm-6 col-xs-5">
				<label for="number">Kunci (opsional)</label>
				<input class="form-control" type="text" name="key" id="key" value="<?php echo isset($_POST['key']) ? $_POST['key'] : ''; ?>" maxlength="32">
            </div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
				<label for="">&nbsp;</label>
				<button class="btn btn-secondary form-control btn-md" name="generate_key" type="submit">Buat</button>
			</div>
          </div>
          <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<button class="btn btn-primary btn-block btn-md" name="generate_crypto" type="submit">Proses</button>
            </div>
          </div>
        </form>
      </div>
      <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
        <div class="text-center">
          <h3>Ini Miku</h3>
          <p>Cuma hiasan 😍</p>
          <img src="asset/image/miku.png" class="rounded" alt="..." style="width: 200px;; height: 250px;">
        </div>
      </div>
    </div>

    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && array_key_exists('generate_crypto', $_POST)) { ?>

      <div class="row">
        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
			<?php 
				$data = [
					'result' => '',
					'code' => '',
					'color' => 'info',
					'message' => '',
				];
				if (!in_array(trim($_POST['text']), [null, '', ' '])) {
					if (isset($_POST['type']) && in_array($_POST['type'], ['encrypt', 'decrypt'])) {
						if (isset($_POST['key']) && !empty($_POST['key'])) {
							$miku = $miku->setKey($_POST['key']);
						}
						if ($_POST['type'] == 'encrypt') {
							$data['result'] = $miku->setPlainText($_POST['text'])
								->encrypt()->getChiperText();
							$data['message'] = 'Hasil Enrkipsi (Chiper Text)';
							$data['color'] = 'success';
						}
						else {
							$data['result'] = $miku->setChiperText($_POST['text'])
								->decrypt()->getPlainText();
							$data['message'] = 'Hasil Dekripsi (Plain Text)';
							$data['color'] = 'success';
						}
					}
					else {
						$data['color'] = 'warning';
						$data['message'] = 'Oops, metode kriptografi tidak ditemukan';
					}
				}
				else {
					$data['color'] = 'danger';
					$data['message'] = 'Oops, silahkan masukan teks';
				}
            ?>
			<div class="alert alert-<?php echo $data['color']; ?>"><?php echo $data['message']; ?></div>
			<?php if (isset($data['result']) && !empty($data['result']) && !in_array($data['result'], ['', ' ', null])) { ?>
			<div class="jumbotron text-wrap"><?php echo $data['result']; ?></div>
        </div>
      </div>
			<?php } ?>
      
    <?php } ?>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
