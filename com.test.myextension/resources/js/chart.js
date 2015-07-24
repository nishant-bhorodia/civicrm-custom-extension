function createChart(jdata) {

    data = jdata;

    margin = {top: 20, right: 20, bottom: 70, left: 40},
    width = 600 - margin.left - margin.right,
            height = 300 - margin.top - margin.bottom,
            parseDate = d3.time.format("%Y-%m-%d %H:%M:%S").parse;

    x = d3.scale.ordinal().rangeRoundBands([0, width], .05),
            y = d3.scale.linear().range([height, 0]),
            xAxis = d3.svg.axis()
            .scale(x)
            .orient("bottom")
            .tickFormat(d3.time.format("%d-%m-%Y")),
            yAxis = d3.svg.axis()
            .scale(y)
            .orient("left")
            .ticks(5),
            svg = d3.select("#chart").append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
            .append("g")
            .attr("transform", "translate(" + margin.left + "," + margin.top + ")");


    data.forEach(function (d) {
        d.receive_date = parseDate(d.receive_date);
        d.net_amount = +d.net_amount;
    });

    x.domain(data.map(function (d) {
        return d.receive_date;
    }));
    y.domain([0, d3.max(data, function (d) {
            return d.net_amount;
        })]);

    svg.append("g")
            .attr("class", "x axis")
            .attr("transform", "translate(0," + height + ")")
            .call(xAxis)
            .selectAll("text")
            .style("text-anchor", "end")
            .attr("dx", "-.8em")
            .attr("dy", "-.55em")
            .attr("transform", "rotate(-90)");

    svg.append("g")
            .attr("class", "y axis")
            .call(yAxis)
            .append("text")
            .attr("transform", "rotate(-90)")
            .attr("y", 6)
            .attr("dy", ".71em")
            .style("text-anchor", "end")
            .text("Value ($)");

    svg.selectAll("bar")
            .data(data)
            .enter().append("rect")
            .style("fill", "steelblue")
            .attr("x", function (d) {
                return x(d.receive_date);
            })
            .attr("width", x.rangeBand())
            .attr("y", function (d) {
                return y(d.net_amount);
            })
            .attr("height", function (d) {
                return height - y(d.net_amount);
            });

}