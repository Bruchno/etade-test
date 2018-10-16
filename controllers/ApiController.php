<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use app\models\FactoryEvent;


interface Save {
    public function insert($date);
}

class ApiController extends Controller{
    
	
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
		
        return [
		   /*'authenticator' => [
			     'class' => HttpBasicAuth::className(),
				 'class' => HttpBearerAuth::className(),
				 'class' => QueryParamAuth::className(),
				 
			],*/
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
           
        ];
    }
	
	public function actionV1()
        {
              $this->enableCsrfValidation = false;          
              $request = Yii::$app->request;
              $event = $request->get('event');
              $data = $request->post();
              $event = $this->changeEvent($event);
              $factory = new FactoryEvent();         
                   $order = $factory->getEventModel($event);                
                   if($order != null){
                   $order->event_hendler($event, 128);
              } else {
                  echo 'Not found!!!';
              }	    
        } 
        public function changeEvent($event){
            $arr_str = explode('_', $event);
            $event_str = '';
            foreach($arr_str as $work){
                  $first = mb_substr($work, 0, 1);
                  $last = mb_substr($work, 1);
                  $first = strtoupper($first);
                  $last = strtolower($last);
                  $event_str .= $first.$last;
              }
            return $event_str;
        }
}
