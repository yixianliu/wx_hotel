<?php

namespace backend\controllers;

use Yii;
use common\models\Menu;
use common\models\MenuModel;
use common\models\Role;
use common\models\Pages;
use yii\web\NotFoundHttpException;

/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends BaseController
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [

            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],

            'verbs' => [
                'class'   => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Menu models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render( 'index' );
    }

    /**
     * Displays a single Menu model.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render( 'view', [
            'model' => $this->findModel( $id ),
        ] );
    }

    /**
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new Menu();

        $parent_id = Menu::findByOne( Yii::$app->request->get( 'id', null ) );

        // 获取父类
        $model->parent_id = empty( $parent_id['parent_id'] ) ? null : $parent_id['m_key'];

        $model->m_key = self::getRandomString();

        // Post 提交
        if (Yii::$app->request->isPost) {

            $data = Yii::$app->request->post();

            // 创建单页面
            if (!empty( $data )) {

                // 生成自定义页面
                if ($data['Menu']['model_key'] == 'UC1') {
                    $Cls = new Pages();
                    $Cls->saveData( $model->m_key, self::getRandomString() );
                }
            }

            if (!$model->load( $data ) || !$model->save()) {
                Yii::$app->getSession()->setFlash( 'error', '保存数据出错 !!' );
                return $this->redirect( ['create', 'id' => $parent_id] );
            }

            return $this->redirect( ['view', 'id' => $model->m_key] );

        }

        return $this->render( 'create', [
            'model'  => $model,
            'result' => [
                'parent'     => Menu::getSelectMenu(),
                'menu_model' => MenuModel::getModel(),
                'role'       => Role::getRoleSelect(),
            ],
        ] );
    }

    /**
     * Updates an existing Menu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param $id
     *
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel( $id );

        if ($model->load( Yii::$app->request->post() ) && $model->save()) {
            return $this->redirect( ['view', 'id' => $model->m_key] );
        }

        return $this->render( 'update', [
            'model'  => $model,
            'result' => [
                'parent'     => Menu::getSelectMenu( 'E1' ),
                'menu_model' => $this->getModel(),
                'role'       => $this->getRole(),
                'data'       => Menu::findByOne( $id ),
            ],
        ] );
    }

    /**
     * 调整路径
     *
     * @param $id
     *
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionAdjustment($id)
    {

        $model = Menu::find()->where( ['m_key' => $id] )->one();

        if ($model->load( Yii::$app->request->post() )) {

            $dataPost = Yii::$app->request->post();

            $data = Menu::findByOne( $dataPost['Menu']['url'] );

            $model->url = $data['menuModel']['url_key'] . '/' . $data['is_type'] . ',' . $data['pages']['page_id'];

            if ($model->save()) {
                return $this->redirect( ['view', 'id' => $model->m_key] );
            }

        } else {

            return $this->render( 'adjustment', [
                'model'  => $model,
                'result' => [
                    'data' => Menu::getSelectMenu( 'E1' ),
                ],
            ] );
        }
    }

    /**
     * 删除内容
     *
     * @param $id
     *
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel( $id )->delete();

        return $this->redirect( ['index'] );
    }

    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menu::findOne( ['m_key' => $id] )) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException( 'The requested page does not exist.' );
        }
    }

}
