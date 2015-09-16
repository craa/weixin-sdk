<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\base;

use weixin\responding\Responsor;

/**
 * Class Weixin 微信核心应用
 *
 * @property
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class Weixin extends Application
{
    /**
     * @var bool 是否开启调试模式
     */
    public $debug = false;

    private static $_apps = [];

    public function __construct($config = [])
    {
        parent::__construct($config);
        self::$_apps[$this->getGuid()] = $this;
    }

    /**
     * 根据GUID获取微信应用实例
     * @param Component $component
     * @return Weixin|null
     * @throws Exception
     */
    public static function app(Component $component)
    {
        if(isset(self::$_apps[$component->getGuid()])){
            return self::$_apps[$component->getGuid()];
        }else{
            throw new Exception('invalid GUID, only the component from Weixin instance can find its parent APP');
        }
    }

    /**
     * 获取APP唯一ID
     * @return mixed
     */
    public function getGuid()
    {
        if(empty($this->_guid)){
            $this->setGuid(mt_rand(100000, 999999));
        }

        return $this->_guid;
    }

    /**
     * @return bool 判断调试模式是否开启
     */
    public function isDebug()
    {
        return $this->debug;
    }

    /**
     * @return Account 微信公众账号组件
     */
    public function getAccount()
    {
        return $this->get('account');
    }

    /**
     * @return Responsor 响应器
     */
    public function getResponsor()
    {
        $responsor = $this->get('responsor');
        return $responsor;
    }

    public function coreComponents()
    {
        return array_merge(parent::coreComponents(), [
            'account' => ['class' => 'weixin\base\Account'],
            'responsor' => ['class' => 'weixin\responding\Responsor'],
        ]);
    }

    /**
     * Configures an object with the initial property values.
     * @param object $object the object to be configured
     * @param array $properties the property initial values given in terms of name-value pairs.
     * @return object the object itself
     */
    public static function configure($object, $properties)
    {
        foreach ($properties as $name => $value) {
            $object->$name = $value;
        }

        return $object;
    }

    /**
     * Creates a new object using the given configuration.
     *
     * You may view this method as an enhanced version of the `new` operator.
     * The method supports creating an object based on a class name, a configuration array or
     * an anonymous function.
     *
     * Below are some usage examples:
     *
     * ```php
     * // create an object using a class name
     * $object = Yii::createObject('yii\db\Connection');
     *
     * // create an object using a configuration array
     * $object = Yii::createObject([
     *     'class' => 'yii\db\Connection',
     *     'dsn' => 'mysql:host=127.0.0.1;dbname=demo',
     *     'username' => 'root',
     *     'password' => '',
     *     'charset' => 'utf8',
     * ]);
     *
     * // create an object with two constructor parameters
     * $object = \Yii::createObject('MyClass', [$param1, $param2]);
     * ```
     *
     * Using [[\yii\di\Container|dependency injection container]], this method can also identify
     * dependent objects, instantiate them and inject them into the newly created object.
     *
     * @param string|array|callable $type the object type. This can be specified in one of the following forms:
     *
     * - a string: representing the class name of the object to be created
     * - a configuration array: the array must contain a `class` element which is treated as the object class,
     *   and the rest of the name-value pairs will be used to initialize the corresponding object properties
     * - a PHP callable: either an anonymous function or an array representing a class method (`[$class or $object, $method]`).
     *   The callable should return a new instance of the object being created.
     *
     * @param array $params the constructor parameters
     * @return object the created object
     * @throws Exception if the configuration is invalid.
     * @see \yii\di\Container
     */
    public static function createObject($type, array $params = [])
    {
        if (is_array($type) && isset($type['class'])) {
            $class = $type['class'];
            unset($type['class']);
            if (class_exists($class)) {
                array_merge($type, $params);
                return new $class($type);
            } else {
                throw new Exception('class ' . $class . ' does not exist');
            }
        } elseif (is_array($type)) {
            throw new Exception('Object configuration must be an array containing a "class" element.');
        } else {
            throw new Exception("Unsupported configuration type: " . gettype($type));
        }
    }

}