#!/usr/bin/python2.6
import cgi
import cgitb
import os
import jinja2
cgitb.enable()

from modelDB import *
from check import *
from update_faculty import *


# Global variable that will hold the input name of the form we will process and
# some other global variables
PASSWORD_INPUT = "password"
CSV_NAME = "FacultyInformation.csv"
FILE_INPUT = "file"

def main():

    print "Content-Type: text/html"
    print
    
    
    form = cgi.FieldStorage()
    
    password_form = str(form.getvalue(PASSWORD_INPUT)).strip()
    
    if check_password(password_form):
        file_obj = form[FILE_INPUT]
        if file_obj.filename:
            #remove previous file and save the new one
            os.remove(CSV_NAME)
            open(CSV_NAME, 'wb').write(file_obj.file.read())
            
            # update db using the new csv
            new_list = make_faculty_fromCSV(CSV_NAME)
            msg = update_facultyInfo(new_list)
            
            msg += "<br>Upload sucessful"
        else:
            msg = "No file was uploaded!"
            
        
        print "<html><body>"
        print "<h3>",msg,"</h3>"
        
        print'''
        <h4>Going back ... </h4>
        <a id="redirect" href="http://mcs3.davidson.edu/workloadtracker/edit_faculty.html" hidden>
        <script>
        setTimeout(function(){ document.getElementById('redirect').click(); }, 2000);
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