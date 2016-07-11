#!/usr/bin/python2.6
import cgi
import cgitb
cgitb.enable()

from modelDB import *
import jinja2

def display_results(query_result):
    # we need an environment and file loding system to load file and
    # work with the templating engine
    
    templateLoader = jinja2.FileSystemLoader( searchpath="./" )
    templateEnv = jinja2.Environment( loader=templateLoader )

    TEMPLATE_FILE = "vacancy_page.php"
    
    template = templateEnv.get_template( TEMPLATE_FILE )
    
    outputText = template.render(data = query_result,faculty_list = get_faculty())
	
    return outputText

def get_all_data():
    # a session that will handle any interactions
    session = Session()

    all_committee = session.query(Committee).all()
    return_data ={}

    # formating data to make rendering easy
    for a_committee in all_committee:

        key = a_committee.name
        value = []
        positions_under = a_committee.members

        for i in positions_under:
	    if i.faculty:
		f_name= i.faculty.fullname
	    else:
		f_name = ""
		
            representation = [i.id,i.loadPoint,f_name,i.kind,
            i.rotationDate]
            value.append(representation)

        return_data[key] = value
       

    return return_data

def get_faculty():
	session = Session()
	all_faculty = session.query(Faculty).all()
	faculty_list =[]
	
	for i in all_faculty:
	    faculty_list.append(i.fullname)
	    
	return faculty_list

def main():

    print "Content-Type: text/html"
    print
    print display_results(get_all_data())



if __name__ == "__main__":
    main()
