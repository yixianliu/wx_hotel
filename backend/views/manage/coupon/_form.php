<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use phpnt\ICheck\ICheck;

/* @var $this yii\web\View */
/* @var $model common\models\Coupon */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode($this->title) ?></h3></div>

        <div class="panel-body">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'denomination')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'quota')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'num')->textInput(['maxlength' => true]) ?>

            <?=
            $form->field($model, 'validity')->widget('kartik\daterange\DateRangePicker', [
                'convertFormat' => true,
                'pluginOptions' => [
                    'timePicker'          => true,
                    'timePickerIncrement' => 30,
                    'format'              => 'Y年 - m月 - d日 h:i:A',
                ],
            ]);
            ?>

            <?= $form->field($model, 'remarks')->textarea(['maxlength' => true, 'rows' => 6]) ?>

            <?= $form->field($model, 'coupon_type')->widget(ICheck::className(), [
                'type'    => ICheck::TYPE_RADIO_LIST,
                'style'   => ICheck::STYLE_SQUARE,
                'items'   => ['discount' => '折扣劵', 'coupon' => '优惠卷'],
                'color'   => 'red',                  // цвет
                'options' => [
                    'item' => function ($index, $label, $name, $checked, $value) {
                        return '<input type="radio" id="coupon_type' . $index . '" name="' . $name . '" value="' . $value . '" ' . ($checked ? 'checked' : false) . '> <label for="coupon_type' . $index . '">' . $label . '</label>&nbsp;&nbsp;';
                    },
                ] ])
            ?>

            <?= $form->field($model, 'pay_type')->widget(ICheck::className(), [
                'type'    => ICheck::TYPE_RADIO_LIST,
                'style'   => ICheck::STYLE_SQUARE,
                'items'   => [ 'before' => '消费后送优惠卷', 'after' => '消费前送优惠卷', 'wechat' => '关注公众号' ],
                'color'   => 'red',                  // цвет
                'options' => [
                    'item' => function ($index, $label, $name, $checked, $value) {
                        return '<input type="radio" id="pay_type' . $index . '" name="' . $name . '" value="' . $value . '" ' . ($checked ? 'checked' : false) . '> <label for="pay_type' . $index . '">' . $label . '</label>&nbsp;&nbsp;';
                    },
                ] ])
            ?>

            <?= Yii::$app->view->renderFile( '@app/views/upload.php', [ 'model' => $model, 'id' => $model->coupon_key, 'num' => 1, 'attribute' => 'thumb', 'text' => '上传缩略图', 'form' => $form ] ); ?>

            <?= Yii::$app->view->renderFile( '@app/views/upload.php', [ 'model' => $model, 'id' => $model->coupon_key, 'num' => 1, 'attribute' => 'images', 'text' => '上传图片', 'form' => $form ] ); ?>

            <div class="form-group">

                <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg']) ?>

                <a href='<?= Url::to(['index']) ?>' class='btn btn-primary btn-lg' title='返回列表'>返回列表</a>

            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>