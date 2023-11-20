<?php
session_start();
require_once "ViewEvent.php";?>
<HTML>
<HEAD>
    <TITLE>Evenimente</TITLE>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <nav class="navtop">
        <div>
            <h1>PST-EVENTS : evenimente</h1>
            <?php
                // Daca nu este logat, afiseaza DOAR link catre pagina de login:
                if (!isset($_SESSION['loggedin'])) {
                    echo '<a href="login.html">Log in</a>';
                }
            ?>

            <!-- <a href="login.html">Log in</a> -->

            <?php
                // Daca este logat, afiseaza DOAR link catre pagina de logout:
                if (isset($_SESSION['loggedin'])) {
                    echo '<a href="logout.php">Log out</a>';
                }
            ?>
            <!-- <a href="logout.php"><i class="fas fa-sign-outalt"></i>Log out</a> -->

            <a href="index.php" type="disable">HOME</a>

            <?php
                // Aici are treaba doar cu utilizatorii logati:
                if (isset($_SESSION['loggedin']))
                {
                    // Daca este admin, link-ul PROFIL merge catre adminHome.php
                    if ($_SESSION['isAdmin'] != 0) {
                        echo '<a href="adminHome.php">Profil</a>';
                    }
                    // Daca este user, link-ul PROFIL merge catre userHome.php
                    else {
                        echo '<a href="userHome.php">Profil</a>';
                    }
                }
                // !!daca apar erori in index cand nu esti logat, aici trebe umblat
            ?>
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
                <!--// verifica daca exista un speaker atribuit pt id-ul eventului in tabela bookings-->
                <?php
                $speakerlist = array();
                if (!empty($bookings_array)) {
                    foreach ($bookings_array as $booking) {
                        if ($booking["ID_EVENT"] == $event["ID"]) {
                            // Find all speakers information for the booked speakers
                            foreach ($speakers_array as $speaker) {
                                if ($speaker["ID"] == $booking["ID_SPEAKER"]) {
                                    $full_name = $speaker["nume"] . ' ' . $speaker["prenume"];
                                    array_push($speakerlist, $full_name);
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




