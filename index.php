<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/reset.css">
    <link rel="stylesheet" href="assets/main.css">
    <title>Calculator</title>
</head>
<body>
<div class="login-box">
    <h1>Calculator</h1>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <input class="user-box" type="number" name="num01" placeholder="Number one">
        <div>
            <select class="user-box" name="operator">
                <option value="add">+</option>
                <option value="subtract">-</option>
                <option value="multiply">*</option>
                <option value="divide">/</option>
                <option value="percentage">%</option>
            </select>
        </div>
        <input class="user-box" type="number" name="num02" placeholder="Number two">
        <div>
            <button class="user-box">Calculate</button>
        </div>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Grob data from input
        $num01 = filter_input(INPUT_POST, "num01", FILTER_SANITIZE_NUMBER_INT);
        $num02 = filter_input(INPUT_POST, "num02", FILTER_SANITIZE_NUMBER_INT);
        $operator = htmlspecialchars($_POST["operator"]);

        // Error handlers
        $errors = false;
        if (empty($num01) || empty($num02) || empty($operator)) {
            echo "<p class='calc-error'>Fill in all fields!</p>";
            $errors = true;
        }
        if (!is_numeric($num01) || !is_numeric($num02)) {
            echo "<p class='calc-error'>Only write numbers!</p>";
            $errors = true;
        }
        // Calculate the numbers if no errors
        if (!$errors) {
            $value = 0;
            switch ($operator) {
                case "add":
                    $value = $num01 + $num02;
                    break;
                case "subtract":
                    $value = $num01 - $num02;
                    break;
                case "multiply":
                    $value = $num01 * $num02;
                    break;
                case "divide":
                    $value = $num01 / $num02;
                    break;
                case "percentage":
                    $value = ($num01 * $num02)/100;
                    break;
                default:
                    echo "<p class='calc-error'>Something went HORRIBLY wrong!</p>";
            }
            echo "<p class='calc-result'>Result = " . $value ."</p>";
        }
    }
    ?>
</div>

</body>
</html>