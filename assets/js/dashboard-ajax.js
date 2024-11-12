jQuery(document).ready(function ($) {
  // Delete resume via AJAX
  $(".custom-delete-button").on("click", function (e) {
    e.preventDefault();

    if (!confirm("Are you sure you want to delete this resume?")) {
      return;
    }

    var resumeId = $(this).data("resume-id");

    $.ajax({
      url: wpjm_ajax_object.ajax_url,
      type: "POST",
      data: {
        action: "wpjm_delete_resume",
        resume_id: resumeId,
        nonce: wpjm_ajax_object.delete_resume_nonce,
      },
      success: function (response) {
        if (response.success) {
          alert(response.data.message);
          location.reload(); // Reload the page or remove the row
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
        action: "wpjm_hide_resume",
        resume_id: resumeId,
        nonce: wpjm_ajax_object.hide_resume_nonce,
      },
      success: function (response) {
        if (response.success) {
          alert(response.data.message);
          location.reload(); // Reload the page or change the status visually
        } else {
          alert(response.data.message);
        }
      },
    });
  });
});
