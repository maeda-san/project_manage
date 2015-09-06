<?php
/**
 * Created by PhpStorm.
 * User: maeda
 * Date: 15/09/05
 * Time: 20:50
 */

/**
 * Class CompanyAction
 */
class CompanyAction extends Controller
{
    /**
     * indexアクション
     * 顧客一覧を取得します
     */
    public function index()
    {
        $companies = CompanyTable::findAll();
        $this->companies = $companies;
    }

    /**
     * registrationアクション
     * エラーがあれば取得し、登録フォームを表示します
     */
    public function registration()
    {
        $flush = $this->getSession('flush');
        if (!is_null($flush)) {
            $this->error = $flush;
            $this->setSession('flush', null);
        }
    }

    /**
     * addアクション
     * 送信されたデータを顧客として登録します
     */
    public function add()
    {
        $return_url = '/company/registration';

        $post = $this->getParameter();
        if (!isset($post['name'])) {
            $this->setSession('flush', 'Need post data.');
            $this->redirectTo($return_url);
        }
        $company = new Company($post);
        $res = $company->save();
        if (!$res) {
            $this->setSession('flush', 'SQL error');
            $this->redirectTo($return_url);
        }
    }
}