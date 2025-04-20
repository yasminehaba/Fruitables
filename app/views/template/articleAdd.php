<?php
$ArticleController = new ArticleController();
if (
	isset($_POST["id_RES"]) &&
	isset($_POST["id_vol"]) &&
	isset($_POST["date_reservation_vol"]) &&
	isset($_POST["nb_place"])

) {
	if (
		!empty($_POST["id_RES"]) &&
		!empty($_POST["id_vol"]) &&
		!empty($_POST["date_reservation_vol"]) &&
		!empty($_POST["nb_place"])

	) {
			} else {
				echo "valeur vide";
			}
		}
			if ($valid == 1) {
		$reservation = new reservation(
			$_POST["id_RES"],
			$_POST["id_vol"],
			$_POST["date_reservation_vol"],
			$_POST["nb_place"]

		);
		$reservationC->addReservation($reservation);

}
?>


<?php include __DIR__ . '/navbar.php';?>

<?php include __DIR__ . '/footer.php'; ?>