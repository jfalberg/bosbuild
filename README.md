# bosbuild
Boston Buildup Purdy Point results generator
Boston Buildup homepage: http://clubct.org/Buildup.html
Final standings from 2018: http://clubct.org/Results/18Results/18bball4.htm

The Boston Buildup is a series of 4 races from January through March which include a 10k, 15k, 20k and a 25k race.  The participants in all 4 races get their time scored based on their performance and distance.  The faster their time the higher their score.  So each participant can run in up to all 4 races, and based on the calculations from each race, they get ranked overall and by their age category which are as follows:

Open Men (OpM) and Open Women (OpW): 29 and under
30-39 (M30 & W30)
40-49 (M40 & W40)
50-59 (M50 & W50)
60 and over (M60 & W60)

So if a participant scored 300 in the first race, 200 in the second race, 250 in the third race and 225 in the 4th race, the results would get calculated as follows taking the highest number by 4 and the lowest by 1:

300*4 + 250*3 + 225*2 + 200*1 = (1200+750+450+200) = 2600

If they only ran one race, that number gets multiplied by 4 and the rest assume a number of zero.

When this project started back in 1999 taking over a previous system that was written in a mainframe environment, the tools I had available at the time included the C source code (will edit this when I find the original source file), FoxPro, Access and Classic ASP to generate the standings page.  When I learned Java, I converted the C source code to Java and made sure the logic still worked.  I would later on re-write the same code in PHP and generate the output so I could import into FoxPro, Access, then migrate over to PHP.

Fast forward to preparations for 2019 when I am looking into getting a new PC with the goal of keeping all the source in one location where I can utilize both PHP and MySQL where I can better migrate and not be reliant on premium tools such as Access nor Excel to help do the tedious work that can be facilitated using PHP & MySQL scripts wherever appropriately possible.

While the PHP page is currently a work in progress, my current goal is to get the essential functionally to fully work then work on the cosmetics so I can better present this to possible employers that have a demand for my skills at this time.

To be further edited.
