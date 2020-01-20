<?php

use yii\helpers\Url;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="http://www.clipartbest.com/cliparts/9Tp/xy9/9Tpxy9grc.png" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Medical</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => 'Главная', 'icon' => 'file-code-o', 'url' => Url::to(['site/index']),],
                    ['label' => 'Медперсонал', 'icon' => 'file-code-o', 'url' => Url::to(['medicalstaff/index']),],
                    ['label' => 'Карты пациентов', 'icon' => 'file-code-o', 'url' => Url::to(['pacients/index']),],
                ],
            ]
        ) ?>

    </section>

</aside>
