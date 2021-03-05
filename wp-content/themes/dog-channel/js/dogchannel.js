// active menu

if(jQuery('#top-menu li').hasClass('current-menu-item')){
  jQuery('.current-menu-item a').attr({
  'aria-current': 'page'
  });
}

/* 8. A part of progressive Hamburger by @heydonworks(https://twitter.com/heydonworks) http://heydonworks.com/
http://heydonworks.com/practical_aria_examples/#hamburger
-----------------------------------------------------------------------------------------
Modified little by milk. thanks by hiroron
*/

// At end of navigation block, return focus to navigation menu button

function navAction() {

jQuery('#top-menu li:last a:last').on('keydown', function(e) {
  if (e.keyCode === 9) {
    if (!e.shiftKey) {
      e.preventDefault();
      jQuery('[aria-controls="top-menu"]').focus();
    }
  }
});

jQuery('#top-menu > li:last-child .dropdown-toggle').on('keydown', function(e) {
  if (jQuery(this).attr('aria-expanded') == 'true') {
    if (e.keyCode === 9) {
      if (!e.shiftKey) {
        e.preventDefault();
        jQuery('.sub-menu li a').focus();
      }
    }
  } else {
    if (e.keyCode === 9) {
      if (!e.shiftKey) {
        e.preventDefault();
        jQuery('[aria-controls="top-menu"]').focus();
      }
    }
  }
});

// At start of navigation block, refocus close button on SHIFT+TAB

jQuery('#top-menu li:first a:first').on('keydown', function(e) {
  if (e.keyCode === 9) {
    if (e.shiftKey) {
      e.preventDefault();
      jQuery('[aria-controls="top-menu"]').focus();
    }
  }
});

// If the menu is visible, always TAB into it from the menu button

jQuery('[aria-controls="top-menu"]').on('keydown', function(e) {
  if (e.keyCode === 9) {
    if (jQuery(this).attr('aria-expanded') == 'true') {
      if (!e.shiftKey) {
        e.preventDefault();
        jQuery('#top-menu li:first a:first').focus();
      } else {
        if (e.shiftKey) {
          e.preventDefault();
          jQuery('#main').focus();
        }
      }
    }
  }
});

};

masthead = jQuery('#masthead');
menuToggle = masthead.find('.menu-toggle');
menuToggle.on('click.twentyseventeen', function() {
 navAction();
});