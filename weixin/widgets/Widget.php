<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\widgets;

use weixin\base\Component;
use weixin\base\Exception;

/**
 * Class Widget 小部件基类
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
abstract class Widget extends Component
{
    abstract function run();

    public static function widget($params = [])
    {
        $className = get_called_class();
        /**
         * @var Widget $widget
         */
        $widget = new $className($params);
        return $widget->run();
    }

    public function render($view, $params = [])
    {
        $viewFile = $this->getViewPath().DIRECTORY_SEPARATOR.$view.'.php';
        if(is_file($viewFile)){
            $params['context'] = $this;
            return $this->renderPhpFile($viewFile, $params);
        }else{
            throw new Exception("the view file {$viewFile} is not exist");
        }
    }

    protected function getViewPath()
    {
        return __DIR__.DIRECTORY_SEPARATOR.'views';
    }

    /**
     * Renders a view file as a PHP script.
     *
     * This method treats the view file as a PHP script and includes the file.
     * It extracts the given parameters and makes them available in the view file.
     * The method captures the output of the included view file and returns it as a string.
     *
     * This method should mainly be called by view renderer or [[renderFile()]].
     *
     * @param string $_file_ the view file.
     * @param array $_params_ the parameters (name-value pairs) that will be extracted and made available in the view file.
     * @return string the rendering result
     */
    protected function renderPhpFile($_file_, $_params_ = [])
    {
        ob_start();
        ob_implicit_flush(false);
        extract($_params_, EXTR_OVERWRITE);
        require($_file_);

        return ob_get_clean();
    }
}