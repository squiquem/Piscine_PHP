select UPPER(user_card.last_name) as NAME, first_name, price
from member
inner join user_card
on member.id_user_card = user_card.id_user
inner join subscription
on member.id_sub = subscription.id_sub
where price > 42
order by last_name, first_name asc;
