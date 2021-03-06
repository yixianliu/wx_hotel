<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = '房间列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rooms-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('添加房间', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'hotel_id',
            'rooms_id',
            'user_id',
            'c_key',
            //'room_num',
            //'title',
            //'content:ntext',
            'num',
            //'check_in_num',
            //'price',
            //'discount',
            //'introduction',
            //'keywords',
            //'path',
            'thumb',
            'images',
            //'is_promote',
            //'is_using',
            //'is_comments',
            //'created_at',
            //'updated_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
