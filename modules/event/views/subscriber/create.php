<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\event\models\Subscriber $model */

$this->title = 'Create Subscriber';
$this->params['breadcrumbs'][] = ['label' => 'Subscribers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscriber-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
