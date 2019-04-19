
    function randchart_draw(nbmonths=12) {
    // console.log(nbmonths);
    var url = window.location.origin + '/public/api/randchart_getjson.php?nb_month=' + nbmonths;

    console.log(url);
    $.ajax({
    url: url,
    method: "GET",
    success: function(data) {

    // console.log(data);
    var month = [];
    var temp = [];

    $(jQuery.parseJSON(data)).each(function() {
    month.push(this.month);
    temp.push(this.temp);
});

    var chartdata = {
    labels: month,
    datasets : [
{
    label: 'Temperatures',
    fill: false,
    backgroundColor: 'rgba(254, 62, 35, 0.5)',
    borderColor: 'rgba(254, 62, 35, 0.5)',
    data: temp
}
    ]
};

    document.getElementById("randchart_container_id").innerHTML = '&nbsp;';
    document.getElementById("randchart_container_id").innerHTML = '<canvas id="randchart_canvas_id"></canvas>';
    var ctx = document.getElementById("randchart_canvas_id").getContext("2d");
    var barGraph = new Chart(ctx, {
    type: 'line',
    data: chartdata
});

},
    error: function(data) {
    console.log(data);
}
});
};
