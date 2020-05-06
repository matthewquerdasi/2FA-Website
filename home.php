<?php
    session_start();
    // SESSION CHECK //
    // check if session loggedIN id has been set and redirec to login if not //
    if ($_SESSION['loggedIN'] != '2') {
        header('Location: index.php');
        exit();
    }

?>

<!DOCTYPE html>
<html>
<head>
  <!-- Google analytics tracking tag -->
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-158867952-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-158867952-1');
  </script>

  <!-- title and styling -->
  <title>Home</title>
  <script src="js/main.js"></script>
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">

  <!-- favicon -->
  <link rel="icon" href="https://matthewquerdasi.com/2fa/images/2FA-favicon.jpg" type="image/jpg">
</head>

<body id="lite-blue">

<!-- MOBILE -->
<div id="mobile">
  <div class="dropdown" id="mobile">
    <button onclick="dropDown()" class="dropbtn" id="mobile">MENU</button>
    <div id="myDropdown" class="dropdown-content" id="mobile">
      <a href ="#title-blockm" id="mobile">About</a>
      <a href ="#sec1m" id="mobile">Research</a>
      <a href ="#sec2m" id="mobile">Data</a>
      <a href ="#sec3m" id="mobile">Full Paper</a>
      <a href="logout.php" id="mobile">Log Out</a>
    </div>
  </div>

  <div id="text-container">
    <div id="title-blockm">
      <h2> Phishing Attacks and 2FA:</br>Moving Towards a More Secure Authentication Infrastructure </h2>

      <p class="writeupm">
          In today’s modern world, Cyber Security is an ever-growing field that is constantly evolving. The proliferation of ways to share and store information online has created a veritable gold mine for cyber attacks and malicious activity. One of the newest and most popular developments in the cyber security field is two-factor authentication for password protection. In this study, we conducted interviews, sent out a survey to the Wesleyan community, and did some practical examination into two factor authentication.
      </p>

    </div>

    <div class="sec-container" id="sec1m">
      <img id="data-pic" src="data-1.png"></img>
    </div>

    <div class="sec-container" id="sec2m">
      <p class="writeupm">
          One of the primary types of cyber-attacks on the modern web is a phishing attack. Phishing is a type of social engineering attack, often used to steal login passwords, or credit card details. For our purposes, we will be discussing phishing attacks that are designed to glean login passwords, as this will allow us to discuss more fundamental issues with current methodologies for authenticating users. One of the most common phishing attacks are spoof emails. For instance, someone would receive an email stating that there is something wrong with their account, and that they should follow the attached link and log in. The link would lead to a fake login page, and when the victim logged in with their username and password, it would be recorded so that the attacker could use it to access the account at their leisure. There are countless variations on this attack but that is a general example, and we believe that it shows the problem with the traditional login structure. A stolen password means a stolen account.
      </p>
    </div>

    <div class="sec-container" id="sec3m">
      <p class="writeupm">
          Before moving on to our experimental findings, it is important to establish exactly what two factor authentication is. When one normally logs in to an online service, they are only required to enter a username (or email) and a password. This is considered single factor authentication. The problem with this, is that passwords are generally unreliable. People are tempted to use short passwords that they can easily remember, re-use passwords between sites, and write down passwords in places that may not be secure. All of these present vulnerabilities for information stored on password protected sites. One way to fight against this is to enforce strict password protocols (the National Institute of Standards and Technology have recently released a new set of such protocols). What we propose to be, and what we believe has shown to be, a better solution is to move towards multi factor authentication. This would mean that in order to log in with a given username, the user would be required to not only insert their password but also provide some secondary form of proof of account ownership. Some examples of a second factor are: a code provided through text/email/an app, some form of biometric data (fingerprint/face scan), a magnetic stripe card, etc. Requiring a password and one of these would be considered two factor authentication, which is what most sites have been moving towards. However, sites that require even more protection, most notably government sites, are moving towards three or more factors for authentication.
      </p>
    </div>

  </div>
</div>

<!-- DESKTOP -->
<div id="desktop">
  <div id="color-block-left">

        <h2 id="top-sec"> <a class="sec-scroll" href="#title-block"> About </a> </h2>

        <h2 class="sections"> <a class="sec-scroll" href ="#sec1"> Research </a> </h2>
        <h2 class="sections"> <a class="sec-scroll" href ="#sec2"> Data </a>  </h2>
        <h2 class="sections"> <a class="sec-scroll" href ="#sec3"> Website  </a>  </h2>
        <h2 class="sections"> <a class="sec-scroll" href ="#sec4"> Full Paper  </a>  </h2>
        <h2 class="sections"> <a class="sec-scroll" href ="https://github.com/matthewquerdasi/2FA-Website" target="_blank"> GitHub  </a>  </h2>

        <h2 class="sections"><a class="sec-scroll" id="log-out" href="logout.php">Log out</a> </h2>

        <!-- FOOTER  -->
        <div class="footer">
            <p id="footer-text">Created and maintained by <a class="sec-scroll" href="https://matthewquerdasi.com/" target="_blank"> Matthew Querdasi </a> and <a class="sec-scroll" href="https://samueldriver.com/" target="_blank"> Sam Driver </a></p>
        </div>
  </div>

  <div id="content-block-right">
      <div id="text-container">
        <div id="title-block">
          <h1 id="header-big"> Welcome! </h1>

          <p class="writeup">
              This site is a demonstration of what we have learned about phishing attacks and two factor authentication during the process of our final project for COMP360. As you can see from the login, we have implemented a rudimentary form of two-factor on this very website using the Google Authenticator library. Over the last several months, we have been collecting data from the greater Wesleyan community on their knowledge of, and attitudes towards cyber security, as well as doing independent research into the topic. On the rest of this page you will be able to read about our experimental findings, view some data visualizations, as well as download the full write-up of our findings. We hope you find this as illuminating as we did!
          </p>

        </div>

        <!-- RESEARCH -->
        <div class="sec-container" id="sec1">
          <h1 id="header-big"> Research </h1>
          <p class="writeup">
            Through a research questionnaire, we were able to learn a tremendous amount about the greater Wesleyan populations attitudes towards and knowledge of cyber security. Generally, people were quite knowledgeable about their security on the web. A majority of participants were able to accurately define the terms “Phishing Attack” and “Two-Factor Authentication”, as well as identify when a website was potentially dangerous. Despite this knowledge, a majority of participants opposed Wesleyan switching over to two-factor authentication, which went against our intuitions and the more positive attitude we had seen in the news. We found that only 20% of respondents had been the victim of a cyber attack in the past, but despite that participants stated they were generally unafraid. If you would like to look at the data in more detail, we have provided some visuals in the next section. If you are interested in more of the conclusions we have drawn from said data, feel free to read the full paper in the section of the same name.
          </p>
        </div>

        <!-- DATA -->
        <div class="sec-container" id="sec2">
          <h1 id="header-big"> Data </h1>
            <div id="graph-container">
              <h4> Breakdown of Average Correct Responses by Question Type </h4>
              <img id="graph1" src="/images/facetedGraph.jpg"></img>
              <h4> Video Walkthrough of Extended Analysis </h4>
              <iframe id="graph2" width="700" height="394" src="https://www.youtube.com/embed/Xzs8kl9Xrp0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              <h2> Go to <a class="log-swap" href="https://github.com/matthewquerdasi/2FA-Website" target="_blank"> GitHub </a></h2>
            </div>
        </div>

        <!-- WEBSITE DETAILS -->
        <div class="sec-container" id="sec3">
          <h1 id="header-big"> Website </h1>
          <p class="writeup">
            This website was built entirely from scratch using HTML and CSS for styling, SQL and PHP for querying and general scripting, as well as jQuery and Ajax for form submission. The website is currently hosted on my (Matt) personal website domain on Bluehost. As you’ve seen, our website implements a rudimentary form of two-factor authentication. Upon  successful login, the user is prompted with a QR code as an added layer of security. We do this using an open source library to generate random secret strings, which are then incorporated into a QR code generator accessible from the Google Authenticator app.
          </p>
        </div>

        <!-- FULL PAPER -->
        <div class="sec-container" id="sec4">
          <iframe id="resume-pdf" src="pdf/Info_Sec_Project_Writeup.pdf#toolbar=0&navpanes=0" width="540.9" height="700"></iframe>
        </div>


    </div>
  </div>
</div>

</body>
</head>
