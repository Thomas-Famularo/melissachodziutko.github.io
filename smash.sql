#List Smash Ultimate characters
#Authors: Melissa Chodziutko, Ryan Sheffler
#Version 1.0

#create a database and use it
drop database if exists site_db;
create database if not exists site_db;
use site_db;

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
values (0, Now(), "Bayonetta", "None yet"),
(0, Now(), "Banjo & Kazooie", "None yet"),
(0, Now(), "Bowser", "None yet"),
(0, Now(), "Bowser Jr.", "None yet"),
(0, Now(), "Captain Falcon", "None yet"),
(0, Now(), "Chrom", "None yet"),
(0, Now(), "Cloud", "None yet"),
(0, Now(), "Corrin", "None yet"),
(0, Now(), "Daisy", "None yet"),
(0, Now(), "Dark Pit", "None yet"),
(0, Now(), "Dark Samus", "None yet"),
(0, Now(), "Diddy Kong", "None yet"),
(0, Now(), "Donkey Kong", "None yet"),
(0, Now(), "Dr. Mario", "None yet"),
(0, Now(), "Duck Hunt", "None yet"),
(0, Now(), "Falco", "None yet"),
(0, Now(), "Fox", "None yet"),
(0, Now(), "Ganondorf", "None yet"),
(0, Now(), "Greninja", "None yet"),
(0, Now(), "Hero", "None yet"),
(0, Now(), "Ice Climbers", "None yet"),
(0, Now(), "Ike", "None yet"),
(0, Now(), "Incineroar", "None yet"),
(0, Now(), "Jigglypuff", "None yet"),
(0, Now(), "Joker", "None yet"),
(0, Now(), "Ken", "None yet"),
(0, Now(), "King Dedede", "None yet"),
(0, Now(), "King K. Rool", "None yet"),
(0, Now(), "Kirby", "None yet"),
(0, Now(), "Link", "None yet"),
(0, Now(), "Little Mac", "None yet"),
(0, Now(), "Lucario", "None yet"),
(0, Now(), "Lucas", "None yet"),
(0, Now(), "Lucina", "None yet"),
(0, Now(), "Luigi", "None yet"),
(0, Now(), "Mario", "None yet"),
(0, Now(), "Marth", "None yet"),
(0, Now(), "Mega Man", "None yet"),
(0, Now(), "Meta Knight", "None yet"),
(0, Now(), "Mewtwo", "None yet"),
(0, Now(), "Mr. Game & Watch", "None yet"),
(0, Now(), "Ness", "None yet"),
(0, Now(), "Olimar", "None yet"),
(0, Now(), "Pac-Man", "None yet"),
(0, Now(), "Palutena", "None yet"),
(0, Now(), "Peach", "None yet"),
(0, Now(), "Pichu", "None yet"),
(0, Now(), "Pikachu", "None yet"),
(0, Now(), "Piranha Plant", "None yet"),
(0, Now(), "Pit", "None yet"),
(0, Now(), "Pokemon Trainer", "None yet"),
(0, Now(), "R.O.B.", "None yet"),
(0, Now(), "Richter", "None yet"),
(0, Now(), "Ridley", "None yet"),
(0, Now(), "Robin", "None yet"),
(0, Now(), "Rosalina", "None yet"),
(0, Now(), "Roy", "None yet"),
(0, Now(), "Ryu", "None yet"),
(0, Now(), "Samus", "None yet"),
(0, Now(), "Sheik", "None yet"),
(0, Now(), "Shulk", "None yet"),
(0, Now(), "Simon", "None yet"),
(0, Now(), "Snake", "None yet"),
(0, Now(), "Sonic", "None yet"),
#(0, Now(), "Terry", "None yet"),
(0, Now(), "Toon Link", "None yet"),
(0, Now(), "Villager", "None yet"),
(0, Now(), "Wario", "None yet"),
(0, Now(), "Wii Fit Trainer", "None yet"),
(0, Now(), "Wolf", "None yet"),
(0, Now(), "Yoshi", "None yet"),
(0, Now(), "Young Link", "None yet"),
(0, Now(), "Zelda", "None yet"),
(0, Now(), "Zero Suit Samus", "None yet"),
(0, Now(), "sans", "None yet"),
(0, Now(), "RANDOM", "None yet");

SELECT * FROM smash;
