<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Productos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="productos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'foto')->fileInput() ?>

    <?php $list = ArrayHelper::map(app\models\Almacenes::find()->all(),'id','nombre'); ?>
    <?= $form->field($model, 'almacen')->dropDownList($list,
             ['prompt'=>'Selecciona un almacén...']) ?>

    <div class="form-group">
        <label class="control-label">Fecha</label>
        <?= DatePicker::widget([
            'model' => $model,
            'attribute' => 'fecha',
            'language' => 'es',
            'options' => ['placeholder' => 'Introduce fecha'],
            'pluginOptions' => [
                'todayHighlight' => true,
                'todayBtn' => true,
                'autoclose'=>true,
                'format' => 'dd/mm/yyyy',
            ]
        ]) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
