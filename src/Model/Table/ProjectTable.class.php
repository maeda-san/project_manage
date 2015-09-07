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
     * @param Project $project
     *
     * @return bool
     */
    public static function insert(Project $project)
    {
        $values = [$project->name, $project->code, $project->status];
        $values = implode('","', $values);
        $values = '"' . $values . '"';

        $pdo = Table::getPdo();
        try {
            $sql = 'INSERT INTO `' . self::TABLE . '` (`name`, `code`, `status`) VALUES (' . $values . ')';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();

            return false;
        }

        return true;
    }
}