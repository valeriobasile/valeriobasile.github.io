#!/bin/sh
d=`date +%Y%m%d-%H%M`
cd /net/aistaff/basile/public_html/politweets/coding/db
tar -czf backup/politweets.sqlite3.$d.tar.gz politweets.sqlite3

