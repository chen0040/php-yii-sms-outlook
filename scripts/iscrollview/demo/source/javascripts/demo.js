// The Mobile Safari Forms Assistant pushes the page up if it needs to scroll, but jQuery Mobile
// doesn't scroll the page back down. This code corrects that.
//
// I decided this should not be incorporated into jquery.mobile.iscrollview.js itself, since it
// really isn't related to iScroll - it is an issue that occurs when using pages that are sized
// to match full-height on mobile device.
//
// There is still code in jquery.mobile.iscrollview.js that deal with a similar issue with
// the address bar, and I think it really doesn't belong there.
//
// IDEA: Create a new plug-in to deal with such concerns: e.g. jquery.mobile.fullheight.
(function mobileSafariFormsAssistantHack($) {
  "use strict";
  $(document).bind("pageinit",
    function installDelegation(pageEvent) {
      var $page = $(pageEvent.target);
      $page.delegate("input,textarea,select", "blur",
        function onBlur(inputEvent) {
          setTimeout(function onAllBlurred() {  // Need this timeout for .ui-focus to clear
            // Are all of the input elements on the page blurred (not focused)?
            if ($page.find("input.ui-focus,textarea.ui-focus,select.ui-focus").length === 0) {
              $.mobile.silentScroll(0);        // If so, scroll to top
              }
            },
          0);
        });
    });
  }(jQuery));

$(document).bind("mobileinit", function() {
  $.mobile.defaultPageTransition = "slide";
  });
