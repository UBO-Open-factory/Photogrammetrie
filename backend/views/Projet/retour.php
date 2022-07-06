<?php

use yii\helpers\Html;
/** @var yii\web\View $this */

$this->title = 'Retour';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Projet Enregistré</h1>

        <p>
        <?= Html::a('Regarder dans Projets Existants', ['index'], ['class' => 'btn btn-success']) ?>
        </p>

        <p>
        <?= Html::a('Nouveau', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>

    
</div>
