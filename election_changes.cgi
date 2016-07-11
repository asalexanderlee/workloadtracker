#!/usr/bin/python2.6
import cgi
import cgitb
cgitb.enable()

from modelDB import *
from check import *
import jinja2

# Global variable that will hold the input name of the form we will process

ELECTIONS_INPUT = "replacements_query"
PASSWORD_INPUT ="password"

def display_results(info):
    
    # we need an environment and file loding system to load file and
    # work with the templating engine
    templateLoader = jinja2.FileSystemLoader( searchpath="./" )
    templateEnv = jinja2.Environment( loader=templateLoader )

    TEMPLATE_FILE = "./election_summary.html"
    template = templateEnv.get_template( TEMPLATE_FILE )

    outputText = template.render(data = info)

    return outputText

def escape_string(a_string):
    new_str= ""
    for i in a_string:
        if i == "<":
            new_str+= "&lt;"
        if i == ">":
            new_str+= "&gt;"
        new_str+= i
    return new_str
    
def modify_position(pos_id,new_faculty,rotation_date):
    session = Session()
    new_faculty = escape_string(str(new_faculty))
    # get faculty 
    faculty_obj_list = session.query(Faculty).filter(Faculty.fullname.
                                                like("%"+new_faculty+"%")).all()
    pos = session.query(Position).get(pos_id)
    committe_name = str(pos.committee.name)
    
    # no confilicts - update position
    if len(faculty_obj_list) == 1:
        faculty_obj = faculty_obj_list[0]
        
        
        #update the faculty holding that position and the rotation date

        pre_rotation = pos.rotationDate
        if pos.faculty:
            pre_fact = pos.faculty.fullname
        else:
            pre_fact = ""
        
        pos.facultyID = faculty_obj.id
        pos.rotationDate = rotation_date
        session.commit()
        
        msg = [pre_rotation,rotation_date,pre_fact,faculty_obj.fullname]  
    
    else:
        msg = [new_faculty]
        
    return committe_name,msg


def main():

    print "Content-Type: text/html"
    print

    form = cgi.FieldStorage()
    password_form = str(form.getvalue(PASSWORD_INPUT)).strip()
    
    if check_password(password_form):
        # a list containing the changes that need to be made
        changes_to_make = str(form.getvalue(ELECTIONS_INPUT)).split(";")
        update_info_dict={}
        for i in changes_to_make:
            if i!="":
                arguments = str(i).split(":")
                pos_id = int(str(arguments[0]))
                new_faculty = arguments[1].strip()
                rotation_date = arguments[2].strip()
                com_name,update_info = modify_position(pos_id,new_faculty,
                                                       rotation_date)
                
                if com_name in update_info_dict.keys():
                    update_info_dict[com_name] +=  [update_info]
                else:
                    update_info_dict[com_name] = [update_info]          
            
            
            
        output_html = display_results(update_info_dict)
        print output_html
        
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
