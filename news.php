<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="utf-8" />
      <meta name="format-detection" content="telephone=no" />
      <meta name="msapplication-tap-highlight" content="no" />
      <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width" />
      <!-- This is a wide open CSP declaration. To lock this down for production, see below. -->
      <meta http-equiv="Content-Security-Policy" content="default-src gap://ready file://* *; style-src 'self' http://* https://* 'unsafe-inline'; script-src 'self' http://* https://* 'unsafe-inline' 'unsafe-eval'">
      <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
      <link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
      <link rel="stylesheet" type="text/css" href="css/index.css" />
</head>

<body>

  <div class="container-fluid">
    <div id="mbtloading1" ></div>
    <script type="text/javascript">
    var ListBlogLink = window.location.hostname;
    var ListCount = 150;
    var ChrCount = 150;
    var TitleCount = 100;
    var ImageSize = 320;
    function mbtlist(json) {
    for (var i = 0; i < ListCount; i++)
    {
    var listing= ListImage = ListUrl = ListTitle = ListImage = ListContent = ListConten = ListAuthor = ListTag = ListDate = ListUpdate = ListComments = thumbUrl = TotalPosts = sk = ListMonth = Y = D = M = m = YY = DD = MM = mm = TT =  "";
    if (json.feed.entry[i].category != null)
    {
    for (var k = 0; k < json.feed.entry[i].category.length; k++) {
        ListTag += json.feed.entry[i].category[k].term;
    if(k < json.feed.entry[i].category.length-1)
    { ListTag += ", ";}
    }
    }
    for (var j = 0; j < json.feed.entry[i].link.length; j++) {
          if (json.feed.entry[i].link[j].rel == 'alternate') {
            break;
          }
        }
    ListUrl= "'" + json.feed.entry[i].link[j].href + "'";
    TotalPosts = json.feed.openSearch$totalResults.$t;
    if (json.feed.entry[i].title!= null)
    {ListTitle= json.feed.entry[i].title.$t.substr(0, TitleCount);}
    if (json.feed.entry[i].thr$total)
    {ListComments= json.feed.entry[i].thr$total.$t;}
    ListAuthor= json.feed.entry[i].author[0].name.$t.split(" ");
    ListAuthor=ListAuthor.slice(0, 1).join(" ");
    ListConten = json.feed.entry[i].content.$t;
    ListContent= ListConten.replace(/(<([^>]+)>)/ig,"").substring(0, ChrCount);
    ListMonth= ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    ListDate= json.feed.entry[i].published.$t.substring(0,10);
                             Y = ListDate.substring(0, 4);
                            m = ListDate.substring(5, 7);
                             D = ListDate.substring(8, 10);
                             M = ListMonth[parseInt(m - 1)];
    ListUpdate= json.feed.entry[i].updated.$t.substring(0, 16);
                             YY = ListUpdate.substring(0, 4);
                            mm = ListUpdate.substring(5, 7);
                             DD = ListUpdate.substring(8, 10);
                             TT = ListUpdate.substring(11, 16);
                             MM = ListMonth[parseInt(mm - 1)];
    if (json.feed.entry[i].content.$t.match(/youtube\.com.*(\?v=|\/embed\/)(.{11})/) != null)
    {var youtube_id = json.feed.entry[i].content.$t.match(/youtube\.com.*(\?v=|\/embed\/)(.{11})/).pop();
        if (youtube_id.length == 11) {
            var ListImage = "'//img.youtube.com/vi/"+youtube_id+"/0.jpg'";
            }
    }
    else if (json.feed.entry[i].media$thumbnail)
    {thumbUrl = json.feed.entry[i].media$thumbnail.url;
    sk= thumbUrl.replace("/s72-c/","/s"+ImageSize+"/");
    ListImage= "'" + sk.replace("?imgmax=800","") + "'";}
    else if (json.feed.entry[i].content.$t.match(/src=(.+?[\.jpg|\.gif|\.png]")/) != null)
    {ListImage =  json.feed.entry[i].content.$t.match(/src=(.+?[\.jpg|\.gif|\.png]")/)[1];}
    else
    {ListImage= "'http://4.bp.blogspot.com/-HALLtgFeep0/VfryhQ0C5oI/AAAAAAAAPcY/77mSGND4q84/s200/Icon.png'";}
    var listing =
    "<img src="+ListImage+"/>" +
    "<h5>"+ ListTitle+"</h5>";
    document.write('<div class="card"><img src='+ListImage+' class="card-img-top" />' + '<h5 class="card-footer">' + ListTitle +'</h5></div>' );}}
    </script>
    <script>
    var ListBlogLink = "https://dhdfarm.blogspot.com";
    var ListCount = 150;
    </script>
    <script>
    document.write("<script src='"+ListBlogLink+"/feeds/posts/default?max-results=1500&alt=json-in-script&callback=mbtlist'></"+"script>");
    </script>
    <script>document.getElementById("mbtloading1").style.display = "none";</script>

  </div>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>
