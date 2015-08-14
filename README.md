# jmws_protostar_idMyGadget
This repo integrates the default joomla template protostar with idMyGadget (like jmws_protostar_idMyGadget). 

## This Template Requires jmws_idMyGadget_for_joomla
For this template to work properly, the jmws_idMyGadget_for_joomla must be installed.

Note that although jmws_idMyGadget_for_joomla comes with a very simple device detector (detect_mobile_browsers) installed "out of the box," it works best when you add one or more of the more sophisticated third-party device detection tools.

Fret not, however!  You can accomplish much of this by running one or more "git clone" commands.

For information on how to install this required code, see the jmws_idMyGadget_for_joomla README.md file.

## Status:
The initial version is pretty much complete, with the following exceptions:

* Integration testing has been minimal.
* Documentation is currently in progress, so at any given time it may be minimal or even lacking completely.

For a project like this, the task of "integration testing" can be extensive and problematic.

Moreover, because this is an experimental project, integration testing hardly seems worthwhile, because I do not know how many people, or even if any at all, might want to use it, much less what they might want to use it for.

Documentation suffers for similar reasons, and carries the additional burden that any documentation only increases the technical debt incurred when changes are made to the underlying code or that written on top of it.

## Specific Changes Made to Protostar

### Integration With IdMyGadget
This template uses IdMyGadget to determine whether the user is accessing the site on a phone, tablet, or desktop, and changes the output accordingly.

This template adds several options to the joomla administration console that allow users to customize the appearance of their site, especially the header, without the need for additional programming.

### Additional Admin Console Options
At some point I plan to post screen shots of these options to [joomoowebsites.com](http://joomoowebsites.com), so you may want to check there for more information.

In the meantime, this section contains a list.

#### New tab: IdMyGadget
* 

#### New tab: Hamburger Nav
* 

#### New tab: Phone Nav
* 

### Changes to Template Positions

#### position-7
Modules placed in the protostar template's existing position-7 appear only on desktops.

To make a module appear in position-7 on phones, put it in position-7-phone . 

To make a module appear in position-7 on tablets, put it in position-7-tablet . 

#### New Positions
The following positions appear in this template, but not in protostar:

* phone-header-nav
* phone-footer-nav
* phone-burger-menu-left
* phone-burger-menu-right

## Requests for Enhancements
I am open to doing additional work on this project.

Note however that I have invested a considerable amount of my own time on this, and depending on the nature of your request(s), I may request some sort of compensation.


## References:
For details about idMyGadget, see the idMyGadget README.md file:
* https://github.com/tomwhartung/idMyGadget/blob/master/README.md

Feel free to download idMyGadget, install the device detectors, and run the demos.

To see idMyGadget in action, see my resume:
* http://tomwhartung.com/resume

To see the power of device detection, when coupled with jQuery Mobile, be sure to visit the site using both a mobile phone and a desktop PC.

Note that the source for my resume is in github here:
* https://github.com/tomwhartung/resume

Feel free to download my resume, add your own details (in json, following the examples in the js/*-examples.js files, and make your own mobile-friendly resume!

For details about the specific idMyGadget code I am using for integration with joomla, see the jmws_idMyGadget_for_joomla README.md file:
* https://github.com/tomwhartung/jmws_idMyGadget_for_joomla/blob/master/README.md

