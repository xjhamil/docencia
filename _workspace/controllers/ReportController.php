<?php

namespace app\controllers;

use kartik\mpdf\Pdf;
use Yii;
use app\models\Report;
use app\models\ReportSearch;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ReportController implements the CRUD actions for Report model.
 */
class ReportController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Report models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Report model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Report model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Report();
        $request = Yii::$app->request;

        if($request->isPost) {
            $model->load($request->post());
            $imageFile = UploadedFile::getInstance($model, 'file');
            if($imageFile) {
                $uid = uniqid(time(), true);
                $seg1 = substr($uid, 0, 4);
                $seg2 = substr($uid, 4, 4);
                $seg3 = substr($uid, 8);
                $directory = Yii::getAlias('@webroot/upload/'.$seg1.'/'.$seg2.'/');
                if (!is_dir($directory)) FileHelper::createDirectory($directory);
                $fileName = $seg3 . '.' . $imageFile->extension;
                $filePath = $directory . $fileName;
                if ($imageFile->saveAs($filePath))
                    $model->file = $seg1.'/'.$seg2.'/'.$fileName;
                else $model->addError('file', 'Ha Ocurrido un Error al subir la Imagen');
            }

            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Report model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $request = Yii::$app->request;

        if($request->isPost) {
            $oldPicture = $model->file;
            $model->load($request->post());
            $imageFile = UploadedFile::getInstance($model, 'file');
            if($imageFile) {
                $uid = uniqid(time(), true);
                $seg1 = substr($uid, 0, 4);
                $seg2 = substr($uid, 4, 4);
                $seg3 = substr($uid, 8);
                $directory = Yii::getAlias('@webroot/upload/'.$seg1.'/'.$seg2.'/');
                if (!is_dir($directory)) FileHelper::createDirectory($directory);
                $fileName = $seg3 . '.' . $imageFile->extension;
                $filePath = $directory . DIRECTORY_SEPARATOR . $fileName;
                $oldPath = $directory . DIRECTORY_SEPARATOR . $oldPicture;
                if(file_exists($oldPath) && is_file($oldPath)) unlink($oldPath);
                if ($imageFile->saveAs($filePath))
                    $model->file = $seg1.'/'.$seg2.'/'.$fileName;
                else $model->addError('file', 'Ha Ocurrido un Error al subir la Imagen');
            }

            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Report model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $directory = Yii::getAlias('@webroot/upload');
        $filePath = $directory . DIRECTORY_SEPARATOR . $model->file;
        if(file_exists($filePath) && is_file($filePath)) unlink($filePath);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Report model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Report the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Report::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGraph() {
        return $this->render('graph');
    }

    public function actionPrint($id)
    {
        //$this->layout = 'print';
        $content = $this->renderPartial('print', [
            'model' => $this->findModel($id),
        ]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Krajee Report Title'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader'=>['Krajee Report Header'],
                'SetFooter'=>['{PAGENO}'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }
}
