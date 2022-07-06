<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Projet */

$this->title = $model->id_projet;
$this->params['breadcrumbs'][] = ['label' => 'Projets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="projet-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_projet' => $model->id_projet], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_projet' => $model->id_projet], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_projet',
            'thumbnail',
            'nom_projet',
            'date_created',
            'nombre_de_photo',
        ],
    ]) ?>

</div>
