<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Fibonacci Sequence Program</title>
    </head>
    <body>
        <h1>Fibonacci Sequence Program</h1>
        <p>Enter a number from 1-20 to get the Fibonacci sequence</p>

        <?php 

            function fibonacci($n) {
                $fibonacci_array = array(0, 1);
                for ($i = 2; $i < $n; $i++) {
                    $fibonacci_array[] = $fibonacci_array[$i - 1] + $fibonacci_array[$i - 2]; // Generate subsequent Fibonacci numbers
                }
                // Return the sequence as a string of comma-separated values
                return implode(", ", array_slice($fibonacci_array, 0, $n));
            }
        ?>

        <form method="post">
            Input: <input type="number" name="number" min="1" max="20" required>
            <input type="submit" value="Submit">
        </form>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $number = $_POST['number'];
                if ($number >= 1 && $number <= 20) {
                    echo "<p>Output: " . fibonacci($number) . "</p>";
                } else {
                    echo "<p>Please enter a number between 1 and 20.</p>";
                }
            }
        ?>
    </body>
</html>