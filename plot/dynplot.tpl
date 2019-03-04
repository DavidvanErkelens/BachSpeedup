var dataset = {$data|@json_encode}
var regression = {$regression|@json_encode}

var minyear = d3.min(dataset, function(d) { return d.year; });
var maxyear = d3.max(dataset, function(d) { return d.year; });

var startvalue = regression['intercept'] + (minyear * regression['slope']);
var endvalue = regression['intercept'] + (maxyear * regression['slope']);


var windowwidth = window.innerWidth;
var windowheight = window.innerHeight;

var marginwidth = 50;
var marginheight = 50;

var w = windowwidth - (2 * marginwidth);
var h = windowheight - (2 * marginheight);


//Create SVG element
var svg = d3.select("body")
    .append("svg")
    .attr("width", w)
    .attr("height", h);


var xScale = d3.scaleLinear()
    .domain([
        d3.min(dataset, function(d) { return d.year; }) - 5, 
        d3.max(dataset, function(d) { return d.year; }) + 5
    ])
    .range([marginwidth, w - marginwidth]);


var yScale = d3.scaleLinear()
    .domain([
        d3.max(dataset, function(d) { return d.duration; }) + 1,
        d3.min(dataset, function(d) { return d.duration; }) - 1
    ])
    .range([marginheight, h - marginheight])

svg.selectAll("circle")
    .data(dataset)
    .enter()
    .append("circle")
    .attr("cx", function(d) {
        return xScale(d.year);
    })
    .attr("cy", function(d) {
        return yScale(d.duration);
    })
    .attr("r", 5)
    .attr("fill", function(d) {
        return d.color;
    })
    .attr("stroke", "black")
    .on("mouseover", handleMouseOver);

// Add scales to axis
var x_axis = d3.axisTop()
    .scale(xScale)
    .ticks(15, "d");

var y_axis = d3.axisRight()
    .scale(yScale)
    .ticks(10)
    .tickFormat(d => d + ":00");

svg.append("line")
    .attr("x1", xScale(minyear))
    .attr("x2", xScale(maxyear))
    .attr("y1", yScale(startvalue))
    .attr("y2", yScale(endvalue))
    .attr("stroke-width", 1)
    .attr("stroke", "black");


//Append group and insert axis
svg.append("g")
    .attr("transform", "translate(0, "  + (h - marginheight) + ")")
    .call(x_axis);

    svg.append("g")
    .attr("transform", "translate(" + marginwidth + ", 0)")
    .call(y_axis);


svg.append("text")
      .attr("transform", "rotate(-90)")
      .attr("x", 0 - (h / 2))
      .attr("y", marginwidth / 2)
      .attr("dy", "1em")
      .style("text-anchor", "middle")
      .style("font-family", "Arial")
      .style("font-size", 12)
      .text("Total duration");

svg.append("text")
    .attr("x", w/2)
    .attr("y", h - (marginheight / 2 ))
    .attr("text-anchor", "middle")
    .style("text-anchor", "middle")
    .style("font-family", "Arial")
    .style("font-size", 12)
    .text("Year of release");


$( document ).ready(function() {
    $("h1#title").text("Work: {$work}");
});

// Create Event Handlers for mouse
function handleMouseOver(d, i) {  

    d3.select(".selected")
        .attr("r", 5)
        .classed("selected", false)

    var x = d3.select(this);

    x.attr("r", 10);
    x.classed("selected", true);

    var locx = xScale(d.year);
    var locy = yScale(d.duration);

    $("div#desc").html(d.infobox);
}