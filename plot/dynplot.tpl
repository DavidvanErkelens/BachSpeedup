var dataset = {$data|@json_encode}
var regression = {$regression|@json_encode}

var minyear = d3.min(dataset, function(d) { return d.year; });
var maxyear = d3.max(dataset, function(d) { return d.year; });

var startvalue = regression['intercept'] + (minyear * regression['slope']);
var endvalue = regression['intercept'] + (maxyear * regression['slope']);


var w = 1800;
var h = 900;



//Create SVG element
var svg = d3.select("body")
    .append("svg")
    .attr("width", w)
    .attr("height", h);

var xScale = d3.scaleLinear()
    .domain([
        d3.min(dataset, function(d) { return d.year; }) - 10, 
        d3.max(dataset, function(d) { return d.year; }) + 10
    ])
    .range([0, w]);


var yScale = d3.scaleLinear()
    .domain([
        d3.max(dataset, function(d) { return d.duration; }) + 1,
        d3.min(dataset, function(d) { return d.duration; }) - 1
    ])
    .range([0, h])

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
var x_axis = d3.axisBottom()
    .scale(xScale)
    .ticks(15);

var y_axis = d3.axisRight()
    .scale(yScale)
    .ticks(10)

svg.append("line")
    .attr("x1", xScale(minyear))
    .attr("x2", xScale(maxyear))
    .attr("y1", yScale(startvalue))
    .attr("y2", yScale(endvalue))
    .attr("stroke-width", 1)
    .attr("stroke", "black");


//Append group and insert axis
svg.append("g")
    .attr("transform", "translate(10, "  + (h - 20) + ")")
    .call(x_axis);

    svg.append("g")
    .attr("transform", "translate(10, 20)")
    .call(y_axis);


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