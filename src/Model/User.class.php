<?php
/**
 * Created by PhpStorm.
 * User: maeda
 * Date: 15/09/05
 * Time: 13:48
 */

/**
 * Class User
 * ユーザモデルクラス
 */
class User extends Model
{
    /**
     * String表現はnameプロパティを返します
     *
     * @return string
     */
    public function __toString()
    {
        if (is_null($this->name)) {
            return 'null';
        }

        return $this->name;
    }

    /**
     * このインスタンスをデータベースに保存します
     *
     * @return bool
     */
    public function save()
    {
        if (is_null($this->is_exist)) {
            return UserTable::insert($this);
        }
        else {
            return UserTable::update($this);
        }
    }
}