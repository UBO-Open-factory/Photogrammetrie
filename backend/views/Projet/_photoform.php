<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Projet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="preview-photoform">
    <img src="/img/test.jpg" alt="" width="60" height="60" class="preview">
    <div class="icons">
        <i class="fa-solid fa-lightbulb"></i>
        <i class="fa-solid fa-arrow-rotate-right"></i>
        <i class="fa-solid fa-upload"></i>
    </div>
    Raspberry Pi 001
    

    <?php $form = ActiveForm::begin([]); ?>

    <?= $form->field($model, 'nom_projet')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::a('Enregistrer',['retour'],['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
