<p class="h3 my-2">Информация</p>
<dl class="row my-5">
    <dt class="col-sm-3">Number of the user</dt>
    <dd class="col-sm-9"><?= $user['user_id'] ?></dd>

    <dt class="col-sm-3">User's email</dt>
    <dd class="col-sm-9">
        <?= $user['mail'] ?>
    </dd>

    <dt class="col-sm-3">Password</dt>
    <dd class="col-sm-9"><?= $user['pass'] ?></dd>

</dl>
<a href="index.php?act=index&quit=true" class="link-dark">Выйти отсюдава!!!</a>