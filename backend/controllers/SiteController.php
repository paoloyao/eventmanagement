<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\Guest;
use yii\web\NotFoundHttpException;
use backend\models\GuestSearch;
use backend\models\Event;
use backend\models\EventGuest;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        // return [
        //     'access' => [
        //         'class' => AccessControl::className(),
        //         'rules' => [
        //             [
        //                 'actions' => ['login', 'error', 'create-guest'],
        //                 'allow' => true,
        //             ],
        //             [
        //                 'actions' => ['logout', 'index', 'create-guest'],
        //                 'allow' => true,
        //                 'roles' => ['@'],
        //             ],
        //         ],
        //     ],
        //     'verbs' => [
        //         'class' => VerbFilter::className(),
        //         'actions' => [
        //             'logout' => ['post'],
        //         ],
        //     ],
        // ];
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
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


    public function actionIndex()
    {
        $form = Yii::$app->request->post();
        $eventIds = Guest::find()
                ->select(['id', new \yii\db\Expression("CONCAT(`first_name`, ' ', `last_name`) as name")])
                ->asArray()
                ->all();
        $names = [];
        foreach($eventIds as $key => $id){
            $names[$key] = $id['name'];
        }
        if(isset($form['GuestSearch'])){
            $searchModel = new GuestSearch();
            $parts = explode(' ', $form['GuestSearch']['first_name']);
            $last_name = array_pop($parts);
            $name = array(implode(' ', $parts), $last_name);

            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $name);

            return $this->render('@backend/views/admin/index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'names' => $names
            ]);
        }
        $searchModel = new GuestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, false);

        return $this->render('@backend/views/admin/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'names' => $names
        ]);
    }

    public function actionCreateGuest(){
        $events = Event::find()->all();
        $guest = new Guest;
        $form = Yii::$app->request->post();
        $formDataEventGuest = [];

        if($guest->load($form)){
            $formDataGuest = array_slice($form, 0, 2);
            $saveGuest = $guest->save();
            $saveEventGuest = $this->getEventGuest(array_slice($form, 2), $guest->id, $formDataGuest["_csrf-backend"]);
            if($saveEventGuest && $saveGuest){
                Yii::$app->session->setFlash('success', 'Guest Created Successfully');
                return $this->refresh();
            }else{
                Yii::$app->session->setFlash('error', 'Failed to create Guest');
            }
        }
        return $this->render('@backend/views/admin/create_guest', ['guest' => $guest, 'events' => $events]);
    }

    public function getEventGuest($list, $guest_id, $csrf){
        foreach($list as $key => $value){
            $evenGuest = new EventGuest;
            $newList["EventGuest"]['event_id'] = (int)$value;
            $newList["EventGuest"]['guest_id'] = $guest_id;
            $newList["_csrf-backend"] = $csrf;
            $evenGuest->load($newList);
            if(!$evenGuest->save()){
                return false;
            }
        }
        return true;
    }

    public function actionView($id)
    {
        $guest = Guest::findOne($id);

        return $this->render('@backend/views/admin/_viewModal', [
            'model' => $guest
        ]);
    }

    public function actionUpdate($id)
    {
        $guest = Guest::findOne($id);
        $events = Event::find()->all();
        $getGuestEvents = EventGuest::find()->andWhere(['guest_id'=>(int)$id])->all();
        $guestEvents = [];
        $it = 0;
        foreach($getGuestEvents as $key => $value){
            $guestEvents[$it++] = $value->event_id;
        }

        if ($guest->load(Yii::$app->request->post()) && $guest->save()) {
            $form = Yii::$app->request->post();
            $saveEventGuest = $this->updateEventGuest(array_slice($form, 2), (int)$id, $form["_csrf-backend"], $guestEvents);
            Yii::$app->session->setFlash('success', 'Guest Updated Successfully<br>... will redirect shortly');
        }

        if ($guest->load(Yii::$app->request->post()) && !$guest->save()) {
            Yii::$app->session->setFlash('error', 'Failed to Update Guest');
        }

        return $this->render('@backend/views/admin/update', [
            'guest' => $guest,
            'events' => $events, 
            'guestEvents' => $guestEvents
        ]);
    }


    public function updateEventGuest($updates, $id, $csrf, $guestEvents){
        EventGuest::deleteAll(['and',
            ['guest_id'=>$id],
            ['not in', 'event_id', $updates]]
        );
        $newList = [];
        foreach($updates as $update){
            if(!in_array($update, $guestEvents) || ($update == $guestEvents)){
                $evenGuest = new EventGuest;
                $newList["EventGuest"]['event_id'] = (int)$update;
                $newList["EventGuest"]['guest_id'] = $id;
                $newList["_csrf-backend"] = $csrf;
                $evenGuest->load($newList);
                if(!$evenGuest->save()){
                    return false;
                }
            }
        }
    }

    public function dump($i){
        echo "<pre>";
        var_dump($i);
        exit();
    }

    public function actionDelete($id)
    {
        $guest = Guest::findOne($id)->delete();

        if ($guest) {
            EventGuest::deleteAll(['guest_id'=>$id]);
            Yii::$app->session->setFlash('success', 'Guest Deleted Successfully');
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }else{
            Yii::$app->session->setFlash('error', 'Failed to Delete Guest');
        }
    }

    // public function actionSearch()
    // {
    //     $this->dump(Yii::$app->request->post());
    // }


    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = 'auth';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        // $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
