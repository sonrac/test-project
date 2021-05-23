$(document).ready(function () {

  function getResult() {
    let range = $('#range').val(),
        place = $('#place').val();

    $.post(
      '/coords/calculate/' + place.toString() + '/' + range.toString(),
      {},
      function (response) {
        let entries = Object.entries(response),
            $results = $('#results');
        $results.empty()
        for (let index in entries) {
          $results.append(
            $('<div/>').text(entries[index][0] + ' ( ' + entries[index][1].toString() + ' km )')
          )
        }
      }
    )
  }

  $('#place').on('change', function (e) {
    let $this = $(this),
      disabled = false,
      $ranges = $('#range, #range-value');

    if (!$this.val()) {
      disabled = true;
    }

    if (disabled) {
      $ranges.attr('disabled', 'disabled');
    } else {
      $ranges.removeAttr('disabled');
      getResult();
    }
  })

  $('#range').on('input', function (){
    $('#range-value').val($(this).val())
  }).on('change', function (){
    getResult();
  });

  $('#range-value').on('change', function (){
    $('#range').val($(this).val())
    getResult();
  });

  $('form').on('submit', function (e) {
    e.stopPropagation();
    e.preventDefault();

    return false;
  })
});
