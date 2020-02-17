<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Productos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Productos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'nombre',
            [ 'attribute' => 'foto',
              'format'=>'raw',
              'label'=>'image',
              'contentOptions' =>['style'=>'text-align:center'],
              'value'=>function($data) {
                        return Html::img('@web//imgs/' . $data->foto,
                                ['width' => '100px']);
                       },
            ],
            /* 
             * Otra forma más sencilla de mostrar el nombre y dirección del almacén en otra línea.
             */
             [
                 'label' =>'Almacén',
                 'attribute' => 'almacen',
                 'format' => 'raw',
                 'value' =>function($data){
                    return $data->almacen . "<br />" .
                           $data->almacen0->nombre . "<br />" .
                           $data->almacen0->direccion;
                 }
             ],
            'fecha',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
