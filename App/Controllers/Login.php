<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;
use \App\Auth;
use \App\Flash;

class Login extends \Core\Controller
{

    public function newAction()
    {
        View::renderTemplate('Login/new.html');
    }

    public function createAction()
    {
        $user = User::authenticate($_POST['email'], $_POST['password']);
        $remember_me = isset($_POST['remember_me']);

        if ($user) {
            Auth::login($user, $remember_me);
            Flash::addMessage('Zostałeś pomyślnie zalogowany');
            $this->redirect(Auth::getReturnToPage());
        } else {
            Flash::addMessage('Logowanie nie powiodło się, spróbuj jeszcze raz', Flash::WARNING);
            View::renderTemplate('Login/new.html', [
                'email' => $_POST['email'],
                'remember_me' => $remember_me
            ]);
        }
    }

    public function destroyAction()
    {
        Auth::logout();
        $this->redirect('/login/show-logout-message');
    }

    public function showLogoutMessage()
    {
        Flash::addMessage('Zostałeś pomyślnie zalogowany');
        $this->redirect('/');
    }
}