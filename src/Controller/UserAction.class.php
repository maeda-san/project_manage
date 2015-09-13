<?php
/**
 * Created by PhpStorm.
 * User: maeda
 * Date: 15/09/05
 * Time: 15:13
 */

/**
 * Class UserAction
 */
class UserAction extends Controller
{
    /**
     * indexアクション
     * ユーザの一覧を表示します。
     */
    public function index()
    {
        $users = UserTable::findAll();
        $this->users = $users;
    }

    /**
     * registrationアクション
     * ユーザの新規登録フォームを表示します。
     * エラーがある場合はエラーも表示します。
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
     * ユーザを新規登録します。
     */
    public function add()
    {
        $post = $this->getParameter();
        $user = new User($post);
        $res = $user->save();
        if (!$res) {
            $this->setSession('flush', 'error');
            $this->redirectTo('/user/registration');
        }
    }

    /**
     * editアクション
     * ユーザの更新フォームを表示します。
     * エラーがある場合はエラーも表示します。
     */
    public function edit()
    {
        $flush = $this->getSession('flush');
        if (!is_null($flush)) {
            $this->error = $flush;
            $this->setSession('flush', null);
        }
    }

    /**
     * updateアクション
     * ユーザを更新します。
     */
    public function update()
    {
        $post = $this->getParameter();
        $post = array_filter($post, 'strlen');
        $user = new User($post, $this->my_user);
        $res = $user->save();
        if (!$res) {
            $this->setSession('flush', 'error');
            $this->redirectTo('/user/edit');
        }
    }
}