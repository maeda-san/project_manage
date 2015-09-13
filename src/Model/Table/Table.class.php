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

    /**
     * 全件取得します
     *
     * @param string $table 対象テーブル名
     * @param string $class 返すクラス名
     *
     * @return array
     */
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

    /**
     * データを取得します
     *
     * @param string $table テーブル名
     * @param string $class 返すクラス名
     * @param array  $where 検索条件
     *
     * @return array
     */
    public static function find($table, $class, array $where)
    {
        $buf = [];
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

    /**
     * データを挿入します
     *
     * @param string $table 対象テーブル
     * @param array  $data  挿入データ:w
     *
     * @return bool 登録成功可否
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

    /**
     * データを更新します
     *
     * @param string $table 対象テーブル
     * @param array  $data  更新データ
     * @param array  $where 検索対象
     *
     * @return bool 更新成功可否
     */
    public static function update($table, array $data, array $where)
    {
        $buf = [];
        foreach ($data as $column => $datum) {
            $buf[] = "`{$column}`='{$datum}'";
        }
        $update_sql = implode(', ', $buf);
        unset($buf);

        $buf = [];
        $where_sql = '';
        foreach ($where as $key => $value) {
            $buf[] = "`{$key}`='{$value}'";
        }
        $where_sql .= implode(' AND ', $buf);

        $pdo = self::getPdo();
        try {
            $sql = "UPDATE `{$table}` SET {$update_sql} WHERE {$where_sql}";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();

            return false;
        }

        return true;
    }

}