/**
 * 网站设置
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Conf`;
CREATE TABLE `#DB_PREFIX#Conf`
(
    `id`          INT(11)      NOT NULL AUTO_INCREMENT,
    `lang_key`    VARCHAR(85)  NULL COMMENT '配置语言',
    `name`        VARCHAR(85)  NOT NULL COMMENT '网站名称',
    `title`       VARCHAR(135) NOT NULL COMMENT '网站标题',
    `email`       VARCHAR(135) NOT NULL COMMENT '网站联系邮箱',
    `phone`       VARCHAR(135) NOT NULL COMMENT '网站联系电话',
    `keywords`    VARCHAR(135) NOT NULL COMMENT '网站关键词',
    `site_url`    VARCHAR(135) NOT NULL COMMENT '网站URL地址',
    `developers`  VARCHAR(135) NOT NULL COMMENT '开发者',
    `icp`         VARCHAR(135) NOT NULL COMMENT '备案号',
    `description` TEXT         NULL COMMENT '网站描述',
    `copyright`   VARCHAR(135) NOT NULL COMMENT '版权所有',
    `created_at`  integer      NOT NULL DEFAULT 0,
    `updated_at`  integer      NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    UNIQUE KEY `lang_key` (`lang_key`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

/**
 * 网站辅助设置
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Assist`;
CREATE TABLE `#DB_PREFIX#Assist`
(
    `id`          INT(11)                         NOT NULL AUTO_INCREMENT,
    `assist_key`  VARCHAR(85)                     NOT NULL COMMENT '网站设置关键KEY',
    `name`        VARCHAR(85)                     NOT NULL COMMENT '字段名',
    `content`     VARCHAR(500)                    NOT NULL COMMENT '字段值',
    `description` TEXT                            NULL COMMENT '网站配置描述',
    `is_type`     SET ('system', 'image', 'file') NOT NULL COMMENT '网站配置类型',
    `is_using`    SET ('On', 'Off')               NOT NULL COMMENT '是否启用',
    `created_at`  integer                         NOT NULL DEFAULT 0,
    `updated_at`  integer                         NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    UNIQUE KEY `assist_key` (`assist_key`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

/**
 * 语言类别
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Language`;
CREATE TABLE `#DB_PREFIX#Language`
(
    `id`         INT(11)           NOT NULL AUTO_INCREMENT,
    `lang_key`   VARCHAR(85)       NOT NULL COMMENT '网站设置关键KEY',
    `name`       VARCHAR(85)       NOT NULL COMMENT '字段名',
    `content`    VARCHAR(150)      NOT NULL COMMENT '国家缩写',
    `is_using`   SET ('On', 'Off') NOT NULL COMMENT '是否启用',
    `is_default` SET ('On', 'Off') NOT NULL COMMENT '是否设定为默认',
    `created_at` integer           NOT NULL DEFAULT 0,
    `updated_at` integer           NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    UNIQUE KEY `lang_key` (`lang_key`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

/**
 * 广告
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Adv`;
CREATE TABLE `#DB_PREFIX#Adv`
(
    `id`         INT(11)           NOT NULL AUTO_INCREMENT,
    `sort_id`    INT(11) UNSIGNED  NOT NULL COMMENT '排序ID',
    `weight`     INT(6) UNSIGNED   NOT NULL COMMENT '权重',
    `size`       VARCHAR(55)       NOT NULL COMMENT '广告形状大小',
    `urls`       VARCHAR(125)      NOT NULL COMMENT '链接地址',
    `is_audit`   SET ('On', 'Off') NOT NULL COMMENT '审核',
    `start_time` INT(11) UNSIGNED  NOT NULL COMMENT '开始时间',
    `end_time`   INT(11) UNSIGNED  NOT NULL COMMENT '结束时间',
    `created_at` integer           NOT NULL DEFAULT 0,
    `updated_at` integer           NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

/**
 * 友情链接
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Friend_Link`;
CREATE TABLE `#DB_PREFIX#Friend_Link`
(
    `id`         INT(11)           NOT NULL AUTO_INCREMENT,
    `title`      VARCHAR(85)       NULL COMMENT '标题',
    `content`    VARCHAR(255)      NULL COMMENT '介绍',
    `author`     VARCHAR(55)       NULL COMMENT '联系人',
    `img`        VARCHAR(125)      NULL COMMENT '图片地址',
    `url`        VARCHAR(125)      NULL COMMENT '链接地址',
    `is_status`  SET ('On', 'Off') NOT NULL DEFAULT 'Off' COMMENT '友情链接状态',
    `is_audit`   SET ('On', 'Off') NOT NULL COMMENT '审核',
    `created_at` integer           NOT NULL DEFAULT 0,
    `updated_at` integer           NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    UNIQUE `title` (`title`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

/**
 * 网站公告
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Announce`;
CREATE TABLE `#DB_PREFIX#Announce`
(
    `id`         INT(11)           NOT NULL AUTO_INCREMENT,
    `user_id`    VARCHAR(85)       NOT NULL COMMENT '用户ID',
    `title`      VARCHAR(125)      NOT NULL COMMENT '标题',
    `content`    TEXT              NOT NULL COMMENT '内容',
    `is_audit`   SET ('On', 'Off') NOT NULL COMMENT '审核',
    `created_at` integer           NOT NULL DEFAULT 0,
    `updated_at` integer           NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    KEY `user_id` (`user_id`),
    UNIQUE `title` (`title`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

/**
 * 管理员(包括审核,后台管理)
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Management`;
CREATE TABLE `#DB_PREFIX#Management`
(
    `id`              INT(11)           NOT NULL AUTO_INCREMENT,
    `username`        VARCHAR(85)       NOT NULL COMMENT '账号',
    `password`        VARCHAR(255)      NOT NULL COMMENT '密码',
    `area`            VARCHAR(125)      NULL COMMENT '地区',
    `login_time`      INT(11) UNSIGNED  NOT NULL COMMENT '登陆时间',
    `last_login_time` INT(11) UNSIGNED  NOT NULL COMMENT '最后登陆时间',
    `login_ip`        VARCHAR(55) COMMENT '登陆IP',
    `token`           INT(11) UNSIGNED  NOT NULL COMMENT '权限ID',
    `is_using`        SET ('On', 'Off') NOT NULL COMMENT '是否启用',
    `created_at`      integer           NOT NULL DEFAULT 0,
    `updated_at`      integer           NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    UNIQUE KEY `username` (`username`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

/**
 * + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + -
 * 用户
 * + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + -
 */

/**
 * 用户信息
 */
DROP TABLE IF EXISTS `#DB_PREFIX#User`;
CREATE TABLE `#DB_PREFIX#User`
(
    `id`              INT(11)                  NOT NULL AUTO_INCREMENT,
    `user_id`         VARCHAR(85)              NOT NULL COMMENT '用户编号ID',
    `openid`          VARCHAR(85)              NOT NULL COMMENT '微信生成的用户Id',
    `username`        VARCHAR(85)              NOT NULL COMMENT '邮箱 / 用户名',
    `password`        VARCHAR(255)             NOT NULL COMMENT '密码',
    `r_key`           VARCHAR(85)              NOT NULL COMMENT '角色关键KEY',
    `credit`          INT(11) UNSIGNED         NULL     DEFAULT 0 COMMENT '积分',
    `nickname`        VARCHAR(85)              NULL     DEFAULT NULL COMMENT '昵称',
    `signature`       TEXT                     NULL     DEFAULT NULL COMMENT '个性签名',
    `address`         VARCHAR(125)             NULL     DEFAULT NULL COMMENT '通讯地址',
    `tel_phone`       VARCHAR(55)              NULL     DEFAULT NULL COMMENT '手机号码',
    `birthday`        VARCHAR(125)             NULL     DEFAULT 0 COMMENT '出生年月日',
    `answer`          VARCHAR(125)             NULL     DEFAULT NULL COMMENT '用户答案',
    `problems_key`    VARCHAR(55)              NULL COMMENT '用户问题',
    `reg_time`        INT(11) UNSIGNED         NOT NULL COMMENT '注册时间',
    `last_login_time` INT(11) UNSIGNED         NOT NULL COMMENT '最后登陆时间',
    `login_ip`        VARCHAR(55)              NULL     DEFAULT 0 COMMENT '登陆IP',
    `sex`             SET ('Male', 'Female')   NOT NULL DEFAULT 'Female' COMMENT '性别',
    `is_display`      SET ('On', 'Off')        NOT NULL DEFAULT 'Off' COMMENT '显示信息',
    `is_head`         SET ('On', 'Off')        NOT NULL DEFAULT 'Off' COMMENT '上传头像',
    `is_security`     SET ('On', 'Off')        NOT NULL DEFAULT 'Off' COMMENT '安全设置',
    `is_using`        SET ('On', 'Off', 'Not') NOT NULL DEFAULT 'Off' COMMENT '是否可用',
    PRIMARY KEY (`id`),
    KEY `r_key` (`r_key`),
    UNIQUE KEY `user_id` (`user_id`),
    UNIQUE KEY `username` (`username`),
    UNIQUE `nickname` (`nickname`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

/**
 * 用户设置
 */
DROP TABLE IF EXISTS `#DB_PREFIX#User_Config`;
CREATE TABLE `#DB_PREFIX#User_Config`
(
    `id`              INT(11)           NOT NULL AUTO_INCREMENT,
    `user_id`         VARCHAR(85)       NOT NULL COMMENT '用户ID',
    `get_praise`      SET ('On', 'Off') NOT NULL COMMENT '接收 / 赞提醒',
    `get_comment`     SET ('On', 'Off') NOT NULL COMMENT '接收 / 评论提醒',
    `is_access`       SET ('On', 'Off') NOT NULL COMMENT '是否开启访问',
    `is_show_phone`   SET ('On', 'Off') NOT NULL COMMENT '是否开启显示手机',
    `is_show_sex`     SET ('On', 'Off') NOT NULL COMMENT '是否开启显示性别',
    `is_show_address` SET ('On', 'Off') NOT NULL COMMENT '是否开启显示通讯地址',
    `created_at`      integer           NOT NULL DEFAULT 0,
    `updated_at`      integer           NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    UNIQUE KEY `user_id` (`user_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

/**
 * 用户等级
 */
DROP TABLE IF EXISTS `#DB_PREFIX#User_Level`;
CREATE TABLE `#DB_PREFIX#User_Level`
(
    `id`         INT(11)           NOT NULL AUTO_INCREMENT,
    `l_key`      VARCHAR(55)       NOT NULL COMMENT '等级关键KEY',
    `name`       VARCHAR(85)       NOT NULL COMMENT '用户等级',
    `is_using`   SET ('On', 'Off') NOT NULL COMMENT '是否开启',
    `created_at` integer           NOT NULL DEFAULT 0,
    `updated_at` integer           NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    UNIQUE KEY `l_key` (`l_key`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

/**
 * 用户安全问题
 */
DROP TABLE IF EXISTS `#DB_PREFIX#User_Problems`;
CREATE TABLE `#DB_PREFIX#User_Problems`
(
    `id`           INT(11)           NOT NULL AUTO_INCREMENT,
    `security_key` VARCHAR(20)       NOT NULL COMMENT '安全问题KEY',
    `name`         VARCHAR(55)       NOT NULL COMMENT '问题',
    `is_using`     SET ('On', 'Off') NULL     DEFAULT 'On' COMMENT '是否启用',
    `created_at`   integer           NOT NULL DEFAULT 0,
    `updated_at`   integer           NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    UNIQUE KEY `security_key` (`security_key`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

/**
 * + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + -
 * 菜单
 * + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + -
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Menu`;
CREATE TABLE `#DB_PREFIX#Menu`
(
    `id`          INT(11)           NOT NULL AUTO_INCREMENT,
    `m_key`       VARCHAR(85)       NOT NULL COMMENT '菜单值',
    `sort_id`     INT(11) UNSIGNED  NOT NULL COMMENT '排序ID',
    `menu_model`  VARCHAR(85)       NULL COMMENT '菜单模型的关键KEY',
    `menu_data`   VARCHAR(155)      NULL COMMENT '菜单数据',
    `r_key`       VARCHAR(85)       NULL COMMENT '角色关键KEY',
    `description` TEXT              NULL COMMENT '描述',
    `parent_id`   VARCHAR(85)       NOT NULL COMMENT '父类值',
    `name`        VARCHAR(85)       NOT NULL COMMENT '菜单名称',
    `json_data`   VARCHAR(155)      NULL COMMENT 'Json 数据',
    `is_language` VARCHAR(55)       NOT NULL COMMENT '语言类别',
    `is_url`      SET ('On', 'Off') NOT NULL COMMENT '是否启用链接(不启用的话,此分类没有链接,只会获取权限)',
    `is_using`    SET ('On', 'Off') NOT NULL COMMENT '是否启用',
    `created_at`  integer           NOT NULL DEFAULT 0,
    `updated_at`  integer           NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    UNIQUE KEY `m_key` (`m_key`),
    KEY `r_key` (`r_key`),
    KEY `name` (`name`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8 COMMENT ='菜单表';

/**
 * 菜单模型
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Menu_Model`;
CREATE TABLE `#DB_PREFIX#Menu_Model`
(
    `id`          INT(11)           NOT NULL AUTO_INCREMENT,
    `model_key`   VARCHAR(55)       NOT NULL COMMENT '菜单模型',
    `sort_id`     INT(11) UNSIGNED  NOT NULL COMMENT '排序ID',
    `menu_type`   VARCHAR(85)       NULL COMMENT 'Url 类型',
    `menu_key`    VARCHAR(85)       NULL COMMENT 'Url 模型关键KEY',
    `name`        VARCHAR(85)       NOT NULL COMMENT '模型名称',
    `is_using`    SET ('On', 'Off') NOT NULL COMMENT '是否启用',
    `is_classify` SET ('On', 'Off') NOT NULL COMMENT '是否启用,启用后分类后,就自动选择指定模型进行分类',
    `created_at`  integer           NOT NULL DEFAULT 0,
    `updated_at`  integer           NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    UNIQUE KEY `model_key` (`model_key`),
    UNIQUE KEY `menu_key` (`menu_key`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8 COMMENT ='菜单模型表';

/**
 * + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + -
 * 文章
 * + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + -
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Article`;
CREATE TABLE `#DB_PREFIX#Article`
(
    `id`           INT(11)                         NOT NULL AUTO_INCREMENT,
    `article_id`   VARCHAR(85)                     NOT NULL COMMENT '文章关键KEY',
    `user_id`      VARCHAR(55)                     NOT NULL COMMENT '用户ID',
    `c_key`        VARCHAR(55)                     NOT NULL COMMENT '分类ID',
    `title`        VARCHAR(125)                    NOT NULL COMMENT '标题',
    `content`      TEXT                            NOT NULL COMMENT '内容',
    `introduction` VARCHAR(255)                    NULL COMMENT '导读',
    `keywords`     VARCHAR(255)                    NULL COMMENT '关键字',
    `path`         VARCHAR(255)                    NULL COMMENT '路径',
    `thumb`        VARCHAR(255)                    NULL COMMENT '文章缩略图',
    `images`       VARCHAR(4000)                   NULL COMMENT '文章图片',
    `praise`       INT(11) UNSIGNED                NULL     DEFAULT 0 COMMENT '赞',
    `forward`      INT(11) UNSIGNED                NULL     DEFAULT 0 COMMENT '转发',
    `collection`   INT(11) UNSIGNED                NULL     DEFAULT 0 COMMENT '收藏',
    `share`        INT(11) UNSIGNED                NULL     DEFAULT 0 COMMENT '分享',
    `attention`    INT(11) UNSIGNED                NULL     DEFAULT 0 COMMENT '关注',
    `is_language`  VARCHAR(55)                     NOT NULL COMMENT '语言类别',
    `is_promote`   SET ('On', 'Off')               NOT NULL COMMENT '推广',
    `is_hot`       SET ('On', 'Off')               NOT NULL COMMENT '热门',
    `is_classic`   SET ('On', 'Off')               NOT NULL COMMENT '经典',
    `is_winnow`    SET ('On', 'Off')               NOT NULL COMMENT '精选',
    `is_recommend` SET ('On', 'Off')               NOT NULL COMMENT '推荐',
    `is_comments`  SET ('On', 'Off')               NOT NULL COMMENT '评论',
    `is_using`     SET ('On', 'Off', 'Out', 'Not') NOT NULL COMMENT '审核',
    `created_at`   integer                         NOT NULL DEFAULT 0,
    `updated_at`   integer                         NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    UNIQUE KEY (`article_id`),
    UNIQUE `title` (`title`),
    KEY `user_id` (`user_id`),
    KEY `c_key` (`c_key`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

/**
 * 文章分类
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Article_Cls`;
CREATE TABLE `#DB_PREFIX#Article_Cls`
(
    `id`          INT(11)           NOT NULL AUTO_INCREMENT,
    `c_key`       VARCHAR(85)       NOT NULL COMMENT '分类KEY',
    `sort_id`     INT(11) UNSIGNED  NOT NULL COMMENT '排序',
    `name`        VARCHAR(125)      NOT NULL COMMENT '名称',
    `description` TEXT              NULL COMMENT '描述',
    `keywords`    VARCHAR(125)      NULL COMMENT '关键字',
    `parent_id`   VARCHAR(85)       NOT NULL COMMENT '父类ID',
    `is_using`    SET ('On', 'Off') NOT NULL COMMENT '是否启用',
    `created_at`  integer           NOT NULL DEFAULT 0,
    `updated_at`  integer           NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    UNIQUE KEY `c_key` (`c_key`),
    UNIQUE `name` (`name`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

/**
 * + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + -
 * 分销机制
 * + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + -
 */

/**
 * 用户
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Dis_Sale_User`;
CREATE TABLE `#DB_PREFIX#Dis_Sale_User`
(
    `id`             INT(11)           NOT NULL AUTO_INCREMENT,
    `user_id`        VARCHAR(85)       NOT NULL COMMENT '用户 Id',
    `wx_user_id`     VARCHAR(85)       NOT NULL COMMENT '微信 Id',
    `parent_user_id` VARCHAR(85)       NOT NULL COMMENT '上一级 用户 Id',
    `is_using`       SET ('On', 'Off') NOT NULL COMMENT '是否启用',
    `created_at`     integer           NOT NULL DEFAULT 0,
    `updated_at`     integer           NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    KEY `user_id` (`user_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

/**
 * 分销设置
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Dis_Sale_Conf`;
CREATE TABLE `#DB_PREFIX#Dis_Sale_Conf`
(
    `id`               INT(11)           NOT NULL AUTO_INCREMENT,
    `user_id`          VARCHAR(85)       NOT NULL COMMENT '用户 Id',
    `name`             VARCHAR(125)      NOT NULL COMMENT '方案名称',
    `commission_one`   FLOAT             NOT NULL COMMENT '一级佣金',
    `commission_two`   FLOAT             NOT NULL COMMENT '二级佣金',
    `commission_three` FLOAT             NOT NULL COMMENT '三级佣金',
    `commission_me`    FLOAT             NOT NULL COMMENT '自我分佣的佣金比例',
    `is_commission_me` SET ('On', 'Off') NOT NULL COMMENT '自我分佣,开启后，已成为金牌用户的客户，自己购买商品也可以分到佣金，比例总和要小于或者等于1',
    `is_using`         SET ('On', 'Off') NOT NULL COMMENT '是否启用',
    `created_at`       integer           NOT NULL DEFAULT 0,
    `updated_at`       integer           NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    KEY `user_id` (`user_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

/**
 * + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + -
 * 小程序及公众号开发
 * + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + -
 */

/**
 * 公众号设置
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Mp_Conf`;
CREATE TABLE `#DB_PREFIX#Mp_Conf`
(
    `id`         INT(11)           NOT NULL AUTO_INCREMENT,
    `conf_id`    VARCHAR(85)       NOT NULL COMMENT '设置关键 Key',
    `name`       VARCHAR(85)       NOT NULL COMMENT '配置名称',
    `app_id`     VARCHAR(85)       NOT NULL COMMENT '公众号 appid',
    `app_secret` VARCHAR(125)      NOT NULL COMMENT '公众号 app_secret',
    `is_using`   SET ('On', 'Off') NOT NULL COMMENT '是否启用',
    `is_working` SET ('On', 'Off') NOT NULL COMMENT '是否使用该公众号为工作项',
    `created_at` integer           NOT NULL DEFAULT 0,
    `updated_at` integer           NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    UNIQUE `name` (`name`),
    UNIQUE KEY `conf_id` (`conf_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

/**
 * 小程序支付设置
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Mini_Program_Conf`;
CREATE TABLE `#DB_PREFIX#Mini_Program_Conf`
(
    `id`         INT(11)           NOT NULL AUTO_INCREMENT,
    `conf_id`    VARCHAR(85)       NOT NULL COMMENT '设置关键 Key',
    `name`       VARCHAR(85)       NOT NULL COMMENT '配置名称',
    `app_id`     VARCHAR(85)       NOT NULL COMMENT '小程序 Id',
    `mch_id`     VARCHAR(85)       NOT NULL COMMENT '商户号 Id',
    `api_psw`    VARCHAR(85)       NOT NULL COMMENT 'API密钥',
    `cert_path`  VARCHAR(300)      NOT NULL COMMENT '证书路径, apiclient_cert.pem',
    `key_path`   VARCHAR(300)      NOT NULL COMMENT '证书路径, apiclient_key.pem',
    `cert_psw`   VARCHAR(85)       NOT NULL COMMENT '证书密码',
    `is_using`   SET ('On', 'Off') NOT NULL COMMENT '是否启用',
    `is_working` SET ('On', 'Off') NOT NULL COMMENT '是否使用该小程序为工作项',
    `created_at` integer           NOT NULL DEFAULT 0,
    `updated_at` integer           NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    UNIQUE `name` (`name`),
    UNIQUE KEY `conf_id` (`conf_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

/**
 * 公众号和小程序关联
 */
DROP TABLE IF EXISTS `#DB_PREFIX#MiniPro_Mp_Related`;
CREATE TABLE `#DB_PREFIX#MiniPro_Mp_Related`
(
    `id`               INT(11)           NOT NULL AUTO_INCREMENT,
    `name`             VARCHAR(85)       NOT NULL COMMENT '关联名称',
    `mini_pro_conf_id` VARCHAR(85)       NOT NULL COMMENT '小程序配置关键 KEY',
    `mp_conf_id`       VARCHAR(85)       NOT NULL COMMENT '公众号配置关键 KEY',
    `is_using`         SET ('On', 'Off') NOT NULL COMMENT '是否启用',
    `created_at`       integer           NOT NULL DEFAULT 0,
    `updated_at`       integer           NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    UNIQUE `name` (`name`),
    UNIQUE KEY `mini_pro_conf_id` (`mini_pro_conf_id`),
    UNIQUE KEY `mp_conf_id` (`mp_conf_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

/**
 * + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + -
 * 招聘管理
 * + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + - + -
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Job`;
CREATE TABLE `#DB_PREFIX#Job`
(
    `id`          INT(11)                         NOT NULL AUTO_INCREMENT,
    `job_id`      VARCHAR(85)                     NOT NULL COMMENT '招聘编号,唯一识别码',
    `user_id`     VARCHAR(55)                     NOT NULL COMMENT '发布用户ID',
    `title`       VARCHAR(125)                    NOT NULL COMMENT '标题',
    `content`     TEXT                            NOT NULL COMMENT '内容',
    `keywords`    VARCHAR(120)                    NULL COMMENT '关键字',
    `images`      VARCHAR(255)                    NULL COMMENT '招聘图片',
    `is_language` VARCHAR(55)                     NOT NULL COMMENT '语言类别',
    `is_using`    SET ('On', 'Off', 'Out', 'Not') NOT NULL COMMENT '审核',
    `created_at`  integer                         NOT NULL DEFAULT '0',
    `updated_at`  integer                         NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `job_id` (`job_id`),
    UNIQUE `title` (`title`),
    KEY `user_id` (`user_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

/**
 * 用户应聘
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Job_Apply_For`;
CREATE TABLE `#DB_PREFIX#Job_Apply_For`
(
    `id`         INT(11)           NOT NULL AUTO_INCREMENT,
    `user_id`    VARCHAR(85)       NOT NULL COMMENT '用户ID',
    `job_id`     VARCHAR(85)       NOT NULL COMMENT '招聘ID',
    `is_using`   SET ('On', 'Off') NOT NULL COMMENT '是否启用',
    `created_at` integer           NOT NULL DEFAULT '0',
    `updated_at` integer           NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    KEY `user_id` (`user_id`),
    UNIQUE `job_id` (`job_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

/**
 * 用户简历
 */
DROP TABLE IF EXISTS `#DB_PREFIX#Resume`;
CREATE TABLE `#DB_PREFIX#Resume`
(
    `id`         INT(11)           NOT NULL AUTO_INCREMENT,
    `user_id`    VARCHAR(85)       NOT NULL COMMENT '用户ID',
    `title`      VARCHAR(125)      NOT NULL COMMENT '简历标题',
    `content`    TEXT              NOT NULL COMMENT '简历内容',
    `path`       VARCHAR(125)      NULL COMMENT '上传简历路径',
    `is_using`   SET ('On', 'Off') NOT NULL COMMENT '是否启用',
    `created_at` integer           NOT NULL DEFAULT '0',
    `updated_at` integer           NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `user_id` (`user_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
