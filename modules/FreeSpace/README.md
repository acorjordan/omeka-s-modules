# FreeSpace
Small omeka-S module that will add a block on admin dashboard to display the space remaining on server. 

The style will change to "warning", when the remaining space goes below the limit that is set in ```Module.php``` with the variable ```$gigaBytesWarningLimit``` (15 Gb by default).

## Default look:
![Screenshot with warning style](https://github.com/symac/Omeka-S-module-FreeSpace/raw/master/screenshot_ok.png)

## With warning:

![Screenshot with warning style](https://github.com/symac/Omeka-S-module-FreeSpace/raw/master/screenshot_full.png)

## Todo 
* Add a config screen to set the limit below which to switch to warning mode.

## Warning
Use it at your own risk.

It’s always recommended to backup your files and your databases and to check your archives regularly so you can roll back if needed.
