<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productos".
 *
 * @property int $id
 * @property string $nombre
 * @property string $foto
 * @property int $almacen
 * @property string $fecha
 *
 * @property Almacenes $almacen0
 */
class Productos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'foto', 'almacen', 'fecha'], 'required'],
            [['almacen'], 'integer'],
            [['fecha'], 'safe'],
            [['nombre', 'foto'], 'string', 'max' => 255],
            [['almacen'], 'exist', 'skipOnError' => true, 'targetClass' => Almacenes::className(), 'targetAttribute' => ['almacen' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'foto' => 'Foto',
            'almacen' => 'Almacen',
            'fecha' => 'Fecha',
        ];
    }

    /**
     * Gets query for [[Almacen0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlmacen0()
    {
        return $this->hasOne(Almacenes::className(), ['id' => 'almacen']);
    }
    
    public function beforeSave($insert) {
        parent::beforeSave($insert);
        
        // Para cambiar el formato de la fecha antes de grabar en la BBDD
        $this->fecha = \DateTime::createFromFormat("d/m/Y", $this->fecha)->format("Y/m/d");
        
        return true;
    }
    
    public function afterFind() {
        parent::afterFind();
        
        $this->fecha = Yii::$app->formatter->asDate($this->fecha, "php:d/m/Y");
    }
}
