<!DOCTYPE html>
<html>
<head>
    <title>"BugBounty Why"</title>
    <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
    <link rel="stylesheet" type="text/css" href="/../_css/header.css">
    <link rel="stylesheet" type="text/css" href="/../_css/default.css">
<!--     <link rel="stylesheet" type="text/css" href="/../_css/why.css"> -->

    {{include ('bootstrap_header.php')}}
</head>

<body>

{% if username and userType == "hunter" %}
  {{ include ('header_hunter.php') }}
{% elseif  username and userType == "marshal" %}
  {{ include ('header_marshal.php') }}
{% else %}
  {{ include ('header_login.php') }}
{% endif %}

  <h1 id="main_header">Why Use Bug Bounty</h1>

  <a class="btn btn-info" href="https://drive.google.com/file/d/0BxyczaPPtz8xUE5zOWxMTWJnT00/view?usp=sharing">Initial Development Plan</a>
  <a class=" btn btn-info" href="https://drive.google.com/folderview?id=0B9Kvk0vZ8r1wNGRSZEJ1bllvYjg&usp=sharing">Technical Design Documents</a>

  <p>
      Like many development processes, BugBounty's end state is different from its initial planned form.
      <br />The main features that we cut from the final release are the recommendation engine, the rankings system, and the messaging system. However, didn't just subtract functionality! We also added an RSS feed system.
  </p>
  <p>
      We encountered a plethora of technical difficulties on our road to completion of this project. These include, but are in no way limited to, the following:
  </p>
  <ul>
      <li>
           Our database was initially poorly conceived.
      </li>
      <li>
          We did not discover bootstrap until halfway through the project.
      </li>
      <li>
          Braintree was a very difficult API to understand.
      </li>
      <li>
          Getting Apache running with everyone was difficult.
      </li>
      <li>
          Setting up the model view controller introduced a lot of extra work.
      </li>
      <li>
          The spelling of marshal, ie marshal or marshall, caused a variety of website crashes and errors.
      </li>


  </ul>
  <h3>Featured Future Features</h3>
  <p>
      In the event that we develop this application beyond its current form, we wish to add the following:
  </p>
  <ul>
      <li>Production version of Braintree</li>
      <li>Messaging system</li>
      <li>Advanced Search System</li>
      <li>Recommendation System</li>
  </ul>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script type="text/javascript" src="/../_javascript/basic_search.js"></script>
  <script type="text/javascript" src="/../_javascript/login.js"></script>
  <script type="text/javascript" src="/../_javascript/logout.js"></script>
  {{include ('bootstrap_footer.php')}}

</body>
</html>
