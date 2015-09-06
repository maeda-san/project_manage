<?php

/**
 * Created by PhpStorm.
 * User: maeda
 * Date: 15/09/05
 * Time: 20:51
 */
class CompanyTable
{
    const TABLE = 'company';

    /**
     * 全件取得します
     *
     * @see Table::findAll
     * @return array
     */
    public static function findAll()
    {
        return Table::findAll(self::TABLE, 'Company');
    }

    /**
     * 顧客データを挿入します
     *
     * @param Company $company
     *
     * @return bool
     */
    public static function insert(Company $company)
    {
        $values = [$company->name];
        $values = implode('","', $values);
        $values = '"' . $values . '"';

        $pdo = Table::getPdo();
        try {
            $sql = 'INSERT INTO `' . self::TABLE . '` (`name`) VALUES (' . $values . ')';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();

            return false;
        }

        return true;
    }
}