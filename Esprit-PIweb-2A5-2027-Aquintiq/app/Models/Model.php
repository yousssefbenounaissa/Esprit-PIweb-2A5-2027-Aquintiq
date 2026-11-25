<?php
namespace App\Models;
use PDO;

/** Modèle de base : CRUD générique (late static binding). Chaque entité déclare $table, $fillable (et $pk si besoin). */
abstract class Model
{
    protected static string $table = '';
    protected static string $pk = 'id';
    protected static array $fillable = [];
    private static ?PDO $pdo = null;

    protected static function db(): PDO
    {
        return self::$pdo ??= new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4', DB_USER, DB_PASS,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false]);
    }
    private static function only(array $d): array { return array_intersect_key($d, array_flip(static::$fillable)); }

    public static function all(string $order = ''): array
    {
        $sql = 'SELECT * FROM `'.static::$table.'`' . ($order ? ' ORDER BY '.preg_replace('/[^a-z_ ,]/i', '', $order) : '');
        return self::db()->query($sql)->fetchAll();
    }
    public static function find(int $id): ?array
    {
        $st = self::db()->prepare('SELECT * FROM `'.static::$table.'` WHERE `'.static::$pk.'` = ?');
        $st->execute([$id]); return $st->fetch() ?: null;
    }
    public static function where(string $col, mixed $val): array
    {
        $st = self::db()->prepare('SELECT * FROM `'.static::$table.'` WHERE `'.preg_replace('/\W/', '', $col).'` = ?');
        $st->execute([$val]); return $st->fetchAll();
    }
    public static function create(array $data): int
    {
        $d = self::only($data); $cols = array_keys($d);
        $st = self::db()->prepare('INSERT INTO `'.static::$table.'` (`'.implode('`,`', $cols).'`) VALUES ('.implode(',', array_fill(0, count($cols), '?')).')');
        $st->execute(array_values($d)); return (int) self::db()->lastInsertId();
    }
    public static function update(int $id, array $data): bool
    {
        $d = self::only($data); if (!$d) return false;
        $set = implode(',', array_map(fn($c) => "`$c`=?", array_keys($d)));
        $st = self::db()->prepare('UPDATE `'.static::$table.'` SET '.$set.' WHERE `'.static::$pk.'` = ?');
        return $st->execute([...array_values($d), $id]);
    }
    public static function delete(int $id): bool
    {
        $st = self::db()->prepare('DELETE FROM `'.static::$table.'` WHERE `'.static::$pk.'` = ?');
        return $st->execute([$id]);
    }
}
