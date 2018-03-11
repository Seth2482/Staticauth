## Staticauth
用了一天多，写出了这么个东西：[Github](https://github.com/Seth8277/Staticauth)
[![Staticauth项目界面](https://imseth.cn/./wp-content/uploads/2018/03/深度截图_选择区域_20180311000154.png "Staticauth项目界面")](https://imseth.cn/./wp-content/uploads/2018/03/深度截图_选择区域_20180311000154.png "Staticauth项目界面")
看到左下角那个小图标没有？没错，这是用 **Laravel** 写的，毕竟是全世界最好的PHP框架。
这个程序只实现了操作本地数据库、编译推送到远程仓库的功能，还需要自行开通Pages服务。

### 运行环境
* Apache 2.0+ with rewrite module
* PHP 7.0+
* Git

### 安装
##### 1.克隆源代码
```
git clone https://github.com/Seth8277/Staticauth.git
```
##### 2.设置 Web 根目录
将 public 目录设置成你的 Web 根目录
在这里提供一份 Apache 配置，仅供参考
```
<VirtualHost *:80>
    DocumentRoot "/to/your/public/folder"
    ServerName your.domain.com
    ServerAlias your.domain.com
    ServerAdmin email@your.com
    ErrorLog logs/dev-error.log
    CustomLog logs/dev-access.log common 
    <Directory "/to/your/public/folder">
        Options Indexes FollowSymLinks
        AllowOverride All
        Order Allow,Deny
        Allow from all
        RewriteEngine on
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteRule ^(.*)$ index.php/$1 [QSA,PT,L]
    </Directory>
</VirtualHost>
```
##### 3.安装依赖
```
composer install
```

##### 4. 生成配置文件和密匙
```
cp .env.example .env
php artisan key:generate
```
请用编辑器打开 .env 填写相关信息

##### 5. 执行数据库迁移
如果您使用的是 Laradock 或者其他虚拟容器的话，您需要切换到容器内（能连接到数据库）执行以下命令
```
php artisan migrate
```
至此，安装就已经结束了。

### 使用
首先，请确保你的 PHP 执行环境安装了 Git，生成了SSH公匙并已经添加到了Coding的项目公匙（需要读写权限）

因为编译和推送功能均为异步进行，你需要在程序根目录下执行以下使程序工作
```
php artisan queue:work
```
第一次添加站点克隆项目时可能需要人工确认下。
你还可以执行以下命令来删除过期站点
```
php artisan site:clear
```

### 对接
每个授权过的域名都会生成一个文件，文件名为域名的base64编码，即获取 ``https://xxxxx.com/域名base64编码`` 的内容即可得到域名的授权状态。
php示例:
```
<?php
$base_url = "https://Seth8277.coding.me/Tieba-Cloud-Sign/";
$file = base64_encode('ttttt.com');
$result = @file_get_contents("{$base_url}{$file}");
if ($result) {
  if ($data = json_decode($result)) {
    // 判断授权是否过期
    if (!empty($result->expire_at) && strtotime($result->expire_at) < time()) {
      echo "未授权";
    }else{
      echo "已授权";
    }
  }
}else{
  echo "未授权";
}

```

### 注意
1. 请确保正确配置了Git后再使用程序。如果**在 PHP 执行环境下**可以免密克隆和推送仓库就说明配置好了。
2. 这个程序**没有账户系统，只能在本地运行**。如果你非要在远程运行，请自行承担后果。
3. **务必要使用HTTPS加密协议，不能使用HTTP协议**

## License
本程序遵循 ``GPL v3`` 协议免费开源，禁止任何形式的商业售卖，不得将基于本程序二次开发的程序闭源或进行售卖。下载使用本程序即默认同意该协议。