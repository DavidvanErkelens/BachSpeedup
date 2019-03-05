<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Bach: {$work}</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">

  </head>
  <body>
  <center><h1 id="title">Loading data for {$work}</h1></center>
  <div id="desc"></div>
  <div id="filter">
    <h3>Filters</h3>
    <div id="filter-country">
      <b>Country</b><br />
    </div>

    <button onClick="filter();">Filter</button>
  </div>
  </body>
  <script src="https://d3js.org/d3.v5.min.js"></script>
  <script src="https://d3js.org/d3-scale.v2.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="dynplot.php?work={$workid}"></script>
</html>