<div class="my-5">
    <h1 class="text-center">Наши товары</h1>
</div>
<div class="row row-cols-1 row-cols-md-2 g-4">
    <?php

    foreach ($goods as $good) :
    ?>
        <div class="col">
            <div class="card h-100">
                <img src="photos/<?= $good['photo_path'] ?>.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?= $good['brand'] ?><?= $good['model'] ?></h5>
                    <p class="card-text"><?= $good['info_brief'] ?></p>
                    <a href="index.php?act=good&id=<?= $good['model_id'] ?>" class="btn btn-primary">More info</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div class="d-grid  col-3 mx-auto my-5">

    <a href="index.php?act=catalog&lim=<?= $_GET['lim'] + 10 ?>" class="btn btn-primary">Button</a>
</div>