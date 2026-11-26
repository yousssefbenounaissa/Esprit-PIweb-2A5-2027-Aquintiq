<?php
function e(?string $s): string { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
function asset(string $path): string { return BASE_URL . '/assets/' . ltrim($path, '/'); }
function url(string $page): string { return BASE_URL . '/index.php?page=' . $page; }
/** Classe CSS "active" si $page correspond à la page courante (navbar / sidebar) */
function navActive(string $page, string $currentPage): string { return $page === $currentPage ? 'active' : ''; }
/** Atelier : état du menu (sidebar Back Office) */
function isActive(string $page, string $currentPage): string { return $page === $currentPage ? 'active' : ''; }
/** Un groupe est ouvert si la page courante appartient à ses pages */
function groupIsExpanded(array $pages, string $currentPage): string { return in_array($currentPage, $pages, true) ? 'true' : 'false'; }
function isOpen(array $pages, string $currentPage): string { return groupIsExpanded($pages, $currentPage) === 'true' ? 'open' : ''; }
function isCollapsed(array $pages, string $currentPage): string { return groupIsExpanded($pages, $currentPage) === 'true' ? '' : 'collapsed'; }
function modules(): array { static $m = null; return $m ??= require __DIR__ . '/modules.php'; }
/** Icônes SVG intégrées (trait, 24x24) — aucune bibliothèque externe */
function icon(string $name, int $size = 24): string {
    static $p = [
      'farm'=>'<path d="M3 21h18M5 21V10l7-6 7 6v11M9 21v-7h6v7"/>',
      'drop'=>'<path d="M12 3c3.6 4.6 6 7.6 6 11a6 6 0 0 1-12 0c0-3.4 2.4-6.4 6-11z"/>',
      'shop'=>'<path d="M4 9l1.2-5h13.6L20 9M4 9v11h16V9M4 9h16M9.5 20v-6h5v6"/>',
      'calendar'=>'<path d="M4 6h16v14H4zM4 11h16M8 3v5M16 3v5M8.5 15.5l2 2 4-4"/>',
      'book'=>'<path d="M4 5a2 2 0 0 1 2-2h13v15H6a2 2 0 0 0-2 2zM4 20a2 2 0 0 0 2 1h13"/>',
      'tool'=>'<path d="M14.5 6.5a4 4 0 0 0 5 5L11 20a2.1 2.1 0 0 1-3-3l8.5-8.5a4 4 0 0 1-2-2z"/>',
      'users'=>'<path d="M9 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM3 20c0-3 2.7-5 6-5s6 2 6 5M17 11a2.5 2.5 0 1 0 0-5M18 15c2 .6 3 2 3 5"/>',
      'sun'=>'<circle cx="12" cy="12" r="4"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3M5 5l2 2M17 17l2 2M19 5l-2 2M7 17l-2 2"/>',
      'chip'=>'<rect x="6" y="6" width="12" height="12" rx="1"/><path d="M9 2v4M15 2v4M9 18v4M15 18v4M2 9h4M2 15h4M18 9h4M18 15h4"/>',
      'bell'=>'<path d="M6 17v-6a6 6 0 1 1 12 0v6l1.5 2h-15zM10 21h4"/>',
      'search'=>'<circle cx="11" cy="11" r="6.5"/><path d="M20 20l-4.2-4.2"/>',
      'menu'=>'<path d="M4 7h16M4 12h16M4 17h16"/>',
      'arrow'=>'<path d="M5 12h14M13 6l6 6-6 6"/>',
      'leaf'=>'<path d="M5 19C5 10 10 5 20 4c0 10-5 15-13 15M5 19c3-5 6-8 10-10"/>',
      'bolt'=>'<path d="M13 2L5 14h6l-1 8 8-12h-6z"/>',
      'home'=>'<path d="M4 11l8-7 8 7v9H4zM10 20v-5h4v5"/>',
      'grid'=>'<rect x="4" y="4" width="7" height="7"/><rect x="13" y="4" width="7" height="7"/><rect x="4" y="13" width="7" height="7"/><rect x="13" y="13" width="7" height="7"/>',
      'out'=>'<path d="M14 4h6v6M20 4l-9 9M18 14v6H4V6h6"/>',
      'check'=>'<path d="M5 12.5l4.5 4.5L19 7.5"/>',
      'x'=>'<path d="M6 6l12 12M18 6L6 18"/>',
      'pin'=>'<path d="M12 21s7-6 7-11a7 7 0 1 0-14 0c0 5 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/>',
      'mail'=>'<rect x="3" y="5" width="18" height="14" rx="1"/><path d="M3 7l9 7 9-7"/>',
    ];
    return '<svg class="ic" width="'.$size.'" height="'.$size.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">'.($p[$name] ?? '').'</svg>';
}
/** Pastille de statut colorée selon la valeur */
function chip(string $v): string {
    $ok = ['Actif','Active','Publié','Confirmée','Disponible','Oui','Auto','Administrateur'];
    $info = ['Planifié','Manuel','Agriculteur','Technicien'];
    $cls = in_array($v, $ok, true) ? 'ok' : (in_array($v, $info, true) ? 'info' : 'off');
    return '<span class="chip '.$cls.'">'.e($v).'</span>';
}

/** Initiales : 1re lettre du prénom + 1re lettre du nom (une seule lettre si le nom n'a qu'un mot) */
function initials(string $name): string {
    $parts = preg_split('/\s+/u', trim($name), -1, PREG_SPLIT_NO_EMPTY);
    if (!$parts) return '?';
    $i = mb_strtoupper(mb_substr($parts[0], 0, 1));
    if (count($parts) > 1) $i .= mb_strtoupper(mb_substr(end($parts), 0, 1));
    return $i;
}
/** URL publique de la photo de profil (nom de fichier contrôlé), ou null */
function avatarUrl(?string $file): ?string {
    return ($file && preg_match('/^u\d+_[a-f0-9]{12}\.(jpg|png|webp)$/', $file)) ? BASE_URL . '/uploads/avatars/' . $file : null;
}
/** Pastille ronde : photo si elle existe, sinon initiales. $size : '', 'lg' ou 'xl' */
function avatarHtml(array $u, string $size = ''): string {
    $src = avatarUrl($u['photo'] ?? null);
    $inner = $src ? '<img src="'.e($src).'" alt="">' : '<span>'.e(initials((string)($u['name'] ?? ''))).'</span>';
    return '<span class="avatar'.($size ? ' '.$size : '').'">'.$inner.'</span>';
}


/* ---------- Sécurité : CSRF + messages flash (atelier Sessions et Sécurité) ---------- */
function csrfToken(): string { return $_SESSION['csrf'] ??= bin2hex(random_bytes(32)); }
function csrfField(): string { return '<input type="hidden" name="csrf" value="' . e(csrfToken()) . '">'; }
function csrfValid(): bool { return hash_equals(csrfToken(), (string) ($_POST['csrf'] ?? '')); }
function flash(string $type, string $text): void { $_SESSION['flash'] = ['type' => $type, 'text' => $text]; }
function takeFlash(): ?array { $f = $_SESSION['flash'] ?? null; unset($_SESSION['flash']); return $f; }
/** Détruit la session ET supprime le cookie PHPSESSID. */
function destroySession(): void
{
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $c = session_get_cookie_params();
        setcookie(session_name(), '', ['expires' => time() - 42000, 'path' => $c['path'], 'domain' => $c['domain'], 'secure' => $c['secure'], 'httponly' => true, 'samesite' => 'Lax']);
    }
    if (session_status() === PHP_SESSION_ACTIVE) session_destroy();
}
