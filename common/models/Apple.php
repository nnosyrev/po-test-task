<?php

namespace common\models;

use common\enums\AppleColor;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

/**
 * Apple model
 *
 * @property int $id
 * @property AppleColor|string $color
 * @property int $size
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

    public function afterFind()
    {
        parent::afterFind();
        $this->color = AppleColor::from($this->color);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_HANGING],
            ['status', 'in', 'range' => [self::STATUS_HANGING, self::STATUS_FALLEN, self::STATUS_ROTTEN]],
            ['color', 'in', 'range' => AppleColor::cases()],
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

    public static function findOneOrFail($condition): self
    {
        $apple = Apple::findOne($condition);

        if (!$apple) {
            throw new NotFoundHttpException('The apple does not exist.');
        }

        return $apple;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }
}
