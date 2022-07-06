<?php

namespace backend\controllers;


use app\models\Rpi;
use app\models\RpiSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;



/**
 * RpiController implements the CRUD actions for Rpi model.
 */
class RpiController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Rpi models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RpiSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => Rpi::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $post = $dataProvider->getModels();

        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rpi model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_rpi)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_rpi),
        ]);
    }

    /**
     * Creates a new Rpi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Rpi();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_rpi' => $model->id_rpi]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Rpi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_rpi)
    {
        $model = $this->findModel($id_rpi);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_rpi' => $model->id_rpi]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Rpi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_rpi)
    {
        $this->findModel($id_rpi)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Rpi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Rpi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_rpi)
    {
        if (($model = Rpi::findOne(['id_rpi' => $id_rpi])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPreview()
    {
        $model = new Rpi();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_rpi' => $model->id_rpi]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('preview', [
            'model' => $model,
        ]);
    }

    public function actionRebooter()
    {
        $model = new Rpi();
        $action = Yii::$app->request->post('action');


        $searchModel = new RpiSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => Rpi::find(),
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        $post = $dataProvider->getModels();

        return $this->render('rebooter', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /*public function actionExcuter()
    {
        $selection =(array)Yii::$app->request->post('selection');

        foreach((array)$selection as $id_rpi){
            $model = Rpi::findOne((int)$id_rpi);//make a typecasting
            $model->rebooter();
            $model->save();
            // or delete
        }
    }*/

    
}
