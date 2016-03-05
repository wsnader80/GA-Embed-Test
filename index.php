<html>
<head>
<title>Ignite Embed API</title>
<!-- Include Chart.js graphing library and Moment.js to do date
     formatting and manipulation. -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>

<!-- Promises PolyFill -->
<script src="/js/Promise.min.js"></script>

<!-- Include the ViewSelector2 component script. -->
<!-- <script src="/public/javascript/embed-api/components/view-selector2.js"></script> -->

<!-- Include the DateRangeSelector component script. -->
<!-- <script src="/public/javascript/embed-api/components/date-range-selector.js"></script> -->

<!-- Include the ActiveUsers component script. -->
<!-- <script src="/public/javascript/embed-api/components/active-users.js"></script> -->
</head>
<body>

<script>
(function(w,d,s,g,js,fs){
  g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(f){this.q.push(f);}};
  js=d.createElement(s);fs=d.getElementsByTagName(s)[0];
  js.src='https://apis.google.com/js/platform.js';
  fs.parentNode.insertBefore(js,fs);js.onload=function(){g.load('analytics');};
}(window,document,'script'));
</script>

<div id="embed-api-auth-container"></div>
<div id="view-selector"></div>
<div id="timeline"></div>


<script>

gapi.analytics.ready(function() {

  // Step 3: Authorize the user.

  var CLIENT_ID = '701122090402-r3p77q8inoa3289o5u7e67sgita8tqi5.apps.googleusercontent.com';

  gapi.analytics.auth.authorize({
    container: 'embed-api-auth-container',
    clientid: CLIENT_ID,
  });

  // Step 4: Create the view selector.

  var viewSelector = new gapi.analytics.ViewSelector({
    container: 'view-selector'
  });

  // Step 5: Create the timeline chart.

  var timeline = new gapi.analytics.googleCharts.DataChart({
    reportType: 'ga',
    query: {
      'dimensions': 'ga:date',
      'metrics': 'ga:sessions',
      'start-date': '30daysAgo',
      'end-date': 'yesterday',
    },
    chart: {
      type: 'LINE',
      container: 'timeline'
    }
  });

  // Step 6: Hook up the components to work together.

  gapi.analytics.auth.on('success', function(response) {
    viewSelector.execute();
  });

  viewSelector.on('change', function(ids) {
    var newIds = {
      query: {
        ids: ids
      }
    }
    timeline.set(newIds).execute();
  });
});
</script>

</body>
</html>