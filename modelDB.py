'''
ORM model for our database.

Our data base has 3 tables: position, faculty and committee.

position represents a unique committee position that can be filled
by a faculty.

faculty contains information about a faculty memeber and the current poistions
a faculty is holding.

committee represents the information about a committee. This will have
information about all the positions in the committee.

'''

import datetime
from sqlalchemy import Column, ForeignKey, Integer, String, DateTime
from sqlalchemy.ext.declarative import declarative_base
from sqlalchemy.orm import sessionmaker, relationship, backref
from sqlalchemy import create_engine



# create an engine to connect to the db, declare mapping,and sessionmaker to
# create a session to handle db interactions.
engine = create_engine('sqlite:///workload.db', echo=False)
Session = sessionmaker(bind=engine)
Base = declarative_base()

class Position(Base):
    __tablename__ = 'position'

    id = Column(Integer, primary_key=True, autoincrement=True)
    loadPoint = Column(String(50))
    rotationDate = Column(String(50))
    kind = Column(String(50)) # can add a special kind if the position is chair

    committeeID = Column(Integer,ForeignKey("committee.id"))
    facultyID = Column(Integer,ForeignKey("faculty.id"))

    def __repr__(self):
        return "<Position(Committee='%s', kind='%s')>" % (self.committee,
        self.kind)

    # expensive method. careful when using this. only meant for debuging
    def str_rep(self):
        return (self.faculty.fullname+" " + self.committee.name + " " +
        self.rotationDate)

class Committee(Base):
    __tablename__ = 'committee'

    id = Column(Integer, primary_key=True, autoincrement=True)
    name = Column(String(50))
    chair = Column(String(50))
    contactInfo = Column(String(100))
    committeeType = Column (String(50))
    description = Column (String(1000))

    members = relationship("Position", backref = "committee")


    def __repr__(self):
        return "<Committee(Name='%s', Type='%s')>" % (self.name,
        self.committeeType)


    # expensive method. careful when using this. only meant for debuging
    def see_members(self):
        for i in self.members:
            print i

class Faculty(Base):
    __tablename__ = 'faculty'

    id = Column(Integer, primary_key=True, autoincrement=True)

    fullname = Column(String(100)) # is like  "LastName, Firstname M"
    email = Column (String(50))
    division = Column(String(50))
    rank = Column(String(50))
    upcomingLeave = Column(String(50))
    leaveDate = Column(DateTime)

    positions = relationship("Position", backref = "faculty")


    def workLoad(self):
        pos = self.positions
        count = 0
        for i in pos:
            count += int(str(i.loadPoint))
        return count

    def total_com(self):
        pos = self.positions
        com_set = set()
        for i in pos:
            com_set.add(i.committee)

        return len(com_set)

    def __repr__(self):
        return "<Faculty(Name='%s', Rank='%s', Division='%s')>" % (self.fullname,
        self.rank ,self.division)

    # expensive method. careful when using this. only meant for debuging
    def see_positions(self):
        print self.fullname
        for i in self.positions:
            print i



Base.metadata.create_all(engine)
