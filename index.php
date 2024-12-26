<!DOCTYPE html>
<html lang="en">

<?php
// Start session to check if the user is logged in
session_start();
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <!-- Font awsome for lazy icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>NASAHN ACADEMY</title>
</head>

<body>
    <div class="welcome">
        <div class="nav">
            <img src="src/img/NASAHN ACADEMY.svg" class="logo" />
            <ul class="list">
                <li>Home</li>
                <li>About Us</li>
                <li onclick="window.location.href='contact.html';">Contact Us</li>
                <li onclick="window.location.href='degrees.html';">Degrees</li>
                <li id="spn">
                    <span>Specialities</span>
                    <ul class="specialities">
                        <li id="HE">Hardware Engineering</li>
                        <a href="software-engeneering.html">
                            <li id="SE">Software Engineering</li>
                        </a>
                        <a href="cryptographie-cyber-securite.html">
                            <li id="CCS">Cryptographie and Cyber Security</li>
                        </a>
                        <li id="CS">Computer Science</li>
                        <li id="NE">Network Engineering</li>
                        <li id="DE">Database Engineering</li>
                    </ul>
                </li>
                <li>Research</li>
            </ul>
            <div class="buttons">

                <a href="sign_in.html">
                    <?php if (isset($_SESSION['user_name'])): ?>
                        <!-- If logged in display name -->
                        <button class="apply">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></button>
                    <?php else: ?>
                        <!-- If not logged in show 'Apply' button -->
                        <button class="apply">Apply</button>
                    <?php endif; ?>
                </a>

                <button id="theme-switch" onclick="togglemode()">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
                        <path
                            d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
                        <path
                            d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Z" />
                    </svg>
                </button>
            </div>

        </div>
        <div class="ecriture">
            <h1 class="h1_of_ecriture">
                Welcome to NASAHN Academy Innovate Your Learning.
            </h1>
            <h1 class="h1_of_ecriture">
                At NASAHN Academy, we blend traditional education with cutting-edge
                techniques to cultivate a dynamic learning environnement.Discover how
                our premium services can elevate your academic journey.
            </h1>
        </div>
    </div>

    <!-- DEGREES -->
    <div class="degrees">
        <h1 class="h1_of_degrees">Degrees</h1>
        <div class="degrees_cards">
            <div class="degree_card">
                <img src="src/img/degrees/Licence.jpeg" alt="License Degree" class="degree_image">
                <h2>License</h2>
                <p>Duration: 3 years</p>
            </div>
            <div class="degree_card">
                <img src="src/img/degrees/Master.jpg" alt="Master's Degree" class="degree_image">
                <h2>Master's</h2>
                <p>Duration: 2 years</p>
            </div>
            <div class="degree_card">
                <img src="src/img/degrees/PhD.png" alt="PhD Degree" class="degree_image">
                <h2>PhD</h2>
                <p>Duration: 4-5 years</p>
            </div>
        </div>
        <div class="button_container">
            <a href="degrees.html" class="more_details_button">More details</a>
        </div>
    </div>

    <h1 class="h1_of_programs" id="h1_of_programs">Programs</h1>
    <div class="grid-container">
        <div class="card" id="he">
            <div class="icon" style="background-color: white;"><i class="material-icons"
                    style="font-size:44px;color:rgb(0, 123, 255)">memory</i></div>
            <h2>Hardware Engineering</h2>
            <p style="color: black;">Design and develop physical computing systems, from microprocessors to complete
                computer systems. Master circuit design, embedded systems, and hardware architecture.</p>
            <button class="read-more-btn" id="He">Read more</button>
        </div>
        <div class="card" id="se">
            <div class="icon" style="background-color: white;"><i class="fa fa-code"
                    style="font-size:36px;color:rgb(18, 137, 18)"></i></div>
            <h2>Software Engineering</h2>
            <p style="color: black;">Learn to design, develop, and maintain complex software systems using modern
                programming languages and development methodologies.</p>
            <button class="read-more-btn" id="Se">Read more</button>
        </div>
        <div class="card" id="ccs">
            <div class="icon" style="background-color: white;"><i class="material-icons"
                    style="font-size:43px;color:red">security</i></div>
            <h2>Cryptography and Cyber Security</h2>
            <p style="color: black;">Explore the science of protecting data, networks, and systems from digital threats.
                Learn advanced encryption techniques and security protocols.</p>
            <button class="read-more-btn" id="Ccs">Read more</button>
        </div>
        <div class="card" id="cs">
            <div class="icon" style="background-color: white;"><i class="material-icons"
                    style="font-size:35px;color:rgb(138, 23, 164)">laptop_windows</i></i></div>
            <h2>Computer Science</h2>
            <p style="color: black;">Study the theoretical foundations of computation and information processing,
                including algorithms, data structures, and computational theory.</p>
            <button class="read-more-btn" id="Cs">Read more</button>
        </div>
        <div class="card" id="ne">
            <div class="icon" style="background-color: white;"><i class="material-icons"
                    style="font-size:37px;color:rgb(255, 111, 0)">device_hub</i></div>
            <h2>Network Engineering</h2>
            <p style="color: black;">Design and implement computer networks, from local networks to global
                infrastructure. Master protocols, security, and network management.</p>
            <button class="read-more-btn" id="Ne">Read more</button>
        </div>
        <div class="card" id="de">
            <div class="icon" style="background-color: white;"><i class="fa fa-database"
                    style="font-size:34px;color:rgb(33, 198, 204)"></i></div>
            <h2>Database Engineering</h2>
            <p style="color: black;">Learn to design, implement and maintain database systems. Master data modeling,
                query optimization, and database administration.</p>
            <button class="read-more-btn" id="De">Read more</button>
        </div>
    </div>
    <br><br><br><br>
    <div class="reasherch" id="reasherch">
        <h1 class="h1_of_reasherch">Research</h1>
        <br>
        <div class="paragraph_of_reasherch">
            <p>
                At our academy, research in tech domains is an exhilarating journey
                into the unknown, where students and faculty push the boundaries of
                what’s possible. From artificial intelligence to cybersecurity, and
                from software engineering to advanced networking, our research delves
                deep into the technologies shaping the future. Under the mentorship of
                industry-leading experts, students tackle real-world problems with
                cutting-edge tools and pioneering approaches, transforming theories
                into impactful solutions. Through rigorous exploration and hands-on
                projects, they gain the expertise to solve complex issues, driving
                innovation and redefining the digital landscape. In these tech
                domains, our researchers are more than students—they are pioneers,
                prepared to leave an indelible mark on the world of technology. Here,
                innovation isn’t just encouraged; it’s essential.
            </p>
        </div>
    </div>
    <br><br><br>
    <div class="trusted">
        <h1 class="h1_of_trusted">Trusted By</h1>
        <div class="logos">
            <div class="logos-slide">
                <img src="src/img/google-color-svgrepo-com.svg">
                <img src="src/img/youtube-circle-logo-svgrepo-com.svg">
                <img src="src/img/intel-svgrepo-com.svg">
                <img src="src/img/nvidia-icon.svg">
                <img src="src/img/microsoft-icon.svg">
            </div>
        </div>
    </div>

    <script>
        var copy = document.querySelector(".logos-slide").cloneNode(true);

        document.querySelector(".logos").appendChild(copy);
    </script>

    <div class="trusted">
        <h1 class="h1_of_trusted">Our Partners</h1>
        <div class="logos2">
            <div class="logos2-slide">
                <img src="src/img/oxford.webp">
                <img src="src/img/Harvard.jpg">
                <img src="src/img/Utoronto_coa.svg.png">
                <img src="src/img/Sydney.jpg">
                <img src="src/img/Northwestern_University_seal.svg.png">
            </div>
        </div>
        <script>
            var copy = document.querySelector(".logos2-slide").cloneNode(true);
            document.querySelector(".logos2").appendChild(copy);
        </script>
    </div>


    <div id="testimonials">
        <h1 class="h1_of_reasherch">Testimonials</h1>
        <div class="testimonial-grid">
            <div class="testimonial-item">
                <img src="src/img/user.jpg" alt="User 1" class="testimonial-image" />
                <p class="testimonial-text">
                    "Studying <strong>computer science</strong> at NASAHN Academy was a game-changer. The intensive,
                    hands-on PhD program
                    sharpened my skills in software development and problem-solving, and now I’m excited to be driving
                    innovation as part of Amazon's dynamic tech team!"
                </p>
            </div>
            <div class="testimonial-item">
                <img src="src/img/user2.jpg" alt="User 2" class="testimonial-image" />
                <p class="testimonial-text">
                    "Studying <strong>software engineering</strong> at NASAHN Academy was truly transformative. The
                    rigorous, hands-on
                    PhD program equipped me with the skills and knowledge to tackle real-world challenges, and now I'm
                    excited to be contributing to groundbreaking innovations as part of Samsung's engineering team!"
                </p>
            </div>
            <div class="testimonial-item">
                <img src="src/img/user3.jpg" alt="User 3" class="testimonial-image" />
                <p class="testimonial-text">
                    "Studying <strong>hardware engineering</strong> at NASAHN Academy was life-changing. The hands-on
                    PhD program
                    prepared me for an incredible career, and now I’m thrilled to be part of Apple’s innovation team!"
                </p>
            </div>
            <div class="testimonial-item">
                <img src="src/img/user4.jpg" alt="User 1" class="testimonial-image" />
                <p class="testimonial-text">
                    "Studying <strong>cybersecurity</strong> at NASAHN Academy was a pivotal experience.
                    The hands-on PhD program provided me with advanced skills in threat
                    detection and network security, and now I'm excited to be part of
                    Google's team, working on cutting-edge solutions to protect users
                    and data worldwide!"
                </p>
            </div>
            <div class="testimonial-item">
                <img src="src/img/user5.jpg" alt="User 2" class="testimonial-image" />
                <p class="testimonial-text">
                    "Studying <strong>network engineering</strong> at NASAHN Academy was an incredible
                    experience. The in-depth, hands-on PhD program gave me a deep
                    understanding of complex network systems, and now I'm excited to
                    apply my expertise as part of Intel's cutting-edge engineering
                    team!"
                </p>
            </div>
            <div class="testimonial-item">
                <img src="src/img/user6.jpg" alt="User 3" class="testimonial-image" />
                <p class="testimonial-text">
                    "Studying <strong>database engineering</strong> at NASAHN Academy was a game-
                    changing experience. The rigorous, hands-on PhD program equipped me
                    with a deep understanding of data systems and analytics, and now I'm
                    excited to bring my expertise to Shell, helping drive innovation in
                    data management and operations!"
                </p>
            </div>
        </div>
    </div>


    <!-- Partie Prix programs-->

    <div class="programs-container">
        <h1 class="programs-title">JOIN US NOW</h1>

        <table class="programs-table">
            <thead>
                <tr>
                    <th>Degree Program</th>
                    <th>License</th>
                    <th>Masters</th>
                    <th>Ph.D</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Duration</td>
                    <td>3 years</td>
                    <td>2 years</td>
                    <td>3 years</td>
                </tr>
                <tr>
                    <td>Annual Tuition</td>
                    <td>20000$</td>
                    <td>25000$</td>
                    <td>40000$</td>
                </tr>
                <tr>
                    <td>Total Tuition</td>
                    <td>60000$</td>
                    <td>50000$</td>
                    <td>120000$</td>
                </tr>
                <tr>
                    <td>Additional Fees</td>
                    <td>2000$</td>
                    <td>3000$</td>
                    <td>10000$</td>
                </tr>
                <tr>
                    <td>Total Price</td>
                    <td>62000$</td>
                    <td>78000$</td>
                    <td>130000$</td>
                </tr>
            </tbody>
        </table>

        <button class="apply">Join Now</button>
    </div>

    <section class="founders-section">
        <h1 class="title">Founders</h1>
        <div class="founders">
            <div class="founder">NAFA Abedllah</div>
            <div class="founder">Sofiane AFRA</div>
            <div class="founder">HAOUA Nourddine</div>
        </div>
    </section>

    <!-- Partie ta3 el footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-column">
                <a class="big-link">Home</a>
                <ul class="home">
                    <li>About NASAHN</li>
                    <li>Admissions</li>
                    <li>Campus life</li>
                    <li>Financial Aid</li>
                    <li>Innovation</li>
                    <li>Degrees</li>
                </ul>
            </div>

            <div class="footer-column">
                <a class="big-link">About Us</a>
                <ul class="about_us">
                    <li>Our Mission</li>
                    <li>Our leadership</li>
                    <li>Our History</li>
                    <li>Accreditation</li>
                    <li>Collaborations</li>
                    <li>Specialities</li>
                </ul>
            </div>

            <div class="footer-column">
                <a class="big-link">Contact Us</a>
                <ul>
                    <li><a href="tel:+1539254214">+1 539 254 214</a></li>
                    <li><a href="mailto:nasahn@gmail.com">Nasahn@gmail.com</a></li>
                </ul>
                <div class="social-media">
                    <a class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a class="social-icon"><i class="fab fa-x"></i></a>
                    <a class="social-icon"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>2025 NASAHN ACADEMY. All rights reserved.</p>
        </div>
    </footer>
</body>

<script>
    function togglemode() {
        document.body.classList.toggle("bluemode");
    }
</script>

</html>