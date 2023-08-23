<?php

namespace Nordy\Php\Controller;
use Nordy\Php\Kernel\Views;
use Nordy\Php\Kernel\AbstractController;
use Nordy\Php\Entity\Notes;
use Nordy\Php\Entity\User;

class Index extends AbstractController {

    public function index()
    {
        $view = new Views();
        $tab = User::getAll();
        $view->setHtml('index.html');
        $view->render([
            'flash' => $this->getFlashMessage(),
            'users' => $tab,
        ]);
    }

    public function create()
    {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $newUser = [
                'name' => $data['name'],
                'surname' => $data['surname']
            ];
            $result = User::insert($newUser);
            if ($result) {
                $this->setFlashMessage("L'utilisateur a été créé avec succès", "success");
            } else {
                $this->setFlashMessage("L'utilisateur n'a pas été créé", "error");
            }
            $this->index();
        } else {
            $view = new Views();
            $view->setHtml('create_user.html');
            $view->render(['flash'=> $this->getFlashMessage()]);
        }
    }

    public function update()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $user = User::getById($id)[0];

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = $_POST;
                if (isset($data['id']) && $data['id'] === $id) {
                    $upData = [
                        'name' => $data['name'],
                        'surname' => $data['surname']
                    ];
                    $result = User::update($id, $upData); 
                    if ($result) {
                        $this->setFlashMessage("L'utilisateur a été mis à jour avec succès", "success");
                    } else {
                        $this->setFlashMessage("L'utilisateur n'a pas été mis à jour", "error");
                    }
                    $this->index();
                }
            } else {
                $view = new Views();
                $view->setHtml('update.html');
                $view->render(['flash'=> $this->getFlashMessage(),
                                'user' => $user]);
            }
        } else {
            $this->setFlashMessage("Oups!", "error");
            exit();
        }
    }

    public function delete()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $result = User::delete($id); 
            if ($result) {
                $this->setFlashMessage("L'utilisateur a été supprimé avec succès", "success");
            } else {
                $this->setFlashMessage('Aucun utilisateur ne correspond', 'error');
            }
        }
        $this->index();
    }
}
