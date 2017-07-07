<?php
namespace app\modules\user\models\backend\forms;

use app\modules\user\models\User;
use Yii;
use yii\base\Model;

/**
 * Password reset form
 *
 * @property null|User $user
 */
class PasswordResetForm extends Model
{
    public $password;
    public $new_password;

    /**
     * @var User
     */
    private $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password','new_password'], 'required'],
            [['password','new_password'], 'string', 'min' => 5],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'password' => 'Старый пароль',
            'new_password' => 'Новый пароль'
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     */
    public function validatePassword($attribute, $params)
    {
        if(!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, Yii::t('modules/user/messages', 'Incorrect password.'));
            }
        }
    }

    /**
     * Finds user by [[id]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findIdentity(Yii::$app->user->id);
        }

        return $this->_user;
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->getUser();

        $user->setPassword($this->new_password);
        $user->removePasswordResetToken();

        return $user->save(false);
    }
}
