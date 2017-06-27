<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\base\Security;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $full_name
 * @property string $email
 * @property string $profile_picture
 * @property string $access_token
 * @property string $user_type
 * @property string $timezone
 * @property string $created_date
 * @property string $modified_date
 *
 * 
 */
class User extends ActiveRecord implements \yii\web\IdentityInterface {

    public $authKey;

    public static function tableName() {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        $user = self::find()->where(["id" => $id, 'profile_status' => 'ACTIVE'])->one();
        if (!count($user)) {
            return null;
        }
        return new static($user);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $userType = null) {

        $user = self::find()->where(["access_token" => $token, 'profile_status' => 'ACTIVE'])->one();
        if (!count($user)) {
            return null;
        }
        return new static($user);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
        $user = self::find()->where(["username" => $username, 'profile_status' => 'ACTIVE'])->one();
        if (!count($user)) {
            return null;
        }
        return new static($user);
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email) {
        $user = self::find()->where(["email" => $email, "user_type" => 'CUSTOMER'])->one();
        if (!count($user)) {
            return null;
        }
        return new static($user);
    }

    /**
     * Finds user by admin user type
     *
     * @param string $email
     * @return static|null
     */
    public static function findByAdminEmail($email) {
        $user = self::find()->where(["email" => $email, "user_type" => 'ADMIN', 'profile_status' => 'ACTIVE'])->one();
        if (!count($user)) {
            return null;
        }
        return new static($user);
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    /*
     * Email Verification
     * 
     * @param string $email to verfiy the email
     * @return boolean if email is verfied for current user
     */

    public function verifyEmail($email) {

        $user = self::find()->where(["email" => $email, 'email_activation_status' => 1, "user_type" => 'Customer', 'status' => 'Active'])->one();

        if (!count($user)) {

            return null;
        }

        return new static($user);
    }

    /*
     * Is user admin
     * 
     * @param string $email to verfiy the email
     * @return boolean if email is verfied for current user
     */

    public static function isUserAdmin($email) {
        if (static::findOne(['email' => $email, 'user_type' => 'ADMIN','profile_status'=>'ACTIVE'])) {
            
            return true;
        } else {
            return false;
        }
    }

}
