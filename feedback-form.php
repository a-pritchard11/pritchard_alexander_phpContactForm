<?php
session_start();
$errors = $_SESSION['form_errors'] ?? [];

$submittedInputs = $_SESSION['form_input']   ?? [];
$submittedName   = $submittedInputs['name']  ?? '';
$submittedEmail  = $submittedInputs['email'] ?? '';

$_SESSION['form_input'] = [];

$_SESSION['form_errors'] = [];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Contact Form</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="main.css">
    </head>
    <body>
        <header>
            <h1>Please Answer Some Questions Below...</h1>
        </header>
        <main>
            <form action="includes/scripts/process_adoption_form.php" method="POST">
                <div>
                    <?php 
                        if (array_key_exists('name', $errors)) {
                            echo '<p style="color:red">' . $errors['name'] . '</p>';
                        }
                    ?>
                    <label for="name">Your name:</label>
                    <input 
                        id="name" 
                        name="name" 
                        type="text" 
                        placeholder="Type Here"
                        <?php if (count($errors) > 0 && $submittedName) {
                            echo 'value="'. $submittedName . '"';
                            // alternatively, you could use interpolation:
                            //echo "value=\"{$submittedName}\"";
                        } ?>
                    >
                </div>
                <div>
                    <?php 
                        if (array_key_exists('email', $errors)) {
                            echo '<p style="color:red">' . $errors['email'] . '</p>';
                        }
                    ?>
                    <label for="email">Your email:</label>
                    <!-- the 'name' attribute on the input is the key this value will be store in 
                     on the request; so 'name="email"' means the key will be 'email' -->
                    <input id="email" name="email" type="email" placeholder="person@email.com">
                </div>
                <div>
                    <label for="feedback">What feedback do you have for my presentation today?</label>
                    <textarea id="feedback" name="feedback"></textarea>
                </div>
                <div>
                    <label for="good_or_bad">Was it good or bad overall?</label>
                    <select id="good_or_bad" name="good_or_bad">
                        <option value="Good">Bad</option>
                        <option value="Bad">Bad</option>
                    </select>
                </div>
                <fieldset>
                    <legend>What other areas could be improved upon?</legend>
                    <label for="length">Length</label>
                    <input id="length" type="checkbox" name="other_fb[]" value="length">

                    <label for="talking-points">Talking Points</label>
                    <input id="talking-points" type="checkbox" name="other_fb[]" value="talking-points">

                    <label for="confidence">Jimmy</label>
                    <input id="confidence" type="checkbox" name="other_fb[]" value="confidence">
                </fieldset>
                <footer>
                    <button type="submit">Send</button>
                </footer>
            </form>
        </main>
        <script src="main.js"></script>
    </body>
</html>
