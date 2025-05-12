<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['users'] = $_POST['users'];
    $_SESSION['diceNum'] = $_POST['diceNum'];
    $_SESSION['gameNum'] = $_POST['gameNum'];
    $_SESSION['dice_results'] = [];
    $_SESSION['game_results'] = [];
    $_SESSION['current_game'] = 0;
    $_SESSION['totals'] = array_fill_keys(array_keys($_POST['users']), 0);

    for ($game = 0; $game < $_SESSION['gameNum']; $game++) {
        $_SESSION['dice_results'][$game] = [];
    }
}

if (isset($_GET['roll']) && $_SESSION['current_game'] < $_SESSION['gameNum']) {
    $current_game = $_SESSION['current_game'];
    $game_results = [];

    foreach ($_SESSION['users'] as $index => $user) {
        $dice = [];
        for ($i = 0; $i < $_SESSION['diceNum']; $i++) {
            $dice[] = rand(1, 6);
        }
        $game_results[$index] = $dice;
        $_SESSION['totals'][$index] += array_sum($dice);
    }

    $_SESSION['dice_results'][$current_game] = $game_results;
    $_SESSION['current_game']++;
}

$max_score = max($_SESSION['totals']);
$winners = [];
foreach ($_SESSION['totals'] as $index => $score) {
    if ($score == $max_score) {
        $winners[] = $_SESSION['users'][$index]['ime'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dzafich Casino - Results</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="./img/favIcon.svg" type="image/x-icon">
    <script>
        function showDiceResults() {
            const animations = document.querySelectorAll('.dice-animation');
            animations.forEach(anim => {
                anim.style.display = 'none';
            });

            const diceImages = document.querySelectorAll('.dice-final');
            diceImages.forEach(dice => {
                dice.style.display = 'inline-block';
            });
        }

        setTimeout(showDiceResults, 1000);
    </script>
</head>
<body>
    <div class="wrapper">
        <h1>Good Luck!</h1>
        <div class="game-info">
            Number of dice: <?= $_SESSION['diceNum'] ?><br>
            Number of games: <?= $_SESSION['gameNum'] ?><br>
            Games played: <?= $_SESSION['current_game'] ?>
        </div>

        <?php if ($_SESSION['current_game'] < $_SESSION['gameNum']): ?>
            <div class="button-container">
                <a href="game.php?roll=1" class="roll-button">Roll Game <?= $_SESSION['current_game'] + 1 ?></a>
            </div>
        <?php endif; ?>

        <?php foreach ($_SESSION['users'] as $index => $user): ?>
            <div class="players">
                <h3><?= $user['ime'] ?></h3>
                <?php
                $last_game = $_SESSION['current_game'] - 1;
                if ($last_game >= 0 && isset($_SESSION['dice_results'][$last_game][$index])): ?>
                    <p>
                        
                        <?php foreach ($_SESSION['dice_results'][$last_game][$index] as $roll): ?>
                            <span class="dice-container">
                                <img src="img/dice-anim.gif" alt="Kocka se vrti" width="50" class="dice-animation">
                                <img src="img/dice<?= $roll ?>.gif" alt="Kocka <?= $roll ?>" width="50" class="dice-final" style="display: none;">
                            </span>
                        <?php endforeach; ?>

                    </p>
                <?php endif; ?>

                <p><strong>Total points: <?= $_SESSION['totals'][$index] ?></strong></p>
                <hr>
            </div>
        <?php endforeach; ?>

        <?php if ($_SESSION['current_game'] > 0): ?>
        <?php endif; ?>

        <?php if ($_SESSION['current_game'] == $_SESSION['gameNum']): ?>
            <script>
                setTimeout(function() {
                    window.location.href = "konec.php";
                }, 1000);
            </script>
        <?php endif; ?>
    </div>
</body>
</html>
