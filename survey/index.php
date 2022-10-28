<?php

require_once '../functions.php';
require_once '../controller/action.php';
require_once '../models/Survey.php';

init_php_session();

if (!is_logged()) {
    header("location: ../");
}

if (isset($_GET['token']) && !empty($_GET['token'])) {
    $survey = new Survey;
    $survey->setToken($_GET['token']);
    $survey_data = $survey->get_survey();

    if (!$survey_data) {
        create_flash_message('token_error', 'This token id is invalid', FLASH_ERROR);
        header("location: ../survey/");
        return;
    }

    $survey_data['choices'] = $survey->get_choices();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ourGes - Create a survey</title>
    <link rel="stylesheet" href="../public/css/reset.css">
    <link rel="stylesheet" href="../public/css/animations.css">
    <link rel="stylesheet" href="../public/css/var.css">
    <link rel="stylesheet" href="../public/css/global.css">
    <link rel="stylesheet" href="../public/css/survey.css">
    <link rel="icon" href="../public/img/favicon.png" />
    <script src="../public/js/script.js"></script>
    <script src="../public/js/jquery-3.6.0.min.js"></script>
</head>

<body class="m-0a ovf" id="body">
    <nav class="flex flex-al">
        <div class="nav__logo flex flex-js pd-1">
            <p>our</p>
            <p onclick="easter()">GES</p>
        </div>
        <div class="nav__menu flex flex-al">
            <div class="nav__menu__usr flex">
                <img src="<?= $_SESSION['profile']->_links->photo->href ?>" alt="profile" onclick="showSubmenu()">
                <i class="fa fa-angle-down" id="fa-angle-down"></i>
            </div>
        </div>
    </nav>
    <div class="nav__submenu pd-1" id="dropdown-menu">
        <div class="nav__submenu__head mb-1">
            <p>Signed in as</p>
            <span><?= $_SESSION['profile']->firstname . " " .  $_SESSION['profile']->name ?></span>
        </div>
        <div class="nav__submenu__foot flex">
            <p class="tag"><?= $_SESSION['class']->promotion ?></p>
            <a href="index.php?action=logout"><i class="fa fa-sign-out"></i></a>
        </div>
    </div>
    <div class="container" id="container">
        <div class="content m-0a">
            <a href="../">
                <p>retour</p>
            </a>

            <div class="survey">
                <?php if (!isset($_GET['token']) || empty($_GET['token'])) : ?>
                    <div class="survey__form">
                        <form action="../controller/survey.php?action='add'" method="POST">
                            <label for="name">Nom du sondage</label>
                            <input type="text" name="name">
                            <label for="description">Description</label>
                            <input type="text" name="description">
                            <label for="type">Type</label>
                            <select name="type">
                                <option value="1">Choix simple</option>
                                <option value="2">Plusieurs choix</option>
                            </select>
                            <input type="hidden" name="nb-choice" value="1">
                            <label for="choice-1">Choix</label>
                            <input type="text" name="choice-1">
                            <button type="submit">Creer</button>
                        </form>
                    </div>
                <?php else : ?>
                    <div class="survey__content">
                        <p>Nom : <?= $survey_data['name'] ?></p>
                        <p>Description : <?= $survey_data['description'] ?></p>
                        <div class="survey__form">
                            <form action="../controller/survey.php?action='response'" method="POST">
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php require '../components/flash_message.php'; ?>
</body>

</html>

<!-- developed by achille david and thibaut dusautoir -->