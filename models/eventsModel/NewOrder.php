<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models\eventsModel;

/**
 * Description of NewOrder
 *
 * @author User
 */

use Yii;
use yii\base\Model;
use \app\components\EventHendler;



class NewOrder extends Model implements EventHendler{
    public function event_hendler($event="NewOrder", $data=100) {
        if($this->dataValidate($data)){
            Yii::$app->mailer->compose($event, ['order' => $data])
    	           ->setFrom(Yii::$app->params['fromEmail'])
		   ->setTo(Yii::$app->params['adminEmail'])
		   ->setSubject('New Order')
		   ->send();
        }else {
            Yii::$app->mailer->compose('default')
    	           ->setFrom(Yii::$app->params['fromEmail'])
		   ->setTo(Yii::$app->params['adminEmail'])
		   ->setSubject('Haker')
		   ->send();
        }
        
    }
    
    public function dataValidate($data){
        $order = $data['order'];
        $pattern = '#^[0-9]+$#';
        return preg_match($pattern, $order);
    }
}

