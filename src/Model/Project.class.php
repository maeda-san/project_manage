<?php

/**
 * Created by PhpStorm.
 * User: maeda
 * Date: 15/09/07
 * Time: 8:40
 */
class Project extends Model
{
    const status_relation = [
            'before_start' => '未開始',
            'active'       => '進行中',
            'finished'     => '完了済',
    ];

    /**
     * このインスタンスをデータベースに保存します
     *
     * @return bool
     */
    public function save()
    {
        if (is_null($this->is_exist)) {
            return ProjectTable::insert($this);
        }
        else {
            return ProjectTable::update($this);
        }
    }
}