<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="software-engineering.css">
    <title>Software Engineering</title>
</head>

<?php

include 'includes/base.php';

// specialty ID 
$specialty_id = isset($_GET['id']) ? intval($_GET['id']) : 1;

// specialty
$query = "SELECT name, description FROM specialties WHERE id = $specialty_id";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $specialty = mysqli_fetch_assoc($result);
} else {
    die("Specialty not found.");
}

// modules
$query_modules = "SELECT name FROM modules WHERE specialty_id = $specialty_id";
$result_modules = mysqli_query($conn, $query_modules);

$modules = [];
if ($result_modules && mysqli_num_rows($result_modules) > 0) {
    while ($row = mysqli_fetch_assoc($result_modules)) {
        $modules[] = $row['name'];
    }
}

// certificats
$query_certificates = "SELECT name, description, image FROM certificates WHERE specialty_id = $specialty_id";
$result_certificates = mysqli_query($conn, $query_certificates);

$certificates = [];
if ($result_certificates && mysqli_num_rows($result_certificates) > 0) {
    while ($row = mysqli_fetch_assoc($result_certificates)) {
        $certificates[] = $row;
    }
}

// references 
$query_references = "SELECT name, author_or_source, description, read_more_url FROM reference WHERE specialty_id = $specialty_id";
$result_references = mysqli_query($conn, $query_references);

$references = [];
if ($result_references && mysqli_num_rows($result_references) > 0) {
    while ($row = mysqli_fetch_assoc($result_references)) {
        $references[] = $row;
    }
}
?>

<body>

    <header class="header">
        <div class="logo">
            <a href="index.php">
                <img src="src/img/NASAHN ACADEMY.svg" alt="Logo">
            </a>
        </div>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="#contact-us">Contact Us</a>
            <a href="#degrees">Degrees</a>
            <a href="#specialities">Specialties</a>
            <a href="#research">Research</a>
        </div>
        <div class="buttons">

            <a href="sign_in.html"><button class="apply-button">Apply</button></a>
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
    </header>



    <section class="section-one">
        <h1 class="specialty-name">
            <?php echo htmlspecialchars($specialty['name']); ?>
        </h1>
        <p class="introduction">
            <?php echo htmlspecialchars($specialty['description']); ?>
        </p>
    </section>


    <section class="section-two">
        <h2 class="section-title">Modules Taught</h2>
        <div class="modules-list">
            <?php if (!empty($modules)): ?>
                <?php foreach ($modules as $module): ?>
                    <div class="module">
                        <p><?php echo htmlspecialchars($module); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No modules available for this specialty.</p>
            <?php endif; ?>
        </div>
    </section>




    <section class="section-three">
        <h2 class="section-title">Certificats</h2>
        <div class="certificates-list">
            <?php if (!empty($certificates)): ?>
                <?php foreach ($certificates as $certificate): ?>
                    <div class="certificate">
                        <img src="<?php echo htmlspecialchars($certificate['image']); ?>" class="certificate-image">
                        <div class="certificate-details">
                            <h3><?php echo htmlspecialchars($certificate['name']); ?></h3>
                            <p><strong>Description:</strong> <?php echo htmlspecialchars($certificate['description']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No certificates available for this specialty.</p>
            <?php endif; ?>
        </div>
    </section>



    <section class="section-four">
        <h2 class="section-title">References</h2>
        <div class="references-list">
            <?php if (!empty($references)): ?>
                <?php foreach ($references as $reference): ?>
                    <div class="reference">
                        <h3><?php echo htmlspecialchars($reference['name']); ?></h3>
                        <p><strong>Author/Source:</strong> <?php echo htmlspecialchars($reference['author_or_source']); ?></p>
                        <p><strong>Description:</strong> <?php echo htmlspecialchars($reference['description']); ?></p>
                        <?php if (!empty($reference['read_more_url'])): ?>
                            <a href="<?php echo htmlspecialchars($reference['read_more_url']); ?>" class="reference-link"
                                target="_blank">Read more</a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No references available for this specialty.</p>
            <?php endif; ?>
        </div>
    </section>

    <section class="section-five">
        <h2 class="section-title">Leave Your Opinion</h2>
        <p class="section-description">We would love to hear your opinion about our Cryptography and Cyber Security
            program.</p>
        <form action="#" method="POST" class="feedback-form">
            <div class="form-grid">
                <div>
                    <div class="form-group">
                        <label for="email">Your Email (optional)</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="feedback">Your Opinion</label>
                        <textarea id="feedback" name="feedback" rows="4" placeholder="Enter your opinion here"
                            required></textarea>
                    </div>
                </div>
                <div class="form-group submit-group">
                    <button type="submit" class="submit-button">Submit</button>
                </div>
            </div>
        </form>
    </section>
</body>

<script>
    function togglemode() {
        document.body.classList.toggle("bluemode");
    }
</script>

</html>