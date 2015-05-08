---
layout: post
title: Crawling Twitter
---

I recently cleaned and packed up a series of scripts that were laying
around as a result of several project involving Twitter data. This
software downloads potentially massive amounts of tweets based on
either a list of keywords or a list of Twitter usernames.

In the first case, the script intercepts the stream of tweets, so only
present tweets are returned (it uses the Twitter *stream* API). In the
other case, the script accesses the *user.timeline* API to return up
to ~3.200 tweets per user, starting from the moment the script is
launched and going back in time.

You only need a valid Twitter API key! (and a few Python libraries...)
There are options to control the rate limit, exclude retweets and
control the output format.

Here's the software github page: https://github.com/valeriobasile/twittercrawler

Have fun!