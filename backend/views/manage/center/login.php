<?php
/**
 *
 * 登录模板
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2017/10/16
 * Time: 17:28
 */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\AppAsset;

$this->title = '登录';

AppAsset::register( $this ); // $this 代表视图对象

$this->beginPage();

?>

<!DOCTYPE html>
<html lang="en" class="body-full-height">
<head>

    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta charset="utf-8"/>

    <?= Html::csrfMetaTags() ?>

    <title>登录 - <?= $result['title']; ?> - <?= $result['name']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name='keywords' content='<?= Yii::$app->params['WebInfo']['KEYWORDS']; ?>'/>
    <meta name='description' content='<?= Yii::$app->params['WebInfo']['DESCRIPTION']; ?>'/>
    <meta name='author' content='<?= Yii::$app->params['WebInfo']['DEVELOPERS']; ?>'/>

    <link rel='shortcut icon' type='image/x-icon' href='./favicon.ico'/>

    <?php $this->head() ?>

</head>
<body>

<?php $this->beginBody() ?>

<div class="login-container">

    <div class="login-box animated fadeInDown">

        <div class="login-body">

            <?php $form = ActiveForm::begin( [ 'action' => [ 'member/login' ], 'class' => "form-horizontal", 'method' => 'post', 'id' => $model->formName() ] ); ?>

            <?= $form->field( $model, 'username' )->textInput( [ 'maxlength' => true, 'placeholder' => '帐号...', 'class' => 'form-control', 'autofocus' => true ] ); ?>

            <?= $form->field( $model, 'password' )->passwordInput( [ 'maxlength' => true, 'placeholder' => '密码...', 'class' => 'form-control' ] ); ?>

            <div class="form-group">
                <?= Html::submitButton( '立即登录', [ 'class' => 'btn btn-orange btn-block btn-lg' ] ); ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>

        <?= Yii::$app->view->renderFile( '@app/views/_FormMsg.php' ); ?>

        <div class="login-footer">
            <div class="pull-left">
                &copy; 2004 - 2020 <?= $result['name']; ?>
            </div>
        </div>

    </div>

</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>


