<?php
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * 所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * 这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */
class Bootstrap extends Yaf\Bootstrap_Abstract{
	
	public function _initLoader() {
        Yaf\Loader::import(APP_PATH . "/vendor/autoload.php");
    }
	
	public function _initConfig() {
		$config = Yaf\Application::app()->getConfig();
		Yaf\Registry::set("config", $config);
	}

	public function _initDefaultName(Yaf\Dispatcher $dispatcher) {
		$dispatcher->setDefaultModule("Index")->setDefaultController("Index")->setDefaultAction("index");
	}
	
	//数据库初始化操作
	public function _initDatabaseEloquent() {
        $config = Yaf\Application::app()->getConfig()->database->toArray();
        $capsule = new Capsule;

        // 创建链接
        $capsule->addConnection($config);

        // 设置全局静态可访问
        $capsule->setAsGlobal();

        // 启动Eloquent
        $capsule->bootEloquent();

    }
}