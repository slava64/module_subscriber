<?php

namespace app\modules\event\models;

use Yii;

/**
 * This is the model class for table "subscriber".
 *
 * @property int $id
 * @property string|null $event
 * @property string $email
 * @property int $blocked
 * @property string $created_at
 * @property string $updated_at
 */
class Subscriber extends \yii\db\ActiveRecord
{
    const REGISTRATION = 'Регистрация';
    const VERIFICATION = 'Верификация';
    const ENTER = 'Вход';
    const SEND_MESSAGE = 'Отправка сообщения';
    const EXIT = 'Выход';

    const INBLOCKED = 0;
    const BLOCKED = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subscriber';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event'], 'string'],
            [['event', 'email'], 'required'],
            ['email', 'email'],
            [['blocked'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['email'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event' => 'Событие',
            'email' => 'Получатель',
            'blocked' => 'Заблокирован',
            'created_at' => 'Дата добавления',
            'updated_at' => 'Дата редактирования',
        ];
    }

    /*public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->created_at = date("Y-m-d H:i:s");
                $this->updated_at = date("Y-m-d H:i:s");
            } else {
                $this->updated_at = date("Y-m-d H:i:s");
            }
            return true;
        } else {
            return false;
        }
    }*/

    public static function getEventList()
    {
        return [
            self::REGISTRATION => self::REGISTRATION,
            self::VERIFICATION => self::VERIFICATION,
            self::ENTER => self::ENTER,
            self::SEND_MESSAGE => self::SEND_MESSAGE,
            self::EXIT => self::EXIT,
        ];
    }

    public static function getBlockedList()
    {
        return [
            self::INBLOCKED => 'Нет',
            self::BLOCKED => 'Да'
        ];
    }

    public static function isActive(string $event, string $email)
    {
       $sub = Subscriber::find()
            ->where(['event' => $event, 'email' => $email, 'blocked' => Subscriber::INBLOCKED])
            ->limit(1)
            ->all();
       if ($sub) {
           return true;
       }
       return false;
    }
}
