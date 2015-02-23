infoscreen
==========

This project is for the information screen in my kitchen.

In the moment, it features information about public transport, temperature and news from an RSS feed.


Feel free to adapt it!

Howto Install - GNU/Linux, hier Debian
---------------------

Für lokalen Webserver:

    sudo aptitude install apache2 php5 libapache2-mod-php5 php5-curl
    sudo /etc/init.d/apache2 restart

Für Tests auf der Kommandozeile:

    php5-cli php5-readline php5-curl
