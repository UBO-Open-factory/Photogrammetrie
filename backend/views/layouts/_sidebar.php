<?php
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
?>

<aside class="shadow">
<?php echo Nav::widget([
    'options' => [
        'class' => 'd-flex flex-column nav-pills'
    ],
    'items' => [
        [
            'label' => 'Accueil',
            'url' => ['/site/index']
        ],
        [
            'label' => 'Commencer',
            'url' => ['/rpi/index']
        ],
        [
            'label' => 'Projets Existants',
            'url' => ['/projet/index']
        ],
        [
            'label' => 'Administration Serveur',
            'url' => ['/admin/index']
        ],
    ]
]) ?>
</aside>