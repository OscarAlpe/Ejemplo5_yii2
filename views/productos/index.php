<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Almacenes;

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
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            [ 'attribute' => 'foto',
              'format'=>'html',
              'label'=>'image',
              'value'=>function($data) {
                        return Html::img(yii\helpers\Url::base('http') . '/imgs/' . $data['foto'],
                                ['width' => '80px',
                                'height' => '80px']);
                       },
            ],
            [
                'attribute'=>'almacen',
                'headerOptions' => ['style' => 'width:30%'],
                'format' => 'html',
                'value' => function ($data) {
                    $output = '';
                    $output .= $data->almacen . "<br />";
                    $output .= Almacenes::findOne($data->almacen)->toArray()["nombre"] . "<br />";
                    $output .= Almacenes::findOne($data->almacen)->toArray()["direccion"] . "<br />";

                    return $output;
                },
            ],
                        
            'fecha',
            //'almacen0.nombre',
            /*
             [
                 'label' =>'Almacén 2',
                 'format' => 'html',
                 'value' =>function($d){
                    return $d->almacen . "<br />" . $d->almacen0->nombre . "<br />" . $d->almacen0->direccion;
                 }
             ],
             */
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
