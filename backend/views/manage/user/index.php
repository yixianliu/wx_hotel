<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = '用户中心';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="col-lg-12">

    <div class="form-group">
        <a href='<?= Url::to( ['create'] ) ?>' class='btn btn-primary' title='添加用户'>添加用户</a>
    </div>

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

        <div class="panel-body">

            <?= GridView::widget( [
                'dataProvider' => $dataProvider,
                'columns'      => [
                    [
                        'class'   => 'yii\grid\CheckboxColumn',
                        'name'    => 'id',
                        'options' => ['width' => 40],
                    ],
                    [
                        'class'   => 'yii\grid\SerialColumn',
                        'options' => ['width' => 70],
                    ],
                    'user_id',
                    'username',
                    'r_key',
                    'l_key',
                    'login_ip',
                    'is_using',
                    [
                        'attribute' => 'last_login_time',
                        'value'     => function ($model) {
                            return date( 'Y - m -d , H:i:s', $model->last_login_time );
                        },
                        'options'   => ['width' => 180],
                    ],
                    [
                        'class'   => 'yii\grid\ActionColumn',
                        'options' => ['width' => 100],
                    ],
                    ['class' => 'yii\grid\ActionColumn'],
                ],
                'tableOptions' => ['class' => 'table table-hover'],
                'pager'        => [
                    'options' => ['class' => 'pagination'],
                ],
            ] ); ?>

        </div>
    </div>

    <?= $this->render( '../../formMsg' ); ?>

</div>
