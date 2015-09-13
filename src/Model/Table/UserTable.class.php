<?php
/**
 * Created by PhpStorm.
 * User: maeda
 * Date: 15/09/05
 * Time: 15:34
 */

/**
 * Class UserTable
 * ユーザモデルDB連携クラス
 *
 * もうちょっと良くしたい
 */
class UserTable
{
    const TABLE = 'user';

    /**
     * ユーザを全件取得します
     *
     * @return array
     */
    public static function findAll()
    {
        return Table::findAll(self::TABLE, 'User');
    }

    /**
     * ユーザを取得します
     *
     * @param array $where 検索条件 キーにカラム名、値にカラム値を入れる
     *
     * @return array
     */
    public static function find(array $where)
    {
        return Table::find(self::TABLE, 'User', $where);
    }

    /**
     * ユーザを登録します
     *
     * @param User $user 登録ユーザ
     *
     * @return bool 登録成功可否
     */
    public static function insert(User $user)
    {
        $data = [
                'name'   => $user->name,
                'mail'   => $user->mail,
                'pass'   => $user->pass,
                'status' => 'active',
        ];

        return Table::insert(self::TABLE, $data);
    }

    /**
     * ユーザを更新します
     *
     * @param User $user 更新ユーザ
     *
     * @return bool 更新成功可否
     */
    public static function update(User $user)
    {
        $data = [
                'name'   => $user->name,
                'mail'   => $user->mail,
                'pass'   => $user->pass,
                'status' => 'active',
        ];
        $where = ['id' => $user->id];

        return Table::update(self::TABLE, $data, $where);
    }
}