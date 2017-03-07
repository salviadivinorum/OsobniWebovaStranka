<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=windows-1250">
    <meta http-equiv="Content-Style-Type" content="text/css">
    <title>E-mailovy formular pro staticke stranky</title>
</head>
<body>

<table style="height:100%;" width="100%" cellSpacing="0" cellPadding="0" border="0">
    <tr><td align="center" valign="top">
            <form action="poslat.php" method="post">
                <table width="200" border="0" class="text">
                    <tr><td width="50"><strong>J</strong>méno:</td><td><input name="jmeno" accesskey="j" type="text"/></td></tr>
                    <tr><td width="50"><strong>E</strong>mail:</td><td><input name="email" accesskey="e" type="text"/></td></tr>
                    <tr><td width="50"><strong>W</strong>eb:</td><td><input name="web" accesskey="w" type="text" value="http://"/></td></tr>
                    <tr><td width="50" valign="top"><strong>T</strong>ext:</td><td><textarea name="text" accesskey="t" rows="5" cols="25"></textarea></td></tr>
                    <tr><td colspan="2" align="center"><input type="submit" class="button" value="Odeslat"/> <input type="reset" value="Vymazat"/></td></tr>
                </table>
            </form>
        </td></tr>
</table

</body>
</html>

