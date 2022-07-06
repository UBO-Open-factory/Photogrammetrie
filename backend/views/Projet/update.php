<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Projet */

$this->title = 'Update Projet: ' . $model->id_projet;
$this->params['breadcrumbs'][] = ['label' => 'Projets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_projet, 'url' => ['view', 'id_projet' => $model->id_projet]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="projet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
