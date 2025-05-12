<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dzafich Casino - Home</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="./img/favIcon.svg" type="image/x-icon">
</head>
<body>
    <div class="wrapper">
        <h1>Welcome</h1>
        <form action="game.php" method="post">
            <?php for ($i = 1; $i <= 3; $i++): ?>
                <div class="players">
                    <p>Player <?= $i ?></p>
                    <div class="input-box">
                        <input type="text" name="users[<?= $i ?>][ime]" placeholder="Name" required>
                    </div>
                </div>
            <?php endfor; ?>
            
            <div class="selectors">
                <div class="selector-box">
                    <label for="diceNum">Number of dice:</label>
                    <select name="diceNum" id="diceNum" required>
                        <?php for ($i = 1; $i <= 3; $i++): ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                
                <div class="selector-box">
                    <label for="gameNum">Number of games:</label>
                    <select name="gameNum" id="gameNum" required>
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>
            
            <div class="button-container">
                <input type="submit" id="startGameButton" value="Start Game">
            </div>
        </form>
    </div>
</body>
</html>
