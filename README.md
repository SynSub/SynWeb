# SynWeb
An opensource sharing platform without biased algorithms.

SynWeb 1.3 Readme File

Visit the live version @ https://synsub.com

Software License - https://opensource.org/licenses/MIT

Requirements:
- PHP 7.3.3 - tested with 7.3.3, possible issues with backward-compatibility.
- MySQL database server
- Web Server - tested with Xampp / Apache.
For an all in one solution, check out Xampp. - https://www.apachefriends.org/index.html

Optional:
- YouTube Data API Key - required to auto-integrate YouTube Channel data into User Profiles. - https://developers.google.com/youtube/v3/getting-started
- Twitter Developer Key & Secret - required to auto-integrate Twitter Feed data into User Profiles. - https://developer.twitter.com/en/docs/basics/authentication/guides/access-tokens.html
Disable these features by leaving the config options empty for each, though this will greatly alter the User Profile Page functionality.

Installation:
- Copy the contents of htdocs to your chosen web folder.
- Create a new database and execute the SynWeb.sql query to install the database tables.
- Edit the config.php file and update your server info and settings.
- Visit your website and create the Owner Account.
The first account created is assigned ID 1, this account cannot be unfollowed, and is automatically followed by new users.
To create a VIP user, edit their node in the node table of the database, and set their VIP from 0, to 1.
This allows a webmaster to create content that only selected logged in users can access.
To make more VIP only pages, simply copy the vip.php file and use as a template.
Example user: Bob - https://example.com/vip.php?nid=Bob
The system will check if Bob is logged in, and if Bob is set to VIP 1, if so, display content, if not, display error.

Features List:
- Secure authentication / login system with spam-bot counter-measures, login cookie checks throughout.
- User passwords stored one-way-cryptographic in the database (user.pass.salt hashed with SHA-256).
- YouTube Channel and Twitter Feed auto-integration and Social Link Buttons for User Profiles and comments.
- Simplified comment and replies system.
- Unique content rating and levels system that applies a natural value filter - giving a rating costs one of yours.
- Basic "self-rating" checks (can't rate self, multiple IP's can rate each other, same IP cannot even with two accounts).
- Wall systems with following / unfollowing for user selected content feed.
- Global Wall and Top Wall systems to browse content from all users.
- URL Wall system to create a wall to discuss anything on the internet.
- Public Top Users List, Top Posts List and direct links to all posts (no account needed / no interaction versions).
- Mobile / Desktop compatible responsive design throughout.
- VIP restricted content system for additional development.

Help support development:

If you would like to support the project development, you can do so with any of the following ways.
- Make a donation towards hosting costs etc - https://paypal.me/Aeeria
- Join the platform - https://synsub.com
- Share the platform far and wide.

Hire my services:

I can assist on a one-to-one basis for individual requests and requirements - staff@synsub.com
I am very familar with the YouTube Data API V3, PHP, HTML, CSS and MySQL database interaction.
I can custom design modules for the platform per request.
