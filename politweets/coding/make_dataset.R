#SELECT id, timestamp, user, tweet.party, message, reply_to, coder, T2, T3, T4, T5, T6, T7 , T8, T9, T10 FROM tweet
#inner join code
#on code.tweet_ind = tweet.ind
#and code.party = tweet.party
#where partition = 'twoweeks'

code <- read.csv('code.csv', header=F)
codetw <- unique(code[code$partition=='twoweeks',])
names(code) <- c('id', 'timestamp', 'user', 'party', 'message', 'reply.to', 'coder', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7' , 'T8', 'T9', 'T10')
code$id <- as.id(code$message)
code$message <- as.character(code$message)
code$reply.to <- as.character(code$message)
codea <- aggregate(code, by=list(code$id), function(x) tail(x, n=1))
code <- codea[,-1]

code$T2 <- as.factor(code$T2)
levels(code$T2) <- c('Normal post', '@Reply', 'Retweet', 'Retweet x/ comment')

code$T3 <- as.factor(code$T3)
levels(code$T3) <- c("N/A", "Public","Journalist", "Lobbyist", "Expert", "Industry", "Authorities", "Celebrity", "CDA", "PvdA", "SP", "VVD", "PVV", "GL", "CU", "D66","PvdD", "SGP", "50Plus", "DPK", "Other Party", "Party Activists")

code$T4 <- as.factor(code$T4)
levels(code$T4) <- c("Campaign Trail", "Campaign Promotion", "Campaign Action", "Call to Vote", "Political Report", "Other Report", "Own/Party Stance", "Critique", "Requesting Public Input", "Advice/Helping", "Acknowledgement", "Personal", "Other")

code$T5 <- as.factor(code$T5)
levels(code$T5) <- c("N/A", "Animal Rights", "Civil/Human Rights", "Crime/Judicial Proceedings", "Business/Economy", "Education", "Environment", "EU", "Government/Democracy", "Social Welfare/Benefits", "Health", "Immigration/Integration", "Military/Defense", "Religion", "Science/Technology", "War/Conflicts", "World Affairs/Events", "National EventsHeritage", "Infrastructure", "Campaign/Party affairs", "Politicians/Personalities", "Norms/Values", "Media")

code$T6 <- as.factor(code$T6)
levels(code$T6) <- c("N/A", "CDA", "PvdA", "SP", "VVD", "PVV", "GL", "CU", "D66", "PvdD", "SGP", "50Plus", "DPK", "Other Party")

code$T7 <- as.factor(code$T7)
levels(code$T7) <- c("Personal", "Mixed", "Political")

code$T8 <- as.factor(code$T8)
levels(code$T8) <- c("Not applicable", "Children", "Pets", "Marital Life/Relationships", "Family time", "Hobbies", "TV/Film", "Music", "Literature", "Sports", "Friends/Chatter", "Health/Well-being", "Religion/Spirituality", "Fashion/Beauty", "Food/Drink", "Tech", "Past Life/Upbringing", "Places/Travel", "Other")

code$T9 <- as.factor(code$T9)
levels(code$T9) <- c("Yes", "No")

code$T10 <- as.factor(code$T10)
levels(code$T10) <- c("Yes", "No")



# integration of 50plus data
#library(foreign)
#fiftyplus <- read.spss('50plus.sav')


