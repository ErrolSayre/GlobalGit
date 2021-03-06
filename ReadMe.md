# GlobalGit

This script is designed to provide a simple way to issue the same Git command to all repositories within the current directory.

The intended use is to do things like `global-git status -s` to see a quick status list of all your projects but any arguments that can be passed to git can be done through this script. This means potentially destructive commands such as `reset --hard` or `remote rm origin` can quickly propagate to all of your repos. Please be careful. If you agree this is a dangerous situation and want to rectify it, please fork, fix, and share.

If you provide no arguments, the script will simply list each of the found repositories.

## Installation

I installed this on my machine by simply using `sudo cp global-git.php /usr/local/bin/global-git` so I wrote a script to do this for me as I iterated over the script. Feel free to make this more robust (adding confirmation perhaps?).

## Requirements

Currently this requires PHP to do its work because that's my most comfortable CLI environment. If someone with more experience with actual shell scripting would like to convert this to use pure sh commands I'd be willing to replace this.