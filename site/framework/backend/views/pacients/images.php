<?php
/**
 * Created by PhpStorm.
 * User: Borz
 * Date: 12.07.2019
 * Time: 18:19
 */
use common\models\pacients\PacientsCart;

$params = Yii::$app->params;

$get = Yii::$app->request->get();
$namePacient = PacientsCart::find()->select('name')->where(['id' => $get['pacient']])->asArray()->one();

$this->title = 'Фотографии пациента';
$this->params['breadcrumbs'][] = ['label' => 'Карты пациентов', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $namePacient['name'] , 'url' => ['pacients/view', 'id' => $get['pacient']]];
$this->params['breadcrumbs'][] = $this->title;

?>
    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">
                Фотографии пациента
            </h6>
            <div class="header-elements">

            </div>
        </div>

        <div class="card-body">
            <div class="row">

                <?php foreach ($images as $key => $item) : ?>
                    <div class="col-sm-4 col-lg-2">
                        <div class="card"> 
                            <div class="card-img-actions m-1">
                                <img class="card-img img-fluid" src="<?= "{$params['pacient_image_path']}{$item->id_pacient}/{$item->img}"?>" alt="">
                                <div class="card-img-actions-overlay card-img">
                                    <a href="<?= "{$params['pacient_image_path']}{$item->id_pacient}/{$item->img}"?>" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round" data-popup="lightbox" rel="group">
                                        <i class="icon-search4"></i>
                                    </a>
                                </div>
                            </div>
                            <a href="/admin/pacients/images?pacient=<?= $item->id_pacient?>&delete_id=<?= $item->id?>" class="btn bnt-danger glyphicon glyphicon-trash delete-image"></a>
                        </div>
                    </div>
                <?php endforeach;?>

            </div>
        </div>
</div>

<?php 
$js = <<<JS

    $(function () {
        $('.delete-image').on('click', function (e) {
            e.preventDefault();
            var nUrl = $(this).attr('href');
            if(confirm('Вы уверены что хотите удалить изображение?')) {

                $.post(nUrl, {}, function (data) {
                    if(data == 'success') {
                        window.location.reload();
                    }
                })

            }
        })
    })

JS;

$this->registerJs($js);
?>