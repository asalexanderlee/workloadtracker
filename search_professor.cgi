#!/usr/bin/python2.6
import cgi
import cgitb
cgitb.enable()

from modelDB import *
import jinja2

# Global variable that will hold the input names of the form we will process

RANK_FORM = "rank_submit"
DIVISION_FORM ="division_submit"
WORKLOAD_FORM = "num_pt_submit"
COMMITTEE_COUNT_FORM = "num_com_submit"
FULL_NAME = "FacultyFullName"
LEAVE_INFO = "leave_info"


def deplay_results(query_result, pass_back_rank, pass_back_div, pass_back_no_com, 
                   pass_back_no_load_pt, pass_back_leaveinfo):
    # we need an environment and file loding system to load file and
    # work with the templating engine
    templateLoader = jinja2.FileSystemLoader( searchpath="./" )
    templateEnv = jinja2.Environment( loader=templateLoader )

    TEMPLATE_FILE = "./faculty_search.html"
    template = templateEnv.get_template( TEMPLATE_FILE )

    outputText = template.render(data = query_result, jinja_rank = pass_back_rank, 
                                 jinja_div = pass_back_div, jinja_no_com = pass_back_no_com,
                                 jinja_no_pt = pass_back_no_load_pt, 
                                 jinja_leave = pass_back_leaveinfo)

    return outputText

def satisfies_criteria(a_faculty,no_committee,no_load_point):
    load = a_faculty.workLoad()
    com_num = a_faculty.total_com()
    
    satisfies = True
    # checking for work load point
    if (str(load) not in no_load_point):
        satisfies = ((load >= 3) and ("3+" in no_load_point))
    
    # checking for work load point:
    if (satisfies and (str(com_num) not in no_committee)):
        
        satisfies = ((com_num >= 2) and ("2+" in no_committee))
        
    return satisfies


def refine_list(faculty_list, no_committee, no_load_point):
    
    final = []
    
    for a_faculty in faculty_list:
        
        if  satisfies_criteria(a_faculty,no_committee,no_load_point):
            final.append(a_faculty)
        
    return final

def format_faculty(faculty_list):
    """
    Given a list of faculty objects, returns a list of lists where each list
    represents a faculty
    """
    return_form = []
    for i in faculty_list:
        representation = [i.fullname,i.rank,i.division,i.workLoad(),i.email]
        pos_held = i.positions
        com_names =[]
        for p in pos_held:
            com_names.append(p.committee.name)

        representation.append(com_names)
        return_form.append(representation)

    return return_form

def get_faculty_info(rank_query,division_query,leaveinfo):
    # a session that will handle any interactions
    session = Session()
    all_faculty = session.query(Faculty)
    
    # filtering by leave
    leave_filtered = all_faculty
    if "no plans" == leaveinfo.lower():
        leave_filtered = all_faculty.filter(Faculty.upcomingLeave.is_(""))

    # filtering by division
    if (division_query[0] == "") and (len(division_query)== 1):
        proper_div = all_faculty
        
    else:
        
        proper_div = all_faculty.filter(Faculty.division.in_(division_query))
    
    
    # filtering by rank
    rank_query_list = []
    if (len(rank_query)==1 and rank_query[0]==""):
        rank_query_list=[all_faculty]
        
    else:
        
        for i in rank_query:
    
            if i.upper() == "OTHER":
                q = all_faculty.filter(~Faculty.rank.
                                       in_(["PROF","ASCPRO","ASTPRO"]))
            else:
                q = all_faculty.filter(Faculty.rank == i)
                
            
            rank_query_list.append(q)

    proper_rank = rank_query_list[0]
    
    for i in range(1,len(rank_query_list)):
        proper_rank = proper_rank.union(rank_query_list[i])
        
        
        
    # combine filter results
    proper_query = (leave_filtered.intersect(proper_rank,proper_div).
                    order_by(Faculty.fullname))
    
    faculty_list = proper_query.all()
    return faculty_list

def name_search(full_name):

    session = Session()
    return (session.query(Faculty).filter(Faculty.fullname.
                                          like("%"+full_name+"%")).all())


def main():

    print "Content-Type: text/html"
    print

    form = cgi.FieldStorage()

    pass_back_rank = ""
    pass_back_div = ""
    pass_back_no_com = ""
    pass_back_no_load_pt = ""
    pass_back_leaveinfo = ""
    
    if form.getvalue("subchange") == "Search" :
        
        pass_back_rank = str(form.getvalue(RANK_FORM))
        pass_back_div = str(form.getvalue(DIVISION_FORM))
        pass_back_no_com = str(form.getvalue(COMMITTEE_COUNT_FORM))
        pass_back_no_load_pt = str(form.getvalue(WORKLOAD_FORM))
        pass_back_leaveinfo = str(form.getvalue(LEAVE_INFO))
        
        rank_query = str(form.getvalue(RANK_FORM)).replace("None","").split(",")
        division_query = str(form.getvalue(DIVISION_FORM)).replace("None","").split(",")
        no_committee = str(form.getvalue(COMMITTEE_COUNT_FORM)).replace("None","").split(",")
        no_load_point = str(form.getvalue(WORKLOAD_FORM)).replace("None","").split(",")
        leaveinfo = str(form.getvalue(LEAVE_INFO))
        
        
        
        # if nothing is selected it means the search should include any values.
        # not selecting == don't mind any of the values        
        if (no_committee == [""]):
            no_committee = "0 1 2+".split()
        if (no_load_point == [""]):
            no_load_point = "0 1 2 3+".split()        
        
        
        
        faculty_list = get_faculty_info(rank_query,division_query,leaveinfo)
        results = refine_list(faculty_list,no_committee,no_load_point)
        
        
    elif form.getvalue("subchange") == "Retrieve" :
        full_name = form.getvalue(FULL_NAME)

        if type(full_name)!= type(""):
            full_name=""
            
        results = name_search(full_name)
        
    else:
        results = name_search("")
        
    query_result = format_faculty(results)
    output_html = deplay_results(query_result, pass_back_rank, pass_back_div, pass_back_no_com, pass_back_no_load_pt, pass_back_leaveinfo)
    print output_html




if __name__ == "__main__":
    main()
