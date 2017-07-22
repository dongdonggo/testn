# fuyuan
> 包含前后台登录认证以及权限管理的后台系统，模板为`color admin`

![image1](http://7xuntv.com1.z0.glb.clouddn.com/zhanghaobao1.png)

![image2](http://7xuntv.com1.z0.glb.clouddn.com/zhanghaobao2.png)

![image3](http://7xuntv.com1.z0.glb.clouddn.com/zhanghaobao3.png)

## 安装依赖关系
```shell
composer install
```
## 复制配置文件
```shell
cp .env.example .env
```

## 创建新的应用程序密钥
```shell
php artisan key:generate
```
## 设置数据库
编辑`.env`文件
```shell
CACHE_DRIVER=array

DB_HOST=YOUR_DATABASE_HOST
DB_DATABASE=YOUR_DATABASE_NAME
DB_USERNAME=YOUR_DATABASE_USERNAME
DB_PASSWORD=YOUR_DATABASE_PASSWORD
```
## 添加自动加载
```shell
composer dump-autoload
```

## 运行数据库迁移
```shell
php artisan migrate
```

## 运行数据填充
```shell
php artisan db:seed
```

## nginx rewrite配置
```shell
location / {
    index  index.html index.htm index.php;
    if (!-e $request_filename){
         rewrite ^/(.*)$ /index.php/$1 last;
    }
}
```
## 访问
[http://xxx.com/admin](http://xxx.com/admin)

后台账号:`admin@admin.com`

后台密码:`admin`
