<?php
/**
 * Created by PhpStorm.
 * User: maeda
 * Date: 15/09/05
 * Time: 19:24
 */

/**
 * Class LoginAction
 */
class LoginAction extends Controller
{
    /**
     * コンストラクタ
     * このコントローラはログイン不要です。
     *
     * @see Controller::__construct
     */
    public function __construct($name, $action)
    {
        parent::__construct($name, $action);
        $this->need_login = false;
    }

    /**
     * indexアクション
     * 特になにもしません。
     */
    public function index()
    {
        // do nothing
    }

    /**
     * checkアクション
     * 送信されたメールアドレスとパスワードから、該当ユーザが存在するか調べます。
     * 存在する場合はログイン処理を行い、存在しない場合はログイン画面に戻します。
     */
    public function check()
    {
        $post = $this->getParameter();
        $mail = $post['mail'];
        $pass = $post['pass'];

        $user = UserTable::find(['mail' => $mail, 'pass' => $pass]);
        if (count($user) === 0) {
            $this->redirectTo('/login');
        }

        $this->login($user[0]);
        $this->redirectTo('/');
    }

    /**
     * logoutアクション
     * ログアウト処理を行います。
     */
    public function logout()
    {
        parent::logout();
        $this->redirectTo('/login');
    }
}