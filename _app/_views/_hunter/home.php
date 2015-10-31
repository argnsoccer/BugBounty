
<!DOCTYPE html>
<html>
  <head>
      <title>Welcome home</title>
      <link rel="stylesheet" type="text/css" href="../_css/home-hunter.css" />
  </head>
  <body>
    {{ include ('header_logout.php') }}
    <div id="content_area">
      <div id="display-boxes">
        <div class="display-box">
          <a href="/_hunter/discover.php">Discover</a>
          <p>Find hot young bugs in your local area</p>
        </div>
        <div class="display-box">
          <a href="/_hunter/hunt.php">Hunt</a>
          <p>Hunt the <i>hell</i> out of those bugs</p>
        </div>
        <div class="display-box" id="tricky_bugger">
          <a href="/_hunter/search.php">Search</a>
          <p>Has anyone really been far even as decided to use even go want to do look more like?  We'll find out this Sunday.</p>
        </div>
      </div>
      <a id="prof_link" href="_hunter/profile/{{username}}">Link to Profile Page</a>
    </div>
    
  </body>
</html>
