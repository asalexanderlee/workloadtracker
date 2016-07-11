from modelDB import *
import csv

# the ff global variables will be the indices of the csv file with the named 
# property

FACULTY_NAME = 1
DIV = 2
RANK = 3
EMAIL = 4
LEAVEINFO =5



def make_faculty_fromCSV(csvFile):

    faculty_list = []

    # open file and create reader
    with open(csvFile, 'rU') as c:
        reader = csv.reader(c, delimiter=',', quotechar='"',
                            skipinitialspace=True)

        row_count = 0
        for row in reader:
            if row_count != 0:

                f_name = row[FACULTY_NAME].strip()
                f_div = row[DIV].strip()
                f_rank = row[RANK].strip()
                f_email = row[EMAIL].strip()
                f_leave = row[LEAVEINFO]

                a_faculty = Faculty(fullname = f_name, email = f_email,
                division = f_div, rank = f_rank, upcomingLeave = f_leave)

                faculty_list.append(a_faculty)

            row_count+=1
            
    return faculty_list

def update_facultyInfo(faculty_list):
    msg = ""
    
    s = Session()
    db_facu = s.query(Faculty)
    updated_list = []
    
    for i in faculty_list:
        fac_fromDB = db_facu.filter(Faculty.fullname == i.fullname).all()
        #if the current faculty is not in the DB, add it
        if len(fac_fromDB)== 0:
            
            s.add(i)
            s.commit()
            updated_list.append(i)
        #if current faculty is in the DB, update the existing record
        elif len(fac_fromDB) == 1:
            
            fac_fromDB = fac_fromDB[0]
            fac_fromDB.division = i.division
            fac_fromDB.rank = i.rank
            fac_fromDB.upcomingLeave = i.upcomingLeave
            s.commit()
            updated_list.append(fac_fromDB)
        else:
            msg = "multiple records for "+ i.fullname +"\n"
            
    #now check if there is any faculty that is in the db but not on the list.
    #such records will be deleted
    
    if db_facu.count() > len(faculty_list):
        db_fac_list = db_facu.all()
        
        for j in db_fac_list:
            if j not in updated_list:
                s.delete(j)
                s.commit()
                msg += "Deleted "+j.fullname+"\n"
                
    return msg
        
