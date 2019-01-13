/*-------------------доп ------------------*/

SELECT count(*) FROM books WHERE year < 2010;
SELECT author, count(*) FROM books GROUP BY author;
UPDATE books SET rate = rate+1 WHERE year != 2012;
SELECT year,count(*) FROM books GROUP BY year ORDER BY count(*) desc;
DELETE FROM books WHERE rate < 5;
DROP TABLE books;