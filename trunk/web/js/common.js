$(document).ready(function() {
        $(".tablesorter").tablesorter();
    });

$(document).ready(function() {
        // When page loads...
        // Hide all content
        $(".tab_content").hide();
        // Activate first tab
        $("ul.tabs li:first").addClass("active").show();
        // Show first tab content
        $(".tab_content:first").show();

        // On Click Event
        $("ul.tabs li").click(function() {
            // Remove any "active" class
            $("ul.tabs li").removeClass("active");
            // Add "active" class to selected tab
            $(this).addClass("active");
            // Hide all tab content
            $(".tab_content").hide();

            // Find the href attribute value to identify the active tab + content
            var activeTab = $(this).find("a").attr("href");
            // Fade in the active ID content
            $(activeTab).fadeIn();

            return false;
        });
    });

$(function() {
        $('.column').equalHeight();
    });
