DELIMITER $$
/*
	增加或者修改pre_live_top的值
	process_type: huoshow:财富值；charm: 魅力
	uid: 修改的UID
	username: 修改的用户username
	price:需要增加的值
	调用：形如：call InsertOrUpdate_preLiveTop('huoshow',102457,'username',345);
*/
USE `huoshow_beta`$$

-- 如果存在同名存储过程，则删除先
DROP PROCEDURE IF EXISTS `InsertOrUpdate_preLiveTop`$$

CREATE DEFINER=`root`@`%` PROCEDURE `InsertOrUpdate_preLiveTop`(
	IN process_type VARCHAR(50), -- 输入参数
	IN uid INT,
	IN username VARCHAR(512),
	IN price INT
    )
BEGIN
	DECLARE _id BIGINT;     -- id
	DECLARE _totalnum INT ; -- 总数
	DECLARE _haveData BOOL DEFAULT FALSE;
	DECLARE done INT DEFAULT 0;
	-- DECLARE num int default 0;
	START TRANSACTION; -- 开始事务
        -- SET @sql_str=CONCAT("SELECT count(id) as num FROM pre_live_top WHERE uid='",uid,"' AND cate='",process_type,"' LIMIT 0,1");
	-- 先用CONCAT构造需要的查询字符串,注意查询字符串中把结果赋值给@num
        SET @sql_str=CONCAT("select exists ( SELECT (id) as num FROM pre_live_top WHERE uid='",uid,"' AND cate='",process_type,"' LIMIT 0,1 ) into @num");

	-- 开始执行
	PREPARE smth FROM @sql_str;
	EXECUTE smth;
	INSERT INTO `pre_run_sql_log` SET `sql`=@sql_str;
	SET @tmp = CONCAT("uid:",uid,"; num:",@num);
	INSERT INTO `pre_run_sql_log` SET `sql`=@tmp;
	-- select @num; -- select 变量可以用于调试、输出变量
	-- 判断的使用方法
	IF @num=1 THEN
		SET @sql_str=CONCAT("UPDATE pre_live_top SET cate='",process_type,"',daynum=daynum+",price,",weeknum=weeknum+",price,",monthnum=monthnum+",price,",totalnum=totalnum+",price," WHERE uid=",uid);
		PREPARE smth FROM @sql_str;
		EXECUTE smth;
		INSERT INTO `pre_run_sql_log` SET `sql`=@sql_str;
	ELSE
		SET @sql_str=CONCAT("INSERT INTO pre_live_top (cate,uid,username,daynum,weeknum,monthnum,totalnum,`tmp_iii`) values('",process_type,"',",uid,",'",username,"',",price,",",price,",",price,",",price,",1)");
		PREPARE smth FROM @sql_str;
		EXECUTE smth;
		INSERT INTO `pre_run_sql_log` SET `sql`=@sql_str;
	END IF;
	COMMIT; -- 提交事务
    END$$

DELIMITER ;