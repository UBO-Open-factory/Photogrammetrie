<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Projet */

$this->title = 'Preview des photos';
$this->params['breadcrumbs'][] = ['label' => 'Projets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $this->beginBlock('messages', false) ?>
Nothing.
<?php $this->endBlock() ?>
<div class="rpi-preview">

    <h1><?= Html::encode($this->title) ?></h1>


    <div>
        <?= $this->render('_photoform', ['model' => $model,]) ?>
    </div>

    

    

</div>
