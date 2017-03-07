<!-- na zacatku mam php skript pro kontrolu vstupnich poli zadanych z formulare nize -->

<?php
    mb_internal_encoding("UTF-8");
    $hlaska='';
    if(isset($_GET['uspech']))
        $hlaska = 'E-mail byl úspěšně odeslán, brzy na něj odpovím.';

    /* podminka hlida jestli v poli _POST neco je */
    if ($_POST)
    {
        /* ze zadanych formularovych poli vytvori cely email */
        if(isset($_POST['jmeno']) && $_POST['jmeno'] &&
            isset($_POST['email']) && $_POST['email'] &&
            isset($_POST['zprava']) && $_POST['zprava'] &&
            isset($_POST['rok']) && $_POST['rok'] == date('Y'))
        {
            $hlavicka = "From:". $_POST['jmeno']."<" . $_POST['email'] . ">";
            $hlavicka .= "\nMIME-Version: 1.0\n";
            $hlavicka .="Content-Type: text/html; charset=\"utf-8\"\n";
            $adresa = 'devadave@seznam.cz';
            $predmet = 'Nová zpráva z mailformu na david.tode.cz';

            /* uspech nastane kdyz $uspech je nenulovy  - email byl odeslan */
            $uspech = mb_send_mail($adresa, $predmet, $_POST['zprava'], $hlavicka);
            if($uspech)
            {
                /* pri uspechu skript presmeruje na hlavicku tohoto sameho souboru s formularem emailformular.php */
                $hlaska = 'E-mail byl úspěšně odeslán, brzy na něj odpovím.';
                header('Location: kontaktform.php?uspech=ano');
                /* header('Location:kontaktform.php#kotva'); */

                exit;
            }
            else
            {
                $hlaska='E-mail se nepodařilo odeslat. Zkontrolujte, prosím, adresu.';
            }
        }

        else
            /* pokud neni nejake policko formulare spravne vyplnene */
        {

           /* header('Location:kontaktform.php#kotva'); */
            $hlaska = 'Formulář není správně vyplněný !';

        }
    }


?>

<!-- tohle mel byt pokus jak si vymazat pomoci JavaScriptu policka v input -->
<!--
<script type="text/javascript">
    function ClearFields() {
        document.getElementById("novyform").value="";

        <?php
            /*
        $_POST= array();
        $_GET = array();
            */
        ?>

    }
</script>
-->



<!-- vlastni stranka "Kontakt" s kontaktnim formularem -->
<!DOCTYPE html>
<html lang="cs-cz">
    <head>
        <meta name="description" content="Kontakt na Davida Jaroše"/>
        <meta name="keyworda" content="osobní, programátor, c#, kontakt"/>
        <meta http-equiv="content-type" content="text/html">
        <meta charset="UTF-8">
        <link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css' />
        <link rel="stylesheet" href="css/stylmailform.css"/>

        <link rel="shortcut icon" href="obrazky/clovek.ico"/>
        <title>Kontaktní formulář</title>
    </head>

    <div id="centrovac">
    <body>
        <header>
        <div id="logo"><a href="index.html"><h1>Ing. David Jaroš</h1></a></div>
        <nav>
            <ul>
                <li><a href="index.html">Úvod</a></li>
                <li><a href="programator.html">Programátor</a> </li>
                <li><a href="projektant.html">Projektant</a> </li>
                <li><a href="vizualizace.html">Vizualizace</a> </li>
                <li class="aktivni"><a href="kontaktform.php">Kontakt</a> </li>
            </ul>
        </nav>
        </header>

        <article>
            <header>
                <h1>Kontakt</h1>
            </header>
            <section>
                <p><strong>Ing. David Jaroš</strong><br>
                    Rejvízská 178<br>
                    790 01 Jeseník
                </P>
                <p></p>
                <p>tel. 725 564 528<br>
                   e-mail: david.jaros(zavináč)centrum.cz
                </p>
                <p>
                    Můj životopis v <a href="obrazky/pdf/David-CZ.pdf" target="_blank">češtině</a>
                    nebo v <a href="obrazky/pdf/David-EN.pdf" target="_blank">angličtině</a><br>
                    Odkaz na mého současného zaměstnavatele <a href="http://www.projekce50r.cz" target="_blank">Ing. Martina Černohouse</a><br>
                    <em>Odkaz na mé (původní) osobní stránky v CMS Wordpress
                        na adrese <a href="http://www.bezva.tode.cz" target="_blank">www.bezva.tode.cz</a>
                    </em>
                </P>
                <p></p>
                <p><strong>Můžete mne kontaktovat pomocí tohoto formuláře:</strong></p>

                <!-- Vlastni kontaktni formular -->
                <!-- Zde vlozen php skript pro vypis chybovych hlasek pri odesilani zpravy -->

                <?php
                    if ($hlaska)
                    {
                        echo('<p id="chyba">'. htmlspecialchars($hlaska) . '</p>');
                        /* header('Location: kontaktform.php#kotva'); */
                    }
                    /* hlida jiz jednou zadany vstup at se neztrati */
                    $jmeno = (isset($_POST['jmeno'])) ? $_POST['jmeno'] : '';
                    $email = (isset($_POST['email'])) ? $_POST['email'] : '';
                    $zprava = (isset($_POST['zprava'])) ? $_POST['zprava'] : '';
                ?>
                <!-- Novy formular se stylovanim -->

                <form id="novyform" method="POST">
                    <fieldset id="user-details">
                        <label for="jmeno">Vaše jméno:</label>
                        <input type="text" name="jmeno"  value="<?= htmlspecialchars($jmeno) ?>"/>

                        <label for="email">Váš e-mail:</label>
                        <input type="email" name="email" value="<?= htmlspecialchars($email) ?>"/>

                        <label for="rok">Aktuální rok:</label>
                        <input type="text" name="rok"/>
                    </fieldset>
                    <fieldset id="user-message">
                        <label for="zprava">Vaše zpráva:</label>
                        <textarea name="zprava" rows="0" cols="0"><?= htmlspecialchars($zprava) ?></textarea>
                        <input type="submit" value="Odeslat" name="submit" class="submit"/>
                        <!--
                        <input type="reset" value="Vymazat" class="reset" onclick="ClearFields"/>
                        -->
                    </fieldset>
                </form>

                <p></p>
            </section>

            <!-- vlozen postranni panel - sidebar -->
            <div id="sidebar">
                <aside>
                    <ul>
                        <h3>Rychlá navigace</h3>
                        <p class="podtrzitko"></p>
                        <li><a href="index.html">Úvod</a></li>
                        <li><a href="obrazky/pdf/David-CZ.pdf" target="_blank">Životopis v češtině</a></li>
                        <li><a href="http://www.github.com/salviadivinorum" target="_blank">Portfolio na GitHub</a></li>
                        <li><a href="kontaktform.php">Kontakt</a></li>
                    </ul>
                </aside>
            </div>
            <div class="cistic"></div>

        </article>
        <footer  >
            <p>Vytvořil &copy; Ing. David Jaroš 2017</p>
        </footer>
    </body>
    </div>
</html>