<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Bach: {$work}</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
  <h1 id="title">Loading data for {$work}</h1>
  <div id="desc"></div>
  </body>
  <script src="https://d3js.org/d3.v5.min.js"></script>
  <script src="https://d3js.org/d3-scale.v2.min.js"></script>
  <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>


  <script src="dynplot.php?work={$workid}"></script>
</html>