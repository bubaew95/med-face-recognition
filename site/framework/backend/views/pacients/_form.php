<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\pacients\PacientsCart */
/* @var $form yii\widgets\ActiveForm */

$params = Yii::$app->params;
?>

<?php print_r($errors);?>

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title"><?= Html::encode($this->title) ?></h6>
        <div class="header-elements">
            <div class="list-icons">

            </div>
        </div>
    </div>

    <div class="card-body">
        Поля отмеченные звездочкой <strong style="color: red;">*</strong> обязательны для заполнения
    </div>

    <div class="card-body">
        <div class="pacients-cart-form">

            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                    <li class="nav-item">
                        <a href="#justified-right-icon-tab1" class="nav-link legitRipple active show" data-toggle="tab">
                            Контактные данные<i class="icon-menu7 ml-2"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#justified-right-icon-tab2" class="nav-link legitRipple" data-toggle="tab">
                            Личные данные <i class="icon-feed ml-2"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#justified-right-icon-tab3" class="nav-link legitRipple" data-toggle="tab">
                            Дополнительные данные<i class="icon-book ml-2"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#justified-right-icon-tab4" class="nav-link legitRipple" data-toggle="tab">
                            Фотографии<i class="icon-book ml-2"></i>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="justified-right-icon-tab1">

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Пациент</h4>
                                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                                <?= $form->field($model, 'sex')->dropDownList([
                                        '' => '-- Выбрать пол --',
                                    'm' => 'М',
                                    'w' => 'Ж'
                                ]) ?>

                                <?= $form->field($model, 'birthday')->textInput() ?>

                                <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

                                <?= $form->field($model, 'phone_home')->textInput(['maxlength' => true]) ?>

                                <?= $form->field($model, 'permanent_address')->textInput(['maxlength' => true]) ?>

                                <?= $form->field($model, 'registration_address')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <h3>Страховка</h3>
                                <?= $form->field($model, 'snils')->textInput(['maxlength' => true]) ?>

                                <?= $form->field($model, 'ins_organization')->textInput(['maxlength' => true]) ?>

                                <?= $form->field($model, 'polis')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>


                    </div>
                    <div class="tab-pane fade" id="justified-right-icon-tab2">
                        <div class="row">
                            <div class="col-md-7">
                                <?= $form->field($model, 'passport')->textInput(['maxlength' => true]) ?>

                                <?= $form->field($model, 'blood_group')->textInput(['maxlength' => true]) ?>

                                <?= $form->field($model, 'hr_factor')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-5">
                                <?= $form->field($model, 'disability')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'allergic')->textarea(['rows' => 6]) ?>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="justified-right-icon-tab3">
                        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'place_work')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'ogrn')->textInput() ?>

                    </div>

                    <div class="tab-pane fade" id="justified-right-icon-tab4">

                       <div class="row">
                           <div class="col-md-4">
                               <?= $form->field($model, 'images[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
                               <img src="http://goo.gl/qgUfzX" id="photo" alt="Ваша фотография">
                               <div id="results" ></div>
                           </div>
                           <div class="col-md-1">
                               ИЛИ
                           </div>
                           <div class="col-md-4">
                               Получить изображение по вебкамере
                               <div class="booth">
                                   <div id="my_camera"></div>
                                   <input type=button value="Configure" onClick="configure()">
                                   <input type=button value="Take Snapshot" onClick="take_snapshot()">
                                   <input type=button value="Save Snapshot" onClick="saveSnap()">
                               </div>
                           </div>
                       </div>

                        <?php if(!$model->isNewRecord && $model->pacientImages) : ?>
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-lg">
                                        <thead>
                                        <tr>
                                            <th width="100" class="text-center">
                                                Изображение
                                            </th>
                                            <th class="text-center">
                                                Вектор лица
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($model->pacientImages as $item) : ?>
                                            <tr>
                                                <td>
                                                    <?= Html::img("{$params['pacient_image_path']}{$model->id}/{$item->img}", ['width' => 100])?>
                                                </td>
                                                <td>
                                                    <div style="font-size: 10px;">
                                                        [<?= $item->embedings?>]
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif ?>

                    </div>
                </div>

            <div class="form-group">
                <?= Html::submitButton('<i class="icon-floppy-disk"></i> Сохранить', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>

    </div>
</div>

<style>
    .booth {
        width: 400px;
        background: #ccc;
        border: 10px solid #ddd;
        margin: 0 auto;
    }

    #photo {
        height: 300px;
    }

    .booth-capture-button {
        display: block;
        margin: 10px 0;
        padding: 10px 20px;
        background: cornflowerblue;
        color: #fff;
        text-align: center;
        text-decoration: none;
    }

    #canvas {
        display: none;
    }
</style>

<!-- CSS -->
<style>
    #my_camera{
        height: 240px; 
    }
</style>

<!-- Script -->
<script type="text/javascript" src="https://raw.githubusercontent.com/jhuckaby/webcamjs/master/webcam.min.js"></script>

<!-- Code to handle taking the snapshot and displaying it locally -->
<script language="JavaScript">

    // Configure a few settings and attach camera
    function configure(){
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
        Webcam.attach( '#my_camera' );
    }
    // A button for taking snap

    // preload shutter audio clip
    var shutter = new Audio();
    shutter.autoplay = false;
    shutter.src = navigator.userAgent.match(/Firefox/) ? 'shutter.ogg' : 'shutter.mp3';

    function take_snapshot() {
        // play sound effect
        shutter.play();

        // take snapshot and get image data
        Webcam.snap( function(data_uri) {
            // display results in page
            document.getElementById('results').innerHTML =
                '<img id="imageprev" src="'+data_uri+'"/>';
        } );

        Webcam.reset();
    }

    function saveSnap(){
        // Get base64 value from <img id='imageprev'> source
        var base64image = document.getElementById("imageprev").src;

        Webcam.upload( base64image, 'upload.php', function(code, text) {
            console.log('Save successfully');
            //console.log(text);
        });

    }
</script>

<?php

$js = <<<JS

JS;
$this->registerJs($js)

?>
