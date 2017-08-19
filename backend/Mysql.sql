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

