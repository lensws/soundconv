import os, sys, subprocess

def files(path):
    for file in os.listdir(path):
        if os.path.isfile(os.path.join(path, file)):
            yield file

def sh_escape(s):
   return s.replace("(","\\(").replace(")","\\)").replace(" ","\\ ").replace("&","\\&").replace("@","\\@")

path="/audio/"

proc = subprocess.Popen(["lslocks"], stdout=subprocess.PIPE, shell=True)
(out, err) = proc.communicate()

proc = subprocess.Popen(["ps -ela"], stdout=subprocess.PIPE, shell=True)
(out2, err) = proc.communicate()

if ( (out.find(path)==-1) & (out2.find("ffmpeg")==-1) ):
    for file in files(path):
	os.system("mkdir "+path+"done")
        os.system("rm "+path+"done/"+sh_escape(file)+".mp3")
        os.system("ffmpeg -i "+path+sh_escape(file)+" -vn -ar 44100 -ac 2 -ab 320k -f mp3 "+path+"done/"+sh_escape(file)+".mp3")
        os.system("rm "+path+sh_escape(file))