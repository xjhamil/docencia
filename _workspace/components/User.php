<?php

/**
 * Created by PhpStorm.
 * User: HENRY
 * Date: 19/03/17
 * Time: 16:26
 */
namespace app\components;

use yii\web\User as WebUser;

class User extends WebUser
{
    public function can($permissionName, $params = [], $allowCaching = true)
    {
        /* @var $identity IdentityInterface */
        $identity = $this->getIdentity();
        if($identity) {
            return $identity->getRole() == $permissionName;
        }
        return false;
    }
}