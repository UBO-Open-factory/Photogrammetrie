<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap4\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
           rel="stylesheet">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap h-flex d-flex flex-column">
    <nav class="navbar-brand navbar-dark bg-dark">
        <a class="navbar-brand" href="\site\index">
            <img src="/img/logo.png" alt="" width="165" height="106.56" class="navbar-brand mb-0 h1">
            UBO Open Factory Photogrammétrie
        </a>
    </nav>
    

   
    

    <main class="d-flex">
        <?php echo $this->render(view:'_sidebar') ?>
        
        <div class="container p-6">
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>



<?php $this->endBody() ?> 
</body>
<footer class="bg-light text-lg-start navbar-fixed-bottom">
  <!-- Copyright -->
  <div class="text-left p-1" style="background-color: rgba(0, 0, 0, 0.1);">
  © 2022 Copyright:
  <a class="text-dark" href="\site\index">UBO Open Factoy</a>
</div>
<div class="text-left p-1 shadow-sm" style="background-color: rgba(0, 0, 0, 0.1);">
Développée en Yii2 Frame Work
<a class="text-dark" href="#">V.1.0.0</a>
</div>
  <!-- Copyright -->
</footer>
</html>
<?php $this->endPage();
