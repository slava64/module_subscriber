<?php

use app\modules\event\models\Subscriber;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\event\models\SubscriberSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Subscribers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscriber-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Subscriber', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'filter' => \app\modules\event\models\Subscriber::getEventList(),
                'attribute' => 'event',
            ],
            'email:email',
            [
                'filter' => \app\modules\event\models\Subscriber::getBlockedList(),
                'attribute' => 'blocked',
                'format' => 'raw',
                'value' => function ($model) {
                    return \app\modules\event\models\Subscriber::getBlockedList()[$model->blocked];
                },
            ],
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Subscriber $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
