---
layout: post
title: Managing my own bibliography
---

Periodically, I find myself dealing with the problem of publishing my list of publications online. There are many services that crawl websites and databases to build per-author bibliography ([Google Scholar](https://scholar.google.fr/) is a good example), but I have a couple of issues with them. For one, they work automatically thus requiring a variable extent of manual work integration and polishing of the data. My main problem, however, is having to (or *wanting* to) publish the list of publications on my website *in a format I have control upon*. I'm ok with having to manage the list of my publications manually, but only if it's in a centralized way.

For the latter task, I started to use [Zotero](https://www.zotero.org/), a bibliography managing tool that comes in the form of a Firefox plugin or a standalone executable. It's not perfect nor complete, but it has all the features I need to create a list of papers and organize them with labels and collections.

I created a collection on Zotero and filled in with my publications. Then I used the export function to export the list in [Bibtex](www.bibtex.org) format. Now this is handy, not only because it generates a single text file, but also because Bibtex is a standard way of creating citation in [LaTeX](http://www.latex-project.org/), which I use to write all my papers.
If I want to pass the citation information of one of my articles to a colleague or I want to cite myself (I do that only when strictly necessary, I swear!) I can just copy and paste from the .bib file. A Bibtex entry looks like this:

    @inproceedings{basile_lesk-inspired_2014,
      title = {A {Lesk}-inspired {Unsupervised} {Algorithm} for {Lexical} {Choice} from {WordNet} {Synsets}},
      url = {http://www.torrossa.it/gs/resourceProxy?an=3003965&publisher=F46792#page=59},
      urldate = {2015-08-21},
      booktitle = {The {First} {Italian} {Conference} on {Computational} {Linguistics} {CLiC}-it 2014},
      author = {Basile, Valerio},
      year = {2014},
      pages = {48},
      file = {Basile2014.pdf:files/72/Basile2014.pdf:application/pdf}
    }

Not every field is mandatory, depending on the type of entry (*inproceedings*, in this case). The *file* field is filled by Zotero and its value is the relative path to the PDF file that Zotero downloads when using the export function.

Now, for the publication part, I mentioned in an [early post]({% post_url 2015-5-5-New-Webpage %}) that this website is powered by [Jekyll](http://jekyllrb.com/), which compiles [markdown](http://daringfireball.net/projects/markdown/) pages into the HTML you are seeing. What's left to publish the list of publications on the website, then, is to convert the Bibtex file containing my personal bibliography to markdown. This is done by the following Python script:

{% highlight python %}
#!/usr/bin/env python

import bibtexparser
from bibtexparser.bwriter import BibTexWriter
from bibtexparser.bibdatabase import BibDatabase

# the bib file is generated automatically by Zotero
with open('publications/publications.bib') as bibtex_file:
    bib_database = bibtexparser.load(bibtex_file)

writer = BibTexWriter()
with open('publication_list.md', 'w') as md_file:
    for bib_item in bib_database.entries:
        if 'booktitle' in bib_item:
            venue = u', {}'.format(bib_item['booktitle']).replace('{','').replace('}','')
        elif bib_item['journal']:
            venue = u', {}'.format(bib_item['journal'])
        else:
            venue = u''

        if 'pages' in bib_item:
            pages = u', {}'.format(bib_item['pages'])
        else:
            pages = u''

        if 'file' in bib_item:
            pdf_link = u' [PDF]({})'.format(bib_item['file'].split(':')[1])
        else:
            pdf_link = u''

        # create bibtex file
        db = BibDatabase()
        db.entries = [bib_item]
        bib_file = 'bib/{0}.bib'.format(bib_item['ID'])
        bib_link = u' [bib]({})'.format(bib_file)
        with open('publications/{0}'.format(bib_file), 'w') as bib:
            bib.write(writer.write(db).encode('UTF-8'))

        md_file.write(u"- {0} *{1}* ({2}){3}{4} {5} {6}\n".format(bib_item['author'],
                                                                  bib_item['title'].replace('{','').replace('}',''),
                                                                  bib_item['year'],
                                                                  venue,
                                                                  pages,
                                                                  pdf_link,
                                                                  bib_link).encode('UTF-8'))
{% endhighlight %}

Note that while looping over the entries the script also creates mini one-entry databases at each iteration and writes them into separate .bib files. This way, I can display a link for each item in the list to a .bib file containing just that entry.

Take a look at the [final result](/publications). Pretty isn't it? And it's almost entirely automatic from the Zotero bibliography, except for clicking *export* and running the Python script.
