<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="revieww.css" />
    <title>Customer Review | Customer Section</title>
</head>
<body>

    <?php
    // Navbar connection
    include("nav.php");

    // Database connection (update with your credentials)
    $servername = "localhost";
    $username = "root"; // Change if different
    $password = ""; // Change if different
    $dbname = "pwc"; // Replace with your actual database name

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch the latest 3 reviews (assuming 'created_at' column exists)
    $sql = "SELECT opinion, fullname FROM feedback ORDER BY created_at DESC LIMIT 3";
    $result = $conn->query($sql);

    $reviews = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $reviews[] = $row;
        }
    }

    $conn->close();
    ?>

    <header>
        <div class="container">
            <div class="container__left">
                <h1>Read what our customers love about us</h1>
                <p>
                    Pet parents trust us for our wide range of high-quality products, from premium food to essential care items, ensuring their pets stay happy and healthy.
                </p>
                <br>
                <p>
                    With seamless shopping and personalized recommendations, we make it easier than ever to find the best products for pets of all shapes and sizes.
                </p>
                <div class="feedback">
                    <div style="position: relative;">
                        <button onclick="location.href='feedback.php'" 
                            style="padding: 10px 15px; background-color: #007bff; color: white; border: none; border-radius: 5px; font-size: 14px; cursor: pointer; position: relative; left: 100px;">
                            Heyy.. Click to Give Feedback
                        </button>
                    </div>
                    <img src="petn.gif" >
                </div>
            </div>

            <div class="container__right">
                <?php
                if (!empty($reviews)) {
                    $imageIndex = 1; // Image counter for avatars
                    foreach ($reviews as $review) {
                        echo '<div class="card">
                                <img src="photo/' . $imageIndex . '.png" alt="user" />
                                <div class="card__content">
                                    <span><i class="ri-double-quotes-l"></i></span>
                                    <div class="card__details">
                                        <p>' . htmlspecialchars($review["opinion"]) . '</p>
                                        <h4>- ' . htmlspecialchars($review["fullname"]) . '</h4>
                                    </div>
                                </div>
                              </div>';
                        $imageIndex++; // Increment image index for next review
                        if ($imageIndex > 3) $imageIndex = 1; // Reset to 1 if more than 3
                    }
                } else {
                    echo "<p>No reviews available yet.</p>";
                }
                ?>
            </div>
        </div>
    </header>

    <?php
    // Footer connection
    include("footer.php");
    ?>

</body>
</html>
