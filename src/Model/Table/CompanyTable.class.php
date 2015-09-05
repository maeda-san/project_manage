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
}