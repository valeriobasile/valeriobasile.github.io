#!/usr/bin/env python3

import bibtexparser

with open('publications/publications.bib') as bibtex_file:
    bib_database = bibtexparser.load(bibtex_file)

with open('publication_list.md', 'w') as out_file:
    for bib_item in bib_database.entries:
        if 'booktitle' in bib_item:
            venue = u', {}'.format(bib_item['booktitle'])
        elif bib_item['journal']:
            venue = u', {}'.format(bib_item['journal'])
        else:
            venue = u''

        if 'pages' in bib_item:
            pages = u', {}'.format(bib_item['pages'])
        else:
            pages = u''
     
        if 'file' in bib_item:
            pdf_link = u'{}'.format(bib_item['file'].split(':')[1])
        else:
            pdf_link = u''
     
        out_file.write(u"- {0} *{1}* ({2}){3}{4} [PDF]({5})\n".format(bib_item['author'],
                                                                      bib_item['title'],
                                                                      bib_item['year'],
                                                                      venue,
                                                                      pages,
                                                                      pdf_link).encode('UTF-8'))

