<?php
/**
 * Created by PhpStorm.
 * User: maeda
 * Date: 15/09/05
 * Time: 18:40
 */

/**
 * Class Model
 *
 * モデルが継承するスーパークラスです
 */
class Model
{
    /**
     * @var bool DBに存在するかを表します。
     */
    protected $is_exist;

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

    /**
     * is_existプロパティの値を書き換えます。
     *
     * @param bool $value 書き換えたい値
     */
    public function setExist ($value) {
        $this->is_exist = $value;
    }
}