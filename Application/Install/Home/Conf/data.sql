#数据表:管理员用户表—结构信息
DROP TABLE IF  EXISTS `zytm_manage_user`;

CREATE TABLE `zytm_manage_user` (
	`manage_name` varchar(10) NOT NULL  COMMENT 'name',
	`manage_role` int	  NOT NULL  DEFAULT '0' COMMENT '权限',
	`manage_email` varchar(30) NOT NULL COMMENT 'email',
	`manage_passwd` varchar(100) NOT NULL COMMENT '密码',
	`manage_create_date`  int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
	`manage_id`	int(11)    NOT NULL  AUTO_INCREMENT COMMENT '用户ID',
    `manage_update_date`  int(11) NOT NULL DEFAULT '0' COMMENT '上次登录时间', 
     PRIMARY KEY (`manage_id`)  
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='管理员信息表' AUTO_INCREMENT=0 ;


#产品表:公司产品表
DROP TABLE IF EXISTS `zytm_goods`;

CREATE TABLE `zytm_goods` (
	`goods_prev_id` int(11)  NOT NULL COMMENT '隶属于产品编码', 
	`goods_name` varchar(100) NOT NULL COMMENT '产品名称`',
	`goods_id`   int(11)	 NOT NULL AUTO_INCREMENT COMMENT  '产品编号',
	`goods_info` text NOT NULL COMMENT '产品简介',
	`goods_image_name` varchar(40) NOT NULL COMMENT '产品图片',
	PRIMARY KEY(`goods_id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='产品信息表' AUTO_INCREMENT=0 ;

#产品大类表
DROP TABLE IF EXISTS `zytm_goods_meun`;
CREATE TABLE `zytm_product_menu` (
	`goods_name` varchar(100) NOT NULL COMMENT '产品名字',
	`goods_id`   tinyint	  NOT NULL COMMENT '产品编码',
	`goods_mainifo` varchar(100) NOT NULL COMMENT '产品简介',
	PRIMARY KEY(`goods_id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='产品菜单信息表' AUTO_INCREMENT=0 ;






