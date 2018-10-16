<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models\eventsModel;

/**
 * Description of NewTransaction
 *
 * @author User
 */
class NewTransaction extends Model implements app\components\EventHendler{
    public function event_hendler($event="new_order", $data=100) {
        echo "Work construct NewTransaction";
    }
}
