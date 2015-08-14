# jmws_protostar_idMyGadget
This repo integrates the default joomla template protostar with idMyGadget (like jmws_protostar_idMyGadget). 

## Dependencies
To function properly, this code requires installation of code in other reqpos.

### Required: jmws_idMyGadget_for_joomla
For this template to work properly, the jmws_idMyGadget_for_joomla must be installed.

Note that although jmws_idMyGadget_for_joomla comes with a very simple device detector (detect_mobile_browsers) installed "out of the box," it works best when you add one or more of the more sophisticated third-party device detection tools.

Fret not, however!  You can accomplish much of this by running one or more "git clone" commands.

For information on how to install this required code, see the jmws_idMyGadget_for_joomla README.md file.

### Highly Recommended: jmws_mod_menu_idMyGadget
For best results, install the jmws_mod_menu_idMyGadget module.

This is required for the hamburger (aka "PhoneBurger") menu to work, and your joomla site will probably whitescreen if you try to create a Hamburger Menu and this module is not present.

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
Clicking on the IdMyGadget tab reveals the following options unique to this template:

* New: Device Detector
  * Allows quickly switching between third-party device detectors
  * Note that each of these is **released under a different license** and has massively different capabilities, but that the IdMyGadget Adapter API makes them "look the same" to joomla
  * Note that only Detect Mobile Browsers works "out of the box," and it does not detect tablets
  * Mobile Detect requires installation from github, for more information see the (IdMyGadget README.md for Mobile Detect)[http://github.com/tomwhartung/idMyGadget/blob/master/gadget_detectors/mobile_detect/README.md]
  * Tera Wurfl requires installation from source forge and is dependent on a database. For more information see the (IdMyGadget README.md for Tera Wurfl)[https://github.com/tomwhartung/idMyGadget/blob/master/gadget_detectors/tera_wurfl/README.md]

##### Site header params - Phones

* Logo (Phone) - Replaces Admin -> Logo in protostar for phones
* Site Title (Phone) - Replaces Admin -> Site Title in protostar for phones
* Tag Line (Phone) - Replaces Admin -> Tag Line in protostar for phones
* Fluid Layout (Phone) - Replaces Admin -> Fluid Layout in protostar for phones

##### Site header params - Tablets

* Logo (tablet) - Replaces Admin -> Logo in protostar for tablets
* Site Title (tablet) - Replaces Admin -> Site Title in protostar for tablets
* Tag Line (tablet) - Replaces Admin -> Tag Line in protostar for tablets
* Fluid Layout (tablet) - Replaces Admin -> Fluid Layout in protostar for tablets

##### Site header params - Desktop Browsers

* Logo (Desktop) - Replaces Admin -> Logo in protostar for desktop browsers
* Site Title (Desktop) - Replaces Admin -> Site Title in protostar for desktop browsers
* Tag Line (Desktop) - Replaces Admin -> Tag Line in protostar for desktop browsers
* Fluid Layout (Desktop) - Replaces Admin -> Fluid Layout in protostar for desktop browsers

#### New tab: Hamburger Nav
This template supports the creation and placement of hamburger menus on one or both sides of the site header.

To make this work, you need to define an appropriate joomla menu and assign it to one of the new positions **phone-burger-menu-left** or **phone-burger-menu-right**.  Use the options on this tab if you define a menu and put it in one of these positions.

This template uses the jQuery Mobile JavaScript Library to display a mobile-friendly pop-up menu.  This may not be the best look, feel, and behavior on desktop browsers!

This template uses the HTML5 canvas element to draw the hamburger navigation icons.  Not all devices fully support using this functionality in this context.

Placing one or more image files in the `templates/jmws_protostar_idmygadget/images/idMyGadget` directory causes this template to use the file instead of drawing the icons.  This can be a good workaround for devices that do not support the HTML5 canvas in this context.  These images must be named as the following table describes.

File Name | Position | Device
----------|----------|-------
phoneBurgerMenuIconLeftPhone | Left | Phone
phoneBurgerMenuIconRightPhone | Right | Phone
phoneBurgerMenuIconLeftTablet | Left | Tablet
phoneBurgerMenuIconRightTablet | Right | Tablet
phoneBurgerMenuIconLeftDesktop | Left | Desktop
phoneBurgerMenuIconRightDesktop | Right | Desktop

**Note that this template scales the image to the size set in the options (Left Hamburger Menu Size or Right Hamburger Menu Size, as approprate).**

For up-to-date information about compatibility with respect to all of this functionality, see the latest articles on [joomoowebsites.com](http://joomoowebsites.com).

Clicking on the Hamburger Nav tab reveals the following options unique to this template:

* Hamburger Menu, Left Side
  * Show on tablets - menus placed in the **phone-burger-menu-left** position always appear on phones, pick yes to have this also display on tablets
  * Show on desktops - menus placed in the **phone-burger-menu-left** position always appear on phones, pick yes to have this also display on desktops
  * Left Hamburger Menu Size - choose one of the available values (in pixels)
  * Left Hamburger Menu Color - use the color picker or type in a hexadecimal RGB value
  * Left Hamburger Line Cap - select round, square, or butt
  * Left Hamburger Line Size - select normal, fat, or thin

* Hamburger Menu, Right Side
  * Show on tablets - menus placed in the **phone-burger-menu-right** position always appear on phones, pick yes to have this also display on tablets
  * Show on desktops - menus placed in the **phone-burger-menu-right** position always appear on phones, pick yes to have this also display on desktops
  * Right Hamburger Menu Size - choose one of the available values (in pixels)
  * Right Hamburger Menu Color - use the color picker or type in a hexadecimal RGB value
  * Right Hamburger Line Cap - select round, square, or butt
  * Right Hamburger Line Size - select normal, fat, or thin

#### New tab: Phone Nav
Clicking on the Phone Nav tab reveals the following options unique to this template:

* Theme for Nav on Phones - value is passed to jQuery Mobile, which has customizable themes (but not many "out of the box")

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

