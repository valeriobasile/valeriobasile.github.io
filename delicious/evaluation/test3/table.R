a1 <- read.delim('1.csv', sep=' ', colClasses=c('character','integer'), header=F)
a2 <- read.delim('2.csv', sep=' ', colClasses=c('character','integer'), header=F)
a3 <- read.delim('3.csv', sep=' ', colClasses=c('character','integer'), header=F)
a4 <- read.delim('4.csv', sep=' ', colClasses=c('character','integer'), header=F)
a5 <- read.delim('5.csv', sep=' ', colClasses=c('character','integer'), header=F)
a6 <- read.delim('6.csv', sep=' ', colClasses=c('character','integer'), header=F)
a7 <- read.delim('7.csv', sep=' ', colClasses=c('character','integer'), header=F)
a8 <- read.delim('8.csv', sep=' ', colClasses=c('character','integer'), header=F)
a9 <- read.delim('9.csv', sep=' ', colClasses=c('character','integer'), header=F)
a10 <- read.delim('10.csv', sep=' ', colClasses=c('character','integer'), header=F)

b1 <- read.delim('b1.csv', sep=' ', colClasses=c('character','integer'), header=F)
b2 <- read.delim('b2.csv', sep=' ', colClasses=c('character','integer'), header=F)
b3 <- read.delim('b3.csv', sep=' ', colClasses=c('character','integer'), header=F)
b4 <- read.delim('b4.csv', sep=' ', colClasses=c('character','integer'), header=F)

d <- merge(a1,a2,by="V1")
d <- merge(d,a3,by="V1")
d <- merge(d,a4,by="V1")
d <- merge(d,a5,by="V1")
d <- merge(d,a6,by="V1")
d <- merge(d,a7,by="V1")
d <- merge(d,a8,by="V1")
d <- merge(d,a9,by="V1")
d <- merge(d,a10,by="V1")
d <- merge(d,b1,by="V1")
d <- merge(d,b2,by="V1")
d <- merge(d,b3,by="V1")
d <- merge(d,b4,by="V1")

names(d) <- c('tag','a1','a2','a3','a4','a5','a6','a7','a8','a9','a10','b1','b2','b3','b4')
write.csv(d, file='test3all.csv', row.names=F)
library(irr)
kappam.fleiss(d[,2:11])
kappam.fleiss(d[,2:15])

