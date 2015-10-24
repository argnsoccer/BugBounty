<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../_images/_logos/bug-hunter-icon.ico" />
    <link rel="stylesheet" type="text/css" href="../../_css/marshall-profile.css" />
</head>
<body>
    <div id="navBar">
        <div id="loginContainer">
            <form id="loginForm" name="loginForm" method="post">
                <input class="loginField" type="text" name="username" placeholder="Username" />
                <input class="loginField" type="password" name="password" placeholder="Password" />
                <input class="loginField" type="submit" value="Log In" id="submitButton" />
                <a id="profile_link" href="marshall-profile.html">My Profile</a>
            </form>
            <button id="logOut">Log Out</button>
        </div>
        <a href="index.html"><img id="navbarLogo" src="../_images/_logos/BugBountyTextLogo.png" alt="BugBounty Logo" /></a>
        <ul>
            <li class="leftNav"><a href="contact.html">Contact</a></li>
            <li class="leftNav"><a href="about.html">About</a></li>
        </ul>
    </div>
    <h1>Your Profile</h1>
    <div id="content_area">
        <h2>Current Bounties</h2>
        <div id="current_bounties">
            <div class="bounty">
                <p>This bounty is a test</p>
                <img id="severity" />
            </div>
            <div class="bounty">
                <p>This bounty is a test</p>
                <img id="severity" />
            </div>
            <div class="bounty">
                <p>This bounty is a test</p>
                <img id="severity" />
            </div>
            <div class="bounty">
                <p>This bounty is a test</p>
                <img id="severity" />
            </div>
            <div class="bounty">
                <p>This bounty is a test</p>
                <img id="severity" />
            </div>
            <div class="bounty">
                <p>This bounty is a test</p>
                <img id="severity" />
            </div>
            <div class="bounty">
                <p>This bounty is a test</p>
                <img id="severity" />
            </div>
            <div class="bounty">
                <p>This bounty is a test</p>
                <img id="severity" />
            </div>
            <div class="bounty">
                <p>This bounty is a test</p>
                <img id="severity" />
            </div>

        </div>
        <h2>Edit Your Profile</h2>
        <form>
            <div id="picture_upload">
                <img id="profile_picture" src="../_images/_random/dan-aykroyd.jpg" alt="Profile Picture" />
                <input type="file" name="profilePicture" />
            </div>
            <div id="profile_info">
                <input type="text" placeholder="Company Name" />
                <input type="password" placeholder="Old Password" />
                <input type="password" placeholder="New Password" />
                <input type="password" placeholder="Confirm New Password" />
            </div>

            <div id="bio_area">
                <h4>Bio</h4>
                <textarea rows="4" cols="90">Tell us about yourself.</textarea>
                <input id="save_button" type="submit" value="Save" />
            </div>
        </form>
        <h2 id="payments_header">Past Payments</h2>
        <div id="past_payments">
        </div>
    </div>

</body>
</html>