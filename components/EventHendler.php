<?php

namespace app\components;

use Yii;


interface EventHendler {
    public function event_hendler($event, $data);
}