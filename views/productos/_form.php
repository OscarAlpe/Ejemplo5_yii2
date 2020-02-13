<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Productos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="productos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'foto')->textInput(['maxlength' => true]) ?>

    <?php $list = ArrayHelper::map(app\models\Almacenes::find()->all(),'id','nombre'); ?>
    <?= $form->field($model, 'almacen')->dropDownList($list,
             ['prompt'=>'Selecciona un almacén...']) ?>

    <label class="control-label">Fecha</label>
    <?= DatePicker::widget([
        'model' => $model,
        'attribute' => 'fecha',
        'language' => 'es',
        'dateFormat' => 'php:d/m/Y',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
