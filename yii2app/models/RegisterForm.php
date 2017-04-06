<?php
 
namespace app\models;
 
use Yii;
use yii\base\Model;
 
/**
 * Register form
 */
class RegisterForm extends Model
{
 
    public $name;
    public $email;
    public $phone;
    public $password;
    public $captcha;
 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'trim'],
            ['name', 'required'],
            ['name', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['name', 'string', 'min' => 2, 'max' => 50],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 50],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['phone', 'string', 'max' => 12, 'min' => 7],
            ['captcha', 'required'],
            ['captcha', 'captcha']
        ];
    }
 
     public function attributeLabels()
    {
        return [
            'name' => 'Login',
            'email' => 'Email',
            'phone' => 'Телефон',
            'password' => 'Пароль',
            'captcha' => 'Проверочный код',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
 
        if (!$this->validate()) {
            return null;
        }
 
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save() ? $user : null;
    }

}