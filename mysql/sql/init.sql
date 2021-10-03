DROP TABLE IF EXISTS japanese_calendar_year;

CREATE TABLE japanese_calendar_year (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name TEXT NOT NULL
) charset=utf8;

INSERT INTO japanese_calendar_year (name) VALUES ("昭和"),("平成"),("令和");