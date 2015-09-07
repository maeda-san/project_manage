<?php

/**
 * Created by PhpStorm.
 * User: maeda
 * Date: 15/09/05
 * Time: 21:14
 */
class Company extends Model
{
    /**
     * このインスタンスをデータベースに保存します
     *
     * @return bool 保存成功可否
     */
    public function save()
    {
        if (is_null($this->is_exist)) {
            return CompanyTable::insert($this);
        }
        else {
            return CompanyTable::update($this);
        }
    }
}