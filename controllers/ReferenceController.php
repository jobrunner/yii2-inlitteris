<?php
/*
 * This file is part of the inlitteris project.
 *
 * (c) Jo Brunner <http://github.com/jobrunner/yii2-inlitteris>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace jobrunner\inlitteris\controllers;

use Yii;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use jobrunner\inlitteris\api\CiteProcessor;

/**
 * ReferenceController implements the CRUD actions for Reference model.
 *
 * @package jobrunner\inlitteris\controllers
 */
class ReferenceController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    /**
     * Lists all Reference models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = Yii::createObject('ReferenceSearch');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Lists all References in a single bibliography.
     *
     * @return mixed
     */
    public function actionBibliography()
    {
        $searchModel        = Yii::createObject('ReferenceSearch');
        $citationStyleModel = Yii::createObject('CitationStyle');
        $dataProvider       = $searchModel->search(Yii::$app->request->queryParams);

        $citationStyleModel->load(Yii::$app->request->get());

        if (null == $citationStyleModel->citationStyle) {
            $citationStyleModel->citationStyle = $this->module->defaultCitationStyle;
        }

        return $this->render('bibliography', [
            'model'        => $citationStyleModel,
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Reference model.
     *
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Creates a new Reference model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        // should be set per owner in user settings
        $defaultReferenceTypeId  = $this->module->defaultReferenceTypeId;
        $model                   = Yii::createObject('Reference');

        $model->load(Yii::$app->request->post());

        if (null === $model->referenceTypeId) {
            $model->referenceTypeId = $defaultReferenceTypeId;
        }

        if (($model->load(Yii::$app->request->post())) &&
            ($model->referenceTypeId == $model->formerReferenceTypeId) &&
            ($model->save()))
        {

            return $this->redirect(['view', 'id' => $model->id]);
        } else {

            return $this->render('create', [
                'model'              => $model,
                'referenceTypeModel' => Yii::createObject('ReferenceType'),
            ]);
        }
    }


    /**
     * Updates an existing Reference model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model                 = $this->findModel($id);
        $formData              = Yii::$app->request->post($model->formName());
        $formerReferenceTypeId = isset($formData['formerReferenceTypeId']) ? $formData['formerReferenceTypeId'] : null;

        if (($model->load(Yii::$app->request->post())) &&
            ($model->referenceTypeId == $formerReferenceTypeId) &&
            ($model->save())) {

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model'              => $model,
                'referenceTypeModel' => Yii::createObject('ReferenceType'),
            ]);
        }
    }


    /**
     * Deletes an existing Reference model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    /**
     * Finds the Reference model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param string $id
     * @return Reference the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        /** @var Reference $model */
        $model = Yii::createObject('Reference');

        if (null !== ($model = $model::findOne($id))) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
