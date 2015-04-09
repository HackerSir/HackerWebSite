var ref$, map, max, API_URL, graphOptions, template, datas, charts, makeChart, updateCharts, fetchBooth, fetchVotes, intervalHandle, setBooth;
ref$ = require('prelude-ls'), map = ref$.map, max = ref$.max;
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
datas = [];
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
  var i$, to$, i, ctx, votesData, results$ = [];
  for (i$ = 0, to$ = max(charts, data.votes.length) - 1; i$ < to$; ++i$) {
    i = i$;
    ctx = charts[i];
    votesData = data.votes[i];
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
intervalHandle = null;
setBooth = function(path){
  return fetchVotes(path, function(votesData){
    var res$, i$, ref$, len$, d;
    $('#booth-name').text(votesData.name);
    if (path === '') {
      $('#canvases').removeClass('canvases');
      $('#video-column').addClass('hide');
      $('#votes-column').removeClass('col-md-4');
      $('#embed-video').attr('src', null);
    } else {
      $('#canvases').addClass('canvases');
      $('#video-column').removeClass('hide');
      $('#votes-column').addClass('col-md-4');
      $('#embed-video').attr('src', votesData.url);
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
    return intervalHandle = setInterval(function(){
      return fetchVotes(path, updateCharts);
    }, 30000);
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
      $(a).text(b + "");
      a.onclick = onclick(i);
      li.appendChild(a);
      document.querySelector('#booths').appendChild(li);
    }
    return setBooth('/0');
  });
};
