<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Administration Serveur';
$this->params['breadcrumbs'][] = $this->title;
?>
<form>
    <label for="inputNom" class="form-label">Nom de projet:</label>
    <input type="Nom" id="inputNom" class="form-control" aria-describedby="passwordHelpBlock">
    <div id="passwordHelpBlock" class="form-text">
    Le nom de projet par défaut si vous ne le modifiez pas dans la page de enregistre .
    </div>
  
    <div class="p-3 mb-3">
        <label for="example" class="form-label">MQTT</label>
        <p>
            Brooker: adresse broker
        </p>
        <p>
            Port: 80
        </p>

    </div>
  <button type="submit" class="btn btn-primary">Enregistrer</button>
  <button type="submit" class="btn btn-primary">Éteindre le système</button>
</form>
