<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../_images/_logos/bug-hunter-icon.ico" />
    <link rel="stylesheet" type="text/css" href="../../_css/marshall-profile.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>

    {{include ('header_logout.php')}}

    <h1>{{username}}'s' Profile</h1>
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
                <img id="profile_picture" src="../../_images/_profiles/_{{username}}/{{username}}_profile.png" />
                <input type="file" name="profilePicture" />
            </div>
            <div id="profile_info">
                <input type="text" placeholder="{{username}}" />
                <input type="text" placeholder="{{email}}" />
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