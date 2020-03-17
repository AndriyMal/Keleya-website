<?php

$localPrevPage = stristr($_SERVER['HTTP_REFERER'],
    "https://keleya.de") ? $_SERVER['HTTP_REFERER'] : kp_get_route("additional-course");

require_once __DIR__ . '/../parts/header.php';
kp_checkLogin();
if (empty($items)) {
    ?>
    <script>
        window.location.replace("<?= kp_get_route("finish") ?>");
    </script>
    <?php
}
?>


<script>
    var uri = window.location.toString();
    if (uri.indexOf("?") > 0) {
        var clean_uri = uri.substring(0, uri.indexOf("?"));
        window.history.replaceState({}, document.title, clean_uri);
    }
</script>

<div class="step without-progress payment">
    <a
            href="<?= $localPrevPage ?>"
            class="go-back">
        <img src="<?= get_template_directory_uri() ?>/payment-system/assets/images/path-back.svg" alt="">
    </a>
    <div class="step-content">
        <h1 class="step-title">
            Eine gute Wahl
        </h1>

        <div class="cart-list">
            <?php
            foreach ($items as $key => $item) {
                ?>
                <div class="cart-item" data-price="<?= $item['price'] ?>">
                    <span class="delete" data-name="<?= $key ?>"></span>
                    <p class="name"> <?= $item['name'] ?> <b style="margin-left: 5px"><?= $item['price'] ?>€</b></p>
                </div>
            <?php } ?>
        </div>

        <div class="payment-form" action=""
        ">
        <p>Promo-Code anwenden</p>
        <form class="promocode-wrapper">
            <input type="text" class="payment-input promocode"
                   oninput="disabledSudmitChecker(this, ['.payment-input.promocode'], false, '.verify-btn')">
            <button class="verify-btn disabled" disabled>Anwenden</button>
        </form>
        <div class="total">
            <p class="text">Total</p>
            <p class="price"><span>64,48</span> €</p>
        </div>

        <div class="btn-group">
            <button type="submit" class="submit-btn payment"
                    style="width: 100%"><span>64,48€ bezahlen</span>
            </button>
        </div>
        </form>


    </div>
</div>
<?php
require_once __DIR__ . '/../parts/footer.php';
?>
<script>
    totalProcessing();
</script>

