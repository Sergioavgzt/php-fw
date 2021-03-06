<?php
namespace Micro\Forms;


use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Identical;

class LoginForm extends Form
{

    public function initialize()
    {
        // Email
        $email = new Text('email', [
            'placeholder' => 'Email'
        ]);

        $email->addValidators([
            new PresenceOf([
                'message' => 'Введите свой e-mail'
            ]),
            new Email([
                'message' => 'Email не верный'
            ])
        ]);

        $this->add($email);

        // Password
        $password = new Password('password', [
            'placeholder' => 'Пароль'
        ]);

        $password->addValidator(new PresenceOf([
            'message' => 'Введите свой пароль'
        ]));

        $password->clear();

        $this->add($password);

        // Remember
        $remember = new Check('remember', [
            'value' => 'yes'
        ]);

        $remember->setLabel('Запомнить меня');

        $this->add($remember);

        // CSRF
        $csrf = new Hidden('csrf');

        $csrf->addValidator(new Identical([
            'value' => $this->security->getSessionToken(),
            'message' => 'CSRF валидация не верна'
        ]));

        $csrf->clear();

        $this->add($csrf);

        $this->add(new Submit('go', [
            'class' => 'btn btn-success'
        ]));
    }
}
