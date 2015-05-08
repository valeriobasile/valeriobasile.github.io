#!/usr/bin/env python

import bibtexparser

with open('publications.bib') as bibtex_file:
    bib_database = bibtexparser.load(bibtex_file)
    
for bib_item in bib_database.entries:
#    print bib_item
    if 'booktitle' in bib_item:
        venue = ', {}'.format(bib_item['booktitle'])
    elif bib_item['journal']:
        venue = ', {}'.format(bib_item['journal'])
    else:
        venue = ''

    if 'pages' in bib_item:
        pages = ', {}'.format(bib_item['pages'])
    else:
        pages = ''

    print ("- {0} *{1}* ({2}){3}{4}".format(bib_item['author'],
                                                bib_item['title'],
                                                bib_item['year'],
                                                venue,
                                                pages))

