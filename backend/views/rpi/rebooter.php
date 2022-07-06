<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap4\Progress;


/* @var $this yii\web\View */
/* @var $searchModel app\models\RpiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rebooter les Raspberry Pi';
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

<div class="rpi-index">

    <h1><?= Html::encode($this->title) ?></h1>

    
    <?=Progress::widget([
            'bars' => [
                ['percent' => $working, 'options' => ['class' => 'progress-bar-striped']],
                ['percent' => $notworking, 'options' => ['class' => 'progress-bar-striped bg-danger']],
            ]
        ]); 
    ?>


    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>   
    <?=Html::beginForm(['index'],'POST');?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn',],

            'id_rpi',
            'adresse_mac',
            [
                'attribute' => 'status',
                'content' => function($model){
                    return $model->getStatusLabels()[$model->status];
                }
            ],
            /*[
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_rpi' => $model->id_rpi]);
                }
            ],*/
        ],
    ]); ?>
    
    <p>
        <button onclick="excutertout()", class='btn btn-success'>Rebooter tout les Raspberry Pi</button>
    </p>
    <p>
        <button onclick="excuter()", class='btn btn-success'>Rebooter les Raspberry Pi séléctionnées</button>
    </p>
    
    <?=Html::endForm();?>
    

    






</div>
