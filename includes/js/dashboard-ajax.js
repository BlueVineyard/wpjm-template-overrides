jQuery(document).ready(function ($) {
  // Delete resume via AJAX
  $(".custom-delete-button").on("click", function (e) {
    e.preventDefault();
    var resumeId = $(this).data("resume-id");

    if (!confirm("Are you sure you want to delete this resume?")) {
      return;
    }

    $.ajax({
      url: wpjm_ajax_object.ajax_url,
      type: "POST",
      data: {
        action: "delete_resume",
        resume_id: resumeId,
        nonce: wpjm_ajax_object.delete_resume_nonce,
      },
      success: function (response) {
        if (response.success) {
          $("#resume-" + resumeId).fadeOut(); // Remove the row without reloading
          alert(response.data.message);
        } else {
          alert(response.data.message);
        }
      },
    });
  });

  // Hide resume via AJAX
  $(".custom-hide-button").on("click", function (e) {
    e.preventDefault();
    var resumeId = $(this).data("resume-id");

    $.ajax({
      url: wpjm_ajax_object.ajax_url,
      type: "POST",
      data: {
        action: "hide_resume",
        resume_id: resumeId,
        nonce: wpjm_ajax_object.hide_resume_nonce,
      },
      success: function (response) {
        if (response.success) {
          location.reload(); // Reload to reflect the new status
        } else {
          alert(response.data.message);
        }
      },
    });
  });

  // Publish resume via AJAX
  $(".custom-publish-button").on("click", function (e) {
    e.preventDefault();
    var resumeId = $(this).data("resume-id");

    $.ajax({
      url: wpjm_ajax_object.ajax_url,
      type: "POST",
      data: {
        action: "publish_resume",
        resume_id: resumeId,
        nonce: wpjm_ajax_object.publish_resume_nonce,
      },
      success: function (response) {
        if (response.success) {
          location.reload(); // Reload to reflect the new status
        } else {
          alert(response.data.message);
        }
      },
    });
  });
});
