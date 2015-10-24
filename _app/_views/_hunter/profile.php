<!DOCTYPE html>
<html>
<head>
    <title>Edit profile</title>
    <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
    <link rel="stylesheet" type="text/css" href="../_css/hunter-profile.css" />
</head>
<body>
    <div id="navBar">
        <img id="navbarLogo" src="../_images/_logos/BugBountyTextLogo.png" alt="BugBounty Logo" />
        <ul>
            <li class="leftNav"><a href="index.html">Home</a></li>
            <li class="leftNav"><a href="contact.html">Contact</a></li>
            <li class="leftNav"><a href="about.html">About</a></li>
        </ul>
        <div id="loginContainer">
            <form id="loginForm" name="loginForm" method="post">
                <input class="loginField" type="text" name="username" placeholder="Username">
                <input class="loginField" type="password" name="password" placeholder="Password">
                <input class="loginField" type="submit" value="Log In" id="submitButton">
            </form>
            <button id="logOut">Log Out</button>
        </div>
    </div>
    <h1>Edit Your Profile</h1>
    <div id="content_area">
        <form>
            <div id="picture_upload">
                <img id="profile_picture" src="../_images/_random/dan-aykroyd.jpg" alt="Profile Picture" />
                <input type="file" name="profilePicture" />
            </div>
            <div id="profile_info">
                <input type="text" placeholder="Username" />
                <input type="password" placeholder="Old Password" />
                <input type="text" placeholder="New Password" />
                <input type="text" placeholder="Confirm New Password" />
                <input type="submit" value="Save" />
            </div>
        </form>
    </div>
    
</body>
</html>