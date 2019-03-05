select film.id_genre, genre.name as name_genre, film.id_distrib, distrib.name as name_distrib, title as title_film
from film
left join genre
on genre.id_genre = film.id_genre
left join distrib
on distrib.id_distrib = film.id_distrib
where film.id_genre between 4 and 8;
