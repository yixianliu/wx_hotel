<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use phpnt\ICheck\ICheck;

?>

<?php $form = ActiveForm::begin( ['options' => ['enctype' => 'multipart/form-data']] ); ?>

<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

        <div class="panel-body">

            <div class='row'>

                <?= $form->field( $model, 'name' )->textInput( ['maxlength' => true] ) ?>

                <?= $form->field( $model, 'app_id' )->textInput( ['maxlength' => true] ) ?>

                <?= $form->field( $model, 'mch_id' )->textInput( ['maxlength' => true] ) ?>

                <?= $form->field( $model, 'api_psw' )->textInput( ['maxlength' => true] ) ?>

                <?= Yii::$app->view->renderFile( '@app/views/_UploadSingle.php', [
                        'model'     => $model,
                        'type'      => 'mini-program',
                        'id'        => $model->conf_id,
                        'text'      => '上传证书文件 - apiclient_cert.pem',
                        'attribute' => 'cert_path',
                        'ext'       => '["pem"]',
                        'form'      => $form]
                ); ?>

                <div class="form-group">
                    <div class="alert alert-info" role="alert">
                        上传为证书文件,默认为上传文件最后的一个.
                    </div>
                </div>

                <?= Yii::$app->view->renderFile( '@app/views/_UploadSingle.php', [
                        'model'     => $model,
                        'type'      => 'mini-program',
                        'id'        => $model->conf_id,
                        'text'      => '上传证书文件 - apiclient_key.pem',
                        'attribute' => 'key_path',
                        'ext'       => '["pem"]',
                        'form'      => $form]
                ); ?>

                <div class="form-group">
                    <div class="alert alert-info" role="alert">
                        上传为证书文件,默认为上传文件最后的一个.
                    </div>
                </div>

                <?= $form->field( $model, 'cert_psw' )->textInput( ['maxlength' => true] ) ?>

                <?= $form->field( $model, 'is_using' )->widget( ICheck::className(), [
                    'type'    => ICheck::TYPE_RADIO_LIST,
                    'style'   => ICheck::STYLE_SQUARE,
                    'items'   => ['On' => '启用', 'Off' => '禁用'],
                    'color'   => 'grey',
                    'options' => [
                        'item' => function ($index, $label, $name, $checked, $value) {
                            return '<input type="radio" id="is_using' . $index . '" name="' . $name . '" value="' . $value . '" ' . ($checked ? 'checked' : false) . '> <label for="is_using' . $index . '">' . $label . '</label>&nbsp;&nbsp;';
                        },
                    ]] );
                ?>

            </div>

        </div>

        <?= $form->field( $model, 'conf_id' )->hiddenInput()->label( false ) ?>

        <div class="panel-footer">

            <?= Html::submitButton( $model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg'] ) ?>

            <a href='<?= Url::to( ['index'] ) ?>' class='btn btn-primary btn-lg' title='返回列表'>返回列表</a>

        </div>

    </div>
</div>

<?php ActiveForm::end(); ?>

