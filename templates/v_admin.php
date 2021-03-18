<?php
foreach ($orders as $order) :  $items = get_items_from_order($order['order_id']); ?>
    <div class="card my-3">
        <h5 class="card-header">Order # <?= $order['order_id'] ?>, Time: <?= $order['date-time'] ?> <br>
            <form method="POST">
                <input type="hidden" name='id' value="<?= $order['order_id'] ?>">
                <label class="mr-sm-2" for="inlineFormCustomSelect">Status: </label>
                <select class="custom-select mr-sm-2" name="status" id="inlineFormCustomSelect">
                    <option selected><?= $order['status_name'] ?></option>
                    <option value="1">Создан</option>
                    <option value="2">В работе</option>
                    <option value="3">Передан в доставку</option>
                    <option value="4">Доставлен</option>
                </select>


                <div class="col-auto my-1">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
        </h5>
        <div class="card-body">
            <h5 class="card-title">Email: <?= $order['mail'] ?></h5>
            <h5 class="card-title">Address: <?= $order['address'] ?></h5>
            <h5 class="card-title">Total: <?= $order['amount'] ?></h5>


            <?php foreach ($items as $item) :  ?>
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Model: <?= $item['model'] ?></h5>
                        <p class="card-text">Price: <?= $item['price'] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>