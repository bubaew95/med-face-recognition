<?php
use yii\helpers\Url;
?>
<aside class="wedget__categories poroduct--cat">
    <h3 class="wedget__title">Разделы</h3>
    <ul>
        <?php foreach ($categories as $item) : ?>
            <li>
                <a href="<?= Url::to(['books/index', 'alias' => $item->name_url])?>"><?= $item->name?></a>
            </li>
        <?php endforeach ?>
    </ul>
</aside>
