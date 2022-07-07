<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap4\Progress;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RpiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'État de connexion des Raspberry Pi';
$this->params['breadcrumbs'][] = $this->title;


$con = mysqli_connect("localhost","root","","rpi_photogrammétrie");
$sql = "SELECT * from rpi";

if ($result = mysqli_query($con, $sql)) {

    // Return the number of rows in result set
    $rowcount = mysqli_num_rows( $result );
    
    // Display result
 }

$on = "SELECT * from rpi WHERE status=1";
$off ="SELECT * from rpi WHERE status=0";

if ($result = mysqli_query($con, $off)) {

    // Return the number of rows in result set
    $rowcountoff = mysqli_num_rows( $result );
    
    // Display result
 }
 if ($result = mysqli_query($con, $on)) {

    // Return the number of rows in result set
    $rowcounton = mysqli_num_rows( $result );
    
    // Display result
 }
$working=($rowcounton/$rowcount)*100;
$notworking=($rowcountoff/$rowcount)*100;
?>

<div class="rpi-index gap-2">


    <h1><?= Html::encode($this->title) ?></h1>

    <div class="p-5 barre-progress">
        <?=Progress::widget([
            'bars' => [
                ['percent' => $working, 'options' => ['class' => 'progress-bar-striped']],
                ['percent' => $notworking, 'options' => ['class' => 'progress-bar-striped bg-danger']],
            ]
        ]); ?>
    </div>

    
    
    
    <p>
        <?= Html::a('Rebooter les Raspberry Pi', ['rebooter'], ['class' => 'btn btn-success']) ?>
    </p>
    <!DOCTYPE html>
    <body>
        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
             Priview Photos</button>

        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modal Test</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <?php echo $rowcountoff ?>Raspberry Pi n'ont pas été connectées,êtes-vous sûr de continuer? 
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Retour</button>
                    <a class="btn btn-danger" href="\projet\create">Oui, continuer quand même</a>
                </div>
            </div>
            </div>
        </div>
    </body>
    </html>






</div>
