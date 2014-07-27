<?php

if (!defined('IN_PHPBB'))
{
	exit();
}

$footnote_artref_tpl = <<< FOOTNOTE_ARTREF
<sup><a href="#{FOOTNOTE_ID}" id="{FOOTNOTE_ARTICLE_ID}" title="See note {FOOTNOTE_NUMBER}">{FOOTNOTE_NUMBER}</a></sup>
FOOTNOTE_ARTREF;

$footnote_tpl = <<< FOOTNOTE_TPL
<li id="{FOOTNOTE_ID}">{FOOTNOTE_TEXT} <a href="#{FOOTNOTE_ARTICLE_ID}" title="Back to article">&#8593;</a></li>
FOOTNOTE_TPL;

$footnotes_tpl = '<hr></hr><div class="footnotes"><p class="footnotes-message">Notes</p><ol>';

$footnotes_search = array('{FOOTNOTE_ID}', '{FOOTNOTE_ARTICLE_ID}', '{FOOTNOTE_NUMBER}', '{FOOTNOTE_TEXT}');

$match_count = preg_match_all("#\[note(?::$bbcode_uid)\](.*?)\[/note(?::$bbcode_uid)\]#si", $message, $matches);

if ($match_count > 0)
{

	$footnotes = $footnotes_tpl;
	$footnote_number = 1;

	for ($i = 0; $i < $match_count; $i++)
	{

		$footnote_artref = $footnote_artref_tpl;
		$footnote = $footnote_tpl;

		list($usec, $sec) = explode(' ', microtime());
		srand((float) $sec + ((float) $usec * 100000));
		$random_id = md5(microtime() . rand());

		$footnote_id = 'fn' . $random_id;
		$footnote_art_id = 'fna' . $random_id;

		$footnote_text = $matches[1][$i];

		$replace = array($footnote_id, $footnote_art_id, $footnote_number, $footnote_text);

		$footnote_artref = str_replace($footnotes_search, $replace, $footnote_artref);
		$footnote = str_replace($footnotes_search, $replace, $footnote);

		$footnotes = $footnotes . $footnote;
		$footnote_number++;

		$message = preg_replace('#\s*\[note(.*?)\](.*?)\[/note(.*?)\]#si', $footnote_artref, $message, 1);
	}

	$message = $message . $footnotes . "</ol></div>";
}

?>
