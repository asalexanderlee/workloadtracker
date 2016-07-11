#!/usr/bin/python2.6
import cgi
import cgitb
import datetime
cgitb.enable()

from modelDB import *
from check import *
import jinja2

# Golbals for form names
PASSWORD_INPUT = "password"
NAME = "name"
CHAIR = "chair"
CONTACT = "contact"
COM_TYPE = "type"
DESCRIPTION = "description"
STRUCTURE_INFO = "positions"

def display_results(com_info,com_members):
    
    # we need an environment and file loding system to load file and
    # work with the templating engine
    templateLoader = jinja2.FileSystemLoader( searchpath="./" )
    templateEnv = jinja2.Environment( loader=templateLoader )

    TEMPLATE_FILE = "./show_committee.html"
    template = templateEnv.get_template( TEMPLATE_FILE )

    outputText = template.render(data = com_info, members=com_members)

    return outputText

def display_com_home(info,msg):
    
    # we need an environment and file loding system to load file and
    # work with the templating engine
    templateLoader = jinja2.FileSystemLoader( searchpath="./" )
    templateEnv = jinja2.Environment( loader=templateLoader )

    TEMPLATE_FILE = "./edit_com.html"
    template = templateEnv.get_template( TEMPLATE_FILE )

    outputText = template.render(data = info,message = msg)

    return outputText

def add_record(com_obj,positions,s):
    
    
    pos_list = positions.split("%")[:-1]
    pos_obj_list = []
    for a_pos in pos_list:
        pos = a_pos.split(",")
        new_type = pos[0].strip().upper()
        new_load = (pos[1].strip())
        cur_year = current_year = str(datetime.date.today().year)[-2:]
        pos_obj = Position(loadPoint = new_load, rotationDate = cur_year, 
                           kind = new_type)
        pos_obj_list.append(pos_obj)
        com_obj.members.append(pos_obj)
        
    
    s.add(com_obj)
    s.add_all(pos_obj_list)
    s.commit()
            
            

def main():
    
    print "Content-Type: text/html"
    print
    s = Session()
    form = cgi.FieldStorage()
    password_form = str(form.getvalue(PASSWORD_INPUT)).strip()
    if check_password(password_form):
        c_name = form.getvalue(NAME)
        c_chair = form.getvalue(CHAIR)
        c_contact = form.getvalue(CONTACT)
        c_type = form.getvalue(COM_TYPE)
        c_description = form.getvalue(DESCRIPTION)
        structure_info = str(form.getvalue(STRUCTURE_INFO))
        
        com_obj = Committee(name=c_name, chair = c_chair, contactInfo = c_contact, 
                            committeeType = c_type,description = c_description)    
    
        
        # a helper function that will add all the positions and the committe with
        # the required relationships
        
        add_record(com_obj,structure_info,s)
        
        # now display changes
        # query the committe just to make sure we have the updated info
        com_obj = s.query(Committee).filter(Committee.name==c_name).all()[0]
        com_info =[com_obj.name, com_obj.committeeType,com_obj.chair, 
                   com_obj.contactInfo,com_obj.description]
        com_members = com_obj.members
        
        # will format members so that each member will be represented by a list.
        # Thus com_members will be a list of lists and com_info is a list
        mem_rep =[]
        for i in range(len(com_members)):
            pos = com_members[i]
            if pos.faculty:
                full_name = pos.faculty.fullname
            else:
                full_name = ""
                    
            represensation = [full_name, pos.kind, pos.loadPoint,
                              pos.rotationDate]
            mem_rep.append(represensation)
            
        outputText = display_results(com_info,mem_rep)
        
        print outputText    
        
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