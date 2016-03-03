---
layout: post
title: Crowdsourcing Common Sense
---

Recently I set up an experiment to create a dataset of human
judgements about objects and places. The subjects are asked to rate
the likelihood of an object to be found in a place (both from
Wikipedia) from *unusual* to *usual*. The goal is to create a gold
standard against which we can evaluate our AI algorithms.

With this premise, I was finally able to try out
[Crowdflower](https://www.crowdflower.com), a platform for
crowdsouring that has grown popular within the NLP community, where
creating a human-annotated gold standard is a common occurrence.  I
uploaded a dataset made of 2,000 object-room pairs, wrote the task
description and instructions, designed the survey's look and feel and
fiddled with the options. Crowdflower gives the customer a good deal
of freedom in terms of customization of the task, funding, and the
contributor base.

I launched the job yesterday and in a few hours it was complete. It is
actually only half done, since I'm waiting for the pro account to be
activated, but it's enough to evaluate the result. Looking at the
aggregated answers, which include confidence scores based on
inter-rater agreement, I'm very happy. The results make sense, there
is plenty of valuable information, and I only spent 45 bucks! 10/10
would crowdsource again.

Now, what I have learned:

**You've got to treat your contributors right.**

Contributors are human beings and they demand respect. Times have
changed and ethical concerns have been risen (see for example [this
2011
paper](http://www.mitpressjournals.org/doi/pdf/10.1162/COLI_a_00057),
now Crowdflower contributors will rate your job an a variety of
factors including how much you pay for task and the fairness of you
test questions. I'm not sure of what the effect of a negative rating
could be on your job, but I guess it affects at least its visibility
and popularity, and ultimately the time it takes to complete and the
quality of the answers.

**Crowdsourcing is not for the faint of heart.**

We are used to run experiments on our PCs, looking up the results,
changing a parameter here and there, rinse and repeat. With
crowdsouring, especially when money are involved, it's a different
story. I spent more than I'm willing to admit triple checking every
single detail of my data, options, interface, you name it. Because
when the button is pushed, the machine starts. (To be fair, you can
pause the job at any time and update the options, but one should be
careful to preserve consistency of the results).

**Internet people are mean.**

OK, that's not really news at all. I was still surprised, though, when
I opened a test question that had been contested by too many users,
only to find comments such as "whatttttt???", "What did you smoke???",
"What a load of rubbish", "what kind of drugs are you on??", and my
favourite: "Worst. Task. Ever.".

Interesting experience overall. I definitely learned a lot about
crowdsourcing human judgements, and about the Crowdflower
platform. For those who want to try, the basic account comes with a
free pass for a max. 1,000 rows dataset. Have fun!