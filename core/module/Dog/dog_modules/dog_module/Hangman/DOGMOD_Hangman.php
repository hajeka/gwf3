<?php
require_once 'HangmanGame.php';
/**
 * The Dog module with triggers for Nimdas hangman plugin.
 * @version 4.0
 * @author spaceone
 * @author noother
 * @author gizmore
 */
final class DOGMOD_Hangman extends Dog_Module
{
	private $instances = array();

	public function getOptions()
	{
		return array(
			'solve_anytime' => 'c,o,b,1', # channel operator boolean
			'placeholder' => 'c,o,s,*',   # channel operator string
			'lives' => 'c,o,i,8',         # channel operator integer
			'singleplayer' => 'c,o,b,0',  # channel operator boolean
		);
	}

	public function on_ADDhang_Pc()
	{
		$argv = $this->argv();
		$argc = count($argv);
		if ($argc === 1)
		{
			$hang_word = strtolower($argv[0]);
			$iso = Dog::getChannel()->getLangISO();
		}
		elseif ($argc === 2)
		{
			$hang_word = strtolower($argv[0]);
			$iso = strtolower($argv[1]);
		}
		else
		{
			return $this->showHelp('+hang');
		}
		
		
		if (GWF_String::strlen($hang_word) < 6 || GWF_String::strlen($hang_word) > 30)
		{
			return $this->rply('err_wordlen', array(6, 30));
		}

		if (!preg_match('/^\p{L}+$/Dui', $hang_word))
		{
			return $this->rply('err_alpha');
		}

		if (false !== ($word = Hangman_Words::getByWord($hang_word)))
		{
			return $this->rply('err_dup');
		}

		if (false === ($word = Hangman_Words::insertWord($hang_word, $iso)))
		{
			return Dog::err('ERR_DATABASE', array(__FILE__, __LINE__));
		}
		
		$this->rply('msg_added', array($hang_word, $word->getID()));
	}

	public function on_REMOVEhang_Hb()
	{
		$argv = $this->argv();
		if (1 !== ($argc = count($argv)))
		{
			return $this->showHelp('-hang');
		}
		$hang_word = strtolower($argv[0]);
		
		if (  (false === ($word = Hangman_Words::getByWord($hang_word)))
			&&(false === ($word = Hangman_Words::getByID($hang_word))) )
		{
			return $this->rply('err_word');
		}
		
		$id = $word->getID();

		if (false === $word->delete())
		{
			return Dog::err('ERR_DATABASE', array(__FILE__, __LINE__));
		}

		return $this->rply('msg_deleted', array($word->getVar('hangman_text'), $id));
	}

	public function on_hang_Pc()
	{
		$channel = Dog::getChannel();
		
		if (false === isset($this->instances[$channel->getID()]))
		{
			$config = array(
				'solution_allowed_everytime' => $this->getConfig('solve_anytime', 'c') === '1',
				'placeholder' => $this->getConfig('placeholder', 'c'),
				'lives' => $this->getConfig('lives', 'c'),
				'singleplayer' => $this->getConfig('singleplayer', 'c') === '1',
			);
			$this->instances[$channel->getID()] = new HangmanGame($config);
		}
		$hang = $this->instances[$channel->getID()];
		$hang instanceof HangmanGame;
		$this->reply($hang->onGuess(Dog::getUser()->getName(), $this->msgarg()));
	}
}
?>
