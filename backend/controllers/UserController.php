<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\Role;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends BaseController
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider( [
            'query' => User::find(),
        ] );

        return $this->render( 'index', [
            'dataProvider' => $dataProvider,
        ] );
    }

    /**
     * Displays a single User model.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render( 'view', [
            'model' => $this->findModel( $id ),
        ] );
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new User();

        if ($model->load( Yii::$app->request->post() )) {

            $model->password = Yii::$app->security->generatePasswordHash( $model->password );

            $model->login_ip = Yii::$app->request->userIP;

            $model->reg_time = time();

            $model->last_login_time = time();

            if (!$model->save()) {
                Yii::$app->getSession()->setFlash( 'error', '数据保存失败!' );
                return $this->redirect( ['create'] );
            }

            return $this->redirect( ['view', 'id' => $model->id] );
        }

        $model->user_id = self::getRandomString();

        return $this->render( 'create', [
            'model'  => $model,
            'result' => [
                'role' => Role::getRoleSelect(),
            ],
        ] );
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel( $id );

        if ($model->load( Yii::$app->request->post() ) && $model->save()) {
            return $this->redirect( ['view', 'id' => $model->id] );
        }

        return $this->render( 'update', [
            'model' => $model,
        ] );
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel( $id )->delete();

        return $this->redirect( ['index'] );
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne( $id )) !== null) {
            return $model;
        }

        throw new NotFoundHttpException( 'The requested page does not exist.' );
    }
}
