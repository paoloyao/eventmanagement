<?php

namespace backend\controllers;

use Yii;
use backend\models\Event;
use backend\models\EventSearch;
use backend\models\EventGuest;
use backend\models\Guest;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\EventGuestSearch;
use yii\data\ActiveDataProvider;
use backend\models\GuestSearch;
/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Event models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EventSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('@backend/views/event/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Event model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('@backend/views/event/index', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Event model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Event();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Event Created Successfully');
            return $this->refresh();
        }

        if ($model->load(Yii::$app->request->post()) && !$model->save()) {
            Yii::$app->session->setFlash('Error', 'Failed to Create Event');
            return $this->refresh();
        }

        return $this->render('@backend/views/event/create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Event model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Event Updated Successfully<br>... will redirect shortly');
        }

        if ($model->load(Yii::$app->request->post()) && !$model->save()) {
            Yii::$app->session->setFlash('error', 'Failed to Update Event');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Event model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionDelete($id)
    {
        $eventGuest = EventGuest::find()->andWhere(['event_id'=>(int)$id])->all();
        if($eventGuest){
            Yii::$app->session->setFlash('error', 'Cannot Delete Event as There are <br>still Guests registered to it!');
            return Yii::$app->response->redirect('index');
        }else{
            $event = $this->findModel($id)->delete();

            if ($event) {
                Yii::$app->session->setFlash('success', 'Event Deleted Successfully');
                return Yii::$app->response->redirect('index');
            }else{
                Yii::$app->session->setFlash('error', 'Failed to Delete Event');
            }
        }
    }

    public function actionReport(){
        // $dataProvider = EventGuest::find()
        // ->select('eventguest.event_id, guest.first_name, guest.last_name, guest.phone, guest.email')
        // ->leftJoin('guest', 'guest.id = eventguest.guest_id');

        $eventIds = Event::find()
                ->select('event.id, event.name, event.datetime')
                ->andWhere("status = 'Show'")
                ->asArray()
                ->all();

        $gridData = [];
        $it = 0;
        foreach($eventIds as $key => $value){
            $gridData[$key]['name'] = $value['name'];
            $gridData[$key]['datetime'] = $value['datetime'];
            $searchModel = new EventGuestSearch();
            $gridData[$key]['searchModel'] = $searchModel;
            $gridData[$key]['dataProvider'] = $searchModel->search(Yii::$app->request->queryParams, $value['id']);
        }

        // echo "<pre>";
        // var_dump($gridData);
        // exit();
    
        $searchModel = new EventGuestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, '10');

        return $this->render('@backend/views/admin/report', [
            'gridData' => $gridData,
        ]);

        // add conditions that should always apply here

        // echo "<pre>";
        // var_dump($dataProvider);
        // exit();

        // $searchModel = new EventGuestSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // grid filtering conditions
        // $query->andFilterWhere([
        //     'id' => $this->id,
        //     'event_id' => $this->event_id,
        //     'guest_id' => $this->guest_id,
        //     'phone' => $this->phone,
        //     'email' => $this->email,
        //     'first_name' => $this->first_name,
        //     'last_name' => $this->last_name
        // ]);

        // $leadsCount = Lead::find()
        // ->select(['COUNT(*) AS cnt'])
        // ->where('approved = 1')
        // ->groupBy(['promoter_location_id', 'lead_type_id'])

        return $this->render('@backend/views/admin/report', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);

    }

    /**
     * Finds the Event model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Event::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
