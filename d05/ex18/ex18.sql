select name
from distrib
where id_distrib
in (42, 62, 63, 64, 65, 66, 67, 68, 69, 71, 88, 89, 90)
or name like '%Y%Y%'
or name like '%y%y%'
limit 2, 5;
