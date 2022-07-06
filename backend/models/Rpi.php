<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rpi".
 *
 * @property int $id_rpi
 * @property string $adresse_mac
 */
class Rpi extends \yii\db\ActiveRecord
{

    const STATUS_DEACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public $rpi;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rpi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_rpi', 'adresse_mac'], 'required'],
            [['id_rpi'], 'integer'],
            [['adresse_mac'], 'string', 'max' => 512],
            [['status'], 'integer'],
            ['status', 'default', 'value' => self::STATUS_DEACTIVE],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_rpi' => 'ID Rpi',
            'adresse_mac' => 'Adresse Mac',
            'status' => 'Status',
        ];
    }

    public function getStatusLabels()
    {
        return[
            self::STATUS_DEACTIVE => 'Deactive',
            self::STATUS_ACTIVE => 'Active'
        ];
    }

    /**
     * {@inheritdoc}
     * @return RpiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RpiQuery(get_called_class());
    }
    
    /*public function rebooter()
    {
        return $this->status=0;
    }*/
}
