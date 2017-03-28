<?php
/**
 * Created by PhpStorm.
 * User: HENRY
 * Date: 19/03/17
 * Time: 16:40
 */

namespace app\components;

use yii\web\IdentityInterface as YiiIdentity;

interface IdentityInterface extends YiiIdentity
{
    public function getRole();
}