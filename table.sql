create database basic;

CREATE TABLE basic.`account`
(
    `accountId`  int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
    `account`    varchar(100) NOT NULL DEFAULT '' COMMENT '账号',
    `password`   varchar(300) NOT NULL DEFAULT '' COMMENT '密码',
    `encrypt`    varchar(300) NOT NULL DEFAULT '' COMMENT '加密密码',
    `phone`      varchar(20)  NOT NULL DEFAULT '' COMMENT '电话',
    `email`      varchar(100) NOT NULL DEFAULT '' COMMENT '邮箱',
    `username`   varchar(60)  NOT NULL DEFAULT '' COMMENT '姓名',
    `sex`        tinyint(1) NOT NULL DEFAULT '1' COMMENT '性别：1男，2女',
    `birth`      datetime              DEFAULT NULL COMMENT '生日',
    `status`     tinyint(1) DEFAULT '0' COMMENT '状态：1 正常，2 停用，3 离职',
    `isDelete`   tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除：0正常，1删除',
    `number`     varchar(50)  NOT NULL DEFAULT '' COMMENT '工号',
    `createTime` datetime              DEFAULT NULL COMMENT '添加时间',
    `updateTime` datetime              DEFAULT NULL COMMENT '修改时间',
    PRIMARY KEY (`accountId`) USING BTREE,
    UNIQUE KEY `uk_account` (`account`),
    UNIQUE KEY `uk_phone` (`phone`),
    KEY          `uk_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='账号表';

INSERT INTO `account` (`accountId`, `account`, `password`, `encrypt`, `phone`, `email`, `username`, `sex`, `birth`,
                       `status`, `isDelete`, `number`, `createTime`, `updateTime`)
VALUES (1, 'admin', '$2y$10$MXQcbuhz5m6PUb53tO1Zw.R9I5EhUQbBTQNmi6b5LyVvGecyEzBcS',
        '$2y$10$MXQcbuhz5m6PUb53tO1Zw.R9I5EhUQbBTQNmi6b5LyVvGecyEzBcS', '', '', 'jayden', 1, NULL, 1, 0, '',
        '2024-04-28 15:19:19', '2024-04-28 15:19:23');
