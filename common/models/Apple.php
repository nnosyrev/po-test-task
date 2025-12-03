<?php

namespace common\models;

use common\enums\AppleColor;
use common\exceptions\RottenAppleException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\BatchQueryResult;
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
    public const STATUS_DROPPED = 'dropped';

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
            ['status', 'in', 'range' => [self::STATUS_HANGING, self::STATUS_DROPPED]],
            ['color', 'in', 'range' => AppleColor::cases()],
        ];
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

    public static function create(AppleColor $appleColor): self
    {
        $now = time();

        $apple = new Apple();
        $apple->color = $appleColor;
        $apple->size = '1.00';
        $apple->status = Apple::STATUS_HANGING;
        $apple->appearance_at = mt_rand($now - \Yii::$app->params['appleAppearancePeriod'], $now);
        $apple->save();

        return $apple;
    }

    public static function findAllNotRotten(): array
    {
        return Apple::find()
            ->where('fall_at IS NULL')
            ->orWhere('fall_at >= :threshold', ['threshold' => time() - \Yii::$app->params['appleRotsInSeconds']])
            ->all();
    }

    public static function findAllOldRotten(): BatchQueryResult
    {
        return Apple::find()
            ->where('fall_at IS NOT NULL')
            ->andWhere('fall_at < :threshold', ['threshold' => time() - \Yii::$app->params['appleRotsInSeconds'] - \Yii::$app->params['deleteRottenOlderThan']])
            ->each();
    }

    public function drop(): void
    {
        if ($this->status === Apple::STATUS_DROPPED) {
            throw new \Exception('The apple is already on the ground');
        }

        $this->status = Apple::STATUS_DROPPED;
        $this->fall_at = time();

        $this->save();
    }

    public function eat(int $percent): void
    {
        if ($this->status === Apple::STATUS_HANGING) {
            throw new \Exception('Trying to eat a hanging apple');
        }

        if ($this->isRotten()) {
            throw new RottenAppleException('The apple is rotten');
        }

        $this->size = $this->size - 1 / 100 * $percent;

        if ($this->size < 0) {
            throw new \Exception('Trying to bite off more than exists');
        }

        if ($this->size === 0.0) {
            $this->delete();
            return;
        }

        $this->save();
    }

    public function isRotten(): bool
    {
        if ($this->status === Apple::STATUS_HANGING) {
            return false;
        }

        return (time() - $this->fall_at > \Yii::$app->params['appleRotsInSeconds']);
    }
}
