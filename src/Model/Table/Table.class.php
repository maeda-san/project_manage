<?php
/**
 * Created by PhpStorm.
 * User: maeda
 * Date: 15/09/05
 * Time: 15:35
 */

/**
 * Class Table
 */
class Table
{
    /**
     * PDOを取得します。
     * DSNやユーザ・パスワードは設定ファイルから読み込まれます。
     *
     * @return PDO
     */
    public static function getPdo()
    {
        $dsn = DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME;
        try {
            $pdo = new PDO(
                    $dsn,
                    DB_USER,
                    DB_PASS,
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }

        return $pdo;
    }

    public static function findAll($table, $class)
    {
        $pdo = self::getPdo();
        try {
            $sql = 'SELECT * FROM `' . $table . '`';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $results = [];
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $buf = new $class($result);
                $buf->setExist(true);
                $results[] = $buf;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }

        return $results;
    }

    public static function find($table, $class, array $where)
    {
        $where_sql = ' WHERE ';
        foreach ($where as $key => $value) {
            $buf[] = "`{$key}`='{$value}'";
        }
        $where_sql .= implode(' AND ', $buf);

        $pdo = self::getPdo();
        try {
            $sql = 'SELECT * FROM `' . $table . '`';
            $sql .= $where_sql;
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $results = [];
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $results[] = new $class($result);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }

        return $results;
    }

    /**
     * データを挿入します
     *
     * @param       $table
     * @param array $data
     *
     * @return bool
     *
     */
    public static function insert($table, array $data)
    {
        $columns = array_keys($data);
        $columns_sql = implode('`,`', $columns);
        $columns = "`{$columns_sql}`";

        $values = implode('","', $data);
        $values = '"' . $values . '"';

        $pdo = self::getPdo();
        try {
            $sql = "INSERT INTO `{$table}` ({$columns}) VALUES ({$values})";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();

            return false;
        }

        return true;
    }

}