<?php

namespace app\modules\user\commands;

use Yii;
use yii\console\Controller;
use app\modules\user\models\User;
use yii\helpers\Console;

class UserController extends Controller
{

    public $user;
    public $pass;
    public $role;
    public $email;

    public function optionAliases()
    {
        return ['u' => 'user', 'p' => 'pass', 'r' => 'role', 'e' => 'email'];
    }

    public function options($actionID)
    {
        return ['user', 'pass', 'role', 'email'];
    }

    /**
     * Adds role to user
     * @param integer $userId
     * @param string $role
     * @return int
     */
    private function actionAddRole($userId, $role = 'admin')
    {
        $user = User::findIdentity($userId);
        if (!$user) {
            $this->stdout("Error: No such user with id '{$userId}'\n", Console::FG_RED);
            return static::EXIT_CODE_ERROR;
        }

        $manager = Yii::$app->authManager;
        $userRole = $manager->getRole($role);
        if (!$userRole) {
            $this->stdout("Error: Not find role '{$role}'\n", Console::FG_RED);
            return static::EXIT_CODE_ERROR;
        }

        $manager->assign($userRole, $userId);
        $this->stdout("Role assign successfully\n", Console::FG_GREEN);
        return static::EXIT_CODE_NORMAL;
    }

    /**
     * Creates a new user with parameters -u=name -p=password -r=role -e=email
     */
    public function actionAdd()
    {
        if ($this->user && $this->pass && $this->role && $this->email) {

            $manager = Yii::$app->authManager;
            $userRole = $manager->getRole($this->role);
            if (!$userRole) {
                $this->stdout("Error: Not find role '{$this->role}'\n", Console::FG_RED);
                return static::EXIT_CODE_ERROR;
            }

            if (User::findByUsername($this->user)) {
                $this->stdout("Error: User '{$this->user}' already exists\n", Console::FG_RED);
                return static::EXIT_CODE_ERROR;
            }

            $user = new User;
            $user->username = $this->user;
            $user->email = $this->email;
            $user->setPassword($this->pass);
            $user->generateAuthKey();
            if ($user->save()) {
                $this->stdout("User added successfully\n", Console::FG_GREEN);
                return $this->actionAddRole($user->getPrimaryKey(), $this->role);
            } else {
                $this->stdout("Error: Not save user\n", Console::FG_RED);
                return static::EXIT_CODE_ERROR;
            }
        }
        $this->stdout("Not set parameters\n", Console::FG_GREEN);
        return static::EXIT_CODE_NORMAL;

    }

}