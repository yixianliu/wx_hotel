<?php

/**
 * @abstract 安装首页控制器
 * @author   Yxl <zccem@163.com>
 */

namespace backend\controllers\mount;

use Yii;

class CenterController extends MountController
{

    /**
     * @abstract 首页
     */
    public function actionIndex()
    {

        $this->isLogin();

        return $this->render( '../index' );
    }

    /**
     * @abstract 关于我们
     */
    public function actionAbout()
    {

        $this->isLogin();

        return $this->render( '../about' );
    }

    /**
     * @abstract 团队作品
     */
    public function actionProduct()
    {

        $this->isLogin();

        return $this->render( '../product' );
    }

    /**
     * @abstract 技术支持
     */
    public function actionSupport()
    {

        $this->isLogin();

        return $this->render( '../support' );
    }

}
