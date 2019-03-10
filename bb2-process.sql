DELETE FROM bbdata.bb2;
INSERT INTO bbdata.bb2 SELECT bb1.NAME AS NAME, bb1.CATEGORY AS CATEGORY, MAX(IF(DISTANCE=10,TIME,'')) AS TIME1, MAX(IF(DISTANCE=15,TIME,'')) AS TIME2, MAX(IF(DISTANCE=20,TIME,'')) AS TIME3, MAX(IF(DISTANCE=25,TIME,'')) AS TIME4, MAX(IF(DISTANCE=10,POINTS,0)) AS PT1, MAX(IF(DISTANCE=15,POINTS,0)) AS PT2, MAX(IF(DISTANCE=20,POINTS,0)) AS PT3, MAX(IF(DISTANCE=25,POINTS,0)) AS PT4, (0) AS PTOTAL, BB1.CATEGORY AS CAT2, (0) AS CRANK, (0) AS PRANK, COUNT(*) AS NRACES FROM bb1 WHERE UCASE(Bb1.name) <> 'UNKNOWN' GROUP BY Bb1.name, Bb1.category ORDER BY Bb1.name, Bb1.category;
UPDATE bbdata.bb2 SET PTOTAL = nPoints(PT1, PT2, PT3, PT4);

SET @rank := 0;
SET @rgrp := 1;
SET @pts := 0;
update bbdata.bb2
  SET NRACES = NRACES + (@rank:= @rank+1)*0,
      PRANK= if(@pts=PTOTAL, @rgrp, @rank),
      PTOTAL= (@pts:= PTOTAL) + (@rgrp:= PRANK)*0
ORDER BY PTOTAL DESC;

SET @rank := 0;
SET @rgrp := 1;
SET @pts := 0;
SET @cat  := '';
update bbdata.bb2
  SET NRACES = NRACES + (@rank:= if(@cat=CATEGORY, @rank+1, 1))*0 + (@rgrp:= if(@cat=CATEGORY,@rgrp,1))*0,
      CRANK= if(@pts=PTOTAL, @rgrp, @rank),
      CATEGORY= @cat:= CATEGORY,
      PTOTAL= @pts:= PTOTAL + (@rgrp:= CRANK)*0
ORDER BY CATEGORY, PTOTAL DESC;

DELETE FROM bbdata.bb3;
insert into bbdata.bb3
SELECT Bb4.corder, Bb2.cat2, Bb2.crank, Bb2.name, Bb2.ptotal, Bb2.nraces
FROM bb2 INNER JOIN bb4 ON bB2.CAT2 = bB4.CAT2
WHERE Bb2.crank <= 5
ORDER BY Bb4.corder, Bb2.cat2, Bb2.crank, Bb2.name;
