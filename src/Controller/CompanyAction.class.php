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
    public function index()
    {
        $companies = CompanyTable::findAll();
        var_dump($companies);
        $this->companies = $companies;
    }

    public function registration()
    {
        $flush = $this->getSession('flush');
        if (!is_null($flush)) {
            $this->error = $flush;
            $this->setSession('flush', null);
        }
    }

    public function add()
    {
        $post       = $this->getParameter();
        $company    = new Company($post);
        $res        = $company->save();
        if (!$res) {
            $this->setSession('flush', 'error');
            $this->redirectTo('/company/registration');
        }
    }
}