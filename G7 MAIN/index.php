<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accept_cookies'])) {
    setcookie('cookies_accepted', 'true', time() + (86400), "/"); // 1 day expiration
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

function sanitizeInput($data) {
    return strip_tags(trim($data)) ;
}

$dataFile = 'group7_data.txt';
if (file_exists($dataFile)) {
    $teamArray = file($dataFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
} else {
    $teamData = 
        "Rechelle|image1.png|Group Member|candidorechelleanne@gmail.com|I'm Rechelle Anne Candido, a third-year BSIT student. A working student, nail tech, makeup artist and I own a small business. I work hard because I want to pursue my course and become successful in the future.\n" .
        "Johnn Vhelle|Image2.jpg|Group Member|johnnvhellebasbas@gmail.com|Hi there! I'm Vhelle, and I'm a third-year college student at PLMun. I currently take the BSIT program. Watching movies and reading stories are two of my interests, and I'd like to master digital art someday.\n" .
        "Ian Christoper|Image5.jpeg|Group Leader|icasenci12@gmail.com|I'm Ian, a third-year BSIT student at PLMun! Just a guy trying to do better every passing day and hoping that life takes me to a simple yet better place.\n" .
        "Justin|Image4.jpg|Group Member|Justinpadora@gmail.com|I'm Justin Padora, a third-year BSIT student who also works as a crew leader at a fast food restaurant. I'm motivated to work hard in order to achieve my goal of graduating.\n";
    file_put_contents($dataFile, $teamData);
    $teamArray = file($dataFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group 7 Team Portfolio</title>
    <link rel="stylesheet" href="style.css">
    <button class="manage" onclick="window.location.href='submit.php'">Manage Team</button>
</head>
<body>
    <script>

function validateName() {
            const nameInput = document.getElementById('name');
            const nameError = document.getElementById('nameError');
            const submitButton = document.querySelector('button[type="submit"]');
            const nameRegex = /^[a-zA-Z\s]+$/;

            if (!nameRegex.test(nameInput.value)) {
                nameError.textContent = "Invalid name. Please use only letters and spaces.";
                submitButton.disabled = true;
            } else {
                nameError.textContent = "";
                if (document.getElementById('emailError').textContent === "") {
                submitButton.disabled = false;
            }
        }
    }
        function validateEmail() {
        const emailInput = document.getElementById('email');
        const emailError = document.getElementById('emailError');
        const submitButton = document.querySelector('button[type="submit"]');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailRegex.test(emailInput.value)) {
            emailError.textContent = "Invalid email address.";
            submitButton.disabled = true;
        } else {
            emailError.textContent = "";
            if (document.getElementById('nameError').textContent === "") {
                submitButton.disabled = false;
            }
        }
    }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('name').addEventListener('input', validateName);
            document.getElementById('email').addEventListener('input', validateEmail);
        });
    </script>
</head>
<body>

    <div class="group-name">BSIT 3L - Group 7</div>
    <p class="group-description">"Integrative Programming"</p>
    <div class="team-members">
        <?php foreach ($teamArray as $index => $memberData): 
            $member = explode('|', sanitizeInput($memberData)); ?>
        <div class="team-member">
            <img id="imagePreview<?php echo $index + 1; ?>" src="<?php echo $member[1]; ?>" alt="Team Member <?php echo $index + 1; ?>">
            <h2><?php echo htmlspecialchars($member[0]); ?></h2>
            <div class="role-label">Role</div>
            <p class="role"><?php echo htmlspecialchars($member[2]); ?></p>
            <div class="contact-label">Contact</div>
            <p class="contact"><?php echo htmlspecialchars($member[3]); ?></p>
            <div class="bio-label">Bio</div>
            <p class="bio"><?php echo htmlspecialchars($member[4]); ?></p>
        </div>
        <?php endforeach; ?>
    </div>
    
    <div class="inquiry-form">
        <h2>Contact Us</h2>
        <form id="inquiryForm" action="form.php" method="post">
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                <span id="nameError" style="color:red;"></span>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <span id="emailError" style="color:red;"></span>
            </div>
            <div>
                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>
            </div>
            <div>
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>

<div id="cookieBanner" class="cookie-banner">
    <p>This website uses cookies to improve user experience. By using our website you consent to all cookies in accordance with our Cookie Policy. <button onclick="acceptCookies()">Accept</button></p>
</div>

    <script>
    function acceptCookies() {
        document.cookie = "cookies_accepted=true; max-age=" + (86400) + "; path=/";
        document.getElementById('cookieBanner').style.display = 'none';
    }

    function checkCookies() {
        let cookies = document.cookie.split(';').map(cookie => cookie.trim());
        let cookiesAccepted = cookies.some(cookie => cookie.startsWith('cookies_accepted='));
        if (!cookiesAccepted) {
            document.getElementById('cookieBanner').style.display = 'block';
        }
    }

    checkCookies();
    </script>
</body>
</html>

<footer>
        <div class="footerLeft">
            <div class="footerMenu">
                <h1 class="fMenuTitle">About Us</h1>
                <ul class="fList">
                    <li class="fListItem">Company</li>
                    <li class="fListItem">Contact</li>
                    <li class="fListItem">Careers</li>
                    <li class="fListItem">Affiliates</li>
                    <li class="fListItem">Stores</li>
                </ul>
            </div>
            <div class="footerMenu">
                <h1 class="fMenuTitle">Useful Links</h1>
                <ul class="fList">
                    <li class="fListItem">Support</li>
                    <li class="fListItem">Refund</li>
                    <li class="fListItem">FAQ</li>
                    <li class="fListItem">Feedback</li>
                    <li class="fListItem">Stories</li>
                </ul>
            </div>
            <div class="footerMenu">
                <h1 class="fMenuTitle">Members</h1>
                <ul class="fList">
                    <li class="fListItem">Rechelle</li>
                    <li class="fListItem">Johnn Vhelle</li>
                    <li class="fListItem">Justin</li>
                    <li class="fListItem">Ian Christoper</li>
                </ul>
            </div>
        </div>
        <div class="footerRight">
            <div class="footerRightMenu">
                <h1 class="fMenuTitle">Subscribe to our newsletter</h1>
                <div class="fMail">
                    <input type="text" placeholder="your@email.com" class="fInput">
                    <button class="fButton">Join!</button>
                </div>
            </div>
            <div class="footerRightMenu">
                <h1 class="fMenuTitle">Follow Us</h1>
                <div class="fIcons">
                    <img src="facebook.jpg" alt="" class="fIcon">
                    <img src="twitter.png" alt="" class="fIcon">
                    <img src="instagram.jpg" alt="" class="fIcon">
                    <img src="whatsapp.jpg" alt="" class="fIcon">
                </div>
            </div>
            <div class="footerRightMenu">
                <span class="copyright">BSIT3L_GRP7_INTPROG@instagram.</span>
                <span class="copyright">BSIT3L_GRP7_INTPROG_official.fbpage.</span>
                <span class="copyright">BSIT3L_GRP7_INTPROG.twiiter.com.</span>
                <br>
                <span class="copyright">MEET OUR TEAM WEB PAGE. All rights reserved. 2024.</span>
            </div>
        </div>
    </footer>
    <script src="OLIX script.js"></script>
</body>

</html>

</body>
</html>

