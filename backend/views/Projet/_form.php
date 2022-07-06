<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Projet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_projet')->textInput() ?>

    <?= $form->field($model, 'nom_projet')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_created')->textInput() ?>

    <?= $form->field($model, 'thumbnail')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
