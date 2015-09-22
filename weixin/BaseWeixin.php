<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin;

use weixin\api\ApiRequestor;
use weixin\base\Application;
use weixin\base\Component;
use weixin\base\Exception;
use weixin\base\Account;
use weixin\responding\Responsor;

/**
 * Class BaseWeixin 微信核心应用
 *
 * @property
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class BaseWeixin extends Application
{
    /**
     * @var bool 是否开启调试模式
     */
    public $debug = false;

    private static $_apps = [];

    /**
     * @var array registered path aliases
     * @see getAlias()
     * @see setAlias()
     */
    public static $aliases = [
        '@weixin' => __DIR__,
    ];

    public function __construct($config = [])
    {
        parent::__construct($config);
        self::$_apps[$this->getGuid()] = $this;
    }

    public function init()
    {
        parent::init();

        if(is_null($this->_runtimePath)){
            $this->getRuntimePath();
        }
    }

    /**
     * 根据GUID获取微信应用实例
     * @param Component $component
     * @return Weixin|null
     * @throws Exception
     */
    public static function app(Component $component)
    {
        if (isset(self::$_apps[$component->getGuid()])) {
            return self::$_apps[$component->getGuid()];
        } else {
            throw new Exception('invalid GUID, only the component from Weixin instance can find its parent APP');
        }
    }

    private $_runtimePath;

    public function getRuntimePath()
    {
        if($this->_runtimePath === null){
            $this->_runtimePath = __DIR__ . DIRECTORY_SEPARATOR . 'runtime';
            self::setAlias('@runtime', $this->_runtimePath);
        }

        return $this->_runtimePath;
    }

    /**
     * Sets the directory that stores runtime files.
     * @param string $path the directory that stores runtime files.
     */
    public function setRuntimePath($path)
    {
        $this->_runtimePath = self::getAlias($path);
        self::setAlias('@runtime', $this->_runtimePath);
    }

    /**
     * 获取APP唯一ID
     * @return mixed
     */
    public function getGuid()
    {
        if (empty($this->_guid)) {
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
        return $this->get('responsor');
    }

    /**
     * @return ApiRequestor 请求器
     * @throws Exception
     */
    public function getApiRequestor()
    {
        return $this->get('apiRequestor');
    }

    /**
     *  返回缓存组件
     * @return \weixin\caching\Cache 缓存组件，如果没配置将返回NULL
     * @throws Exception
     */
    public function getCache()
    {
        return $this->get('cache', false);
    }

    public function coreComponents()
    {
        return array_merge(parent::coreComponents(), [
            'account' => ['class' => 'weixin\base\Account'],
            'responsor' => ['class' => 'weixin\responding\Responsor'],
            'apiRequestor' => ['class' => 'weixin\api\ApiRequestor'],
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

    public function setAliases($aliases)
    {
        foreach ($aliases as $alias => $path) {
            self::setAlias($alias, $path);
        }
    }

    /**
     * Translates a path alias into an actual path.
     *
     * The translation is done according to the following procedure:
     *
     * 1. If the given alias does not start with '@', it is returned back without change;
     * 2. Otherwise, look for the longest registered alias that matches the beginning part
     *    of the given alias. If it exists, replace the matching part of the given alias with
     *    the corresponding registered path.
     * 3. Throw an exception or return false, depending on the `$throwException` parameter.
     *
     * For example, by default '@yii' is registered as the alias to the Yii framework directory,
     * say '/path/to/yii'. The alias '@yii/web' would then be translated into '/path/to/yii/web'.
     *
     * If you have registered two aliases '@foo' and '@foo/bar'. Then translating '@foo/bar/config'
     * would replace the part '@foo/bar' (instead of '@foo') with the corresponding registered path.
     * This is because the longest alias takes precedence.
     *
     * However, if the alias to be translated is '@foo/barbar/config', then '@foo' will be replaced
     * instead of '@foo/bar', because '/' serves as the boundary character.
     *
     * Note, this method does not check if the returned path exists or not.
     *
     * @param string $alias the alias to be translated.
     * @param boolean $throwException whether to throw an exception if the given alias is invalid.
     * If this is false and an invalid alias is given, false will be returned by this method.
     * @return string|boolean the path corresponding to the alias, false if the root alias is not previously registered.
     * @throws Exception if the alias is invalid while $throwException is true.
     * @see setAlias()
     */
    public static function getAlias($alias, $throwException = true)
    {
        if (strncmp($alias, '@', 1)) {
            // not an alias
            return $alias;
        }

        $pos = strpos($alias, '/');
        $root = $pos === false ? $alias : substr($alias, 0, $pos);

        if (isset(static::$aliases[$root])) {
            if (is_string(static::$aliases[$root])) {
                return $pos === false ? static::$aliases[$root] : static::$aliases[$root] . substr($alias, $pos);
            } else {
                foreach (static::$aliases[$root] as $name => $path) {
                    if (strpos($alias . '/', $name . '/') === 0) {
                        return $path . substr($alias, strlen($name));
                    }
                }
            }
        }

        if ($throwException) {
            throw new Exception("Invalid path alias: $alias");
        } else {
            return false;
        }
    }

    /**
     * Registers a path alias.
     *
     * A path alias is a short name representing a long path (a file path, a URL, etc.)
     * For example, we use '@yii' as the alias of the path to the Yii framework directory.
     *
     * A path alias must start with the character '@' so that it can be easily differentiated
     * from non-alias paths.
     *
     * Note that this method does not check if the given path exists or not. All it does is
     * to associate the alias with the path.
     *
     * Any trailing '/' and '\' characters in the given path will be trimmed.
     *
     * @param string $alias the alias name (e.g. "@yii"). It must start with a '@' character.
     * It may contain the forward slash '/' which serves as boundary character when performing
     * alias translation by [[getAlias()]].
     * @param string $path the path corresponding to the alias. If this is null, the alias will
     * be removed. Trailing '/' and '\' characters will be trimmed. This can be
     *
     * - a directory or a file path (e.g. `/tmp`, `/tmp/main.txt`)
     * - a URL (e.g. `http://www.yiiframework.com`)
     * - a path alias (e.g. `@yii/base`). In this case, the path alias will be converted into the
     *   actual path first by calling [[getAlias()]].
     *
     * @throws Exception if $path is an invalid alias.
     * @see getAlias()
     */
    public static function setAlias($alias, $path)
    {
        if (strncmp($alias, '@', 1)) {
            $alias = '@' . $alias;
        }
        $pos = strpos($alias, '/');
        $root = $pos === false ? $alias : substr($alias, 0, $pos);
        if ($path !== null) {
            $path = strncmp($path, '@', 1) ? rtrim($path, '\\/') : static::getAlias($path);
            if (!isset(static::$aliases[$root])) {
                if ($pos === false) {
                    static::$aliases[$root] = $path;
                } else {
                    static::$aliases[$root] = [$alias => $path];
                }
            } elseif (is_string(static::$aliases[$root])) {
                if ($pos === false) {
                    static::$aliases[$root] = $path;
                } else {
                    static::$aliases[$root] = [
                        $alias => $path,
                        $root => static::$aliases[$root],
                    ];
                }
            } else {
                static::$aliases[$root][$alias] = $path;
                krsort(static::$aliases[$root]);
            }
        } elseif (isset(static::$aliases[$root])) {
            if (is_array(static::$aliases[$root])) {
                unset(static::$aliases[$root][$alias]);
            } elseif ($pos === false) {
                unset(static::$aliases[$root]);
            }
        }
    }

}