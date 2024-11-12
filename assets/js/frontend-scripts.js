jQuery(document).ready(function ($) {
  var $summaryContainer = $(
    ".ae_resume_body-summary.ae_resume_body-card.toggle-text"
  );

  // Select the paragraphs to include in the toggle (adjust the selector if needed)
  var $paragraphs = $summaryContainer.find("p");

  // Determine the cutoff point, for example after the first paragraph
  var cutoffIndex = 0; // Change this index to decide after which paragraph to hide content

  // Wrap all paragraphs after the cutoff point in a hidden container
  $paragraphs.each(function (index) {
    if (index > cutoffIndex) {
      $(this).wrapAll(
        '<div class="toggle-text-content" style="display: none;"></div>'
      );
    }
  });

  // Insert the ellipsis at the end of the last visible paragraph
  $paragraphs
    .eq(cutoffIndex)
    .append('<span class="toggle-text-ellipses">... </span>');

  // Add the "Read more" link at the end of the container
  $summaryContainer.append(
    '<a href="javascript:;" class="toggle-text-link">Read more</a>'
  );

  // Toggle content visibility on click
  $(".toggle-text-link").click(function () {
    var $this = $(this);
    var $content = $summaryContainer.find(".toggle-text-content");
    var $ellipses = $summaryContainer.find(".toggle-text-ellipses");

    $content.toggle(); // Show or hide the additional content
    $ellipses.toggle(); // Show or hide the ellipses

    // Change the link text based on the content's visibility
    if ($content.is(":visible")) {
      $this.text("Read less");
    } else {
      $this.text("Read more");
    }
  });

  $(".ae-toggle-text").each(function () {
    var fullText = $(this).find("p").html();
    var shortText = fullText.split("<br>")[0];

    if (fullText.length > shortText.length) {
      $(this)
        .find("p")
        .html(shortText + '... <a href="#" class="toggle-link">Read More</a>');

      $(this).on("click", ".toggle-link", function (e) {
        e.preventDefault();
        var isExpanded = $(this).hasClass("expanded");
        $(this).toggleClass("expanded");

        if (isExpanded) {
          $(this)
            .parent()
            .html(
              shortText + '... <a href="#" class="toggle-link">Read More</a>'
            );
        } else {
          $(this)
            .parent()
            .html(
              fullText +
                ' <a href="#" class="toggle-link expanded">Read Less</a>'
            );
        }
      });
    }
  });

  if ($(".ae_resume_body").length > 0) {
    var $right = $(".ae_resume_body-right");
    var $left = $(".ae_resume_body-left");
    var $container = $(".ae_resume_body");
    var offsetTop = $container.offset().top;
    var bottomLimit =
      $left.offset().top + $left.outerHeight() - $right.outerHeight();

    $(window).scroll(function () {
      var scrollTop = $(window).scrollTop();

      if (scrollTop > offsetTop && scrollTop < bottomLimit) {
        $right.css({
          position: "fixed",
          top: 0,
          right:
            $container.offset().left +
            parseInt($container.css("padding-right")) +
            "px",
        });
      } else if (scrollTop >= bottomLimit) {
        $right.css({
          position: "absolute",
          top: bottomLimit - offsetTop + "px",
          right: 0,
        });
      } else {
        $right.css({
          position: "relative",
          top: "auto",
          right: "auto",
        });
      }
    });
  }
});

/**
 * Bookmark Script
 */
jQuery(document).ready(function ($) {
  // Show tooltip on hover
  $(document).on("mouseenter", "[data-tooltip]", function () {
    var $this = $(this);
    var tooltipText = $this.attr("data-tooltip");

    // Create and append the tooltip to the hovered element
    var tooltip = $('<span class="tooltip"></span>').text(tooltipText);
    $this.append(tooltip);

    // Position the tooltip
    tooltip
      .css({
        top: $this.height() + 10 + "px", // 10px below the element
        left: "50%",
        transform: "translateX(-50%)",
        position: "absolute",
      })
      .fadeIn();
  });

  // Hide tooltip on mouse leave
  $(document).on("mouseleave", "[data-tooltip]", function () {
    $(this).find(".tooltip").remove();
  });

  // Using event delegation to bind events to dynamically loaded elements

  // Show the bookmark details when "add-bookmark" is clicked
  $(document).on("click", ".add-bookmark", function (e) {
    e.preventDefault();
    $(this).siblings(".bookmark-details").fadeIn();
  });

  // Close the bookmark details popup on clicking outside of it
  $(document).mouseup(function (e) {
    var container = $(".bookmark-details");

    if (!container.is(e.target) && container.has(e.target).length === 0) {
      container.fadeOut();
    }
  });

  // Reinitialize visibility settings when new content is loaded via AJAX
  $(document).on("ajaxComplete", function () {
    // Initially hide the bookmark details
    $(".bookmark-details").hide();
  });
});
