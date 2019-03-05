select last_name, first_name, date_format(birthdate, "%Y-%m-%d") as birthdate
from user_card
where date_format(birthdate, "%Y") = '1989'
order by last_name asc;
