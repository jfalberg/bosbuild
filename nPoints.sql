DELIMITER $$

DROP FUNCTION IF EXISTS `bbdata`.`nPoints` $$
CREATE DEFINER=`root`@`localhost` FUNCTION `nPoints`(a INT, b INT, c INT, d INT) RETURNS int(11)
BEGIN
  DECLARE tmp int;
  if (a > b) then
     set tmp = a;
     set a = b;
     set b = tmp;
  end if;
  if (c > d) then
     set tmp = c;
     set c = d;
     set d = tmp;
  end if;
  if (a > c) then
     set tmp = a;
     set a = c;
     set c = tmp;
  end if;
  if (b > d) then
     set tmp = b;
     set b = d;
     set d = tmp;
  end if;
  if (b > c) then
     set tmp = b;
     set b = c;
     set c = tmp;
  end if;
  RETURN a * 1 + b * 2 + c * 3 + d * 4;
END $$

DELIMITER ;