insert into ft_table (login, `group`, creation_date)
select last_name as login, 'other' as `group`, birthdate as creation_date
from user_card
where last_name like '%a%' and length(last_name) < 9
order by last_name asc
limit 10;
