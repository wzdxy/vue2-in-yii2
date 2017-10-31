-- 创建表
-- 关系表
CREATE TABLE `relationship` (
  `cid`  INT(11)      NOT NULL,
  `pid`  INT(11)      NOT NULL,
  `type` VARCHAR(255) NOT NULL
  COLLATE 'utf8_unicode_ci',
  PRIMARY KEY (`pid`, `cid`, `type`)
)
  COLLATE = 'utf8_unicode_ci'
  ENGINE = InnoDB;

-- 用户表
CREATE TABLE `user` (
  `id`                   INT(11)      NOT NULL AUTO_INCREMENT,
  `username`             VARCHAR(255) NOT NULL
  COLLATE 'utf8_unicode_ci',
  `auth_key`             VARCHAR(32)  NOT NULL
  COLLATE 'utf8_unicode_ci',
  `password_hash`        VARCHAR(255) NOT NULL
  COLLATE 'utf8_unicode_ci',
  `password_reset_token` VARCHAR(255) NULL     DEFAULT NULL COLLATE 'utf8_unicode_ci',
  `email`                VARCHAR(255) NOT NULL
  COLLATE 'utf8_unicode_ci',
  `status`               SMALLINT(6)  NOT NULL DEFAULT '10',
  `created_at`           INT(11)      NOT NULL,
  `updated_at`           INT(11)      NOT NULL,
  `token_key`            TEXT         NULL
  COLLATE 'utf8_unicode_ci',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username` (`username`),
  UNIQUE INDEX `email` (`email`),
  UNIQUE INDEX `password_reset_token` (`password_reset_token`)
)
  COLLATE = 'utf8_unicode_ci'
  ENGINE = InnoDB
  AUTO_INCREMENT = 2;

-- 文章表
CREATE TABLE `article` (
  `id`            INT(11)      NOT NULL AUTO_INCREMENT,
  `title`         VARCHAR(255) NULL     DEFAULT NULL COLLATE 'utf8_unicode_ci',
  `text`          TEXT         NULL
  COLLATE 'utf8_unicode_ci',
  `html`          TEXT         NULL
  COLLATE 'utf8_unicode_ci',
  `author_id`     INT(11)      NULL     DEFAULT NULL,
  `author_name`   VARCHAR(255) NULL     DEFAULT NULL COLLATE 'utf8_unicode_ci',
  `type`          VARCHAR(255) NULL     DEFAULT NULL COLLATE 'utf8_unicode_ci',
  `tag`           VARCHAR(255) NULL     DEFAULT NULL COLLATE 'utf8_unicode_ci',
  `status`        INT(11)      NULL     DEFAULT NULL,
  `created_at`    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `url`           VARCHAR(255) NULL     DEFAULT NULL COLLATE 'utf8_unicode_ci',
  `comment_count` INT(11)      NULL     DEFAULT '0',
  PRIMARY KEY (`id`)
)
  COLLATE = 'utf8_unicode_ci'
  ENGINE = InnoDB
  AUTO_INCREMENT = 6;

-- 标签
CREATE TABLE `tag` (
  `id`          INT(11) NOT NULL AUTO_INCREMENT,
  `name`        TEXT    NULL
  COLLATE 'utf8_unicode_ci',
  `url`         TEXT    NULL
  COLLATE 'utf8_unicode_ci',
  `status`      INT(11) NULL     DEFAULT '0',
  `description` TEXT    NULL
  COLLATE 'utf8_unicode_ci',
  `type`        INT(11) NULL     DEFAULT '0',
  `count`       INT(11) NULL     DEFAULT '0',
  PRIMARY KEY (`id`)
)
  COLLATE = 'utf8_unicode_ci'
  ENGINE = InnoDB
  AUTO_INCREMENT = 6;

-- 评论
CREATE TABLE `comment` (
  `id`           INT(11)   NOT NULL AUTO_INCREMENT,
  `text`         TEXT      NOT NULL
  COLLATE 'utf8_unicode_ci',
  `author_id`    INT(11)   NULL     DEFAULT NULL,
  `author_name`  TEXT      NOT NULL
  COLLATE 'utf8_unicode_ci',
  `author_email` TEXT      NOT NULL
  COLLATE 'utf8_unicode_ci',
  `author_blog`  TEXT      NULL
  COLLATE 'utf8_unicode_ci',
  `author_ip`    TEXT      NULL
  COLLATE 'utf8_unicode_ci',
  `parent`       INT(11)   NULL     DEFAULT NULL,
  `status`       INT(11)   NULL     DEFAULT NULL,
  `type`         INT(11)   NULL     DEFAULT NULL,
  `created_at`   TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`   TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)
  COLLATE = 'utf8_unicode_ci'
  ENGINE = InnoDB
  AUTO_INCREMENT = 17;

-- 用户组
CREATE TABLE `group` (
  `id`   INT(11)      NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL     DEFAULT NULL COLLATE 'utf8_unicode_ci',
  PRIMARY KEY (`id`)
)
  COLLATE = 'utf8_unicode_ci'
  ENGINE = InnoDB
  AUTO_INCREMENT = 5;

-- 权限
CREATE TABLE `permission` (
  `id`          INT(11)      NOT NULL AUTO_INCREMENT,
  `name`        VARCHAR(255) NULL     DEFAULT NULL COLLATE 'utf8_unicode_ci',
  `description` TEXT         NULL
  COLLATE 'utf8_unicode_ci',
  PRIMARY KEY (`id`)
)
  COLLATE = 'utf8_unicode_ci'
  ENGINE = InnoDB
  AUTO_INCREMENT = 19;

-- 配置
CREATE TABLE `setting` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user` INT(11) NULL DEFAULT NULL,
  `name` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
  `value` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
  PRIMARY KEY (`id`)
)
  COLLATE 'utf8_unicode_ci';

-- 插入初始数据
INSERT INTO `group` (`id`,`name`) VALUES
  (1,'master'),
  (2,'admin'),
  (3,'editor'),
  (4,'author');

INSERT INTO `permission` (`id`,`name`,`description`)
VALUES
  (1,'article_add',''),
  (2,'article_delete_self',''),
  (3,'article_delete_all',''),
  (4,'article_review',''),
  (5,'article_edit_self',''),
  (6,'article_edit_all',''),
  (7,'comment_delete_self',''),
  (8,'comment_delete_all',''),
  (9,'message_delete',''),
  (10,'system_site_description',''),
  (11,'system_index_head',''),
  (12,'system_site_description',''),
  (13,'system_site_theme',''),
  (14,'user_add',''),
  (15,'user_group',''),
  (16,'user_invite',''),
  (17,'user_delete',''),
  (18,'guest_ban_ip','');

INSERT INTO `relationship` (`cid`,`pid`,`type`) VALUES
  (1,1,'group-permission'),
  (1,2,'group-permission'),
  (1,3,'group-permission'),
  (1,4,'group-permission'),
  (2,1,'group-permission'),
  (2,2,'group-permission'),
  (2,3,'group-permission'),
  (2,4,'group-permission'),
  (3,1,'group-permission'),
  (3,2,'group-permission'),
  (3,3,'group-permission'),
  (4,1,'group-permission'),
  (4,2,'group-permission'),
  (4,3,'group-permission'),
  (5,1,'group-permission'),
  (5,2,'group-permission'),
  (5,3,'group-permission'),
  (5,4,'group-permission'),
  (6,1,'group-permission'),
  (6,2,'group-permission'),
  (6,3,'group-permission'),
  (7,1,'group-permission'),
  (7,2,'group-permission'),
  (8,1,'group-permission'),
  (8,2,'group-permission'),
  (9,1,'group-permission'),
  (9,2,'group-permission'),
  (10,1,'group-permission'),
  (11,1,'group-permission'),
  (12,1,'group-permission'),
  (13,1,'group-permission'),
  (14,1,'group-permission'),
  (14,2,'group-permission'),
  (15,1,'group-permission'),
  (15,2,'group-permission'),
  (16,1,'group-permission'),
  (16,2,'group-permission'),
  (17,1,'group-permission'),
  (18,1,'group-permission'),
  (18,2,'group-permission');

INSERT INTO `setting` (`user`, `name`, `value`) VALUES
  (0,'admin-domain','admin.zchi.me'),
  (0,'front-domain','front.zchi.me'),
  (0,'index-head','Welcome To ZCHI ''s Blog'),
  (0,'index-title','ZCHI ''s Blog')