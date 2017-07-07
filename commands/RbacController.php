<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\modules\user\models\User;
use yii\helpers\Console;

class RbacController extends Controller
{

    /**
     * Creates the roles.
     */
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $user = $auth->createRole('user');
        $user->description = 'Пользователь';
        $auth->add($user);

        $manager = $auth->createRole('manager');
        $manager->description = 'Менеджер';
        $auth->add($manager);
        $auth->addChild($manager, $user);

        $admin = $auth->createRole('admin');
        $admin->description = 'Администратор';
        $auth->add($admin);
        $auth->addChild($admin, $manager);
    }

    /**
     * Adds role to user
     * @param integer $userId
     * @param string $role
     * @return int
     */
    public function actionAddRole($userId, $role = 'admin')
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

}