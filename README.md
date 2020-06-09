# Smash Bidding Tracker
## Credit Where Credit's Due
This website was created to streamline the process of Marist Game Society's semiannual Charity Smash Tournament.
This code was based on a project created for Software Development II by Amy Moczydlowski, Melissa Chodziutko, Shaina Razvi, Danielle Anderson, with some additional code snippets from the professor, Casimer DeCusatis.
The original code was modified into its current form by Ryan Sheffler, with some assistance from Melissa Chodziutko and Paul Ippolito

## Why?
Every semester, Marist Games Society holds a *Smash Bros.* Tournament. Each character is auctioned off individually for real money and all proceeds go to charity. With previous entries, we were able to hold a proper, in-person auction, though it took a very long time to do and was quite tiring for whoever had to run it and announce each character. The moment *Super Smash Bros. Ultimate* was released, we knew we couldn't keep doing that. We instead opted to create this website, where our members can place their bids before the start of the tournament, then we can just collect money and get the fighting started during the meeting.

## The Basics
This website uses PHP, SQL, and Javascript (in addtion to HTML, of course). Its main function is to keep track of and display a running table of all characters in *Smash Ultimate* as well as a bidder name and bid amount for each. SQL handles both that table, and one that keeps track of all transactions. This second table helps to show how bids developed, and who is responsible for what. This makes fact-checking user mistakes very easy. Though it used to be used much more in previous versions, in its current state, PHP is barely used to form the actual content of the page. Instead, most of the PHP code (which can be found in [helpers_smash.php](includes/helpers_smash.php) ) acts as a way for the SQL table data to be retrieved by Javascript. Javascript is responsible for forming the actual dynamic elements of the page. Both the bid and history tables are created by Javascript, and them, the tab buttons, the rolling message box, and the bid pop-up have their behavior defined by Javascript. All of these Javascript files can be found in the "includes" file and are named with respect to what they do.
***This page does not accept money from any users. It is no more than a way for the users to say how much they intend to pay for characters and to keep track of current bids.***

## Upkeep
If you don't have plans to modify the website in any significant way, there are only 2 things to do: adding characters and resetting the database.
### Adding Characters
I tried to keep adding a new character a very simple affair. All that needs to be done is adding a new entry into [smash.sql](smash.sql). That is as simple as placing `(0, Now(), "[Character Name]", "None yet")` into the existing list, replacing [Character Name] with an actual name, of course. Just don't forget to add a comma or semicolon or to reset the database afterwards to make the changes take effect. Lastly, don't forget to add in their Stock Icon which can normally be found on [this page of the wiki](https://www.ssbwiki.com/Category:Head_icons_(SSBU)). Use the 200x200 sized one and drop it into the "icons" file. Do not rename the file unless the name in the SQL database does not match up for some reason, [bidtable.js](includes/bidtable.js) will automatically take the name from the SQL database and find the file based on that.
### Resetting the Database
This step is extremely simple. Just source the [smash.sql](smash.sql) file. It will automatically delete the entire database and recreate it. ***Only do this before or after club members are done bidding. It will delete all bids. Use a simple `ADD` or `UPDATE` query if you need to modify the tables while the bidding is open.***

## Known Bugs (and Notes on them)
- None right now! Well, the rolling message box may have issues on smaller screens (like a portrait-orientation phones), but it hasn't been tested yet.
