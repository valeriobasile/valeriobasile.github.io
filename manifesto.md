---
layout: page
title: The Pre-aggregation Manifesto
---

Much of modern Natural Language Processing, as well as other subfields of Artificial Intelligence, is based on some form of supervised learning. Since when the rule-based systems have been overcome by statistical models, we have seen Hidden Markov Models, Support Vector Machines, Convolutional and Recurrent Neural Networks, and more recently Transformer Networks each replacing the previous state of the art. In a way or another, all these models learn from data produced by humans, crowdsourced or otherwise. This methodology has worked well for many problems, but it is now starting to show its limits, as the rest of this document will show.

## The Annotation of Language Data

Let us begin with a quick primer on how linguistic annotation is traditionally conducted. The basic components are the following:
* a set of **instances** to annotate. These can be sentences, documents, words (in or out of context), or other linguistically meaningful units.
* a target **phenomenon**, described in detail by means of guidelines and examples.
* an annotation **scheme**, defining the possible values for the phenomenon to annotate, and additional rules, where applicable.
* a group of **annotators**, selected on the basis of expertise, availability, or a mix of the two.

With these premises, the act of annotating a set is an iterative process, where each annotator expresses their judgment about the target phenomenon on an instance at a time, in the modalities defined by the annotation scheme.

In reality, often several phenomena are annotated together on the same set, whether independently or by means of strict or suggested rules to enforce constraints and dependencies between the phenomena. The instances may be grouped and therefore annotated in tuples rather than individually, in which case "an instance" has to be intended as "a tuple". Moreover, the possible values may be categorical variables, real numbers, integers on a scale, and so on. 

## The Annotators

Generally speaking, there are two classes of individuals involved in an annotation process: **experts** and the **crowd**. Experts are a broad category comprising people considered competent on the phenomenon that is being annotated. However, this category has grown to include people that are not necessarily *experts* on certain phenomena by academic standards, but rather present characteristics deemed relevant to a specific annotation, such as, for instance, victims of hate speech, or activists for social rights, in abusive language annotations []. Finally, experts are often simply the authors of work involving the annotation, their associates, students, or friends. That is, expert annotation is often times a matter of **availability** of human resources to perform the annotation task.

Since the annotation of language data is notoriously costly, in the last decade scholars have turned more and more to *crowdsourcing* platforms, like Amazon Machanical Turk [] or Figure Eight []. Through these online platforms, a large number of annotators are available for a reasonable price*. The trade-off, when using these services, is a lesser control on the identity of the annotators, although some filters based on geography and skill can be imposed. Moreover, as the number of annotators grow, the set of instances to annotate is divided among them unpredictably, and the participation of each individual to the annotation task is typically uneven. As a result, with crowdsourcing, the question-answer matrix is sparse, while it is in general complete with expert annotation.

* Whether this price is fair has been debated for some years now [].

## Agreement and Harmonization



## Issues with the Annotation Process

The current process of linguistic annotation retains a series of practices that evolved for pure linguistic annotation, i.e., tha annotation of *objective*, often technical linguistic aspects of texts. Typical examples of such tasks are the annotation of parts of speech, or word senses. Once a theoretical framework is established, the unwritten assumption is made that there is **exactly one truth**, one true value for each variable defined in the annotation scheme for each instance to annotate. This assumption makes sense: according to the any standard grammar of English, a word in a sentence can either be a noun or a verb, or any other grammatical category, but not more than one at the same time. There is no quantum superposition in grammar, no fuzzy logic applies. 

There may be uncertainty, of course. The annotation scheme may not be sufficiently clear to all the annotators. They may have different opinions, of just make mistakes, leading to a sub-optimal agreement measure. However, any disagreement is treated as a kind of statistical noise in the data, and removed by forcing an agreement (harmonization).

Unfortunately, such practices start to fall apart once the focus moves to more and more abstract, latent, and pragmatic aspects of natural language. 
