<?php

namespace app\modules\event\models;

class Event
{
    public static function init(string $event, string $email, Action $action)
    {
        if (Subscriber::isActive($event, $email)) {
            $action->init();
        }
    }
}