<?php

/**
 * Created by PhpStorm.
 * User: maeda
 * Date: 15/09/07
 * Time: 8:47
 */
class ProjectAction extends Controller
{
    public function index()
    {
        $projects = ProjectTable::findAll();
        $this->projects = $projects;
    }

    public function registration()
    {
        $flush = $this->getSession('flush');
        if (!is_null($flush)) {
            $this->error = $flush;
            $this->setSession('flush', null);
        }

        $this->companies = CompanyTable::findAll();
    }

    /**
     * addアクション
     * ユーザを新規登録します。
     */
    public function add()
    {
        $return_url = '/project/registration';

        $post   = $this->getParameter();
        if (count($post) === 0) {
            $this->setSession('flush', 'Need post data.');
            $this->redirectTo($return_url);
        }

        $project   = new Project($post);
        $res    = $project->save();
        if (!$res) {
            $this->setSession('flush', 'SQL error.');
            $this->redirectTo($return_url);
        }
    }
}