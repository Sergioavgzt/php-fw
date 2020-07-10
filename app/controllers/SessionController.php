<?php
namespace Micro\Controllers;

use Micro\Forms\LoginForm;
use Micro\Forms\SignUpForm;
use Micro\Forms\ForgotPasswordForm;
use Micro\Auth\Exception as AuthException;
use Micro\Models\Users;
use Micro\Models\ResetPasswords;
use Micro\Models\SuccessLogins;
use Micro\Models\Zaprosy;
/**
 * Controller used handle non-authenticated session actions like login/logout, user signup, and forgotten passwords
 */
class SessionController extends ControllerBase
{

    /**
     * Default action. Set the public layout (layouts/public.volt)
     */
    public function initialize()
    {
        $this->view->setTemplateBefore('public');
    }

    public function indexAction()
    {
    }


    /**
     * Starts a session in the admin backend
     */
    public function loginAction()
    {
        $form = new LoginForm();

        try {
            if (!$this->request->isPost()) {
                if ($this->auth->hasRememberMe()) {
                    return $this->auth->loginWithRememberMe();
                }
            } else {

                if ($form->isValid($this->request->getPost()) == false) {
                    foreach ($form->getMessages() as $message) {
                        $this->flash->error($message);
                    }
                } else {

                    $this->auth->check([
                        'email' => $this->request->getPost('email'),
                        'password' => $this->request->getPost('password'),
                        'remember' => $this->request->getPost('remember')
                    ]);

						// авторизуем и переадресовываем на стр about
						return $this->response->redirect('about');
                }
            }
        } catch (AuthException $e) {
            $this->flash->error($e->getMessage());
        }

        $this->view->form = $form;
    }

    /**
     * Shows the forgot password form
     */
    public function forgotPasswordAction()
    {
        $form = new ForgotPasswordForm();

        if ($this->request->isPost()) {

            // Send emails only is config value is set to true
            if ($this->getDI()->get('config')->useMail) {

                if ($form->isValid($this->request->getPost()) == false) {
                    foreach ($form->getMessages() as $message) {
                        $this->flash->error($message);
                    }
                } else {

                    $user = Users::findFirstByEmail($this->request->getPost('email'));
                    if (!$user) {
                        $this->flash->success('Нет аккаунта с таким email');
                    } else {

                        $resetPassword = new ResetPasswords();
                        $resetPassword->usersId = $user->id;
                        if ($resetPassword->save()) {
                            $this->flash->success('На Ваш email послано сообщение для сброса пароля.');
                        } else {
                            foreach ($resetPassword->getMessages() as $message) {
                                $this->flash->error($message);
                            }
                        }
                    }
                }
            } else {
                $this->flash->warning('Emails are currently disabled. Change config key "useMail" to true to enable emails.');
            }
        }

        $this->view->form = $form;
    }

    /**
     * Closes the session
     */
    public function logoutAction()
    {
		// записываем время выхода в табл. SuccessLogins
		// ID текущего пользователя
/* 		$identity = $this->session->get('auth-identity');
		$userid = $identity[id];
		
		// найти строку с id текущего пользователя и dateOut = '0000-00-00 00:00:00'
		$conditions = "usersId = :usersId: AND dateOut = :dateOut:";
		$parameters = array(
			"usersId" => $userid,
			"dateOut" => '0000-00-00 00:00:00'
		);
		$robots = SuccessLogins::find(
			array(
			$conditions,
			"bind" => $parameters
			)
		);
		foreach ($robots as $robot) {
	 		$robot->dateOut;
		}
		$robot->dateOut = date("Y-m-d H:i:s");
		
        if (!$robot->save()) {
			
            $this->flash->error($user->getMessages());
			
        } else {
 */
			$this->auth->remove();
			return $this->response->redirect('index');
 //       }
    }
}
