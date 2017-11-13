import os, sys, subprocess

def files(path):
    for file in os.listdir(path):
        if os.path.isfile(os.path.join(path, file)):
            yield file

def sh_escape(s):
   return s.replace("(","\\(").replace(")","\\)").replace(" ","\\ ").replace("&","\\&").replace("@","\\@")

path="/audio/"

#Если файл все еще заливается по шарику samba, то надо подождать
proc = subprocess.Popen(["lslocks"], stdout=subprocess.PIPE, shell=True)
(out, err) = proc.communicate()

#Если файл уже занят кодированием, удалять преждевременно нельзя
proc = subprocess.Popen(["ps -ela"], stdout=subprocess.PIPE, shell=True)
(out2, err) = proc.communicate()

if ( (out.find(path)==-1) & (out2.find("ffmpeg")==-1) ):
    for file in files(path):
	os.system("mkdir "+path+"done")
        os.system("rm "+path+"done/"+sh_escape(file)+".mp3")
        os.system("ffmpeg -i "+path+sh_escape(file)+" -vn -ar 44100 -ac 2 -ab 320k -f mp3 "+path+"done/"+sh_escape(file)+".mp3")
        os.system("rm "+path+sh_escape(file))
		#для ведения статистики надо php скрипту на сайте передать данные через POST-формат 
        os.system("curl -d key=48f37ad768d9f72bc01b40fb520b3ff0 -d file="+sh_escape(file)+" http://example.com/stat.php")