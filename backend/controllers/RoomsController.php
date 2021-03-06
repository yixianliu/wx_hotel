<?php

namespace backend\controllers;

use Yii;
use backend\models\RoomsSearch;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use common\models\Hotels;
use common\models\RoomsClassify;
use common\models\RoomsField;
use common\models\RoomsTag;
use common\models\RelevanceHotelsField;
use common\models\RelevanceRoomsField;
use common\models\RelevanceRoomsTag;
use common\models\Rooms;

/**
 * RoomsController implements the CRUD actions for Rooms model.
 */
class RoomsController extends BaseController
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
     * Lists all Rooms models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new RoomsSearch();
        $dataProvider = $searchModel->search( Yii::$app->request->queryParams );

        return $this->render( 'index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ] );
    }

    /**
     * Displays a single Rooms model.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        $model = $this->findModel( $id );

        $dataFieldProvider = new ActiveDataProvider( [
            'query' => RelevanceRoomsField::find()->where( ['rooms_id' => $model->rooms_id] ),
        ] );

        $dataTagProvider = new ActiveDataProvider( [
            'query' => RelevanceRoomsTag::find()->where( ['rooms_id' => $model->rooms_id] ),
        ] );

        return $this->render( 'view', [
            'model'             => $model,
            'dataFieldProvider' => $dataFieldProvider,
            'dataTagProvider'   => $dataTagProvider,
        ] );
    }

    /**
     * Creates a new Rooms model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rooms();

        $model->user_id = Yii::$app->user->identity->username;

        if ($model->load( Yii::$app->request->post() )) {

            $post = Yii::$app->request->post();

            // 创建事务
            $transaction = Yii::$app->db->beginTransaction();

            if (!Rooms::CreateData( $model, $post )) {
                $transaction->rollBack();
                Yii::$app->getSession()->setFlash( 'error', '辅助参数无法录入!' );
                return $this->redirect( ['create'] );
            }

            // 提交事务
            if (!$model->save()) {
                $transaction->rollBack();
                Yii::$app->getSession()->setFlash( 'error', '无法录入数据!' );
                return $this->redirect( ['create'] );
            }

            $transaction->commit();

            Yii::$app->getSession()->setFlash( 'success', '添加 ' . $model->title . ' 成功!' );

            return $this->redirect( ['view', 'id' => $model->id] );

        }

        $model->rooms_id = self::getRandomString();

        $result['classify'] = RoomsClassify::getClsSelect( 'Off' );

        $result['hotel'] = Hotels::getHotelSelect();

        $result['field'] = RoomsField::findByAll();

        $result['tag'] = RoomsTag::findByAll();

        return $this->render( 'create', [
            'model'  => $model,
            'result' => $result,
        ] );
    }

    /**
     * Updates an existing Rooms model.
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

        if ($model->load( Yii::$app->request->post() )) {

            $post = Yii::$app->request->post();

            // 创建事务
            $transaction = Yii::$app->db->beginTransaction();

            if (!static::CreateData( $model, $post, 'On' )) {
                $transaction->rollBack();
                Yii::$app->getSession()->setFlash( 'error', '辅助参数无法录入!' );
                return $this->redirect( ['create'] );
            }

            if (!$model->save()) {
                $transaction->rollBack();
                Yii::$app->getSession()->setFlash( 'error', '无法录入数据!' );
                return $this->redirect( ['create'] );
            }

            // 提交事务
            $transaction->commit();

            Yii::$app->getSession()->setFlash( 'success', '修改 ' . $model->title . ' 成功!' );

            return $this->redirect( ['view', 'id' => $model->id] );
        }

        $result['classify'] = RoomsClassify::getClsSelect( 'Off' );

        $result['hotel'] = Hotels::getHotelSelect();

        $result['tag'] = RoomsTag::findByAll();

        $result['field'] = RoomsField::findByAll();

        return $this->render( 'update', [
            'model'  => $model,
            'result' => $result,
        ] );
    }

    /**
     * Deletes an existing Rooms model.
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
     * Finds the Rooms model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return Rooms the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rooms::findOne( $id )) !== null) {
            return $model;
        }

        throw new NotFoundHttpException( 'The requested page does not exist.' );
    }

    public function actionAjaxRes()
    {

        if (!Yii::$app->request->isAjax) {
            return $this->redirect( ['index'] );
        }

        $id = Yii::$app->request->get( 'id', null );

        $result = Rooms::findAll( ['hotel_id' => $id] );

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return ['result' => $result, 'status' => true];
    }
}
