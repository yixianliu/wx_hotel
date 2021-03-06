<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '酒店管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

        <div class="panel-body">

            <h1><?= Html::encode( $this->title ) ?></h1>

            <p>
                <?= Html::a( '更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary'] ) ?>
                <?= Html::a( '删除', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data'  => [
                        'confirm' => '是否删除这条记录?',
                        'method'  => 'post',
                    ],
                ] ) ?>
                <?= Html::a( '返回列表', ['index'], ['class' => 'btn btn-primary'] ) ?>
                <?= Html::a( '继续添加', ['create'], ['class' => 'btn btn-primary'] ) ?>
            </p>

            <?= DetailView::widget( [
                'model'      => $model,
                'attributes' => [
                    'hotel_id',
                    'user_id',
                    'name',
                    'introduction',
                    'keywords',
                    'address',
                    [
                        'attribute' => 'thumb',
                        'format'    => 'html',
                        'value'     => function ($model) {

                            $filenameReal = Yii::getAlias( '@webroot/../../frontend/web/temp/hotels/' ) . '/' . $model->hotel_id . '/' . $model->thumb;

                            if (!is_file( $filenameReal )) {
                                $filename = Yii::getAlias( '@web/../../frontend/web/img/' ) . 'not.jpg';
                            } else {
                                $filename = Yii::getAlias( '@web/../../frontend/web/temp/hotels/' ) . '/' . $model->hotel_id . '/' . $model->thumb;
                            }

                            return '<img width="280" height="150" src="' . $filename . '" alt="' . $model->name . '" />';
                        },
                        'options'   => ['width' => 180],
                    ],
                    [
                        'attribute' => 'images',
                        'format'    => 'html',
                        'value'     => function ($model) {

                            if (empty( $model->images )) {
                                return '<img width="280" height="150" src="' . Yii::getAlias( '@web/../../frontend/web/img/' ) . 'not.jpg' . '" alt="' . $model->name . '" />';
                            }

                            $imagesData = explode( ',', $model->images );

                            $html = '<div class="row">';
                            foreach ($imagesData as $value) {

                                if (empty( $value ))
                                    continue;

                                $html .= '<div class="col-md-3">';
                                $html .= '<img width="340" height="220" src="' . Yii::getAlias( '@web/../../frontend/web/temp/hotels/' ) . '/' . $model->hotel_id . '/' . $value . '" alt="' . $model->name . '" />';
                                $html .= '</div>';
                            }
                            $html .= '</div>';

                            return $html;
                        },
                        'options'   => ['width' => 180],
                    ],
                    [
                        'attribute' => 'is_promote',
                        'value'     => function ($model) {
                            $state = [
                                'On'  => '开启',
                                'Off' => '未启用',
                            ];

                            return $state[ $model->is_promote ];
                        },
                    ],
                    [
                        'attribute' => 'is_comments',
                        'value'     => function ($model) {
                            $state = [
                                'On'  => '开启',
                                'Off' => '未启用',
                            ];

                            return $state[ $model->is_comments ];
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
                    'content:html',
                ],
                'template'   => '<tr><th width="200">{label}</th><td>{value}</td></tr>',
            ] ) ?>

        </div>
    </div>
</div>

