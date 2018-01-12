# soundconv
Python script for sound converter server

1. Install minimal Linux
2. Update all packeges.
3. If not installed python, do it.
4. If not installed ffmpeg, do it.
5. If not installed samba-server, do it.
6. Make dir /audio at root of file system by root user.
7. Share it via samba. Example of part of samba config in samba.conf.
8. Upload conv.py to /root
8. Under root by crontab -e command paste crontab file strings.
------------------------------------------------------------------------
9. If U need statistic, install LAMP, curl.
10. Make database at Mysql.
11. Replace login and pass U need for mysql connect at stat_put.php, stat_read.php files.
12. For stat_put.php generate some pass and don't forget to add it to conv.py.
13. For stat_read.php some pass for view, it`s need for http://example.com/stat_read.php?key=qwerty123
