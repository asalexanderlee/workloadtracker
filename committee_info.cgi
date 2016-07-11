#!/usr/bin/python2.6
import cgi
import cgitb
cgitb.enable()

from modelDB import *
import jinja2

# Global variable that will hold the input name of the form we will process

COMMITTE_NAME = "submit"


def display_results(com_info,com_members):
    
    # we need an environment and file loding system to load file and
    # work with the templating engine
    templateLoader = jinja2.FileSystemLoader( searchpath="./" )
    templateEnv = jinja2.Environment( loader=templateLoader )

    TEMPLATE_FILE = "./edit_com_update.html"
    template = templateEnv.get_template( TEMPLATE_FILE )

    outputText = template.render(data = com_info, members=com_members)

    return outputText



def main():
    
    print "Content-Type: text/html"
    print

    form = cgi.FieldStorage()
    committee_name = str(form.getvalue(COMMITTE_NAME)).strip()
    
    # when we have a page to select committee, uncomment the above 2 lines.
    # Then comment the one below.

    
    # this is a fairly easy thing to do, so won't be using a helper
    s = Session()
    com_obj = s.query(Committee).filter(Committee.name == committee_name).all()
    com_obj = com_obj[0]
    
    com_info =[com_obj.name, com_obj.committeeType,com_obj.chair, 
               com_obj.contactInfo,com_obj.description]
    
    com_members = com_obj.members
    
    # will format members so that each member will be represented by a list.
    # Thus com_members will be a list of lists and com_info is a list
    members_info=[]
    for i in range(len(com_members)):
        pos = com_members[i]
        if pos.faculty:
            
            f_name= pos.faculty.fullname
        else:
            f_name = ""
        representation = [f_name, pos.kind, pos.loadPoint,
                          pos.rotationDate,pos.id]
        members_info.append(representation)
        
    outputText = display_results(com_info,members_info)
    
    print outputText
    
if __name__ == "__main__":
    main()
