<?php
/**
 * Created by PhpStorm.
 * User: maeda
 * Date: 15/09/05
 * Time: 14:05
 */

/**
 * Class UrlParser
 * URL解析クラス
 */
class UrlParser
{
    /**
     * @var string コントローラ名
     */
    private $controller;
    /**
     * @var string アクション名
     */
    private $action;
    /**
     * @var string ターゲット名
     */
    private $target;

    /**
     * URLを解析して各プロパティを設定します。
     * URLパターンは以下です。
     * http://{domain}/{controller}/{action}/{target}
     *
     * たとえば
     * http://localhost/user/show/1
     * なら、
     * Userコントローラのshowアクションでパラメータが1
     * みたいな感じです。
     *
     * デフォルトはコントローラがMain, アクションがindex, ターゲットがnullになります。
     */
    public function __construct()
    {
        $uri = $_SERVER['REQUEST_URI'];

        $pattern = '#^/(?<controller>.*)/(?<action>.*)/(?<target>.*)$#';
        $match = preg_match($pattern, $uri, $values);
        if ($match) {
            $this->controller = $values['controller'];
            $this->action = $values['action'];
            $this->target = $values['target'];
        } else {
            $pattern = '#^/(?<controller>.*)/(?<action>.*)$#';
            $match = preg_match($pattern, $uri, $values);
            if ($match) {
                $this->controller = $values['controller'];
                $this->action = $values['action'];
            } else {
                $this->controller = explode('/', $uri)[1];
            }
        }
        if ($this->controller === '') {
            $this->controller = 'main';
        }
        if ($this->action === '' || is_null($this->action)) {
            $this->action = 'index';
        }
        if ($this->target === '') {
            $this->target = null;
        }
        $this->controller = ucfirst($this->controller);
    }

    /**
     * このクラスはプロパティの取得を許可します。
     *
     * @param string $name パラメータ名
     *
     * @return mixed
     */
    public function __get($name)
    {
        return $this->$name;
    }
}