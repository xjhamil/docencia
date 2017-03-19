<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\components\IdentityInterface;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $role
 */
class User extends ActiveRecord  implements IdentityInterface
{
    const ROLE_ADMIN = 'admin';
    const ROLE_DIRECTOR = 'director';
    const ROLE_SECRETARY = 'secretary';

    const ROLES = [
        User::ROLE_ADMIN => 'Administrador',
        User::ROLE_DIRECTOR => 'Director',
        User::ROLE_SECRETARY => 'Secretaria',
    ];

    public static function tableName()
    {
        return '{{%user}}';
    }

    public function rules() {
        return [
            [['username', 'password_hash', 'email', 'auth_key', 'status', 'created_at', 'updated_at', 'role'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'email'], 'string', 'max' => 255],
            [['auth_key', 'role'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password_hash' => 'Password Hash',
            'email' => 'Email',
            'auth_key' => 'Auth Key',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'role' => 'Role',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return User::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return User::findOne(['username'=>$username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function getRole() {
        return $this->role;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password_hash);
    }
}
