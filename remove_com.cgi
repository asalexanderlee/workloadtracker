#!/usr/bin/python2.6
import cgi
import cgitb
cgitb.enable()

from modelDB import *
from check import *
import jinja2

# Global variable that will hold the input name of the form we will process

COMMITTE_NAME = "submit_delete"
PASSWORD_INPUT = "password"

def display_results(info,msg):
    
    # we need an environment and file loding system to load file and
    # work with the templating engine
    templateLoader = jinja2.FileSystemLoader( searchpath="./" )
    templateEnv = jinja2.Environment( loader=templateLoader )

    TEMPLATE_FILE = "./edit_com.html"
    template = templateEnv.get_template( TEMPLATE_FILE )

    outputText = template.render(data = info,message = msg)

    return outputText

def main():
    
    print "Content-Type: text/html"
    print    
    
    s= Session()
    
    form = cgi.FieldStorage()
    password_form = str(form.getvalue(PASSWORD_INPUT)).strip()
    
    committee_name = str(form.getvalue(COMMITTE_NAME)).strip()
    
    if check_password(password_form):

        com_obj = s.query(Committee).filter(Committee.name == committee_name).all()
        if len(com_obj) == 1:
            com_obj = com_obj[0]
            pos_list = com_obj.members
            for i in pos_list:
                s.delete(i)
            s.delete(com_obj)
            s.commit()    
            
            msg = ("<b>" + committee_name + "</b>  and all the positions under it "
                   +"have been removed from our records.")
            
            all_com = s.query(Committee).all()
            info =[]
            for i in all_com:
                info.append(i.name)
                
            info.sort()
            outPut = display_results(info,msg)
            
            print outPut   
        else:
            print'''
            <html>
    
            <body onload="loading()">
            
            <a id="redirect" href="http://mcs3.davidson.edu/workloadtracker/com_home.cgi">
            
            
            <script>
            function loading(){
               document.getElementById('redirect').click();
            }
            </script>
            </body>
            </html>
            '''            
            
        
    else:
        
        print '''
        <html>

        <body onload="loading()">
        
        <a id="redirect" href="http://mcs3.davidson.edu/workloadtracker/wrong_password.html" hidden>
        
        
        <script>
        function loading(){
           document.getElementById('redirect').click();
        }
        </script>
        </body>
        </html>
        '''
    
if __name__ == "__main__":
    main()