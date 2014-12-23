<?php

session_start();

if (!isset($_SESSION['num1']) || !isset($_SESSION['num2'])) {
    // no known session. cannot validate captcha
    $_SESSION['error']['captcha'] = 'Cannot validate captcha.';
    foreach ($_POST as $key => $value) {
        if (!is_array($_POST[$key])) {
            $$key = addslashes($value);
            $_SESSION['form'][$key] = $value;
        }
    }

    header('Location: index.php');
    exit;
}

$sum = (int) $_SESSION['num1'] + (int) $_SESSION['num2'];
if (isset($_POST['captcha']) && (int) $_POST['captcha'] !== $sum) {
    // captcha given but incorrect
    $_SESSION['error']['captcha'] = 'Captcha incorrect.';
    foreach ($_POST as $key => $value) {
        if (!is_array($_POST[$key])) {
            $$key = addslashes($value);
            $_SESSION['form'][$key] = $value;
        }
    }

    header('Location: index.php');
    exit;
} else {
    // captcha correct, show a new one next time
    unset($_SESSION['num1'], $_SESSION['num2']);
    //submit
    if (isset($_POST['submit_form'])) {


        $error = false;

        //assign posted variables
        foreach ($_POST as $key => $value) {
            if (!is_array($_POST[$key])) {
                $$key = addslashes($value);
                $_SESSION['form'][$key] = $value;
            }
        }

        if ($name == '') {
            $_SESSION['error']['name'] = 'Full name is required';
            $error = true;
        }

        if ($email == '') {
            $_SESSION['error']['email'] = 'Email is required';
            $error = true;
        }
        $valid_email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($valid_email == false) {
            $_SESSION['error']['email'] = 'Please enter a valid email';
            $error = true;
        }
        if (!$error) {
            /*
              function _getSessionValueFromKey($key) {
              if (isset($_SESSION['form'][$key])) {
              $value = $_SESSION['form'][$key];
              } else {
              $value = '';
              }
              return $value;
              }
             */
            if (isset($_SESSION)) {
                session_destroy();
                unset($_SESSION);
            }

            $url = 'index.php?msg=success';
            header('Location: ' . $url);
            exit;
        } else {
            $url = 'index.php';
            header('Location: ' . $url);
            exit;
        }
    }
}
?>