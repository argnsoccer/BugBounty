<!-- <div class="navbar navbar-default" id="navBarCustom">

    <div class="navbar-header">
      <a class="navbar-brand">
        <img id="navbarLogo" src="../_images/_logos/BugBountyTextLogo.png" alt="BugBounty"/>
      </a>
      <ul class="nav navbar-nav">
        <li class="leftNav"><a href="/">Home</a></li>
        <li class="leftNav"><a href="/why">Why Us</a></li>
        <li class="leftNav"><a href="/about">About</a></li>
        <li class="leftNav"><a href="/contact">Contact</a></li>
      </ul>
    </div>

    <div class="navbar-collapse navbar-header collapse navbar-right">
      <a class="dropdown btn btn-success rightNavBar" href="#" data-toggle="dropdown" id="navLogin">Login</a>
      <a class="dropdown btn btn-secondary rightNavBar" href="#" data-toggle="dropdown" id="navsSignUp">Sign Up</a>

      <div class="dropdown-menu nav navbar-nav" id="navBarDropDown">
        <form id="login" name="loginForm" method="post">
          <input class="loginForm" type="text" name="username" placeholder="Username" id="usernameLogin"/>
          <input class="loginForm" type="password" name="password" placeholder="Password" id="passLogin"/>
          <button type="submit" class="btn btn-success" id="submitLogin">Log In</button>
          <input class="headerInput" type="submit" value="Log In" id="submitLogin" />
        </form>
      </div>

    </div>

  </div> -->

<nav class="navbar navbar-inverse navbar-fixed-top">
  <a class="navbar-brand">
    <img id="navbarLogo" src="../_images/_logos/BugBountyTextLogo.png" alt="BugBounty"/>
  </a>
  <ul class="nav navbar-nav navbar-left">
    <li class="leftNav"><a href="/">Home</a></li>
    <li class="leftNav"><a href="/why">Why Us</a></li>
    <li class="leftNav"><a href="/about">About</a></li>
    <li class="leftNav"><a href="/contact">Contact</a></li>
  </ul>
  <ul class="nav navbar-nav navbar-right">

    <a class="dropdown-toggle btn btn-success rightButton" href="#" data-toggle="dropdown" id="navLogin">Login</a>

    <div class="dropdown-menu nav navbar-nav" id="navBarDropDown">
      <form id="login" name="loginForm" method="post">
        <input class="loginForm" type="text" name="username" placeholder="Username" id="usernameLogin"/>
        <input class="loginForm" type="password" name="password" placeholder="Password" id="passLogin"/>
        <button type="submit" class="btn btn-success" id="submitLogin">Log In</button>
      </form>
    </div>

    <div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle rightButton endButton" data-toggle="dropdown"
    aria-haspopup="true" aria-expanded="false">Sign Up <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a href="/signup">As a Hunter</a></li>
      <li><a href="/signup">As a Marshal</a></li>
      <li role="separator" class="divider"></li>
      <li><a href="/why">I'm Not Sure</a></li>
    </ul>
  </div>


  </ul>

</nav>
