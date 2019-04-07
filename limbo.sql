#List all buildings on campus
#Authors: Danielle Anderson, Amy Moczydlowski, Shaina Razvi, Melissa Chodziutko
#Version 1.0

#create a database and use it
drop database if exists limbo_db;
create database if not exists limbo_db;
use limbo_db;
drop database if exists site_db;
create database if not exists site_db;
use site_db;

#create user table
drop table if exists users;
create table if not exists users
(
user_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
username VARCHAR(20) NOT NULL,
pass CHAR(40) NOT NULL,
email VARCHAR(100) NOT NULL,
PRIMARY KEY (user_id)
);

#insert admin (only one who needs a login)
insert into users (username, pass, email)
values ("admin", "gaze11e", "admin@marist.com");

#create stuff table
drop table if exists stuff;
create table if not exists stuff
(
id INT AUTO_INCREMENT PRIMARY KEY,
location_id INT NOT NULL,
description TEXT NOT NULL,
create_date DATETIME NOT NULL,
update_date DATETIME NOT NULL,
room TEXT,
owner TEXT,
finder TEXT,
item_status SET("found", "lost", "claimed") NOT NULL
);

#create location table
drop table if exists location;
create table if not exists location
(
id INT AUTO_INCREMENT,
create_date DATETIME NOT NULL,
update_date DATETIME NOT NULL,
name TEXT NOT NULL,
PRIMARY KEY (id)
);

insert into location (create_date, update_date, name)
values (Now(), Now(), "Byrne House"),
(Now(), Now(), "Cannavino Library"),
(Now(), Now(), "Champagnat"),
(Now(), Now(), "Chapel"),
(Now(), Now(), "Cornell Boathouse"),
(Now(), Now(), "Donnelly"),
(Now(), Now(), "Dyson Center"),
(Now(), Now(), "Fern Tor"),
(Now(), Now(), "Fontaine Hall"),
(Now(), Now(), "Foy Townhouses"),
(Now(), Now(), "Fulton Street Townhouses (Lower)"),
(Now(), Now(), "Fulton Street Townhouses (Upper)"),
(Now(), Now(), "Greystone Hall"),
(Now(), Now(), "Hancock Center"),
(Now(), Now(), "Kieran Gatehouse"),
(Now(), Now(), "Kirk House"),
(Now(), Now(), "Leo Hall"),
(Now(), Now(), "Longview Park"),
(Now(), Now(), "Lowell Thomas"),
(Now(), Now(), "Lower Townhouses"),
(Now(), Now(), "Marian Hall"),
(Now(), Now(), "McCann Center"),
(Now(), Now(), "Mid-Rise Hall"),
(Now(), Now(), "North Campuse Housing Complex"),
(Now(), Now(), "St. Anne's Hermitage"),
(Now(), Now(), "St. Peter's"),
(Now(), Now(), "Science and Allied Health Building"),
(Now(), Now(), "Sheahan Hall"),
(Now(), Now(), "Steel Plant Studios and Gallery"),
(Now(), Now(), "Student Center/Music Building"),
(Now(), Now(), "West Cedar Townhouses (Lower)"),
(Now(), Now(), "West Cedar Townhouses (Upper)");

#List all buildings on campus
#Authors: Danielle Anderson, Amy Moczydlowski, Shaina Razvi, Melissa Chodziutko
#Version 1.0

#create a database and use it

drop table if exists smash;
create table if not exists smash
(
id INT AUTO_INCREMENT,
bid INT NOT NULL,
update_date DATETIME NOT NULL,
character_name TEXT NULL,
buyer_name TEXT NOT NULL,
PRIMARY KEY (id)
);

insert into smash (bid, update_date, character_name, buyer_name)
values (0, Now(), "Bayonetta", "No One"),
(0, Now(), "Bowser", "No One"),
(0, Now(), "Bowser Jr.", "No One"),
(0, Now(), "Captain Falcon", "No One"),
(0, Now(), "Chrome", "No One"),
(0, Now(), "Cloud", "No One"),
(0, Now(), "Corn", "No One"),
(0, Now(), "Daisy", "No One"),
(0, Now(), "Dark Pit, Arm", "No One"),
(0, Now(), "Dark Samoos", "No One"),
(0, Now(), "Diddy Kong", "No One"),
(0, Now(), "Donkey Kong, Expand", "No One"),
(0, Now(), "Dr. Mario", "No One"),
(0, Now(), "Duck Hunt", "No One"),
(0, Now(), "Falco", "No One"),
(0, Now(), "Fox", "No One"),
(0, Now(), "Ganondorf", "No One"),
(0, Now(), "Greninja", "No One"),
(0, Now(), "Ice Cucks", "No One"),
(0, Now(), "Ike", "No One"),
(0, Now(), "Incineroar", "No One"),
(0, Now(), "Jigglyboof", "No One"),
(0, Now(), "Joker", "No One"),
(0, Now(), "Ken Sugimori", "No One"),
(0, Now(), "King Dedede", "No One"),
(0, Now(), "King Gay Rool", "No One"),
(0, Now(), "Kirby", "No One"),
(0, Now(), "Lonk", "No One"),
(0, Now(), "Little Mac", "No One"),
(0, Now(), "Lusario", "No One"),
(0, Now(), "Lucas", "No One"),
(0, Now(), "Lucina", "No One"),
(0, Now(), "Luigi", "No One"),
(0, Now(), "Mario", "No One"),
(0, Now(), "Marth", "No One"),
(0, Now(), "Megay Man", "No One"),
(0, Now(), "Meta Knight", "No One"),
(0, Now(), "Mewtwo", "No One"),
(0, Now(), "Mr. Gay and Watch", "No One"),
(0, Now(), "Ness", "No One"),
(0, Now(), "Olimar", "No One"),
(0, Now(), "Pac-Man", "No One"),
(0, Now(), "Palutena", "No One"),
(0, Now(), "Peach", "No One"),
(0, Now(), "Pichu", "No One"),
(0, Now(), "Pikakpik", "No One"),
(0, Now(), "Pit, Arm", "No One"),
(0, Now(), "Piranha Plant", "No One"),
(0, Now(), "Pokemon Trainer", "No One"),
(0, Now(), "ROB", "No One"),
(0, Now(), "Richter", "No One"),
(0, Now(), "Ridley", "No One"),
(0, Now(), "Robin", "No One"),
(0, Now(), "Rosaluma", "No One"),
(0, Now(), "Roy", "No One"),
(0, Now(), "Ryu", "No One"),
(0, Now(), "Samoos", "No One"),
(0, Now(), "Sheik", "No One"),
(0, Now(), "Shulk", "No One"),
(0, Now(), "Simon & Garfunkel", "No One"),
(0, Now(), "Snake's dummy thick ass cheeks", "No One"),
(0, Now(), "Sanik", "No One"),
(0, Now(), "Toon Link", "No One"),
(0, Now(), "Villager", "No One"),
(0, Now(), "Wario time", "No One"),
(0, Now(), "Wii Fit Trainer", "No One"),
(0, Now(), "Wolf", "No One"),
(0, Now(), "Yoshi", "No One"),
(0, Now(), "Young Link", "No One"),
(0, Now(), "Zelda", "No One"),
(0, Now(), "Zero Suit Samoos", "No One");

SELECT * FROM smash;

#adding items to stuff table
insert into stuff (location_id, description, create_date, update_date, room, owner, finder, item_status)
values (15, "Black Backpack", '2017-10-23 11:42:03', '2017-12-06 07:12:46', "HC 005", "John Smith", "N/A", "lost"),
(7, "Pink Calculator", '2018-07-15 22:56:19', '2018-07-17 17:08:35', "DY 222", "Sky Hillings", "N/A", "lost"),
(6, "Red Waterbottle", '2018-09-26 07:34:44', '2018-10-19 04:23:55', "DN 108", "Frank Sampson", "N/A", "lost"),
(18, "iPhone6 with pink case", '2018-05-12 20:12:32', '2018-07-13 10:11:46', "Leo Lounge", "Bob Ington", "Rose Perkins", "found"),
(20, "Japanese I book", '2018-06-07 18:38:22', '2018-10-27 14:50:35', "LT 102", "Sam Oberson", "George Cal", "found"),
(9, "Blue ballpoint pen", '2018-08-02 20:44:03', '2018-11-07 13:54:00', "FN 100", "Phil Hedge", "Abby Johnson", "found");