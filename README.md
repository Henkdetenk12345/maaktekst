# maaktekst
PHP-scripts om TTI-teletekstpagina's te maken van de NOS Nieuws-website 

Als je de PHP-interpreter nog niet hebt geïnstalleerd, typ dan

<b>sudo apt-get update</b>

<b>sudo apt-get install php</b> (getest op PHP 8.4 en 8.5)

Plaats alle bestanden in een handige map. In mijn geval gebruik ik /home/pi/maaktekst.
Om het bijwerken van bestanden te vereenvoudigen, gebruik ik git.

<b>sudo apt-get install git</b>

<b>git clone https://github.com/henkdetenk12345/maaktekst/ ~/maaktekst/</b>

# hoe moet je dit toevoegen aan CRON
To create a schedule type

<b>sudo crontab -e</b>

Voeg je cron planningen toe aan het einde

  0  8 * * * /home/pi/maaktekst/render.sh

  55 20 * * * /home/pi/maaktekst/render.sh
  
In dit voorbeeld betekent dit dat het script voor het genereren van de pagina om 08:00 en 20:55 uur moet worden uitgevoerd.
