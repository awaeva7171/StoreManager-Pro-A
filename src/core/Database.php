<?php

class Database
{
    private static ?PDO $pdo = null;

    public static function getConnexion(): PDO
    {
        if (self::$pdo === null) {
            try {
                self::$pdo = new PDO(
                    "pgsql:host=localhost;dbname=storemanager_pro;port=5432",
                    "postgres",
                    "postgres"
                );
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $ex) {
                error_log("Echec PostgreSQL (" . $ex->getMessage() . "), fallback SQLite.");

                $sqliteFile = __DIR__ . '/../../erp.db';
                self::$pdo = new PDO('sqlite:' . $sqliteFile);
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdo->exec('PRAGMA foreign_keys = ON;');
            }
        }

        return self::$pdo;
    }

    public static function query(string $sql, bool $single = true): array
    {
        $pdo = self::getConnexion();
        $query = $pdo->query($sql);
        return $single ? $query->fetch() : $query->fetchAll();
    }

    public static function prepare(string $sql, array $datas): PDOStatement
    {
        $pdo = self::getConnexion();
        $statement = $pdo->prepare($sql);
        $statement->execute($datas);
        return $statement;
    }

    public static function executeQuery(string $sql, array $datas, bool $single = true): array
    {
        $statement = self::prepare($sql, $datas);
        return $single ? $statement->fetch() : $statement->fetchAll();
    }

    public static function executeUpdate(string $sql, array $datas): int
    {
        $pdo = self::getConnexion();
        $statement = self::prepare($sql, $datas);
        return (str_starts_with(strtoupper($sql), 'INSERT'))
            ? (int) $pdo->lastInsertId()
            : $statement->rowCount();
    }
}