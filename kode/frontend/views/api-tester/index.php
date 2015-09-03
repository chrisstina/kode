<?php
/* @var $this yii\web\View */


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\models\ApiTesterForm;

$this->title = 'Api tester';
$this->params['breadcrumbs'][] = $this->title;

?>
<h1>api-tester/index</h1>

<div class="row">
    <div class="col-lg-12">
        <?php echo $response?>
    </div>
</div>

<h2>Request</h2>
<div class="row">
    <div class="col-lg-5">
        <?php $form = ActiveForm::begin(['id' => 'apitester-form']); ?>
        <?php echo $form->field($model, 'method')->radioList(ApiTesterForm::allowedHttpMethods()) ?>
        <?php echo $form->field($model, 'url') ?>

        <div class="form-group">
            <?php 
                for ($i = 0; $i < ApiTesterForm::ALLOWED_PARAMS_COUNT; $i++)
                {
                    echo Html::activeLabel($model, 'params') . ' ' . ($i + 1).' ';
                    echo Html::activeInput('text', $model, 'paramKeys[' . $i . ']');
                    echo ' : ';
                    echo Html::activeInput('text', $model, 'paramVals[' . $i . ']');
                    echo '<br />';
                }
            ?>
        </div>

        <div class="form-group">
            <?php echo $form->field($model, 'expectedParamKey') ?>
            <?php echo $form->field($model, 'expectedParamValue') ?>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>