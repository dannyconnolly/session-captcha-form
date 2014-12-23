<?php
session_start();

if (!isset($_SESSION['num1']) && !isset($_SESSION['num2'])) {
    $_SESSION['num1'] = rand(1, 5);
    $_SESSION['num2'] = rand(1, 5);
}

/**
 *  HELPER FUNCTIONS
 */
function _getSessionValueFromKey($key) {
    if (isset($_SESSION['form'][$key])) {
        $value = $_SESSION['form'][$key];
    } else {
        $value = '';
    }

    return $value;
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <body>
        <div class="page">
            <nav class="demo-nav">

            </nav>
            <div class="content">
                <header class="demo-header">
                    <h1>Form captcha using Session</h1>
                </header>

                <div class="demo">
                    <form action="validate.php" method="post" class="basic-grey">

                        <h1>Contact Form 
                            <span>Please fill all the texts in the fields.</span>
                        </h1>
                        <?php
                        // print error here if any
                        if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
                            ?>
                            <div class="form-error">
                                <p class="title">Following errors were found: </p>
                                <?php
                                foreach ($_SESSION['error'] as $key => $value) {
                                    echo '<p>' . $value . '</p>';
                                }
                                ?>
                            </div>
                            <?php
                            unset($_SESSION['error']);
                        }
                        ?>  
                        <?php
                        // print error here if any
                        if (isset($_GET['msg'])) {
                            ?>
                            <div class="form-success">
                                <p class="title">Success. Your message has been sent. Please do not expect a reply, this is just a demo.</p>                                
                            </div>
                            <?php
                            unset($_SESSION['msg']);
                        }
                        ?>  
                        <label>
                            <span>Your Name :</span>
                            <input id="name" type="text" name="name" placeholder="Your Full Name" value="<?php echo _getSessionValueFromKey('name'); ?>"/>
                        </label>

                        <label>
                            <span>Your Email :</span>
                            <input id="email" type="text" name="email" placeholder="Valid Email Address" value="<?php echo _getSessionValueFromKey('email'); ?>" />
                        </label>

                        <label>
                            <span>Message :</span>
                            <textarea id="message" name="message" placeholder="Your Message to Us"  value="<?php echo _getSessionValueFromKey('message'); ?>"></textarea>
                        </label> 
                        <label>
                            <span>Subject :</span>
                            <select name="selection">
                                <option value="Job Inquiry">Job Inquiry</option>
                                <option value="General Question">General Question</option>
                            </select>
                        </label>    
                        <label>
                            <span><?php echo $_SESSION['num1']; ?> + <?php echo $_SESSION['num2']; ?>?</span>
                            <input id="captcha" type="text" name="captcha" placeholder="<?php echo $_SESSION['num1']; ?> + <?php echo $_SESSION['num2']; ?>?" />
                        </label>
                        <label>
                            <span>&nbsp;</span> 
                            <input type="submit" class="button" value="Send" name="submit_form" /> 
                        </label>    
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
