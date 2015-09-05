<?php
/**
 * Created by PhpStorm.
 * User: maeda
 * Date: 15/09/05
 * Time: 15:04
 */

/**
 * Class Controller
 *
 * フロントコントローラ以外のコントローラが継承するスーパークラスです
 */
class Controller
{
    /**
     * @var string 実行されるアクション
     */
    protected $action;
    /**
     * @var string 表示されるビューのパス
     */
    protected $view;
    /**
     * @var string このインスタンスのコントローラ名
     */
    protected $name;
    /**
     * @var bool ログインが必要か否か
     */
    protected $need_login;

    /**
     * コンストラクタ
     * プロパティの設定を行います
     *
     * @param string $name   コントローラ名
     * @param string $action アクション名
     */
    public function __construct($name, $action)
    {
        $this->name = $name;
        $this->action = $action;
        $this->setView($name, $action);
        $this->need_login = true;
    }

    /**
     * コントローラを実行します
     */
    public function run()
    {
        session_start();

        // login check
        if ($this->need_login && !$this->isLogin()) {
            $this->redirectTo('/login');
        }

        $action = $this->action;
        $this->$action();
        $this->render();
    }

    /**
     * ビューを設定します
     *
     * @param string $controller コントローラ名
     * @param string $action     アクション名
     */
    protected function setView($controller, $action)
    {
        $dir = __DIR__ . '/../View/';
        $this->view = $dir . $controller . '/' . $action . '.php';
    }

    /**
     * 設定されているビューを描写します
     */
    public function render()
    {
        ob_start();
        ob_implicit_flush(0);
        require $this->view;
        $content = ob_get_clean();
        ob_end_clean();
        echo $content;
    }

    /**
     * セッションに値を設定します
     *
     * @param string $key   セッションキー
     * @param string $value セッション値
     */
    protected function setSession($key, $value)
    {
        $_SESSION['free'][$key] = $value;
    }

    /**
     * セッションから値を取得します。
     * セッションが存在しない場合はnullを返します
     *
     * @param string $key セッションキー
     *
     * @return string|null
     */
    protected function getSession($key)
    {
        if (!isset($_SESSION['free'][$key])) {
            return null;
        }

        return $_SESSION['free'][$key];
    }

    /**
     * POSTまたはGET値を取得します
     *
     * @return mixed
     */
    protected function getParameter()
    {
        return $_REQUEST;
    }

    /**
     * 他ページへリダイレクトします
     *
     * @param string $url リダイレクト先URL
     */
    protected function redirectTo($url)
    {
        header('Location: ' . $url);
        exit;
    }

    /**
     * ログイン処理を行います
     */
    protected function login()
    {
        $_SESSION['login'] = '1';
    }

    /**
     * ログアウト処理を行います
     */
    protected function logout()
    {
        $_SESSION['login'] = null;
    }

    /**
     * ログイン状態を調べます
     *
     * @return bool ログイン状態
     */
    protected function isLogin()
    {
        if (isset($_SESSION['login']) && !is_null($_SESSION['login'])) {
            return true;
        }

        return false;
    }
}