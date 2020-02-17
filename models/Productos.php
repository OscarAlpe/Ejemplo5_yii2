<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

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
    public $actualizarFoto;
    
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
            [['nombre', /*'foto',*/ 'almacen', 'fecha'], 'required'],
            [['almacen'], 'integer'],
            [['fecha'/*, 'foto'*/], 'safe'],
            [['nombre'/*,'foto'*/], 'string', 'max' => 255],
            [['almacen'], 'exist', 'skipOnError' => true, 'targetClass' => Almacenes::className(), 'targetAttribute' => ['almacen' => 'id']],
            [['foto'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
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
       
        $this->actualizarFoto = TRUE;
        // Para cambiar el formato de la fecha antes de grabar en la BBDD
        $this->fecha = \DateTime::createFromFormat("d/m/Y", $this->fecha)->format("Y/m/d");
        $this->foto = UploadedFile::getInstance($this, 'foto');
        if (!isset($this->foto)) {
            $this->foto = $this->getOldAttribute("foto");
            $this->actualizarFoto = FALSE;
        }

        return true;
    }
    
    public function afterFind() {
        parent::afterFind();
        
        $this->fecha = Yii::$app->formatter->asDate($this->fecha, "php:d/m/Y");
    }
    
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);

        $this->foto = UploadedFile::getInstance($this, 'foto');
        if ($this->actualizarFoto) {
            $this->foto->saveAs("imgs/" . $this->id . '-' . $this->foto->baseName . '.' . $this->foto->extension);
            $this->foto = $this->id . '-' . $this->foto->baseName . '.' . $this->foto->extension;

            $this->updateAttributes(["foto"]);
        }
    }
     
}
