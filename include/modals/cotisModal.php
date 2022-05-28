<?php
$id = $_SESSION['id'];
$role = $_SESSION['role'];
?>

<div class="modal" id="modal">
    <div class="bg-modal" id="bg-modal"></div>
    <div class="cotis-box">
        <form action="" method="post">
            <div class="d-flex modal-form">
                <input type="hidden" name="date_cot" value="<?php echo date("Y-m-d") ?>" required>
                <input type="hidden" name="id" value="<?php echo $id ?>" required>
                <div class="input-box">
                    <label for="montant">Montant de votre cotisation :</label>
                    <input type="number" name="montant" placeholder="en €" min="70" required>
                </div>
                <input type="hidden" name="role" value="<?php echo $role ?>" required>
            </div>
            <br />
            <input type="submit" value="Payer" name="addCot">
        </form>
    </div>
</div>

<?php
if ($_SESSION['isCot'] == false) {
    if (!empty($_POST['addCot'])) {
        if ($_SESSION['isCot'] == false) {
            $date_cot = $_POST['date_cot'];
            $id = $_POST['id'];
            $montant = $_POST['montant'];
            $role = $_POST['role'];

            $addQuery = "INSERT INTO `cotiser` (`date_cotise`, `id`, `montant_cot`, `role_adh`) VALUES (?,?,?,?)";
            $result = $bdd->prepare($addQuery);
            try {
                $result->execute(array($date_cot, $id, $montant, $role));
            } catch (PDOexception $th) {
?>
                <div class="error-message">
                    vous avez déjà effectué au moins une cotisation au cours de la dernière année. <br> veuillez réessayer lorsque votre cotisation prendra fin.
                </div>
            <?php
            }
        } else { ?>
            <div class="active modal" id="modal">
                <div class="bg-modal" id="bg-modal"></div>
                <div class="cotis-box">
                    <div class="good-message">
                        Vous avez déjà une cotisation active.
                    </div>
                </div>
            </div>
    <?php }
    }
} else { ?>
    <div class=" active modal" id="modal">
        <div class="bg-modal" id="bg-modal"></div>
        <div class="cotis-box">
            <div class="good-message">
                Vous avez déjà une cotisation active.
            </div>
        </div>
    </div>
<?php }




//var_dump($header, $_SERVER);
