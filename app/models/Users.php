<?php
namespace Micro\Models;

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;

/**
 * Micro\Models\Users
 * All the users registered in the application
 */
class Users extends Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $company;

    /**
     *
     * @var string
     */
    public $position;

    /**
     *
     * @var string
     */
    // public $temppassword;

    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var string
     */
    public $mustChangePassword;

    /**
     *
     * @var string
     */
    public $profilesId;

    /**
     *
     * @var string
     */
    public $banned;

    /**
     *
     * @var string
     */
    public $suspended;

    /**
     *
     * @var string
     */
    public $active;

    /**
     * Before create the user assign a password
     */
    public function beforeValidationOnCreate()
    {
        if (empty($this->password)) {

            // Generate a plain temporary password
            $tempPassword = preg_replace('/[^a-zA-Z0-9]/', '', base64_encode(openssl_random_pseudo_bytes(12)));

            // The user must change its password in first login
            $this->mustChangePassword = 'Y';

            // Use this password as default
            $this->password = $this->getDI()
                ->getSecurity()
                ->hash($tempPassword);
        } else {
            // The user must not change its password in first login
            $this->mustChangePassword = 'N';
        }

        // The account must be confirmed via e-mail
        // Only require this if emails are turned on in the config, otherwise account is automatically active
        if ($this->getDI()->get('config')->useMail) {
            $this->active = 'N';
        } else {
            $this->active = 'Y';
        }
        
        // The account is not suspended by default
        $this->suspended = 'Y';

        // The account is not banned by default
        $this->banned = 'N';
    }

    /**
     * Send a confirmation e-mail to the user if the account is not active
     */
    public function afterSave()
    {
        // Only send the confirmation email if emails are turned on in the config
        if ($this->getDI()->get('config')->useMail) {

            if ($this->active == 'N') {

                $emailConfirmation = new EmailConfirmations();

                $emailConfirmation->usersId = $this->id;
				
					// данные нового сотрудника
					$id = $this->id;
					$userrow = Users::findFirst($id);
					$userEmail = $userrow->email;
					$na = $userrow->name;
					$userCompany = $userrow->company;

                if ($emailConfirmation->save()) {
                    $this->getDI()
                        ->getFlash()
                        ->notice('Письмо для подтверждения email послано на ' . $this->email);
						
					// отправка письма админу после регистрации нового сотрудника 

					// чтение из БД e-mail админов
					$robots = Users::find(
						array(
						"profilesId = '1'"
						)
					);
					// создаём массив с адресами
					$adminsAndUserEmails = [];
					
					// заносим адреса админов
					foreach ($robots as $robot) {
						$userName = $robot->name;
						if ($userName != 'Sergio')
						$adminsAndUserEmails[] = $robot->email;
					}		

					// отправка письма: адреса, Заголовок, параметры (переменные передаём в шаблон письма mailPassword.volt)
					$this->getDI()->getMail()->send(
						$adminsAndUserEmails, 
						"Новый сотрудник зарегистрировался!", 'newUser', 
						[ 'userEmail' => $userEmail, 'na' => $na, 'userCompany' => $userCompany ] 
						
					);
                }
            }
        }
    }

    /**
     * Validate that emails are unique across users
     */
    public function validation()
    {
        $validator = new Validation();

        $validator->add('email', new Uniqueness([
            "message" => "Пользователь с таким email уже зарегистрирован"
        ]));

        return $this->validate($validator);
    }

    public function initialize()
    {
        $this->belongsTo('profilesId', __NAMESPACE__ . '\Profiles', 'id', [
            'alias' => 'profile',
            'reusable' => true
        ]);

        $this->hasMany('id', __NAMESPACE__ . '\Users', 'name');
		
/*        $this->hasMany('id', __NAMESPACE__ . '\SuccessLogins', 'usersId', [
            'alias' => 'successLogins',
            'foreignKey' => [
                'message' => 'Сотрудника нельзя удалить пока он активен в системе'
            ]
        ]);
 */  
/*         $this->hasMany('id', __NAMESPACE__ . '\PasswordChanges', 'usersId', [
            'alias' => 'passwordChanges',
            'foreignKey' => [
                'message' => 'Сотрудника нельзя удалить пока он активен в системе'
            ]
        ]);
 */
/*         $this->hasMany('id', __NAMESPACE__ . '\ResetPasswords', 'usersId', [
            'alias' => 'resetPasswords',
            'foreignKey' => [
                'message' => 'Сотрудника нельзя удалить пока он активен в системе'
            ]
        ]);
 */		
    }

}
