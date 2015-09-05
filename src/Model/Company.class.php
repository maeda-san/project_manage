<?php

/**
 * Created by PhpStorm.
 * User: maeda
 * Date: 15/09/05
 * Time: 21:14
 */
class Company extends Model
{
    private $id;
    private $name;

    /**
     * コンストラクタ
     * プロパティの設定を行います
     *
     * @param array $data 設定データ
     */
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
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
}