<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Rpi */

$this->title = 'Update Rpi: ' . $model->id_rpi;
$this->params['breadcrumbs'][] = ['label' => 'Rpis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_rpi, 'url' => ['view', 'id' => $model->id_rpi]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rpi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
