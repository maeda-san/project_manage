<?php

/**
 * Created by PhpStorm.
 * User: maeda
 * Date: 15/09/07
 * Time: 8:37
 */
class ProjectTable
{
    const TABLE = 'project';

    /**
     * 全件取得します
     *
     * @see Table::findAll
     * @return array
     */
    public static function findAll()
    {
        return Table::findAll(self::TABLE, 'Project');
    }

    /**
     * 案件データを挿入します
     *
     * @param Model $model
     *
     * @return bool
     */
    public static function insert(Project $project)
    {
        $data = [
                'name'   => $project->name,
                'code'   => $project->code,
                'status' => $project->status,
        ];

        return Table::insert(self::TABLE, $data);
    }

    public static function update(Model $model)
    {
        // TODO: Implement update() method.
    }
}