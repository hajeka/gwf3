<?php
$lang = array(
	'title' => 'PHP - Local File Inclusion',
	'info' =>
		'Votre mission est d'exploiter ce code, lequel a �videmment une :<a href="http://en.wikipedia.org/wiki/Local_File_Inclusion">faille LFI</a>:<br/>'.PHP_EOL.
		'<br/>'.PHP_EOL.
		'<code>%1$s</code><br/>'.PHP_EOL.
		'<br/>'.PHP_EOL.
		'Il y a beaucoup de choses importantes dans <a href="%2$s">../solution.php</a>, alors s'il vous pla�t vous pourriez inclure et ex�cuter ce fichier pour nous.<br/>'.PHP_EOL.
		'<br/>'.PHP_EOL.
		'Voici quelques exemples de ce script en action (dans la bo�te ci-dessous)::<br/>'.PHP_EOL.
		'<a href="%5$s">%5$s</a><br/>'.PHP_EOL.
		'<a href="%6$s">%6$s</a><br/>'.PHP_EOL.
		'<a href="%7$s">%7$s</a><br/>'.PHP_EOL.
		'<br/>'.PHP_EOL.
		'Pour les besoins de d�bogage, vous pouvez acc�der au <a href="%3$s">code source entier</a>, ainsi qu'a sa <a href="%4$s">version surlign�e</a>.<br/>'.PHP_EOL.
		'',

	'example_title' => 'Le script vuln�rable en action',
	'err_basedir' => 'Ce dossier n'est pas une partie du challenge.',
	'credits' => 'Merci � %1$s pour ces alpha tests, sa motivation et ces brillantes id�es!',
	'msg_solved' => 'Bien jou�. Si vous trouvez une faille de type local file inclusion, g�n�ralement la bo�te peut se pirat� en quelques minutes.',
);
?>