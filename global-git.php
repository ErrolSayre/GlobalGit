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
$response = `find . -name "*.git" -type d`;
$matches = explode(LF, $response);
foreach ($matches as $match) {
	if ($match) {
		// locate the parent directory
		$match = pathinfo($match, PATHINFO_DIRNAME);
		echo $match, LF;
		
		// only act upon this repo if there are arguments
		if ($arguments) {
			// remove the leading . placed by find
			$match = $dir.ltrim($match, '.');
			chdir($match);
			echo `git $arguments`, LF;
		}
	}
}
