---
layout: page
title: The Non-aggregation Manifesto
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

Generally speaking, there are two classes of individuals involved in an annotation process: **experts** and the **crowd**. Experts are a broad category comprising people considered competent on the phenomenon that is being annotated. However, this category has grown to include people that are not necessarily *experts* on certain phenomena by academic standards, but rather present characteristics deemed relevant to a specific annotation, such as, for instance, [victims of hate speech, or activists for social rights, in abusive language annotation](https://www.aclweb.org/anthology/W16-5618.pdf). Finally, experts are often simply the authors of work involving the annotation, their associates, students, or friends. That is, expert annotation is often times a matter of **availability** of human resources to perform the annotation task.

Since the annotation of language data is notoriously costly, in the last decade scholars have turned more and more to *crowdsourcing* platforms, like [Amazon Mechanical Turk](https://www.mturk.com/) or [Appen](https://appen.com/). Through these online platforms, a large number of annotators are available for a reasonable price*. The trade-off, when using these services, is a lesser control on the identity of the annotators, although some filters based on geography and skill can be imposed. Moreover, as the number of annotators grow, the set of instances to annotate is divided among them unpredictably, and the participation of each individual to the annotation task is typically uneven. As a result, with crowdsourcing, the question-answer matrix is sparse, while it is in general complete with expert annotation.

\* Whether this price is fair [has been debated for some years](https://www.mitpressjournals.org/doi/pdf/10.1162/COLI_a_00057) now.

## Agreement and Harmonization

Once a sufficient number of annotations on a sufficient number of instances is collected, they are compiled into the so-called *gold standard* dataset, for purposes such as training supervised machine learning models or benchmarking automatic prediction systems. The term *gold standard* originates in the financial domain and it has been borrowed to convey the function of the compiled dataset of serving as a reference. That is, once the gold standard dataset is created, it represents the truth against which compare future predictions on the same set of instances.

The most straightforward procedure to compile a gold standard from a set of annotations is to apply some form of instance-wise aggregation, such as by majority vote: for each instance, the choice indicated by the relative majority of the annotators is selected as the true value for the gold standard. Depending on a series of factors including the number of annotators, this process can be more complicated, e.g, involving strategies to break the ties, or compute averages in the case of the annotation of numeric values on a scale.

Sometimes, extra effort is put into **resolving** the disagreement. This is done by thoroughly discussing each disagreed-upon instance, going back to the annotation guidelines, or having an additional annotator make their judgment independently, or any combination of these methods. This phase takes the name of **harmonization**.

Scrupolous researchers compute quantitative measures of **inter-annotator agreement** (known in some circles as *inter-rater agreement*) to track how much the annotators gave similar answers to the same questions. A number of metrics are available from the literature for this purpose. Among the most popular ones we find percent agreement (the ratio of the number of universally agreed-upon instances over the total number of instances), Cohen's Kappa (a metric that takes into account the probability of agreeing by chance), Fleiss' Kappa (a generalization of Cohen's Kappa to an arbitrary number of annotators), and Krippendorff's Alpha (a further generalization applicable to incomplete question-answer matrices). Crowdsourcing platforms implement such metrics and compute them automatically. Whatever the choice of metric, while compiling a gold standard dataset, the purpose of computing inter-rater agreement is to provide a quantitative measure of how hard the task is for the human annotator. As such, the inter-annotator agreement is also interpreted as related to the upper bound of measurable computer performance on the same task. The inter-annotator agreement is typically computed before harmonization, sometimes both before and after, in order to measure the efficacy of the harmonization itself.

## Issues with the Traditional Annotation Process

The current process of linguistic annotation retains a series of practices that evolved for pure linguistic annotation, i.e., tha annotation of *objective*, often technical linguistic aspects of texts. Typical examples of such tasks are the annotation of parts of speech, or word senses. Once a theoretical framework is established, the unwritten assumption is made that there is **exactly one truth**, one true value for each variable defined in the annotation scheme for each instance to annotate. This assumption makes sense: according to the any standard grammar of English, a word in a sentence can either be a noun or a verb, or any other grammatical category, but not more than one at the same time. There is no quantum superposition in grammar, no fuzzy logic applies. 

There may be uncertainty, of course. The annotation scheme may not be sufficiently clear to all the annotators. They may have different opinions, of just make mistakes, leading to a sub-optimal agreement measure. However, any disagreement is treated as a kind of statistical noise in the data, and removed by forcing an agreement by harmonization or automatic aggregation of the annotation.

Unfortunately, such practices start to fall apart once the focus moves to more and more abstract, latent, and pragmatic aspects of natural language. Case in point, there has been a greatly increasing number of papers in Natural Language Processing venues on datasets and tasks related to abusive language, offensive language, and hate speech. These phenomena cannot be treated with the same methodological framework as traditional linguistic annotation, for the reason that such framework does not model the hearer's (or reader's) **perception** of the communicative intent conveyed by abusive natural language expressions. The same message can be perceived as abusive by one annotator and not abusive by another annotator. In such case, I postulate that both opinions are correct, and therefore **both annotations should be considered true** in the gold standard. The traditional annotation process simply does not contemplate this outcome, and is therefore obsolete when applied tto highly subjective phenomena.

*Aggregation and harmonization destroy any personal opinion that come as a result of the different cultural and demographic background of the annotators.* 

## Action Points

1. Create and distribute **non-aggregated** datasets.
2. Avoid evaluating models against aggregated gold standards.
3. Sign this manifesto and spread the word.
