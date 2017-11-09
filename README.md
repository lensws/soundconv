# soundconv
Python script for sound converter server

1. Install minimal Linux
2. Update all packeges.
3. If not installed python, do it.
4. If not installed ffmpeg, do it.
5. If not installed samba-server, do it.
6. Make dir /audio at root of FS by root user.
7. Share it via samba. Example of part of samba config in samba.conf.
8. Upload conv.py to /root
8. Under root by crontab -e command paste crontab file strings.
