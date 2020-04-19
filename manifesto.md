---
layout: page
title: The Pre-aggregation Manifesto
---

Much of modern Natural Language Processing, as well as other subfields of Artificial Intelligence, is based on some form of supervised learning. Since when the rule-based systems have been overcome by statistical models, we have seen Hidden Markov Models, Support Vector Machines, Convolutional and Recurrent Neural Networks, and more recently Transformer Networks each replacing the previous state of the art. In a way or another, all these models learn from data produced by humans, crowdsourced or otherwise. This methodology has worked well for many problems, but it is now starting to show its limits, as the rest of this document will show.

## Linguistic Annotation

Let us begin with a quick primer on how linguistic annotation is traditionally conducted. The basic components are the following:
* a set of **instances** to annotate. These can be sentences, documents, words (in or out of context), or other linguistically meaningful units.
* a target **phenomenon**, described in detail by means of guidelines and examples.
* an annotation **scheme**, defining the possible values for the phenomenon to annotate, and additional rules, where applicable.
* a group of **annotators**, selected on the basis of expertise, availability, or a mix of the two.

With these premises, the act of annotating a set is an iterative process, where each annotator expresses their judgment about the target phenomenon on an instance at a time, in the modalities defined by the annotation scheme.

In reality, often several phenomena are annotated together on the same set, whether independently or by means of strict or suggested rules to enforce constraints and dependencies between the phenomena. The instances may be grouped and therefore annotated in tuples rather than individually, in which case "an instance" has to be intended as "a tuple". Moreover, the possible values may be categorical variables, real numbers, integers on a scale, and so on. 


