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
 * @property string $role
 */
class User extends ActiveRecord  implements IdentityInterface
{
    public $password;

    const ROLE_ADMIN = 'admin';
    const ROLE_DIRECTOR = 'director';
    const ROLE_SECRETARY = 'secretary';

    const ROLES = [
        User::ROLE_ADMIN => 'Administrador',
        User::ROLE_DIRECTOR => 'Director',
        User::ROLE_SECRETARY => 'Secretaria',
    ];

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    const STATUSES = [
        User::STATUS_ENABLED => 'Habilitado',
        User::STATUS_DISABLED => 'Deshabilitado'
    ];

    public static function tableName()
    {
        return '{{%user}}';
    }

    public function rules() {
        return [
            [['username', 'password_hash', 'email', 'auth_key', 'status', 'role'], 'required'],
            [['username', 'password_hash', 'email', 'password'], 'string', 'max' => 255],
            [['auth_key', 'role'], 'string', 'max' => 32],
            [['username', 'email'], 'unique'],
            [['status'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Usuario',
            'password_hash' => 'Password',
            'email' => 'Correo',
            'auth_key' => 'Auth Key',
            'status' => 'Estado',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'role' => 'Rol',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return User::findOne(['id'=>$id,'status'=>User::STATUS_ENABLED]);
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
        return User::findOne(['username'=>$username, 'status'=>User::STATUS_ENABLED]);
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
