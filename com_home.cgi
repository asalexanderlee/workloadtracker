#!/usr/bin/python2.6

import cgi
import cgitb
import jinja2
from modelDB import *

cgitb.enable()

def display_results(info):
    
    # we need an environment and file loding system to load file and
    # work with the templating engine
    templateLoader = jinja2.FileSystemLoader( searchpath="./" )
    templateEnv = jinja2.Environment( loader=templateLoader )

    TEMPLATE_FILE = "./edit_com.html"
    template = templateEnv.get_template( TEMPLATE_FILE )

    outputText = template.render(data = info,message="")

    return outputText

def main():
    print "Content-Type: text/html"
    print
    
    s= Session()
    all_com = s.query(Committee).all()
    
    info =[]
    for i in all_com:
        info.append(i.name)
        
    info.sort()
    outPut = display_results(info)
    print outPut
if __name__ == "__main__":
    main()