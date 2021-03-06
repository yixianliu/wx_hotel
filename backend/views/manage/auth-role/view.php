<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AuthRole */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Auth Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register( $this );
?>
<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

    <h1><?= Html::encode( $this->title ) ?></h1>

    <p>
        <?= Html::a( '更改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary'] ) ?>
        <?= Html::a( '删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => '是否删除这条记录?',
                'method'  => 'post',
            ],
        ] ) ?>
        <?= Html::a( ' 继续添加', ['create'], ['class' => 'btn btn-primary'] ) ?>
        <?= Html::a( ' 返回列表', ['index'], ['class' => 'btn btn-primary'] ) ?>
    </p>

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

        <div class="panel-body">

            <?= DetailView::widget( [
                'model'      => $model,
                'attributes' => [
                    'name',
                    'description',
                    'rule_name',
                    'data',
                    [
                        'attribute' => 'type',
                        'value'     => function ($model) {
                            return $model->type == 1 ? '认证角色' : '认证权限';
                        },
                    ],
                    [
                        'attribute' => 'status',
                        'value'     => function ($model) {
                            return $model->status == 1 ? '已启用' : '已关闭';
                        },
                    ],
                    [
                        'attribute' => 'created_at',
                        'value'     => function ($model) {
                            return date( 'Y - m - d , h:i', $model->created_at );
                        },
                    ],
                    [
                        'attribute' => 'updated_at',
                        'value'     => function ($model) {
                            return date( 'Y - m - d , h:i', $model->updated_at );
                        },
                    ],
                ],
                'template'   => '<tr><th width="200">{label}</th><td>{value}</td></tr>',
            ] ) ?>

        </div>
    </div>
</div>
