<?php


function replace($preg, $to, $string)
{
	return preg_replace('/'.$preg.'/',$to, $string);
}

function validadeMacAddres($mac)
{
	return (preg_match('/([a-fA-F0-9]{2}[:|\-]?){6}/', $mac) == 1);
}

function RemoveSeparator($mac, $separator = array(':', '-'))
{
	return str_replace($separator, '', $mac);
}

function AddSeparator($mac, $separator = ':')
{
	$result = '';
	while (strlen($mac) > 0)
	{
		$sub = substr($mac, 0, 2);
		$result .= $sub . $separator;
		$mac = substr($mac, 2, strlen($mac));
	}
	// remove trailing colon
	return substr($result, 0, strlen($result) - 1);
}

function utf8_str_split(string $input, int $splitLength = 1)
{
    $re = \sprintf('/\\G.{1,%d}+/us', $splitLength);
    \preg_match_all($re, $input, $m);
    return $m[0];
}

function removeUnsedBytes($string, $index=4)
{
    return substr($string, $index, strlen($string));
}

?>
