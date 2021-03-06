<?php

namespace api\controllers;

use common\models\RoomsClassify;
use Yii;
use common\models\Rooms;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RoomsController implements the CRUD actions for Rooms model.
 */
class ApiRoomsController extends ApiBaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
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

        $response = Yii::$app->response;

        $response->format = \yii\web\Response::FORMAT_JSON;

        $result['rooms'] = Rooms::findByAll();

        if (!empty($result['rooms'])) {

            // 缩略图
            foreach ($result['rooms'] as $value) {

                $filename = Yii::getAlias('@webroot/../../frontend/web/temp/rooms/') . '/' . $value['rooms_id'] . '/' . $value['thumb'];

                if (empty($value['thumb']) || !is_file($filename)){
                    $value['thumb'] = '/img/not.jpg';
                }else {
                    $value['thumb'] = '/temp/rooms/' . $value['rooms_id'] . '/' . $value['thumb'];
                }

            }

        }

        $result['classify'] = RoomsClassify::findByAll();

        $response->data = $result;

        $response->send();
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

        $response = Yii::$app->response;

        $response->format = \yii\web\Response::FORMAT_JSON;

        $response->data['result'] = $this->findModel( $id )->toArray();

        $response->send();
    }

    /**
     * Creates a new Rooms model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rooms();

        if ($model->load( Yii::$app->request->post() ) && $model->save()) {
            return $this->redirect( ['view', 'id' => $model->id] );
        }

        return $this->render( 'create', [
            'model' => $model,
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

        if ($model->load( Yii::$app->request->post() ) && $model->save()) {
            return $this->redirect( ['view', 'id' => $model->id] );
        }

        return $this->render( 'update', [
            'model' => $model,
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
}
