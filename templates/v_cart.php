<section class="shopping-cart dark">
    <div class="container">
        <div class="block-heading">
            <h2>Shopping Cart</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.</p>
        </div>
        <div class="content">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="items">
                        <?php foreach ($cart as $cartgood) :
                            $sum += $cartgood['price'] ?>
                            <div class="product">
                                <div class="row">
                                    <div class="col-md-3">
                                        <img class="img-fluid mx-auto d-block image" src="photos/<?= $cartgood['photo_path'] ?>.jpg">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="info">
                                            <div class="row">
                                                <div class="col-md-5 product-name">
                                                    <div class="product-name">
                                                        <a href="index.php?act=good&id=<?= $cartgood['model_id'] ?>"><?= $cartgood['brand'] . " " . $cartgood['model'] ?></a>
                                                        <div class=" product-info">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 price">
                                                    <span><?= $cartgood['price'] ?>руб</span>
                                                </div>
                                                <div class="col-md-3 price">
                                                    <span><a href="index.php?act=cart&delete=<?= $cartgood['model_id'] ?>">Удалить</a></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <div class="col-md-12 col-lg-4">
                            <div class="summary">
                                <h3>Summary</h3>
                                <div class="summary-item"><span class="text">Total</span><span class="price">
                                        <?= $sum ?> руб
                                    </span></div>
                                <a class="btn btn-primary btn-lg btn-block" href="index.php?act=order">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</section>