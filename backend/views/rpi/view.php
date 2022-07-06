<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Rpi */

$this->title = $model->id_rpi;
$this->params['breadcrumbs'][] = ['label' => 'Rpis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="rpi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_rpi' => $model->id_rpi], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_rpi' => $model->id_rpi], [
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
            'id_rpi',
            'adresse_mac',
        ],
    ]) ?>

</div>
