<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = '卡卷管理';
$this->params['breadcrumbs'][] = $this->title;

?>

<style>
    /*设置表格文字左右和上下居中对齐*/
    #w0 td {
        vertical-align: middle;
    }
</style>

<div class="col-lg-12">

    <div class="form-group">
        <a href='<?= Url::to( ['create'] ) ?>' class='btn btn-primary btn-lg' title='添加优惠卷'>添加卡卷</a>
        <a href='<?= Url::to( ['rooms/create'] ) ?>' class='btn btn-primary btn-lg' title='添加房间'>添加房间</a>
        <a href='<?= Url::to( ['hotels/create'] ) ?>' class='btn btn-primary btn-lg' title='添加酒店'>添加酒店</a>
        <a href='<?= Url::to( ['index'] ) ?>' class='btn btn-primary btn-lg' title='添加酒店'>本地卡券</a>
        <a href='<?= Url::to( ['index', 'type' => 'wechat'] ) ?>' class='btn btn-primary btn-lg' title='添加酒店'>公众号卡券</a>
    </div>

    <div class="form-group">
        <div class="alert alert-info" role="alert">
            创建卡券,必须先对接好公众号和小程序,要不卡券无法进行创建!
        </div>
    </div>

    <?= Yii::$app->view->renderFile( '@app/views/_FormMsg.php' ); ?>

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

        <div class="panel-body">

            <?php if (empty( $type )): ?>

                <?=
                GridView::widget( [
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
                        [
                            'attribute' => 'images',
                            'format'    => 'html',
                            'value'     => function ($model) {

                                $images = (!is_file( Yii::getAlias( '@webroot/../../frontend/web/temp/coupon/' ) . $model->coupon_key . '/' . $model->images )) ?
                                    Yii::getAlias( '@web/../../frontend/web/img/not.jpg' ) :
                                    Yii::getAlias( '@web/../../frontend/web/temp/coupon/' ) . $model->coupon_key . '/' . $model->images;

                                return '<img width="280" height="150" src="' . $images . '" alt="' . $model->title . '" />';
                            },
                            'options'   => ['width' => 180],
                        ],
                        'card_id',
                        'denomination',
                        'brand_name',
                        'title',
                        'quantity',
                        'quota',
                        [
                            'attribute' => 'updated_at',
                            'value'     => function ($model) {
                                return date( 'Y - m -d , H:i:s', $model->updated_at );
                            },
                            'options'   => ['width' => 180],
                        ],
                        [
                            'class'   => 'yii\grid\ActionColumn',
                            'options' => ['width' => 100],
                        ],
                    ],
                    'tableOptions' => ['class' => 'table table-hover'],
                    'pager'        => [
                        'options' => ['class' => 'pagination'],
                    ],
                ] );
                ?>

            <?php else: ?>

                <div id="w0" class="grid-view">
                    <div class="summary">共<b><?= $dataProvider['total_num'] ?></b>条数据.</div>
                    <table class="table table-hover">
                        <colgroup>
                            <col width="40">
                            <col width="70">
                            <col width="180">
                            <col width="180">
                            <col width="100">
                        </colgroup>
                        <thead>
                        <tr>
                            <th><a href="/backend/web/coupon/index.html?sort=images" data-sort="images">公众号卡券 ID</a></th>
                            <th class="action-column">#</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($dataProvider['card_id_list'] as $value): ?>

                            <tr>
                                <td><?= $value ?></td>
                                <td>
                                    <a href="/backend/web/coupon/view-3.html" title="查看"><span class="glyphicon glyphicon-eye-open"></span></a>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>

            <?php endif; ?>

        </div>
    </div>

</div>
