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

class ApiController extends Controller{
    
	
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
		
        return [
		   'authenticator' => [
			     'class' => HttpBasicAuth::className(),
				 'class' => HttpBearerAuth::className(),
				 'class' => QueryParamAuth::className(),
				 
			],
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
	   $order = $request->post('order');
	   switch ($event){
         case 'new_order': {
		  
			Yii::$app->mailer->compose($event, ['order' => $order])
    	   ->setFrom(Yii::$app->params['fromEmail'])
		   ->setTo(Yii::$app->params['adminEmail'])
		   ->setSubject('Tema2')
		   ->send();
		   break;
           }
		   default: {
			Yii::$app->mailer->compose('default')
    	   ->setFrom(Yii::$app->params['fromEmail'])
		   ->setTo(Yii::$app->params['adminEmail'])
		   ->setSubject('Haker')
		   ->send();
           }
		}
    }
     
}
