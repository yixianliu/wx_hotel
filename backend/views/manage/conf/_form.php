<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>


<?php $form = ActiveForm::begin(); ?>

<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

        <div class="panel-body">

            <?= $form->field( $model, 'lang_key' )->textInput( ['maxlength' => true] ) ?>

            <?= $form->field( $model, 'name' )->textInput( ['maxlength' => true] ) ?>

            <?= $form->field( $model, 'title' )->textInput( ['maxlength' => true] ) ?>

            <?= $form->field( $model, 'email' )->textInput( ['maxlength' => true] ) ?>

            <?= $form->field( $model, 'phone' )->textInput( ['maxlength' => true] ) ?>

            <?= $form->field( $model, 'keywords' )->textInput( ['maxlength' => true] ) ?>

            <?= $form->field( $model, 'site_url' )->textInput( ['maxlength' => true] ) ?>

            <?= $form->field( $model, 'developers' )->textInput( ['maxlength' => true] ) ?>

            <?= $form->field( $model, 'icp' )->textInput( ['maxlength' => true] ) ?>

            <?= $form->field( $model, 'description' )->textarea( ['rows' => 6] ) ?>

            <?= $form->field( $model, 'copyright' )->textInput( ['maxlength' => true] ) ?>

        </div>

        <div class="panel-footer">

            <?= Html::submitButton( $model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg'] ) ?>

            <a href='<?= Url::to( ['index'] ) ?>' class='btn btn-primary btn-lg' title='返回列表'>返回列表</a>

        </div>

    </div>
</div>

<?php ActiveForm::end(); ?>

