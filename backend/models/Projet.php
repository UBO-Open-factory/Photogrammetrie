<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "projet".
 *
 * @property int $id
 * @property int $projet_id
 * @property string $nom
 * @property string|null $date_created
 * @property string|null $vignette
 */
class Projet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projet';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_projet', 'nom_projet'], 'required'],
            [['id_projet'], 'integer'],
            [['date_created'], 'safe'],
            [['nom_projet'], 'string', 'max' => 512],
            [['thumbnail'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_projet' => 'ID Projet',
            'nom_projet' => 'Nom Projet',
            'date_created' => 'Date Created',
            'thumbnail' => 'Thumbnail',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjetQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjetQuery(get_called_class());
    }

    /*public function save()
    {
        $photoPath = Yii::getAlias('@backend/web/storage/videos/'. $this->video.'.mp4');
        if(!is_dir(dirname($photoPath))){
            FileHelper::createDirectory(dirname($photoPath));
            }
            $this->video->saveAs($photoPath);
    }*/
}
