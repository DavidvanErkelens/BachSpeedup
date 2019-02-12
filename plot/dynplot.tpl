var dataset = {$data|@json_encode}

// Set:
// 0: year
// 1: dur string
// 2: dur float
// 3: title

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
        d3.max(dataset, function(d) { return d[2]; }) + 1,
        d3.min(dataset, function(d) { return d[2]; }) - 1
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
        return yScale(d[2]);
    })
    .attr("r", 5);

svg.selectAll("text")
    .data(dataset)
    .enter()
    .append("text")
    .text(function(d) {
        // return d[1];
        return "(" + d[0] + " - " + d[1] + ")";
        //  return d[3] + " (" + d[0] + " - " + d[1] + ")";
    })
    .attr("x", function(d) {
         return xScale(d[0]);
    })
    .attr("y", function(d) {
         return yScale(d[2]);
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