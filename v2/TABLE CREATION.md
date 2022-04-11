# Guild   
```
CREATE TABLE `Guild` (
 `id` bigint NOT NULL COMMENT 'Discord Guild ID',
 `prefix` varchar(3) NOT NULL DEFAULT '$' COMMENT 'prefix bot listens for',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
```
# PermissionAdmin
```
CREATE TABLE `PermissionAdmin` (
 `relation` varchar(36) NOT NULL,
 `field` bigint NOT NULL DEFAULT '0' COMMENT 'bitwise field of permissions',
 `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
 UNIQUE KEY `relation` (`relation`),
 CONSTRAINT `FK_PermissionAdmin_RelationUUID` FOREIGN KEY (`relation`) REFERENCES `SnowflakeRelationship` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
```
# Snowflake
```
CREATE TABLE `Snowflake` (
 `id` bigint NOT NULL COMMENT 'Discord supplied ID',
 `type` int NOT NULL COMMENT '1 - User, 2 - Role',
 UNIQUE KEY `id` (`id`),
 KEY `FK_Snowflake_TypeID` (`type`),
 CONSTRAINT `FK_Snowflake_TypeID` FOREIGN KEY (`type`) REFERENCES `SnowflakeType` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
```
# SnowflakeRelationship
```
CREATE TABLE `SnowflakeRelationship` (
 `gid` bigint NOT NULL COMMENT 'Discord Guild ID',
 `snowflake` bigint NOT NULL,
 `uuid` varchar(36) NOT NULL,
 PRIMARY KEY (`uuid`),
 UNIQUE KEY `uuid` (`uuid`),
 KEY `FK_SnowflakeRelationship_SnowflakeId` (`snowflake`),
 KEY `FK_SnowflakeRelationship_GuildId` (`gid`),
 CONSTRAINT `FK_SnowflakeRelationship_GuildId` FOREIGN KEY (`gid`) REFERENCES `Guild` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
 CONSTRAINT `FK_SnowflakeRelationship_SnowflakeId` FOREIGN KEY (`snowflake`) REFERENCES `Snowflake` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
```
# SnowflakeType
```
CREATE TABLE `SnowflakeType` (
 `name` varchar(10) NOT NULL,
 `id` int NOT NULL AUTO_INCREMENT,
 `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
```