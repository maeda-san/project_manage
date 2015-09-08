<?php

/**
 * Created by PhpStorm.
 * User: maeda
 * Date: 15/09/07
 * Time: 8:40
 */
class Project extends Model
{

    private $id;
    private $name;
    private $code;
    private $status;
    private $company;
    private $created_at;
    private $updated_at;

    const status_relation = [
            'before_start' => '未開始',
            'active'       => '進行中',
            'finished'     => '完了済',
    ];

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

    public function getCompanyName()
    {
        $company = CompanyTable::find(['id' => $this->company]);

        return $company[0]->name;
    }
}