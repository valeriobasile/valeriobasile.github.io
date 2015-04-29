#!/usr/bin/env python

import sqlite3
import os
import sys

DB_FILE = "politweets_test.sqlite3"
TAB_FILE = "/net/aistaff/basile/twitter/Politweets/politweets_twoweeks.tab"
TAB_FILE_TEST = "/net/aistaff/basile/twitter/Politweets/politweets_test.tab"
CANDIDATES = "/net/aistaff/basile/twitter/Politweets/candidates_short.csv"

# read list of candidates
parties = dict()
partyindex = dict()
fd = open(CANDIDATES)
for line in fd:
    party, name, twitter, username, _ = line[:-1].split('\t')
    parties[username] = party
    partyindex[party] = 0
partyindex["NA"] = 0
fd.close()

# create SQLite database from tab-separated data
os.remove(DB_FILE)
conn =  sqlite3.connect(DB_FILE)
c = conn.cursor()
c.execute("""CREATE TABLE IF NOT EXISTS tweet (
                ind INTEGER, 
                id TEXT, 
                timestamp INTEGER, 
                user TEXT, 
                party TEXT, 
                message TEXT, 
                reply_to TEXT)""")
conn.commit()
c.execute("""CREATE TABLE IF NOT EXISTS tweet_test (
                ind INTEGER, 
                id TEXT, 
                timestamp INTEGER, 
                user TEXT, 
                party TEXT, 
                message TEXT, 
                reply_to TEXT)""")
conn.commit()
c.execute("""CREATE TABLE IF NOT EXISTS code (
                coder TEXT,
                tweet_ind INTEGER, 
                party TEXT, 
                partition TEXT,
                T2 INTEGER,
                T3 INTEGER,
                T4 INTEGER,
                T5 INTEGER,
                T6 INTEGER,
                T7 INTEGER,
                T8 INTEGER,
                T9 INTEGER,
                T10 INTEGER)""")
conn.commit()
c.execute("""CREATE TABLE IF NOT EXISTS last_code (
                coder TEXT, 
                tweet_ind INTEGER,
                party TEXT)""")
conn.commit()
c.execute("""CREATE TABLE IF NOT EXISTS last_code_test (
                coder TEXT, 
                tweet_ind INTEGER)""")
conn.commit()
c.execute("""CREATE TABLE IF NOT EXISTS coderparty (
                coder TEXT, 
                party TEXT)""")
conn.commit()

# read tab-separated data file and insert rows
fd = open(TAB_FILE)

i = 0

for line in fd:
    tweet_id, timestamp, user, message, reply_to = line.decode("utf-8")[:-1].split('\t')
    if user in parties:
        party = parties[user]
    else:
        party = "NA"
    c.execute("""INSERT INTO tweet (ind, id, timestamp, user, party, message, reply_to) 
               VALUES (?, ?, ?, ?, ?, ?, ?);""", (partyindex[party], tweet_id, timestamp, user, party, message, reply_to))
    i += 1
    partyindex[party] += 1
    if i % 1000 == 0:
        sys.stderr.write("inserted {0} lines\r".format(i))
        
sys.stderr.write("inserted {0} lines\n".format(i))
conn.commit()


# read tab-separated data file and insert rows
fd = open(TAB_FILE_TEST)

i = 0
for line in fd:
    tweet_id, timestamp, user, message, reply_to = line.decode("utf-8")[:-1].split('\t')
    if user in parties:
        party = parties[user]
    else:
        party = "NA"
    c.execute("""INSERT INTO tweet_test (ind, id, timestamp, user, party, message, reply_to) 
               VALUES (?, ?, ?, ?, ?, ?, ?);""", (i, tweet_id, timestamp, user, party, message, reply_to))
    i += 1

    if i % 1000 == 0:
        sys.stderr.write("inserted {0} lines\r".format(i))
        
sys.stderr.write("inserted {0} lines\n".format(i))
conn.commit()


c.execute("INSERT INTO coderparty (coder, party) VALUES ('VVD','VVD');")
c.execute("INSERT INTO coderparty (coder, party) VALUES ('PVDA','PVDA');")
c.execute("INSERT INTO coderparty (coder, party) VALUES ('PVV','PVV');")
c.execute("INSERT INTO coderparty (coder, party) VALUES ('CDA','CDA');")
c.execute("INSERT INTO coderparty (coder, party) VALUES ('SP','SP');")
c.execute("INSERT INTO coderparty (coder, party) VALUES ('D66','66');")
c.execute("INSERT INTO coderparty (coder, party) VALUES ('GL','GL');")
c.execute("INSERT INTO coderparty (coder, party) VALUES ('CU','CU');")
c.execute("INSERT INTO coderparty (coder, party) VALUES ('SGP','SGP');")
c.execute("INSERT INTO coderparty (coder, party) VALUES ('PVDD','PVDD');")
c.execute("INSERT INTO coderparty (coder, party) VALUES ('DPK','DPK');")
conn.commit()

os.chmod(DB_FILE, 0777)


