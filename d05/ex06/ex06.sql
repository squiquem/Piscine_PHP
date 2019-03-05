select title, summary 
from film
where UPPER(summary) like '%VINCENT%'
order by id_film asc;
