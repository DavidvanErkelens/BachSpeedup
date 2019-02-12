// var dataset = [
//     [5, 20], [480, 90], [250, 50], [100, 33], [330, 95],
//     [410, 12], [475, 44], [25, 67], [85, 21], [220, 88]
//   ];

var dataset = [
    [1971, "15:08", "Violinkonzerte BWV 1041 - 1043" ],
[1979, "15:44", "Concerti Per Violino BWV 1041-1042-1043" ],
[1999, "12:43", "Violin Concertos (BWV 1041-1043)" ],
[1990, "14:49", "Concertos (BWV 1043, 1044, 1060, 1064)" ],
[1990, "14:49", "Concertos, BWV 1043, 1044, 1060, 1064" ],
[1971, "15:08", "Violinkonzerte BWV 1041 - 1043" ],
[1989, "14:09", "Concertos For Violin BWV 1041 & 1042 / Concerto For Two Violins BWV 1043 / Concerto For Violin & Oboe BWV 1060" ],
[1957, "13:18", "Konzerte Für Violine, Streicher Und Continuo Nr. 1 A-moll, BWV 1041 & Nr. 2 E-dur, BWV 1042 / Konzert Für 2 Violinen, Steicher Und Continuo D-moll, BWV1043" ],
[1963, "14:27", "3 Doppelkonzerte Nach BWV 1047 1043 1060" ],
[1961, "13:18", "Konzerte Für Violine, Streicher Und Continuo (Nr. 1 A-moll, BWV 1041 | Nr. 2 E-dur, BWV 1042) / Konzert Für 2 Violinen, Steicher Und Continuo (D-moll, BWV 1043)" ],
[1996, "16:43", "The Violin Concertos BWV 1041-1043" ],
[1986, "16:39", "Violinkonzerte / Violin Concertos BWV 1041, 1042, 1043, 1056, 1060" ],
[1999, "12:43", "Violin Concertos (BWV 1041-1043)" ],
[1970, "16:44", "Concerto N°1 Bwv 1041 / Concerto N°2 Bwv 1042 / Double Concerto Bwv 1043" ],
[1983, "16:53", "Violin Concertos / Violinkonzerte" ],
[1963, "14:27", "3 Double Concertos: According To BWV 1060, 1043, 1060" ],
[2014, "12:07", "Violin Concertos BWV 1041-1043 & 1060R" ],
[1987, "16:43", "Concerto Pour 2 Violons BWV 1043 - Concertos Pour Violin BWV 1041 & 1042" ],
[1983, "20:02", "Konzert Für Zwei Violinen In D-moll, Violinkonzerte In A-moll & E-dur" ],
[1997, "14:20", "Solo & Double Violin Concertos" ],
[2003, "16:29", "Concertos" ],
[1974, "3:30", "Swinging Bach" ],
[1979, "13:01", "Grosse Meister Der Musik" ],
[1966, "29:36", "Weihnachts-Oratorium • Christmas Oratorio • Oratorio De Noël, BWV 248" ],
[1973, "16:16", "Konzert In D-moll Für 2 Violinen Und Streicher BWV 1043 • Konzert In D-moll Für Violine, Oboe Und Streicher BWV 1060" ],
[2009, "14:46", "Bach Concertos" ],
[2003, "16:28", "Concertos" ],
[2018, "16:29", "Concertos" ],
[1966, "23:26", "4 Ouvertüren Orchestersuiten - BWV 1066-1069" ],
[1976, "16:14", "Double Violin Concerto D Minor / Solo Flute Sonata A Minor / Suite No. 2 B Minor" ],
[2017, "2:39", "Les Chefs D'oeuvres de Johann-Sebastian Bach" ],
[1997, "3:46", "The Best Of J. S. Bach" ],
[2000, "21:28", "Concertos" ],
[1991, "16:26", "Violinkonzerte" ],
[1983, "4:24", "Из Сокровищницы Мирового Исполнительского Искусства (Скрипка - Альт - Виолончель)" ],
[1976, "14:41", "Concert Of The Century" ],
[1999, "12:23", "Violin Concertos" ],
[2001, "20:30", "Violin Concertos" ],
[1990, "3:18", "Jesu, Joy Of Man's Desiring" ],
[2003, "3:23", "Solo & Double Violin Concertos" ],
[1966, "11:00", "Messe En Si Minor, Bwv 232" ],
[1996, "5:20", "The Romantic Bach (A Celebration Of Bach's Most Romantic Music)" ],
[1988, "16:25", "Konzerte / Concertos" ],
[1981, "4:00", "Festliches Konzert" ],
[1962, "13:18", "Konzerte Für Violine, Streicher Und Continuo Nr. 1 A-moll, BWV 1041 & Nr. 2 E-dur, BWV 1042 / Konzert Für 2 Violinen, Steicher Und Continuo D-moll, BWV1043" ],
[1971, "14:13", "Violinkonzerte A-moll E-dur Doppelkonzert D-moll" ],
[1972, "8:58", "The Joy of Singing" ],
[1957, "13:18", "Konzerte Für Violine, Streicher Und Continuo Nr. 1 A-moll, BWV 1041 & Nr. 2 E-dur, BWV 1042 / Konzert Für 2 Violinen, Steicher Und Continuo D-moll, BWV1043" ],
[1976, "14:41", "Concert Of The Century" ],
[2005, "3:17", "Ghost Stories And Fairy-Tales" ],
[1980, "8:41", "Romanze" ],
[2000, "3:00", "Золотое Барокко" ],
[1987, "1:21", "The Best Of The Baroque" ],
[1958, "13:18", "Concertos For Violin, Strings And Continuo / Concerto For 2 Violins, Strings And Continuo" ],
[1983, "16:36", "Concerti For 2 Violins / Concerto For Violin And Oboe" ],
[2004, "4:17", "Bach For Meditation" ],
[2001, "20:30", "Violin Concertos" ],
[1981, "4:24", "Скрипка" ],
[1990, "3:23", "Jesu, Joy Of Man's Desiring & The Immortal Music Of J. S. Bach" ],
[2006, "6:35", "B.A.C.H. - Bach Alternative Compositions On Historical Basics" ],
[2003, "9:29", "Concerts Avec Plusieurs Instruments - II" ],
[2004, "5:32", "Barockens Mästerverk" ],
[2011, "2:13", "Music In And On The Air" ],
[2003, "16:29", "Concertos" ],
[1976, "14:41", "Concert Of The Century" ],
[1991, "14:30", "Violin Concertos" ],
[1986, "20:30", "Bach: Violin Concertos" ],
[1991, "14:30", "Violin Concertos" ],
[1987, "5:56", "Vivaldi - Bach" ],
[1986, "20:30", "Bach: Violin Concertos" ],
[2005, "9:22", "Inner Thoughts" ],
[1980, "4:24", "Violin" ],
[2015, "11:23", "Vivaldi: The Four Season, Concerto For 4 Violins, Bach: Double Concerto, Mozart: Sinfonia Concertante K.364" ],
[1999, "13:41", "Harpsichord Concertos III" ],
[1965, "15:40", "Concerto For Two Violins In D Minor and Sonata In C Major For Two Violins / Concerto Grosso, Op. 3 No. 8" ],
[1988, "16:26", "Yehudi Menuhin At The National Philharmonic In Warsaw" ],
[1982, "16:13", "Bach: Violin Concerto In E; Concerto For Two Violins; Concerto For Violin And Oboe" ],
[2000, "14:25", "Double Concertos: Concerto For Two Violins / Sinfonia Concertante / Concerto For Violin And Cello" ],
[1985, "11:00", "Klassisch und Elektronisch" ],
[2000, "2:14", "Jazz Sebastian Bach" ],
[2000, "2:14", "Jazz Sebastian Bach" ],
[2012, "6:44", "The Best of Bach" ],
[2009, "4:37", "Best Of Bach" ],
[2000, "13:11", "Double Concertos" ],
[1986, "11:00", "Mit Diesem Musikalischen Gruß Bedanken Wir Uns Für Die Gute Zusammenarbeit 1985-1986" ],
[1982, "5:07", "Great Baroque Adagios" ],
[1992, "4:53", "Collection" ],
[1993, "9:01", "Violin Concertos In A Minor, E, G Minor; Double Concerto In D Minor" ],
[1996, "4:14", "Violin/Oboe Concertos" ],
[1970, "11:29", "Le Monde De Bach" ],
[1997, "3:15", "Adagio J.S. Bach" ],
[1989, "3:42", "Bach Violin Concertos" ],
[1989, "8:10", "The Basic Bach" ],
[2012, "14:35", "Double Concertos: Concerto For Two Violins / Sinfonia Concertante / Concerto For Violin And Cello" ],
[2002, "75:39", "Funeral Music" ],
[2000, "14:50", "Concertos 1 / Violin Concertos" ],
[2001, "14:22", "Violin Concertos" ],
[1995, "15:32", "Violinkonzerte · Violin Concertos / Violinromanzen · Violin Romances" ],
[2001, "14:05", "Violin Concertos" ],
[1988, "7:20", "The Best Of Baroque" ],
[1992, "17:07", "Best Of The Great Composers 6: Bach" ],
[1977, "14:41", "Concert Of The Century" ],
[1975, "4:26", "Bach / Händel" ],
[1990, "4:06", "Concerti per Violino e Orchestra" ],
[2002, "1:30", "The Two And Three Part Inventions (Inventions & Sinfonias)" ],
[1997, "9:53", "60th Anniversary Gala Concert" ],
[2000, "3:29", "Bach the concerto Album" ],
[1989, "8:26", "D-Moll Toccata És Fúga / E-Moll Triószonáta / C-Dúr Toccata, Adagio És Fúga" ],
[1981, "15:42", "Suites Nos. 1, 2, 3, 4 For Cello Solo" ],
[1981, "16:16", "Berühmte Doppelkonzerte" ],
[1991, "2:57", "Butterfly Collection" ],
[1976, "14:41", "Concert Of The Century" ],
[1983, "8:00", "Скрипка" ],
[1980, "5:07", "Barock Zum Träumen" ],
[1981, "14:27", "Conciertos Dobles" ],
[1996, "3:29", "Εθνική Λυρική Σκηνή" ],
[2018, "18:86", "Retrospective" ],
[1996, "3:29", "Εθνική Λυρική Σκηνή" ],
[1974, "10:39", "J.S. Bach - Eine Liebhaber-Ausgabe, Teil 1" ],
[2002, "3:06", "Nigel Kennedy's Greatest Hits" ],
[1989, "2:01", "Cinema Weekend - Classics In Films" ],
[1994, "3:10", "Jesu, Joy Of Man's Desiring And Other Great Works" ],
[1997, "3:46", "The Best Of J. S. Bach" ],
[1976, "14:41", "Concert Of The Century" ],
[1998, "3:48", "Funiculi Funicula 15" ],
[1996, "8:09", "The Best Of Bach" ],
[2011, "14:36", "Concertos For Flute, Oboe And Violin (Reconstructed By Christopher Hogwood); Violin Concertos" ],
[2000, "4:41", "Sempre Adagio • Famous Slow Movements" ],
[1998, "2:51", "Johann Sebastian Bach" ],
[1965, "15:40", "Concerto For Two Violins In D Minor and Sonata In C Major For Two Violins / Concerto Grosso, Op. 3 No. 8" ],
[2004, "4:18", "Bach For Meditation" ],
[1984, "1:57", "Bach Favourite Melodies" ],
[1980, "5:07", "Great Baroque Adagios" ],
[2011, "51:33", "International Festival 'George Enescu' - 1st Edition - Thursday, 18 September 1958: Concertul Orchestrei Filarmonicii „George Enescu”" ],
[1997, "3:48", "J.S. Bach - Violinkonzerte" ],
[2015, "3:27", "Best of German Baroque: J.S. Bach" ],
[1993, "3:45", "The Best Of Bach" ],
[2005, "13:04", "Violin Concertos" ],
[1982, "16:13", "Bach: Violin Concerto In E; Concerto For Two Violins; Concerto For Violin And Oboe" ],
[2000, "13:40", "The Complete Concertos Vol. 3" ],
[1997, "13:03", "Bach Violin Concertos" ],
[2009, "16:27", "Concertos" ],
[1981, "21:05", "Passacaglia, Fantasia And Fugue / Concerto For Organ And String Orchestra" ],
[2001, "8:43", "Movie Adagios" ],
[1977, "14:41", "Concert Of The Century" ],
[1972, "8:58", "The Joy Of Singing" ],
[2002, "76:28", "Music For Relaxation = Musique Pour La Relaxation" ],
[1972, "8:58", "The Joy Of Singing" ],
[2000, "5:22", "Violin For Relaxation" ],
[2005, "5:32", "Obras-Primas Do Barroco" ],
[1994, "3:39", "Largo" ],
[1997, "5:38", "The Ultimate Collection" ],
[2017, "4:52", "Fratres" ],
[1982, "14:56", "Piano" ],
[1982, "21:05", "Орган" ],
[2012, "48:23", "The All-Baroque Box" ],
[1989, "02:51", "The Best Of" ],
[1995, "1:49", "Cinema Classics" ],
[2002, "3:06", "Nigel Kennedy's Greatest Hits" ],
[2005, "8:43", "Movie Adagios (Over 2½ Hours Of Beautiful Screen Classics)" ],
[2005, "8:43", "Movie Adagios (Over 2½ Hours Of Beautiful Screen Classics)" ],
[2017, "5:30", "Bach, Give Us A Tune!" ],
[1990, "4:49", "Concerti" ],
[1988, "10:07", "Berühmte Konzerte" ],
[1998, "9:01", "Violin Concertos In A Minor, E, G Minor; Double Concerto In D Minor" ],
[1995, "15:12", "Conciertos Para Violín" ],
[2006, "13:11", "Bach"],
[1986, "6:32", "Concert On The Occasion Of The Foundation Of The European Philharmonic Association A.S.B.L."],
[1988, "16:26", "Violinkonzerte"],
[2018, "3:44", "Quer Bach 2"],
[2017, "14:51", "Bach & Vivaldi For Mandolin"],
[1986, "6:32", "Concert On The Occasion Of The Foundation Of The European Philharmonic Association A.S.B.L."],
[1997, "2:51", "Toccata and Fugue Ave Maria and many others"],
[1991, "14:30", "Violin Concertos"],
[2011, "2:03", "Johann Sebastian Bach"],
[1985, "16:39", "Violin Concertos"],
[2003, "3:06", "Gran Concerto Barocco"],
[2003, "3:19", "Chill With Bach"],
[1997, "6:59", "Bach"],
[2010, "5:32", "Гений Барокко"],
[1968, "2:14", "J. S. Bach"],
[1972, "8:58", "The Joy of Singing"],
[1995, "4:25", "Bach At Bedtime:  Lullabies For The Still Of The Night"],
[2004, "5:32", "Barokin Mestari"],
[1998, "4:34", "The Most Relaxing Classical Album In The World Ever! II"],
[2006, "75:54", "100 Best Baroque"],
[1993, "4:00", "Desert Island Discs"],
[1999, "6:27", "The Very Best Of Bach"],
[2010, "6:48", "Baroque Favorites"],
[1993, "20:30", "Violin Concertos"],
[1982, "21:05", "Passacaglia, Fantasia And Fugue / Concerto For Organ And String Orchestra"],
[2002, "3:06", "Nigel Kennedy's Greatest Hits"],
[1995, "5:03", "Meditación"],
[2001, "7:47", "Strings On Wings"],
[2016, "14:28", "Great Moments At Carnegie Hall. Selected Highlights From 125 Years Of Performance History"],
[1989, "15:05", "Violin Concertos • Violinkonzerte"],
[1992, "8:08", "Romantic Classics (Filmthemes)"],
[2001, "3:56", "20 Classics - Digitalaufnahmen Großer Klassischer Musik"],
[2000, "5:16", "Clásicos Populares"],
[1996, "3:28", "De Keuze Van Fred Brouwers"],
[1997, "3:50", "Schloßkonzert - Verzaubernde Melodien"],
[2011, "3:13", "Bach 101"],
[1996, "3:09", "Hall Of Fame"],
[2004, "2:59", "Cara Klara"],
[1998, "6:16", "Classical Peace"],
[2014, "15:07", "Two X Four"],
[1994, "19:55", "Brandenburg Concertos Nos. 1, 3 & 6 / Double Concerto For 2 Violins"],
[1985, "8:53", "Plays/Spielt/Joue Bach - Mozart - Lalo - Sarasate"],
[2010, "14:35", "Double Concertos: Concerto For Two Violins / Sinfonia Concertante / Concerto For Violin And Cello"],
[2010, "14:35", "Double Concertos: Concerto For Two Violins / Sinfonia Concertante / Concerto For Violin And Cello"],
[2014, "15:32", "Violinkonzerte · Violin Concertos / Violinromanzen · Violin Romances"],
[2002, "2:37", "Les Plus Beaux Concertos"],
[2007, "8:45", "Best Of Bach"],
[2001, "6:54", "Pesti"],
[2002, "7:54", "Adagios, Romantic Dreams Of Exquisite Beauty"],
[2009, "10:54", "The great violin concertos"],
[2011, "6:26", "Bach Essential"],
[1976, "14:41", "Concert Of The Century"],
[2016, "49:54", "The Historic Recordings"],
[2008, "72:59", "101 Classics The Best Loved Classical Melodies"],
[2014, "4:52", "'Channel Family Of Artists'"],
[2017, "26:38", "The Brandenburg Concertos. Suites Nos. 2 & 3"],
[1994, "14:38", "Concerti"],
[2009, "13:08", "The Daniel Hope Collection"],
[1992, "7:06", "The Collection"],
[2006, "75:54", "100 Meisterwerke Der Barockmusik"],
[2008, "22:12", "The Essential Isaac Stern"],
[1998, "15:32", "Vol. 2: Paris, 1929-1932"],
[1995, "1:49", "Cinema Classics"],
[1987, "3:53", "Presentation '87"],
[1997, "8:23", "The Best Of Bach (1685 - 1750)"],
[1994, "3:39", "Largo"],
[2001, "4:09", "20 Relaxing Classics"],
[2003, "77:50", "Your Hundred Best Tunes - The Nation's Favourite Classical Music"],
[2011, "3:56", "Greatest Hits In Classical Music"],
[1997, "10:05", "Bach With Ocean Sounds / Air - Classical Inspirations"],
[2012, "7:03", "Purple Monkey Brain Tunes"],
[2017, "2:05", " The Best Synthesizer Classics Album In The World Ever! Episode II The Synth Strikes Back"],
[2016, "17:04", "1960s/4"],
[2008, "2:39", "Myleene's Music For Mothers"],
[2008, "15:58", "The Original Jacket Collection"],
[2008, "54:09", "Zeitreise Durch Die Musik"],
[1996, "3:09", "Hall Of Fame"],
[2017, "28:23", "The Complete HMV & Telefunken Recordings"]
]


var w = 1800;
var h = 900;

function timeToFloat(time) {
    var values = time.split(":");
    var total = parseFloat(values[0]);
    total += parseFloat(values[1]) / 60.0;
    return total;
}


//Create SVG element
var svg = d3.select("body")
    .append("svg")
    .attr("width", w)
    .attr("height", h);

var xScale = d3.scaleLinear()
    .domain([
        d3.min(dataset, function(d) { return d[0]; }) - 10, 
        d3.max(dataset, function(d) { return d[0]; }) + 10
    ])
    .range([0, w]);


var yScale = d3.scaleLinear()
    .domain([
        d3.max(dataset, function(d) { return timeToFloat(d[1]); }) + 1,
        d3.min(dataset, function(d) { return timeToFloat(d[1]); }) - 1
    ])
    .range([0, h])

svg.selectAll("circle")
    .data(dataset)
    .enter()
    .append("circle")
    .attr("cx", function(d) {
        return xScale(d[0]);
    })
    .attr("cy", function(d) {
        return yScale(timeToFloat(d[1]));
    })
    .attr("r", 5);

svg.selectAll("text")
    .data(dataset)
    .enter()
    .append("text")
    .text(function(d) {
        return d[1];
         return d[2] + " (" + d[0] + " - " + d[1] + ")";
    })
    .attr("x", function(d) {
         return xScale(d[0]);
    })
    .attr("y", function(d) {
         return yScale(timeToFloat(d[1]));
    })
    .attr("font-family", "sans-serif")
    .attr("font-size", "11px")
    .attr("fill", "red");
 
// Add scales to axis
var x_axis = d3.axisBottom()
    .scale(xScale)
    .ticks(15);

var y_axis = d3.axisRight()
    .scale(yScale)
    .ticks(10)

//Append group and insert axis
svg.append("g")
    .attr("transform", "translate(10, "  + (h - 20) + ")")
    .call(x_axis);

    svg.append("g")
    .attr("transform", "translate(10, 20)")
    .call(y_axis);