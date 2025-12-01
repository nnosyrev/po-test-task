<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Apple model
 *
 * @property int $id
 * @property string $color
 * @property int $size
 * @property int $percent
 * @property string $status
 * @property int $created_at
 * @property int $fall_at
 */
class Apple extends ActiveRecord
{
    public const STATUS_HANGING = 'hanging';
    public const STATUS_FALLEN = 'fallen';
    public const STATUS_ROTTEN = 'rotten';


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%apple}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_HANGING],
            ['status', 'in', 'range' => [self::STATUS_HANGING, self::STATUS_FALLEN, self::STATUS_ROTTEN]],
        ];
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        //return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }
}
