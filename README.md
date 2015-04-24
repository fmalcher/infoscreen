infoscreen
==========

This project is for the information screen in my kitchen.

Currently, it features information about public transport, temperature and news from an RSS feed.

This project uses:
* [Easy.GO API](http://www.myeasygo.de/) for schedule information from MDV (Mitteldeutscher Verkehrsverbund)
* [LastRSS](http://lastrss.oslab.net/) for news updates from the [Tagesschau RSS feed](http://www.tagesschau.de/xml/rss2)
* [OpenWeatherMap API](http://openweathermap.org/api) for weather information

This project is not maintained at the moment. There are plenty of things I could do better ;-)
Feel free to adapt it!



Howto Install - GNU/Linux (here: Debian)
---------------------

for local web server:

    sudo aptitude install apache2 php5 libapache2-mod-php5 php5-curl
    sudo /etc/init.d/apache2 restart

for tests on the CLI:

    php5-cli php5-readline php5-curl
