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
     * 顧客を取得します
     *
     * @param array $where 検索条件 キーにカラム名、値にカラム値を入れる
     *
     * @return array
     */
    public static function find(array $where)
    {
        return Table::find(self::TABLE, 'Company', $where);
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
        $data = [
                'name'   => $company->name,
        ];

        return Table::insert(self::TABLE, $data);
    }
}