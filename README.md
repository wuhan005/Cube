![Cube Logo](https://raw.githubusercontent.com/wuhan005/Cube/master/static/img/logo-xx.png)

创造你想要的一切！ Create Everything You Like!

##简介
总有一些小工具、小应用，显得有那么点“高不成低不就”。比如 JSON 格式化，调用 API 获取音乐。


你将他们一个个单独提出来做成一个站点，一个应用难免会显得有点单调。而 Cube 则是将你做的一些小工具作为一个个插件的形式安装进来。你可以选择启动关闭删除它们，快速使用，用完即走，方便管理。

这，就是 Cube 存在的意义。

![Cube 首页](https://user-images.githubusercontent.com/12731778/44003672-2345d0dc-9e89-11e8-9212-d5d9075daf61.png)

![BRS 小工具](https://user-images.githubusercontent.com/12731778/44003655-dc9d1f96-9e88-11e8-903b-c3a826a390b4.png)
<center>（自带的示例小工具——Hello B★RS）</center>

![小工具管理](https://user-images.githubusercontent.com/12731778/44003846-45801830-9e8c-11e8-8ce0-af8b04ff3201.png)
<center>（小工具管理界面）</center>

##启动
Clone from Github
`git clone git@github.com:wuhan005/Love-Bangumi.git`

##TODO
管理登录

上传小工具压缩包并解压

小工具数据库接口

##模块介绍
```
.
├── LICENSE
├── Module 用户插件
│   ├── HelloBRS 内置示例小工具
│   │   └── HelloBRS.php
│   └── Newplugin 有错误的小工具示例
│       └── Newplugin.php
├── README.md
├── core 核心文件
│   ├── Cube.php 程序入口
│   ├── DataBase.php 数据库类
│   ├── File.php 文件类
│   ├── Footer.php 页面底部
│   ├── Functions.php 常用方法
│   ├── ModuleFinder.php 查找/列出小工具
│   ├── ModuleLoader.php 加载处理小工具（核心）
│   ├── ModuleStage.php 展示渲染小工具，会有接口给用户，用户是在这一层开发
│   ├── SlideBar.php 页面小工具侧边栏
│   ├── SliderDisplayer.php 侧边栏相关函数
│   └── module 系统功能，以内置小工具形式存在
│       ├── Account 账户
│       │   └── Account.php
│       ├── Error 错误的小工具模板
│       │   └── Error.php
│       ├── Forbidden 被禁止的小工具模板
│       │   └── Forbidden.php
│       ├── Main Cube 主页
│       │   ├── Main.php
│       │   └── Main_mainpage.php
│       ├── Manager 小工具管理
│       │   ├── Manager.php
│       │   └── Manager_mainpage.php
│       └── Setting Cube 设置
│           └── Setting.php
├── database
│   └── Cube.db 数据库
├── index.php
└── static 静态资源
    ├── css
    ├── img
    ├── js
    └── lib
```
##LICENSE
MIT



