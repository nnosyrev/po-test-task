<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * SpecialUser model
 *
 * @property int $id
 * @property string $username
 * @property string $password_hash
 * @property string $email
 * @property string $auth_key
 * @property int $status
 */
class SpecialUser implements IdentityInterface
{
    public const STATUS_DELETED = 0;
    public const STATUS_INACTIVE = 9;
    public const STATUS_ACTIVE = 10;

    public static function create()
    {
        $specialUser = new self();
        $specialUser->username = 'Special user';
        $specialUser->status = User::STATUS_ACTIVE;
        $specialUser->auth_key = Yii::$app->params['authKey'];
        $specialUser->setPassword(Yii::$app->params['loginPassword']);

        return $specialUser;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return self::create();
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return 1;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
}
