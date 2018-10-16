<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

/**
 * Description of FactoryEvent
 *
 * @author User
 */

use Yii;
use app\models\eventsModel\NewOrder;
use app\models\eventsModel\NewTransaction;


class FactoryEvent {
    public function getEventModel($event){
        $class = __DIR__.  '\eventsModel\\'. $event . '.php';
        $event = 'app\models\eventsModel\\'.$event;
        if(file_exists($class)){
            return new $event();
        }else {
         return NULL;
        }
    }
}
