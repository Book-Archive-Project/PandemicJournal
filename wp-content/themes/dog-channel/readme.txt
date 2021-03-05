=== dogchannel ===
Parent Theme: twentyseventeen
Version: 1.4.2
Contributors: Masuko Koeda
Tags: two-columns, right-sidebar, accessibility-ready, featured-images, full-width-template
Text Domain:  dog-channel
Requires at least: 4.9.4
Tested up to: 4.9.4
Stable tag: 4.9.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

This theme extend default theme Twenty Sixteen, and It's accessible theme of cute dog image for the site.
Also, if you change the background image you can use this theme on various sites.
The top page shows the background image on the full screen.

= About Accessibility =

Text color contrast ratio with the background color conforms success criteria (level AA) 1.4.3 of WCAG 2.0.
It's conforms success criteria for keyboard operation the criteria (level A) 2.1.1 of WCAG 2.0.
Added the aria-current attribute to the menu selected in the global menu.
When opening the drawer menu, the screen will be full screen, so move the tab key only to move within the menu (Focus does not move to the original page below) so that you will not lose track of the focus.
When closing the drawer menu, the focus on the original page is maintained.

== Theme dogchannel License ==

Dog Channel WordPress Theme is child theme of Twenty Seventeen WordPress Theme, Copyright 2018 Milk
Dog Channel WordPress Theme is distributed under the terms of the GNU GPL

== Theme twentyseventeen License ==
Twenty Seventeen WordPress Theme, Copyright 2016 WordPress.org
Twenty Seventeen is distributed under the terms of the GNU GPL

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

== Images License ==

All images
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== About Confirmation Display ==

Display confirmation etc. are performed under the following environment in the state where the theme unit test data is imported.

* OS:Windows 7
  BrowserF
   Internet Explorer11 (+ Zoom 200%, Maximum text size, Large text size)
   Firefox59.0.1 (+ Zoom 200%, Only text zoom 200%)
   GoogleChrome65.0.3325.162 (+ Zoom 200%)

* OS:Windows 10
  BrowserF
   Edge41.16299.248.0(+ Zoom 200%)
   Firefox59.0.1 (+ Zoom 200%, Only text zoom 200%)
   GoogleChrome65.0.3325.162 (+ Zoom 200%)

* OS:Mac OS High Sierra 10.13.3
  Browser:
   Safari11.0.3(+ Zoom 200%, Only text zoom 200%)
   Firefox59.0.1(+ Zoom 200%, Only text zoom 200%)
   GoogleChrome65.0.3325.162(+ Zoom 200%)

* Tablet:iPad iOS 11.2.6
  Browser:
   Safari

* Smartphone:Xperia Android8.0.0
  Browser:
   Firefox59.0.1
   GoogleChrome65.0.3325.109

* Smartphone:iPhone7 iOS 11.2.6
  Browser:
   Safari

* Xcode9.2 Simulator10.0 iPhoneX iOS 11.2

= Screen reader and browser used to confirm voice reading =

* PC-Talker 7 + Win7 Internet Explorer11
* NVDA 2018.1jp + Win7 Firefox59.0.1
* Voice Over + iPad iOS 11.2.6 Safari
* TalkBack6.1.0.186797687 + Xperia Android8.0.0 GoogleChrome65.0.3325.109


== Installation and Make the top page full screen ==

1. Unzip the downloaded theme's zip file.
2. Upload it in the wp-content/themes/ of server by the FTP.
3. In your admin panel, go to Themes of Appearance. 
4. Click activate to use this theme.
6. Set A static page in Appearance > Customize > Homepage Settings. And choose Front Page in Homepage and Blog in Posts page.

== Frequently Asked Questions ==

= Can I change the top page full screen display image? =
The top page full screen display image of this theme displays useing the background image of css.
So, replace the image of same file name and size as this theme.
This theme is made accessible.
So, Please make the contrast ratio of the background image and text color is 4.5: 1 or more.

= Can I change the color? =
Yes, you can. Please make the contrast ratio of the background image and text color is 4.5: 1 or more.

== Changelog ==

= 1.4.3 =
* 2018-07-16
* Add aria-current attribute of WAI-ARIA at the breadcrumb

= 1.4.2 =
* 2018-06-08
* Adjust style

= 1.4.1 =
* 2018-06-07
* Fix input padding and position h2  of front page blog

= 1.4.0 =
* 2018-06-03
* Change screenshot, Fix social link lisited color 

= 1.3.9 =
* 2018-06-01
* Change image of bg_body.png

= 1.3.8 =
* 2018-05-31
* Add a prefix to two functions, Changed copyright form

= 1.3.7 =
* 2018-05-28
* Add the file of content-front-page.php and the file of content-front-page-panels.php, Fix style of site-title and site-description

= 1.3.6 =
* 2018-05-27
* Change link style and on hover style on navigation

= 1.3.5 =
* 2018-05-27
* Change link style and on hover style

= 1.3.4 =
* 2018-05-23
* Fix text link color

= 1.3.3 =
* 2018-05-23
* Fix text link color, Fix textdomain

= 1.3.2 =
* 2018-05-19
* Fix some bugs

= 1.3.1 =
* 2018-05-18
* Fix something is breaking and pushing down the WordPress admin bar, Fix text and other content that is overlapping, Change the link colors for contrast 

= 1.3 =
* 2018-05-02
* Fix dogchannel.js to bug of focus to navigation menu, Fix style.css to letters of navigation menu hidden on smartphone 

= 1.2.4 =
* 2018-04-14
* Fix license of theme in readme and license file

= 1.2.3 =
* 2018-04-14
* Fix license in readme and license file

= 1.2.2 =
* 2018-04-14
* Add license in readme file

= 1.2.1 =
* 2018-04-13
* Fix escape function

= 1.2 =
* 2018-04-13
* Add license of images, Fixed escape url

= 1.1 =
* 2018-04-07
* Add license file, enqueued properly Google Fonts, Fixed PHP error

= 1.0 =
* 2018-03-23
* Theme Release