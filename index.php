<?php
require_once "ViewEvent.php";?>
<HTML>
<HEAD>
    <TITLE>Evenimente</TITLE>
    <link href="style.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">
    <nav class="navtop">
        <div>
            <h1>PST-EVENTS : evenimente</h1>
            <a href="login.html">Log in</a>

            <a href="logout.php"><i class="fas fa-sign-outalt"></i>Log out</a>
        </div>
    </nav>
</HEAD>
<BODY>
<div id="product-grid">
    <div class="txt-heading"><div class="txt-headinglabel">EVENTS: </div></div>
    <?php
    $viewEvents = new ViewEvent();
    $query = "SELECT * FROM events";
    $events_array = $viewEvents->getAllProduct($query);
    if (! empty($events_array)) {
        foreach ($events_array as $key => $value) {
            ?>
            <div class="product-item">
                <form method="post" action="cos.php?action=add&code=<?php
                echo $events_array[$key]["code"]; ?>">
                    <div class="product-image">
                        <img src="<?php echo $events_array[$key]["image"]; ?>">
                    </div>

                    <div>
                        <strong><?php echo $events_array[$key]["name"];
                            ?></strong>
                    </div>
                    <div class="product-price"><?php echo
                            "$".$events_array[$key]["price"]; ?></div>
                    <div>
                        <input type="text" name="quantity" value="1" size="2" />
                        <input type="submit" value="Add to cart"
                               class="btnAddAction" />
                    </div>
                </form>
            </div>
            <?php
        }
    }
    ?>
</div>
</BODY>
</HTML>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

</head>
<body>




</body>
</html>