<?php

namespace idfly\shellTaskUi\models;

use yii\web\IdentityInterface;

class User implements IdentityInterface
{
    public static function findIdentity($id)
    {
        return new self;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return new self;
    }

    public function getId()
    {
        return 'demo';
    }

    public function getAuthKey()
    {
        return 'demo';
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

}
