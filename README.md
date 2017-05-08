# Slim-Service-Skeleton

基于 Slim 框架的第三方组件服务的扩展方案，提供最简单的微信事件驱动服务。

## 核心特性

----

- 第三方的组件使用 Pimple 提供的容器，依赖注入至Slim 的核心应用中
- 事件操作绑定至具体的类，维护性变强
- 可以加载功能强大的数据库操作 **（Laravel Eloquent ORM）** , 
- 加入当前流行的 Twig 模板引擎
- 遵循 **PSR-7** 标准，完成HTTP请求及响应的操作

---

框架构建简约流程。 

#### 1. 建立Slim 程序的引导文件在 bootstrap 文件夹下  **app.php**

app.php 负责完成composer引导加载所有的依赖库， 初始化Slim\App 容器  **需要注意的是，整个程序仅能定义一个 ``$app`` ** （如果定义其他的同名变量 $app 可能会覆盖）

#### 2. 因为 Slim 的核心类 App 是继承于 Pimple 依赖注入容器的，所以可以轻松完成的其他组件的注入。

比如我们在 app.php 中我们可以定义服务

>定义服务与定义参数没有什么不同。 只需在容器上设置一个数组键即可。但是，当您检索服务时，将执行该闭包。：

例如：


	$app['some_service'] = function () {
    		return new Service();
	};


 
要检索服务，请使用：


	$service = $app['some_service'];
   


首先调用，创建服务; 然后在任何后续访问中返回相同的实例。

#### 工厂服务

如果要为每个服务访问返回不同的实例，可以使用 factory()方法包装服务定义：

	$app['some_service'] = $app->factory(function () {
   		return new Service();
	});

每次调用$app['some_service']时，都会创建一个新的服务实例。


**(持续更新)**

Defining services in Slim Skeleton. There is no different than defining parameters. Just set an array key on the container to be a closure. We can  retrieve the service, the closure is executed and up the service creation:
                           
