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
}