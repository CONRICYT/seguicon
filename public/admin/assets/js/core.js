/**
 *
 */
let hexToRgba = function(hex, opacity) {
  let result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
  let rgb = result ? {
    r: parseInt(result[1], 16),
    g: parseInt(result[2], 16),
    b: parseInt(result[3], 16)
  } : null;

  return 'rgba(' + rgb.r + ', ' + rgb.g + ', ' + rgb.b + ', ' + opacity + ')';
};

/**
 *
 */
$(document).ready(function() {
  /** Constant div card */
  const DIV_CARD = 'div.card';

  /** Initialize tooltips */
  $('[data-toggle="tooltip"]').tooltip();

  /** Initialize popovers */
  $('[data-toggle="popover"]').popover({
    html: true
  });

  /** Function for remove card */
  $('[data-toggle="card-remove"]').on('click', function(e) {
    let $card = $(this).closest(DIV_CARD);

    $card.remove();

    e.preventDefault();
    return false;
  });

  /** Function for collapse card */
  $('[data-toggle="card-collapse"]').on('click', function(e) {
    let $card = $(this).closest(DIV_CARD);

    $card.toggleClass('card-collapsed');

    e.preventDefault();
    return false;
  });

  /** Function for fullscreen card */
  $('[data-toggle="card-fullscreen"]').on('click', function(e) {
    let $card = $(this).closest(DIV_CARD);

    $card.toggleClass('card-fullscreen').removeClass('card-collapsed');

    e.preventDefault();
    return false;
  });

  /**  */
  if ($('[data-sparkline]').length) {
    let generateSparkline = function($elem, data, params) {
      $elem.sparkline(data, {
        type: $elem.attr('data-sparkline-type'),
        height: '100%',
        barColor: params.color,
        lineColor: params.color,
        fillColor: 'transparent',
        spotColor: params.color,
        spotRadius: 0,
        lineWidth: 2,
        highlightColor: hexToRgba(params.color, .6),
        highlightLineColor: '#666',
        defaultPixelsPerValue: 5
      });
    };

    require(['sparkline'], function() {
      $('[data-sparkline]').each(function() {
        let $chart = $(this);

        generateSparkline($chart, JSON.parse($chart.attr('data-sparkline')), {
          color: $chart.attr('data-sparkline-color')
        });
      });
    });
  }

  /**  */
  if ($('.chart-circle').length) {
    require(['circle-progress'], function() {
      $('.chart-circle').each(function() {
        let $this = $(this);

        $this.circleProgress({
          fill: {
            color: tabler.colors[$this.attr('data-color')] || tabler.colors.blue
          },
          size: $this.height(),
          startAngle: -Math.PI / 4 * 2,
          emptyFill: '#F4F4F4',
          lineCap: 'round'
        });
      });
    });
  }

  $('input').each(function() {
      var is_cheeck = $(this).prop("checked");
      if(is_cheeck) {
          var label = $(this).parent();
          label.find("span").addClass("bg-green");

          $(this).prop("checked", true);
      }
  });

});

$(document).on('change', '.checkTask', function(e){

    var is_cheeck = $(this).prop("checked");
    if(!is_cheeck) {
        $(this).prop("checked", true);
    } else {
        var self = $(this);

        var FuncionOk = function (){
            $('#divConfirm').modal('hide');
            ajax_post_function(self);

        };

        var FunctionCancelar = function (o){
            self.prop('checked', false);
        };

        showConfirmB("Tarea", "Vas a finalizar la tarea, ¿Estás de acuerdo?", FuncionOk, FunctionCancelar, [])
    }
});

function checkTaskData(element){
    var formData = new FormData();

    element.closest('tr').find('input').each(function(){
        console.log($(this).val());
    });

    formData.append("username", "Groucho");

    return formData;
}

function checkTask(o, self){

    label = self.parent();
    label.find("span").addClass("bg-green");
    self.prop('disabled', true);
}

function checkTaskError(o, self){

}

function ajax_post_function(element){
  showLoader('Espera un momento...');

  var form_data = [];

  var function_data = element.data('function-data');
  var function_success = element.data('function-success');
  var function_error = element.data('function-error');

  if (function_data !== undefined) {
      form_data = window[function_data].apply(null, [element]);
  }

  $.ajax({
      'url': element.data('url'),
      type: 'post',
      dataType: 'json',
      data: form_data,
      processData: false,
      contentType: false,
      headers: {
          'X-CSRF-TOKEN': $('[name="_token"]').val()
      },
      success: function (o) {
          closeLoader();
          if (o.result == 1 || o.data !== undefined) {
              if (function_success !== undefined) {
                  window[function_success].apply(null, [o, element]);
              }
          } else {
              if (function_error !== undefined) {
                  window[function_error].apply(null, [o, element]);
              } else {
                  showAlert("Verify", o.errors);
              }
          }
      }
  });
}
