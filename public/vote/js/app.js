var ref$, map, zip, API_URL, graphOptions, template, charts, makeChart, updateCharts, fetchBooth, fetchVotes, currentBooth, intervalHandle, setBooth;
ref$ = require('prelude-ls'), map = ref$.map, zip = ref$.zip;
API_URL = '../vote-api';
graphOptions = function(title){
  return {
    graphTitle: title,
    graphTitleFontColor: '#f2f2f2',
    annotateDisplay: true,
    annotateLabel: '<%=v2%>：<%=v3%>票',
    graphMin: 0,
    scaleFontColor: '#fff',
    responsive: false
  };
};
template = function(data){
  return {
    labels: data.labels,
    datasets: [{
      fillColor: '#99bce2',
      strokeColor: "rgba(151,187,205,0.8)",
      highlightFill: '#99bce2',
      highlightStroke: "rgba(151,187,205,1)",
      data: data.votes
    }]
  };
};
charts = [];
makeChart = function(data){
  var x$, canvas;
  x$ = canvas = document.createElement("canvas");
  x$.setAttribute("height", "150");
  document.querySelector('#canvases').appendChild(canvas);
  new Chart(canvas.getContext('2d')).HorizontalBar(template(data), graphOptions(data.name));
  return canvas.getContext('2d');
};
updateCharts = function(data){
  var i$, ref$, len$, ref1$, ctx, votesData, results$ = [];
  for (i$ = 0, len$ = (ref$ = zip(charts, data.votes)).length; i$ < len$; ++i$) {
    ref1$ = ref$[i$], ctx = ref1$[0], votesData = ref1$[1];
    results$.push(updateChart(ctx, template(votesData), graphOptions(votesData.name), true, true));
  }
  return results$;
};
fetchBooth = function(cb){
  return $.get(API_URL + "/booth", cb);
};
fetchVotes = function(id, cb){
  return $.get(API_URL + "/votes" + id, cb);
};
currentBooth = "/0";
intervalHandle = null;
setBooth = function(path){
  return fetchVotes(path, function(votesData){
    var res$, i$, ref$, len$, d;
    $('#booth-name').text(votesData.name);
    $('#embed-video').attr('src', votesData.url);
    if (path === '') {
      $('#canvases').removeClass('canvases');
      $('#video-column').addClass('hide');
      $('#votes-column').removeClass('col-md-4');
    } else {
      $('#canvases').addClass('canvases');
      $('#video-column').removeClass('hide');
      $('#votes-column').addClass('col-md-4');
    }
    if (charts.length === 0) {
      res$ = [];
      for (i$ = 0, len$ = (ref$ = votesData.votes).length; i$ < len$; ++i$) {
        d = ref$[i$];
        res$.push(makeChart(d));
      }
      charts = res$;
    } else {
      updateCharts(votesData);
    }
    if (intervalHandle !== null) {
      clearInterval(intervalHandle);
    }
    intervalHandle = setInterval(function(){
      return fetchVotes(path, updateCharts);
    }, 30000);
    return console.log(intervalHandle);
  });
};
window.onload = function(){
  var onclick;
  onclick = function(i){
    return function(){
      setBooth("/" + i);
    };
  };
  fetchBooth(function(booth){
    var i, b, li, a;
    for (i in booth) {
      b = booth[i];
      console.log(i, b);
      li = document.createElement('li');
      a = document.createElement('a');
      a.href = '#';
      a.innerText = b;
      a.onclick = onclick(i);
      li.appendChild(a);
      document.querySelector('#booths').appendChild(li);
    }
    return setBooth('/0');
  });
};
