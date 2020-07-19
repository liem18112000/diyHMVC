<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- Favicon -->
	<link rel="icon" type="image/png" href="<?= PUBLICS['img'] . '/favicon/logo.png' ?>">

	<!-- Style Sheets -->
	<link rel="stylesheet" href="<?= PUBLICS['css'] . '/application/main.css' ?>">
	<link rel="stylesheet" href="<?= PUBLICS['css'] . '/application/footer.css'?>">

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Lobster|Lobster+Two|Oswald|Roboto&display=swap" rel="stylesheet">

	<title><?= WEB_NAME ?> </title>
</head>

<body>

	<?php
	use Framework\Translator\SimpleTranslator as Translator;
	require_once(Application['paths']['app'] . '/view/component/navbar.php');
	require_once(Application['paths']['app'] . '/view/' . $this->view . '.php');
	// require_once(Application['paths']['app'] . '/view/component/footer.php');
	?>

	<!-- Modal -->
	<div class="modal fade" id="myModal" role="dialog" style='color: black;'>
		<div class="modal-dialog  ">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title font-title"><?= WEB_NAME ?></h1>
				</div>
				<div class="modal-body font-paragraph">

					<?php

					if (isset($_SESSION['msg'])) {

						echo '<div class="alert alert-' . $_SESSION['msg_class'] . ' text-center" role="alert">';
						foreach ($_SESSION['msg'] as $message) {
							echo $message;
						}
						echo '</div>';
					}

					?>

				</div>
				<div class="modal-footer" id='model-footer'>

					<buuton class="btn btn-dark font-paragraph btn-block" data-dismiss="modal" role="button"><?=Translator::translate('Completed')?></buuton>

				</div>
			</div>

		</div>
	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src='<?= PUBLICS['js'] . '/application/main.js' ?>'></script>

	<script>
		<?php
		if (isset($_SESSION['msg'])) {

			echo '$("#myModal").modal("show");';

			unset($_SESSION['msg']);

			unset($_SESSION['msg_class']);
		}
		?>
	</script>



</body>

</html>