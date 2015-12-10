<div class="navbar navbar-inverse navbar-fixed-top">

  <div class="navbar-header">
    <a class="navbar-brand">
      <img id="navbarLogo" src="/_images/_logos/BugBountyTextLogo.png" alt="BugBounty"/>
    </a>
    <ul class="nav navbar-nav">
      <li class="leftNav"><a href="/">Home</a></li>
      <li class="leftNav"><a href="/_hunter/discover">Discover</a></li>
      <li class="leftNav"><a href="/why">Why Us</a></li>
      <li class="leftNav"><a href="/about">About</a></li>
      <li class="leftNav"><a href="/contact">Contact</a></li>
      <li class="leftNav">
         <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" id="searchText" class="form-control" placeholder="Search for a Bounty!">
        </div>
        <button class="btn btn-default" type="submit" id="submitSearchForm" data-toggle="modal" 
          data-target="#basicSearchModal" data-whatever="@getbootstrap">
          Submit
        </button>
      </form>
    </li>
    </ul>

  </div>

  <div class="nav navbar-nav navbar-right">
    <button type="submit" id="submitProfile" class="btn btn-success rightButton">Profile</button>
    <button type="submit" class="btn btn-danger rightButton endButton" id="submitLogout" name="logoutForm" method="post">Log Out</button>
  </div>

</div>