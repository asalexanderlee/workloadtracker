#!/usr/bin/python2.6
import cgi
import cgitb
cgitb.enable()

from modelDB import *
from check import *
import jinja2

# Global variable that will hold the input name of the form we will process
PASSWORD_INPUT = "password"

COM_ID = "committee_id"
NAME = "name"
CHAIR = "chair"
CONTACT = "contact_info"
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

def modify_positions(com,change_info,s):
    
    
    
    change_info = change_info.split("%")[:-1]
    
    for edit in change_info:
        
        
        pos = edit.split(",")
        
        pos_id = int(pos[3].strip())
        new_type = pos[0].strip().upper()
        new_load = (pos[1].strip())
        pos_remove = pos[2].strip()
        
        
        if pos_id < 0: # means add this position
            
            current_year = str(datetime.date.today().year)[-2:]
            new_pos = Position(loadPoint = new_load, kind = new_type, 
                               rotationDate = current_year)
            com.members.append(new_pos)
            s.add(new_pos)
            print "here"
            
            
        elif pos_remove == "true": # means remove the position
            the_pos = s.query(Position).get(pos_id)
            s.delete(the_pos)
            
            
        else: # if it gets here, it means modify existing position
            the_pos = s.query(Position).get(pos_id)
            the_pos.loadPoint = new_load
            the_pos.kind = new_type
            
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
        
        structure_edit = str(form.getvalue(STRUCTURE_INFO))
        
        
        # get the committee and make the changes
    
        
        
        com_obj = s.query(Committee).filter(Committee.name==c_name).all()[0]
        c_id  = com_obj.id
        com_obj.name = c_name
        com_obj.chair = c_chair
        com_obj.contactInfo = c_contact
        com_obj.committeeType = c_type
        com_obj.description = c_description
        
        s.commit()
        
        # a helper function that will handle all the position modifications
        modify_positions (com_obj,structure_edit,s)
        
        # now display changes
        # query again just to make sure we have the updated info
        com_obj = s.query(Committee).get(c_id)
        
        com_info =[com_obj.name, com_obj.committeeType,com_obj.chair, 
                   com_obj.contactInfo,com_obj.description]
        
        com_members = com_obj.members
        
        # will format members so that each member will be represented by a list.
        # Thus com_members will be a list of lists and com_info is a list
        members_rep=[]
        for i in range(len(com_members)):
            pos = com_members[i]
            
            if pos.faculty:
                f_name= pos.faculty.fullname
            else:
                f_name = ""
                
            representation = [f_name, pos.kind, pos.loadPoint,
                              pos.rotationDate,pos.id]
            members_rep.append(representation)
            
        outputText = display_results(com_info,members_rep)
        
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