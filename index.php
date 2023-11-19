<?php
require_once "ViewEvent.php";?>
<HTML>
<HEAD>
    <TITLE>Evenimente</TITLE>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <nav class="navtop">
        <div>
            <h1>PST-EVENTS : evenimente</h1>
            <a href="login.html">Log in</a>
            <a href="logout.php"><i class="fas fa-sign-outalt"></i>Log out</a>
            <a href="index.php" type="disable">HOME</a>
        </div>
    </nav>
</HEAD>
<BODY>
<div id="product-grid">
    <div class="txt-heading"><div class="txt-headinglabel">EVENTS: </div></div>
    <?php
    $viewEvents = new ViewEvent();
    $events_array = $viewEvents->getAllProduct("events");
    $bookings_array = $viewEvents->getAllProduct("booking");
    $speakers_array = $viewEvents->getAllProduct("speakers");
    if (! empty($events_array)) {
        foreach ($events_array  as $key => $event) {
            ?>
            <div class="product-item">
                <form method="post" action="eveniment_<?php echo $events_array[$key]["ID"]; ?>.html"
                    <div>
                        <p>Titlu:  <strong><?php echo $events_array[$key]["titlu"];
                                ?></strong> </p>

                    </div>
                    <div>
                        <p> Data: <strong><?php echo $events_array[$key]["date"];
                            ?></strong> </p>
                    </div>
<!--                // verifica daca exista un speaker atribuit pt id-ul eventului in tabela bookings-->
                <?php
                $speakerlist = array();
                if (!empty($bookings_array)) {
                    foreach ($bookings_array as $booking) {
                        if ($booking["ID_EVENT"] == $event["ID"]) {
                            // Find all speakers information for the booked speakers
                            foreach ($speakers_array as $speaker) {
                                if ($speaker["ID"] == $booking["ID_SPEAKER"]) {
                                    array_push($speakerlist, $speaker["nume"]);
                                }
                            }
                        }
                    }
                }
                ?>
                <?php if (!empty($speakerlist)) { ?>
                    <div>
                        <p>Speakers:</p>
                        <ol>
                            <?php foreach ($speakerlist as  $speaker) { ?>
                                <li> <strong><?php echo $speaker; ?></strong></li>
                            <?php } ?>
                        </ol>
                    </div>
                <?php } ?>


                        <input type="text" name="quantity" value="1" size="2" />
                        <input type="submit" value="View page"
                               class="btnAddAction" />


                    </div>

                </form>
                <hr id="despartitor">
                <br>
            </div>
            <?php

        }
    }
    ?>
</div>
</BODY>
</HTML>




