<?php
use yii\helpers\Url;
?>

<div class="categori-menu">
    <span class="categorie-title">
        Разделы
        <i class="fa fa-list"></i>
    </span>
    <nav class="<?= $limit ? 'home-category' : null?>">
        <ul class="categori-menu-list menu-hidden" style="">
            <?php foreach ($categories as $key => $category) : ?>
                <li>
                    <a href="<?= Url::to(['books/index', 'alias' => $category->name_url])?>">
                        <span>
                            <i class="fa fa-book"></i>
                        </span>
                        <div>
                            <?= $category->name?>
                        </div>
                    </a>
                </li>
            <?php endforeach ?>
        </ul>
    </nav>
    <?php if($limit) : ?>
        <div class="all-categories">
            <?= \yii\helpers\Html::a('Показать все', ['books/index'])?>
        </div>
    <?php endif ?>
</div>