<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Rpi */

$this->title = 'Add Rpi';
$this->params['breadcrumbs'][] = ['label' => 'Rpis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rpi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
