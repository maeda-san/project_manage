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

    public static function findAll()
    {
        return Table::findAll(self::TABLE, 'Company');
    }

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