$(document).ready(function() {
  $('.new').click(function() {
    if ($('.empty').length == 0) {
      var emptyCard = '<div class="empty card"><h3></h3><div></div></div>';
      $('.cards').prepend(emptyCard);
    });
  });
});
