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
    private $id;
    private $name;
    private $mail;
    private $pass;
    private $status;
    private $created_at;
    private $updated_at;

    /**
     * コンストラクタ
     * プロパティの設定を行います
     *
     * @param array $data 設定データ
     * @param User  $base_user
     */
    public function __construct(array $data, User $base_user = null)
    {
        if ($base_user != null) {
            $buf = $base_user->getAll();
            $data = array_merge($buf, $data);
        }

        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

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
     * プロパティの取得を許可します
     *
     * @param string $name プロパティ名
     *
     * @return mixed
     */
    public function __get($name)
    {
        return $this->$name;
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
        } else {
            return UserTable::update($this);
        }
    }

    /**
     * プロパティを全件取得します
     *
     * @return array
     */
    public function getAll()
    {
        return get_object_vars($this);
    }
}