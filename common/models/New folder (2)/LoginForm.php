<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\web\IdentityInterface;
use common\models\User;

/**
 * Login form
 */
class LoginForm extends Model implements IdentityInterface
{
    public $username;
    public $password;
    public $rememberMe = true;
   // public $verifyCode;  

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {   
        return [
            // username and password are both required
            [['username'], 'required'],      
            // rememberMe must be a boolean value
           // ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
           // ['password', 'validatePassword'],  
           // ['verifyCode', 'captcha'],      
            

        ];
    }  

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            // echo "<pre>";print_r($attribute);die;
            if (!$user) {
                $this->addError('user_name', 'Incorrect username');
                return false;
            }

           
                 
                
        }
    }

  

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
         
        return false; 
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    { 
      
       
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }
       
        return $this->_user;
    }
    public static function findIdentity($id)

    {

        return static::findOne(['id' => $id]);

    }
    
    public static function findIdentityByAccessToken($token, $type = null)

    {

        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');

    }

    
    public function getId()

    {

        return $this->getPrimaryKey();

    }

    
    public function getAuthKey()

    {

       

        return $this->auth_key;

    }

    
    public function validateAuthKey($authKey)

    {

        return $this->getAuthKey() === $authKey;

    }



}
