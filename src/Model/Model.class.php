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
     * is_existプロパティの値を書き換えます。
     *
     * @param bool $value 書き換えたい値
     */
    public function setExist ($value) {
        $this->is_exist = $value;
    }
}