select floor_number as floor, sum(nb_seats) as seats
from cinema
group by floor_number
order by seats desc;
