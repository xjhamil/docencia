<?php

namespace app\controllers;

use Yii;
use app\models\Person;
use app\models\PersonSearch;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * PersonController implements the CRUD actions for Person model.
 */
class PersonController extends Controller
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
            ]


        ];
    }

    /**
     * Lists all Person models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PersonSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Person model.
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
     * Creates a new Person model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Person();
        $request = Yii::$app->request;

        if($request->isPost) {
            $model->load($request->post());
            $imageFile = UploadedFile::getInstance($model, 'picture');
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
                    $model->picture = $seg1.'/'.$seg2.'/'.$fileName;
                else $model->addError('picture', 'Ha Ocurrido un Error al subir la Imagen');
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
     * Updates an existing Person model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $request = Yii::$app->request;

        if($request->isPost) {
            $oldPicture = $model->picture;
            $model->load($request->post());
            $imageFile = UploadedFile::getInstance($model, 'picture');
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
                    $model->picture = $seg1.'/'.$seg2.'/'.$fileName;
                else $model->addError('picture', 'Ha Ocurrido un Error al subir la Imagen');
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
     * Deletes an existing Person model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $directory = Yii::getAlias('@webroot/upload');
        $filePath = $directory . DIRECTORY_SEPARATOR . $model->picture;
        if(file_exists($filePath) && is_file($filePath)) unlink($filePath);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Person model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Person the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Person::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionList($q = null, $id = null) {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query;
            $query->select('id, name AS text')
                ->from('{{%person}}')
                ->where(['like', 'name', $q])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Person::findOne($id)->name];
        }
        return $out;
    }
}
