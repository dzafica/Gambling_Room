<?php
session_start();

$totals = $_SESSION['totals'];
arsort($totals); // razvrsti od najvišjega do najnižjega

$ranked_players = [];
foreach ($totals as $index => $score) {
    $ranked_players[] = [
        'name' => $_SESSION['users'][$index]['ime'],
        'score' => $score
    ];
}

// redirect timer
$redirect_time = 15;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Rezultati</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            /* premakne vse gor */
        }

        .wrapper {
            width: 150%;
            min-height: 500px;
            border: #b7a2c9 solid;
            border-radius: 5px;
            background-color: rgba(75, 58, 112, 0.9);
            background-image: url('img/fireworks.gif');
            /* Add this line */
            background-size: cover;
            /* Ensure the image covers the entire area */
            background-position: center;
            /* Center the image */
            text-align: center;
            padding: 20px;
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        .podium {
            display: flex;
            justify-content: center;
            align-items: flex-end;
            height: 400px;
        }

        .place {
            width: 150px;
            text-align: center;
            color: white;
            font-weight: bold;
            font-size: 24px;
            position: relative;
        }

        .first {
            background-color: #c3a039;
            height: 200px;
            z-index: 3;
        }

        .second {
            background-color: #c0c0c0;
            height: 150px;
            z-index: 2;
        }

        .third {
            background-color: #cd7f32;
            height: 120px;
            z-index: 1;
        }

        .place-name {
            position: absolute;
            top: -30px;
            left: 0;
            right: 0;
            font-size: 26px;
            color: white;
            text-shadow: 2px 2px 5px #000;
        }

        .redirect {
            text-align: center;
            color: #c5c3c4;
            margin-top: 30px;
        }
    </style>
    <script>
        let counter = <?= $redirect_time ?>;
        function countdown() {
            document.getElementById('countdown').innerText = counter;
            if (counter > 0) {
                counter--;
                setTimeout(countdown, 1000);
            } else {
                window.location.href = "index.php";
            }
        }
        window.onload = countdown;
    </script>
</head>

<body>
    <h1>Results</h1>
    <div class="wrapper">
        <div class="podium">
            <div class="place second">
                <div class="place-name"><?= $ranked_players[1]['name'] ?> (<?= $ranked_players[1]['score'] ?>)</div>
                2
            </div>
            <div class="place first">
                <div class="place-name"><?= $ranked_players[0]['name'] ?> (<?= $ranked_players[0]['score'] ?>)</div>
                1
            </div>
            <div class="place third">
                <div class="place-name"><?= $ranked_players[2]['name'] ?> (<?= $ranked_players[2]['score'] ?>)</div>
                3
            </div>
        </div>
        <div class="redirect">
            New game starting in... <span id="countdown"><?= $redirect_time ?></span>
        </div>
    </div>

</body>

</html>