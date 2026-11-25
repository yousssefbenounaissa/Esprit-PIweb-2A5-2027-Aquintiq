<?php
namespace App\Controllers;

use App\Models\User;
use PDOException;
use RuntimeException;

/** Paramètres du compte : nom, téléphone, photo de profil. Route : index.php?page=account */
class AccountController extends Controller
{
    protected string $area  = 'front';
    protected string $page  = 'account';
    protected string $title = 'Mon compte | AQUINTIQ';

    private const MAX_BYTES = 2097152; // 2 Mo

    public function index(): void
    {
        if (empty($_SESSION['user'])) { header('Location: ' . url('login')); exit; }
        $_SESSION['csrf'] ??= bin2hex(random_bytes(32));

        if ($_SERVER['REQUEST_METHOD'] === 'POST') $this->save();   // se termine par une redirection

        $flash = $_SESSION['flash'] ?? null;
        unset($_SESSION['flash']);
        try { $u = User::find((int) $_SESSION['user']['id']); } catch (PDOException $e) { $u = null; }
        $u ??= $_SESSION['user'] + ['phone' => null];

        $this->render('account', ['u' => $u, 'csrf' => $_SESSION['csrf'], 'flash' => $flash]);
    }

    private function save(): void
    {
        if (!hash_equals($_SESSION['csrf'], (string) ($_POST['csrf'] ?? ''))) $this->done('err', 'Session expirée, veuillez réessayer.');

        $id    = (int) $_SESSION['user']['id'];
        $name  = trim((string) ($_POST['name'] ?? ''));
        $phone = trim((string) ($_POST['phone'] ?? ''));
        if (mb_strlen($name) < 2 || mb_strlen($name) > 80)                    $this->done('err', 'Entrez votre nom complet (2 à 80 caractères).');
        if ($phone !== '' && !preg_match('/^[0-9+()\s.\-]{6,20}$/', $phone))  $this->done('err', 'Numéro de téléphone invalide.');

        $data   = ['name' => $name, 'phone' => $phone !== '' ? $phone : null];
        $newFile = null;
        try {
            $old  = User::find($id)['photo'] ?? null;
            $file = $_FILES['photo'] ?? null;
            if ($file && ($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
                $newFile = $this->storePhoto($file, $id);
                $data['photo'] = $newFile;
            } elseif (!empty($_POST['remove_photo'])) {
                $data['photo'] = null;
            }
            User::update($id, $data);
            if (array_key_exists('photo', $data)) $this->deletePhoto($old);
        } catch (RuntimeException $e) {
            $this->done('err', $e->getMessage());
        } catch (PDOException $e) {
            if ($newFile) $this->deletePhoto($newFile);
            $this->done('err', 'Enregistrement impossible. La colonne « photo » existe-t-elle ? Exécutez database/add_photo.sql.');
        }

        $_SESSION['user']['name'] = $name;
        if (array_key_exists('photo', $data)) $_SESSION['user']['photo'] = $data['photo'];
        $this->done('ok', 'Modifications enregistrées.');
    }

    /** Vérifie l'image, la recadre en carré 256 px (si GD est disponible) et renvoie le nom du fichier créé. */
    private function storePhoto(array $f, int $id): string
    {
        $err = $f['error'];
        if ($err === UPLOAD_ERR_INI_SIZE || $err === UPLOAD_ERR_FORM_SIZE) throw new RuntimeException('Image trop lourde (2 Mo maximum).');
        if ($err !== UPLOAD_ERR_OK || !is_uploaded_file($f['tmp_name']))   throw new RuntimeException('Échec du téléversement, réessayez.');
        if ($f['size'] > self::MAX_BYTES)                                   throw new RuntimeException('Image trop lourde (2 Mo maximum).');

        $types = [IMAGETYPE_JPEG => 'jpg', IMAGETYPE_PNG => 'png', IMAGETYPE_WEBP => 'webp'];
        $info  = @getimagesize($f['tmp_name']);
        if (!$info || !isset($types[$info[2]]))   throw new RuntimeException('Format non pris en charge (JPG, PNG ou WebP).');
        if ($info[0] * $info[1] > 25000000)       throw new RuntimeException('Image trop grande (25 mégapixels maximum).');

        $dir = dirname(__DIR__, 2) . '/uploads/avatars';
        if (!is_dir($dir) && !mkdir($dir, 0755, true)) throw new RuntimeException('Dossier uploads/avatars introuvable.');
        $base = 'u' . $id . '_' . bin2hex(random_bytes(6));   // le nom ne vient jamais de l'utilisateur

        if (function_exists('imagecreatefromstring')) {
            $src = @imagecreatefromstring((string) file_get_contents($f['tmp_name']));
            if ($src) {
                $w = imagesx($src); $h = imagesy($src); $s = min($w, $h);
                $dst = imagecreatetruecolor(256, 256);
                imagefill($dst, 0, 0, imagecolorallocate($dst, 255, 255, 255));
                imagecopyresampled($dst, $src, 0, 0, intdiv($w - $s, 2), intdiv($h - $s, 2), 256, 256, $s, $s);
                $ok = imagejpeg($dst, "$dir/$base.jpg", 85);
                imagedestroy($src); imagedestroy($dst);
                if ($ok) return "$base.jpg";
            }
        }
        $name = $base . '.' . $types[$info[2]];
        if (!move_uploaded_file($f['tmp_name'], "$dir/$name")) throw new RuntimeException('Impossible d’enregistrer l’image.');
        return $name;
    }

    private function deletePhoto(?string $file): void
    {
        if ($file && preg_match('/^u\d+_[a-f0-9]{12}\.(jpg|png|webp)$/', $file)) {
            @unlink(dirname(__DIR__, 2) . '/uploads/avatars/' . $file);
        }
    }

    /** Message à usage unique, puis retour sur la page (évite le renvoi du formulaire). */
    private function done(string $type, string $text): void
    {
        $_SESSION['flash'] = ['type' => $type, 'text' => $text];
        header('Location: ' . url('account'));
        exit;
    }
}
