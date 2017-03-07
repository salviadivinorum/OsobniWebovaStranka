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
                header('Location: emailformular.php?uspech=ano');
                exit;


            }
            else
            {
                $hlaska='E-mail se nepodařilo odeslat. Zkontrolujte, prosím, adresu.';
            }
        }


        else
            /* pokud neni nejake policko formulare spravne vyplnene */
            $hlaska = 'Formulář není správně vyplněný !';
    }


?>

<!DOCTYPE html>
<html lang="cs-cz">
    <head>
        <meta http-equiv="content-type" content="text/html">
        <meta charset="UTF-8">
        <link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css' />
        <link rel="stylesheet" href="stylformulare.css"/>
        <title>Kontaktní formulář</title>
    </head>
    <body>
    <p>Můžete mne kontaktovat pomocí tohoto formuláře:</p>
    <h1>Můžete mne kontaktovat pomocí formuláře</h1>

    <?php
    if ($hlaska)
            echo('<p>'. htmlspecialchars($hlaska) . '</p>');
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
            <input type="submit" value="Odeslat zprávu" name="submit" class="submit"/>
        </fieldset>
    </form>
    <p></p>


    <!-- stary formular bez stylovani -->
    <form method="POST">
        <table>
            <tr>
                <td>Vaše jméno:</td>
                <td><input name="jmeno" type="text" value="<?= htmlspecialchars($jmeno) ?>"/> </td>
                <!-- Automaticky hlida a doplnuje jiz jednou neco napsaneho -->
            </tr>

            <tr>
                <td>Váš e-mail:</td>
                <td><input name="email" type="email" value="<?= htmlspecialchars($email) ?>" /></td>
            </tr>
            <tr>
                <td>Aktuální rok</td>
                <td><input name="rok" type="number"/> </td>
            </tr>

        </table>
        <textarea name="zprava"><?= htmlspecialchars($zprava) ?></textarea>
        <br>

        <input type="submit" value="Odeslat"/>
    </form>
    </body>
</html>