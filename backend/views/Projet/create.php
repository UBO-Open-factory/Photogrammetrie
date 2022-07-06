<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Projet */

$this->title = 'Preview Projet';
$this->params['breadcrumbs'][] = ['label' => 'Projets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_photoform', [
        'model' => $model,
    ]) ?>

</div>
