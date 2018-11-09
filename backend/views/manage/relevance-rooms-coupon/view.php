<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RelevanceRoomsCoupon */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '派送设置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

        <div class="panel-body">

            <p>
                <?= Html::a( 'Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary'] ) ?>
                <?= Html::a( 'Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data'  => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method'  => 'post',
                    ],
                ] ) ?>
            </p>

            <?= DetailView::widget( [
                'model'      => $model,
                'attributes' => [
                    'title',
                    'coupon_key',
                    'validity',
                    'num',
                    'denomination',
                    'quota',
                    [
                        'attribute' => 'coupon_type',
                        'value'     => function ($model) {

                            $state = ['discount' => '折扣劵', 'coupon' => '优惠卷'];

                            return $state[ $model->coupon_type ];
                        },
                    ],
                    [
                        'attribute' => 'pay_type',
                        'value'     => function ($model) {
                            $state = [
                                'before' => '消费后送优惠卷',
                                'after'  => '消费前送优惠卷',
                                'wechat' => '关注公众号',
                            ];

                            return $state[ $model->pay_type ];
                        },
                    ],
                    [
                        'attribute' => 'is_using',
                        'value'     => function ($model) {
                            $state = [
                                'On'  => '开启',
                                'Off' => '未启用',
                            ];

                            return $state[ $model->is_using ];
                        },
                    ],
                    [
                        'attribute' => 'images',
                        'format'    => 'html',
                        'value'     => function ($model) {

                            $images = (!is_file( Yii::getAlias( '@webroot/../../frontend/web/temp/coupon/' ) . $model->images )) ?
                                Yii::getAlias( '@web/../../frontend/web/img/not.gif' ) :
                                Yii::getAlias( '@web/../../frontend/web/temp/coupon/' ) . $model->images;

                            return '<img width="520" height="350" src="' . $images . '" alt="' . $model->title . '" />';
                        },
                        'options'   => ['width' => 180],
                    ],
                    [
                        'attribute' => 'created_at',
                        'value'     => function ($model) {
                            return date( 'Y - m -d , h:i', $model->created_at );
                        },
                    ],
                    [
                        'attribute' => 'updated_at',
                        'value'     => function ($model) {
                            return date( 'Y - m -d , h:i', $model->updated_at );
                        },
                    ],
                    'remarks',
                ],
                'template'   => '<tr><th width="200">{label}</th><td>{value}</td></tr>',
            ] ) ?>

        </div>
    </div>
</div>

