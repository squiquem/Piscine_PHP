select count(distinct id_film) as films
from member_history
where date between '2006-10-30' and '2007-07-27'
or (extract(day from date) = 24 and extract(month from date) = 12);
