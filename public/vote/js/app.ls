
data = {
    labels: ["一", "二"],
    datasets: [
        {
            fillColor: "rgba(220,220,220,0.5)",
            strokeColor: "rgba(220,220,220,0.8)",
            highlightFill: "rgba(220,220,220,0.75)",
            highlightStroke: "rgba(220,220,220,1)",
            data: [65, 100]
        }
    ]
};

json-data =
  JSON.parse '{"name":"總合計","url":"http://hackersir.info","votes":[{"name":"學生會會長","labels":[],"votes":[]}]}'

json-data-1 =
  name: '第一投票所'
  url: "//www.youtube.com/embed/ePbKGoIGAXY"
  votes:
    [
      { name: "會長", labels: ["不同意", "同意"], votes: [1,2] },
      { name: "經濟系議員", labels: ["不同意", "同意"], votes: [1,2] },
      { name: "土管系議員", labels: ["不同意", "同意"], votes: [1,2] },
      { name: "合經系議員", labels: ["不同意", "同意"], votes: [1,2] },
      { name: "國貌系議員", labels: ["不同意", "灣家阿幹", "2"], votes: [90,2, 0] }
    ]



graph-options = (title) ->
  graphTitle: title
  graphTitleFontColor: '#f2f2f2'
  annotateDisplay: true
  annotateLabel: '<%=v2%>：<%=v3%>票'
  graphMin: 0
  scaleFontColor: '#fff'
  responsive: false

old =
        fillColor: "rgba(151,187,205,0.5)"
        strokeColor: "rgba(151,187,205,0.8)"
        highlightFill: "rgba(151,187,205,0.75)"
        highlightStroke: "rgba(151,187,205,1)"

template = (data) ->
  {
    labels: data.labels
    datasets: [
      {
        fillColor: '#99bce2'
        strokeColor: "rgba(151,187,205,0.8)"
        highlightFill: '#99bce2'
        highlightStroke: "rgba(151,187,205,1)"
        data: data.votes
      }
    ]
  }

make-chart = (data) ->

  canvas = document.create-element "canvas"
            ..set-attribute "height", "150"
  document .querySelector \#canvases .append-child canvas
  new Chart(canvas.get-context \2d).HorizontalBar (template data), (graph-options data.name)
  canvas.get-context \2d

charts = []

add = !->
  #  document.charts[0].datasets[0].bars[0].value += 10
  #  document.charts[0].update!
  for i from 0 til json-data.votes.length
    ctx = document.charts[i]
    data = json-data.votes[i]
    data.votes[0] += 1
    updateChart ctx, (template data), (graph-options data.name), true, true

window.onload = !->
  #Chart.defaults.global.scaleFontColor = '#fff'
  document.add = add
  # document.querySelector \#canvases .style.height = "#{window.inner-height*0.95}px"
  document.charts = [ make-chart d for d in json-data.votes ]
