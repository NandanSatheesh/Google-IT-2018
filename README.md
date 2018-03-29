# Google-IT-2018
Google IT puts your Google-ing skills to the test. Event of TATVA 2018.

Participants will be provided with a screengrab of a webpage with obvious UI elements removed. The objective here is to find the exact URL to the webpage using the remaining UI elements on the screen as clues to make appropriate Google searches. 

# Setup Instructions
  1. Install the latest version of WAMP server and Run it.
  2. Type 'localhost' on your browser
  3. Create a Virtual Host with the name 'GoogleIt' and specify the exact path to the directory where the source files are stored.
  4. Open 'phpmyadmin' and create a new database with the name 'google-it' 
  5. Click on Import Database and select 'googleit.sql'. This will create the required database to store the Image URLS, Users etc.
  6. You are ready to run Google It.
  
  Note: You'll have to change the port to your virtual host in the WAMP server configuration file. 
