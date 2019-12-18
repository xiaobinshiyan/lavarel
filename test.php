<?php
return array(
	'URL_MODEL'=>'2',
	'DEFAULT_THEME'    =>    'default',
	'LAYOUT_ON'=>true,
	'MODULE_ALLOW_LIST' => array ('Home','Admin'),
	'DEFAULT_MODULE' => 'Home',
);

return array(
	'DB_TYPE'=>'mysql',      //数据库类型
    'DB_HOST'=>'localhost',  //服务器地址
    'DB_NAME'=>'book',       //数据库名
    'DB_USER'=>'root',       //数据库账号
    'DB_PWD'=>'admin',            //数据库密码
    'DB_PORT'=>3306,         //数据库端口
    'DB_PREFIX'=>'',      //数据库表前缀
    'DB_CHARSET'=>'utf8',    //数据库字符编码
    'DB_DEBUG'  =>  TRUE ,  //数据库sql调试日志的开启
    'OUTPUT_CHARSET' =>  'utf-8',
    'MODULE_ALLOW_LIST' => array ('Home','Admin'),
    'DEFAULT_MODULE' => 'Home',
);