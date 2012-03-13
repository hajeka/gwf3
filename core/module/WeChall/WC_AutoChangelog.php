<?php
/**
 * AutoChangelog for WeChall
 * updated by cronjob
 * @author spaceone
 */
final class WC_AutoChangelog
{

	private static $outfile = 'changes.txt';

	/**
	 *
	 * @todo poll only new revisions and append to changelogfile (extend GDO or modulevar?)
	 *  if GDO: repository url dynamically
	 * @todo add to WC Cronjob
	 * @todo rename
	 * @author spaceone
	 */
	public static function main()
	{
		$svn = new GWF_SvnInfo;
		$svn->setRepository('https://svn.gwf3.gizmore.org/GWF3');

		$startrev = 422;//292;
		$logs = $svn->getLog($startrev, 5000);

		$back = '';
		foreach ($logs as $log)
		{
			$comment = $log['comment'];
			$thx = '';

			if (Common::startsWith($comment, 'WC') || false !== strpos(strtolower($comment), 'wechall'))
			{
				# TODO: GWF_Date::toString

				if (0 < preg_match_all('/\(\s*?thx +([^\)]+)\)/', $comment, $matches))
				{
					foreach ($matches[1] as $match)
					{
						foreach (preg_split('/[\s,;]+/', $match) as $username)
						{
							$username = htmlspecialchars(trim($username));
							$thx .= sprintf('<a title="%s" href="%sprofile/%s">%s</a>'.PHP_EOL, $username, GWF_WEB_ROOT, $username);
						}
					}
				}

				# TODO: HTML formatting
				$pattern = 'Revision: %s; by %s; on %s;'.PHP_EOL.'  %s'.PHP_EOL.'%s'.PHP_EOL;
				$back .= sprintf($pattern, $log['version-name'], $log['creator-displayname'], $log['date'], str_replace("\n", "\n  ", $comment), $thx);
			}
		}

		if (false === file_put_contents(GWF_WWW_PATH.self::$outfile, $back))
		{
			# TODO
		}
	}
}
