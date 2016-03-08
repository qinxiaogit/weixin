#数据表:管理员用户表—结构信息
DROP TABLE IF  EXISTS `zytm_manageUser`;

CREATE TABLE `zytm_manageUser` (
	`manage_name` varchar(10) NOT NULL  COMMENT 'name',
	`manage_role` int	  NOT NULL  DEFAULT '0' COMMENT '权限',
	`manage_email` varchar(30) NOT NULL COMMENT 'email',
	`manage_passwd` varchar(20) NOT NULL COMMENT '密码',
	`manage_create_date`  int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
	`manage_id`	int(11)    NOT NULL  AUTO_INCREMENT COMMENT '用户ID',
    `manage_update_date`  int(11) NOT NULL DEFAULT '0' COMMENT '上次登录时间', 
     PRIMARY KEY (`manage_id`)  
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='管理员信息表' AUTO_INCREMENT=0 ;


#产品表:公司产品表
DROP TABLE IF EXISTS `zytm_goods`;

CREATE TABLE  `zytm_goods` (
	`goods_prev_id` int(11)  NOT NULL COMMENT '隶属于产品编码', 
	`goods_name` varchar(20) NOT NULL COMMENT '产品名称`',
	`goods_id`   int(11)	 NOT NULL DEFAULT '0' COMMENT  '产品编号',
	`goods_info` varchar(40) NOT NULL COMMENT '产品简介',
	`goods_image_path` varchar(40) NOT NULL COMMENT '产品图片'
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='产品信息表' AUTO_INCREMENT=0 ;

