#!/usr/bin/php
<?php
// define helpful constants
if (!defined('LF'))	define('LF', "\n");

// locate the current tree
$dir = 	getcwd();
echo 'Git repositories in ', $dir, LF;

// determine if there are any arguments
$arguments = array();
if (count($argv) > 1) {
	$arguments = array_slice($argv, 1);
}
if (count($arguments)) {
	$arguments = implode(' ', $arguments);
}

// only continue if there are arguments
// locate git repositories in the current tree
$response = shell_exec('find . -name "*.git" -type d');
$matches = explode(LF, $response);
foreach ($matches as $match) {
	if ($match) {
		// determine if this match is a repo
		chdir($dir.'/'.$match);
		$isBare = shell_exec('git config core.bare');
		
		if (strpos($isBare, 'true') !== false) {
			// there will be no working directory, so assume the commands will work on bare repos
			echo $match, ' (bare repo)', LF;
		} else {
			// since this isn't a bare repo, assume the parent directory is the working copy
			$match = pathinfo($match, PATHINFO_DIRNAME);
			chdir($dir.'/'.$match);
			echo $match, LF;
		}
		
		// only act upon this repo if there are arguments
		if ($arguments) {
			passthru('git '.$arguments);
			echo LF, LF;
		}
	}
}
