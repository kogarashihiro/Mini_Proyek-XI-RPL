<?php 
	session_start();

	$random=rand(1, 3);
	$player="😎";
	$robot="🖥";
	$hasil="";
	$lovePlayer="❤️❤️❤️";
	$loveRobot="❤️❤️❤️";

	if (isset($_POST['reset'])) {
		session_unset();
	}


	if (isset($_POST["✋"]) || isset($_POST["✌️"]) || isset($_POST["✊"])) {
	
	if (isset($_POST['✋'])) {
		$player='✋';
	}elseif (isset($_POST['✌️'])) {
		$player='✌️';
	}elseif (isset($_POST['✊'])) {
		$player='✊';
	}

	if ($random == 1) {
		$robot="✋";
	}elseif ($random == 2){
		$robot="✌️";
	}elseif ($random == 3){
		$robot="✊";
		}

	}

	if ($player == $robot) {
		$hasil="Hasil Seri 😞";
	}elseif( 
		($player=="✋" && $robot=="✊") ||
		($player=="✌️" && $robot=="✋") ||
		($player=="✊" && $robot=="✌️") 
		){
		$hasil="Kamu Menang 😏";
	}elseif( 
		($robot=="✋" && $player=="✊") ||
		($robot=="✌️" && $player=="✋") ||
		($robot=="✊" && $player=="✌️") 
		){
		$hasil="Robot Menang 😭";
	}

	// Penyimpanan Nyawa
	if ($hasil == "Kamu Menang 😏") {
		if (!isset($_SESSION['nyawaRobot'])) {
			$_SESSION['nyawaRobot']=2;
		}elseif($_SESSION['nyawaRobot']==2) {
			$_SESSION['nyawaRobot']=1;
		}elseif($_SESSION['nyawaRobot']==1) {
			$_SESSION['nyawaRobot']=0;
		}

	}elseif ($hasil == "Robot Menang 😭") {
		if (!isset($_SESSION['nyawaPlayer'])) {
			$_SESSION['nyawaPlayer']=2;
		}elseif($_SESSION['nyawaPlayer']==2) {
			$_SESSION['nyawaPlayer']=1;
		}elseif($_SESSION['nyawaPlayer']==1) {
			$_SESSION['nyawaPlayer']=0;
		}
	}
	// Menyimpan Nyawa End

	if (isset($_SESSION['nyawaPlayer']) || isset($_SESSION['nyawaRobot'])) {
		$nyawaRobot=$_SESSION['nyawaRobot'];
		
		if (isset($_SESSION['nyawaRobot'])) {
			
		if ($nyawaRobot==2) {
			$loveRobot="❤️❤️";
		}elseif ($nyawaRobot==1) {
			$loveRobot="❤️";
		}elseif ($nyawaRobot==0) {
			$loveRobot="";
		}
	}

		
		if (isset($_SESSION['nyawaPlayer'])) {

			$nyawaPlayer=$_SESSION['nyawaPlayer'];
		if ($nyawaPlayer==2) {
			$lovePlayer="❤️❤️";
		}elseif ($nyawaPlayer==1) {
			$lovePlayer="❤️";
		}elseif ($nyawaPlayer==0) {
			$lovePlayer="";
		}
	}
		
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Suit</title>
	<link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="asset/css/style.css">
	<script src="asset/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="bg-img">
	<div class="bg-atas d-flex text-light">
		<div class="kiri col-6 ps-4 d-flex align-items-center">
			<h1>😎</h1>
			<h4><?= $lovePlayer ?></h4>
		</div>
		<div class="kanan col-6 text-end pe-4 d-flex align-items-center justify-content-end">
			<h4><?= $loveRobot ?></h4>
			<h1>🖥</h1>
		</div>
	</div>

	<div class="body d-flex align-items-center justify-content-center flex-column" style="min-height: 85vh;">

		<div class="hasil text-light mb-4">
			
		</div>

		<button type="submit" class="btn btn-outline-light mb-4" data-bs-toggle="modal" data-bs-target="#PilihEmoji">Start</button>

		<!-- Reset -->
		<form method="post" action="">
			<button type="submit" name="reset" class="btn btn-outline-light">Reset</button>
		</form>
		<!-- ModalStart -->
		<div class="modal fade" id="PilihEmoji" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  
		  <div class="modal-dialog modal-dialog-center">
		    <div class="modal-content bg-glases text-light">
		      <div class="modal-header">
		        <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih!</h1>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <div class="modal-body text-center">
		      	<form method="post" action="">
		        <button class="btn btn-outline-light" name="✋">
		        	<h1>✋</h1>
		        </button>
		        <button class="btn btn-outline-light mx-5" name="✌️">
		        	<h1>✌️</h1>
		        </button>
		        <button class="btn btn-outline-light" name="✊">
		        	<h1>✊</h1>
		        </button>
		        </form>
		      </div>
		    </div>
		  </div>
		</div>
		<!-- Modal end -->
		
		<!-- Modal pesan -->
		<div class="modal fade" id="ModalPesan" tabindex="-1" aria-labelledby="modalPesan" aria-hidden="true">
		  
		  <div class="modal-dialog modal-dialog-center">
		    <div class="modal-content bg-glases text-light">
		      <div class="modal-body text-center">
		      	<h1><?= $hasil ?></h1>
		      </div>
		    </div>
		  </div>
		</div>
		<!-- Modal pesan end -->
		<!-- Arena -->
		<div class="arena bg-glases p-3 col-lg-8 row text-light">
			<div class="col-4 kiri p-3">
				<h5>Player</h5>
				<h1 style="font-size: 80px;" class="text-center"><?= $player ?></h1>
			</div>
			<div class="col-4 tengah p-3 text-center">
				<p class="fw-bold" style="font-size: 60px">VS</p>
			</div>
			<div class="col-4 kanan p-3 text-end">
				<h5>BOT</h5>
				<h1 style="font-size: 80px;" class="text-center"><?= $robot ?></h1>
			</div>
		</div>
		<!-- Arena End -->
	</div>
</div>
</body>
</html>

<?php if (!empty($hasil)): ?>
	<script>
		var hasilModal= new bootstrap.Modal(document.getElementById("ModalPesan"));
		hasilModal.show();
	</script>
<?php endif ?>