<?php require_once 'inc/header.php' ?>
<?php if($view == 'promotion'): ?>
    <?php include 'promotion.php' ?>
<?php else: ?>
<main>
    <div class="container mt-minus" id="mainbody">
        <?php include 'facts.php' ?>
        <?php include 'cart_product.php' ?>
        <?php include 'shops.php' ?>
        <?php include 'main.php' ?>
    </div>
    <?php include 'vacancies.php' ?>
</main>
<?php endif; ?>
<footer>
    <?php require_once 'inc/footer.php' ?>
</footer>
</body>
</html>
