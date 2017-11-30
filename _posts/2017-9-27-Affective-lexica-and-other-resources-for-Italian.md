---
layout: post
title: Affective lexica and other resources for Italian
---

An affective lexicon is a database of words (or word senses, phrases, or other kinds of lexical items) where each item is classified according to its content in terms of subjectivity, polarity (potisive or negative), capability of evoking specific emotions and so on. Such resources are used to build automatic systems that analyze natural language (for example, from websites or social media), and "read" the sentiment expressed in the text. This activity is called [Sentiment Analysis](https://en.wikipedia.org/wiki/Sentiment_analysis) (or Opinion Mining) and it is gaining more and more attention from the scientific communities as well as industry, because it can answer questions like "are customers happy with product X?" or "what type of people approve policy Y?".

Italian is a somewhat poorly represented language in the panorama of language resources. This is true for affective lexica too, but thanks to a vibrant community, things are rapidly changing.
I conducted a quick survey, by asking on the mailing list of the [Italian Association for Computational Linguistics](http://www.ai-lc.it/) about affective lexica for Italian.
I received many replies, that I compiled in the list below. Some of them are lexica, some are other kinds of resources and methods, either in the Italian language or somehow linked to the Italian NLP community.

* **Sentix** Affective lexicon, automatically build by aligning MultiWordNet, WordNet and SentiWordNet. Each sense is given scores for positive polarity, negative polarity and intensity. Available at [http://valeriobasile.github.io/twita/downloads.html][http://valeriobasile.github.io/twita/downloads.html]. 
Publication: [V. Basile and M. Nissim (WASSA 2013)](http://www.aclweb.org/anthology/W/W13/W13-16.pdf#page=112).

* Lexicon created semi-automatically for the participation to the [EVALITA 2014](http://www.evalita.it/2014) shared task [SENTIPOLC](http://www.di.unito.it/~tutreeb/sentipolc-evalita14/index.html). Described in [Di Gennaro, Rossi e Tamburini (EVALITA 2014)](https://docs.google.com/viewer?url=http%3A%2F%2Fwww.fileli.unipi.it%2Fprojects%2Fclic%2Fproceedings%2FProceedings-EVALITA-2014.pdf).

* Sentiment lexicon developed semi-automatically for the [Opener project]. It contains 24.293 lexical entries labeled with positive/neutral/negative polarity. Available at [https://dspace-clarin-it.ilc.cnr.it/repository/xmlui/handle/20.500.11752/ILC-73](https://dspace-clarin-it.ilc.cnr.it/repository/xmlui/handle/20.500.11752/ILC-73).*

* Proprietary sentiment lexicon containing single words, multiword expressions and idiomatic expressions, annotated with polarity, intensity, emotions and domain distributed by [CELI](https://www.celi.it/) under commercial licence. Described in [A. Bolioli, F. Salamino, V. Porzionato (ESSEM 2013)](http://ceur-ws.org/Vol-1096/paper12.pdf).

* Polarized word embeddings can be created with the technique described in [G. Attardi (IIR 2015)](http://ceur-ws.org/Vol-1404/paper_21.pdf) and implemented in [DeepNL](https://github.com/attardi/deepnl).

* Database of affective norms for Italian developed for the [INCREASE](https://sites.google.com/view/mariamontefinese/increase?authuser=0) project. Available at [https://sites.google.com/view/mariamontefinese/norms-data?authuser=0](https://sites.google.com/view/mariamontefinese/norms-data?authuser=0) (other affective and semantic resources are available on the same Web page). Described in [Montefinese, M., Ambrosini, E., Fairfield, B. et al. Behav Res (2014)](https://link.springer.com/article/10.3758%2Fs13428-013-0405-3).

* Automatic method to build multilingual opinionated lexicons based on distant supervision. Used for the participation to the [EVALITA 2016](http://www.evalita.it/2016) shared task [SENTIPOLC](http://www.di.unito.it/~tutreeb/sentipolc-evalita16/index.html). Dictionaries in English and Italian are available at [http://sag.art.uniroma2.it/demo-software/distributional-polarity-lexicon/](http://sag.art.uniroma2.it/demo-software/distributional-polarity-lexicon/). Described in [G. Castellucci, D. Croce, R. Basili (2016)](http://www.lrec-conf.org/proceedings/lrec2016/pdf/449_Paper.pdf) and [G. Castellucci, D. Croce, R. Basili (2015)](http://iir2015.isti.cnr.it/proceedings/IIR_2015_submission_7.pdf).

* **SentiWords** High coverage resource containing roughly 155.000 English words associated with a sentiment score included between -1 and 1. Available at [http://hlt-nlp.fbk.eu/technologies/sentiwords](http://hlt-nlp.fbk.eu/technologies/sentiwords). Described in [Gatti L., Guerini M. & Turchi M. (2015)](http://arxiv.org/abs/1510.09079).

* **SentIta and Doxa** italian databases and tools for sentiment analysis.

A big thank you to all the contributors. If you know of other resources that would fit the list above, feel free to contact me, I'll be happy to update the list.


