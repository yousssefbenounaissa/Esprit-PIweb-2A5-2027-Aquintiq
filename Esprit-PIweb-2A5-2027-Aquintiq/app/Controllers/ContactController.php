<?php
namespace App\Controllers;

use App\Models\ContactMessage;
use PDOException;

class ContactController extends Controller
{
    protected string $area  = 'front';
    protected string $page  = 'contact';
    protected string $title = 'Contact | AQUINTIQ';

    public function index(): void
    {
        $old = []; $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $old = [
                'name'    => trim((string) ($_POST['name'] ?? '')),
                'email'   => strtolower(trim((string) ($_POST['email'] ?? ''))),
                'subject' => trim((string) ($_POST['subject'] ?? '')),
                'message' => trim((string) ($_POST['message'] ?? '')),
            ];
            if (!csrfValid()) {
                $errors['form'] = 'Session expirée, veuillez réessayer.';
            } else {
                if (mb_strlen($old['name']) < 2 || mb_strlen($old['name']) > 80)  $errors['name'] = 'Votre nom : 2 à 80 caractères.';
                if (!filter_var($old['email'], FILTER_VALIDATE_EMAIL) || mb_strlen($old['email']) > 120) $errors['email'] = 'Adresse e-mail invalide.';
                if (mb_strlen($old['subject']) > 120)                              $errors['subject'] = 'Objet : 120 caractères maximum.';
                if (mb_strlen($old['message']) < 10 || mb_strlen($old['message']) > 2000) $errors['message'] = 'Message : 10 à 2000 caractères.';
            }
            if (!$errors) {
                try {
                    ContactMessage::create($old);
                    flash('ok', 'Merci ! Votre message a bien été envoyé.');
                    $this->redirect('contact');
                } catch (PDOException $e) {
                    $errors['form'] = 'Base de données indisponible : message non enregistré.';
                }
            }
        }

        $this->render('contact', ['old' => $old, 'errors' => $errors, 'flash' => takeFlash()]);
    }
}
