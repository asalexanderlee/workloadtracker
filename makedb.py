import csv
from modelDB import *


# Constant values that depend on the CSV file
COM_NAME = 0
COM_TYPE = 2
CHAIR = 0
CONTACT_INFO = 1

NAME = 0
ENDDATE = 1
POS_KIND = 2
WORK_LOAD = 3

FACULTY_NAME = 1
DIV = 2
RANK = 3
EMAIL = 4

# a session object that will be used to add data
session = Session()


def committee_pos_fromCSV(csvFile):
    """
    Organize CSV
    """
    pos_list = []
    com_list = []


    # open file and create reader
    with open(csvFile, 'rU') as c:
        reader = csv.reader(c, delimiter=',', quotechar='"',
                            skipinitialspace=True)


        committee_name = ""
        row_num = 1
        for row in reader:
            if row[0] == 'Committee Name':
                index = 0

            elif index < 3:
                # create committee object
                index += 1
                if index == 1:

                    committee_name = row[COM_NAME].strip()
                    committee_type = row[COM_TYPE].strip()

                if index == 2:
                    committee_chair = row[CHAIR].strip()
                    chair_contact = row[CONTACT_INFO].strip()
                    a_comm = Committee(name=committee_name, chair = committee_chair,
                    contactInfo = chair_contact, committeeType = committee_type,
                    description = "")
                    com_list.append(a_comm)

            elif index == 3:
                #these are all the positions

                faculty_name = row[NAME].strip()
                expiration_date = row[ENDDATE].strip()
                position_kind = row[POS_KIND].strip()
                load = row[WORK_LOAD].strip()

                a_pos = Position(loadPoint = load, rotationDate = expiration_date,
                kind = position_kind)

                pos_list.append((a_pos,faculty_name,committee_name,row_num))

            row_num +=1
    return com_list,pos_list


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

                a_faculty = Faculty(fullname = f_name, email = f_email,
                division = f_div, rank = f_rank)

                faculty_list.append(a_faculty)

            row_count+=1

    return faculty_list

def tolerating_index(a_str,a_list):
    if a_str in a_list:
        return a_list.index(a_str)

    index = 0
    for i in a_list:
        str_list = a_str.split()

        contained = True
        for str_part in str_list:
            contained  = contained and (str_part in i)

        if contained:
            return index

        index += 1
    return -1

def add_faculties(faculty_list):
    for i in faculty_list:
        match=session.query(Faculty).filter(Faculty.fullname==i.fullname).all()
        if (len(match) == 0):
            session.add(i)
    session.commit()



def add_committees(committee_list):
    for i in committee_list:
        match = session.query(Committee).filter(Committee.name==i.name).all()
        if (len(match) == 0):
            session.add(i)

    session.commit()

def add_positions(position_list):
    session.add_all(position_list)
    session.commit()

def main():

    com_list,pos_tuple = committee_pos_fromCSV("FullCommitteesList.csv")
    faculty_list = make_faculty_fromCSV("FacultyInformation.csv")

    # maybe inelegant, but ensures consistency in the db
    com_dict = {}
    for i in com_list:
        com_dict[i.name] = i

    faculty_dict= {}
    for j in faculty_list:
        faculty_dict [j.fullname] = j

    faculty_name_list = sorted(faculty_dict.keys())

    # associate a position with the coressponding faculty and committe
    for k in pos_tuple:
        associated_committe = com_dict [k[2]]
        full_name = faculty_name_list[tolerating_index(k[1],faculty_name_list)]
        associated_faculty = faculty_dict[full_name]
        the_position = k[0]

        associated_committe.members.append(the_position)
        associated_faculty.positions.append(the_position)

    # get a list of positions. These positions should have the proper
    # associations with committee and faculty objects

    position_objects = []
    for l in pos_tuple:
        position_objects.append(l[0])

    # Add position, faculty and committee to the database
    add_positions(position_objects)
    add_committees(com_list)
    add_faculties(faculty_list)

    '''
    # The following code was used to ensure consistency through out our
    # batabase.

    count_committee = 0
    for m in com_dict.values():
        count_committee += len(m.members)

    count_faculty = 0
    for n in faculty_dict.values():
        count_faculty += len(n.positions)

    # should all be the same if the data is consistent
    print "total positions form positions list =",len(position_objects)
    print "total positions form faculty info =",count_faculty
    print "total positions form committee info =",count_committee


    # examine very similar positions to avoid multiple entries to the database
    all_position =[]
    for i in pos_tuple:
        all_position.append(i[0].str_rep())

    all_position.sort()
    all_position_set= sorted(list(set(all_position)))
    print len(all_position) - len(all_position_set), "total repeats"

    prev = ""
    for i in all_position:
        if i == prev:
            print i
        prev = i

    # see relationships
    print "see 3 committes and their memebers"
    counter = 3
    for key in com_dict:
        if counter !=0:
            print key
            com_dict[key].see_members()
        else:
            break
        counter -=1


    print "see 10 faculty and their positions"
    counter = 10
    for key_2 in faculty_dict:
        if counter !=0:
            faculty_dict[key_2].see_positions()
        else:
            break
        counter -=1
    '''

if __name__ =="__main__":
    main()
