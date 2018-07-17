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

    updateColors(null);

    $('.datetimepicker').datetimepicker({useCurrent: false, locale: 'es', showClose:true, format: "DD-MM-YYYY HH:mm"});

    $('.datetimepicker').datetimepicker().on("dp.change", function (e) {
        $(this).find('.updateDate').html(e.date.format("DD-MM-YYYY HH:mm")+'&nbsp;');
        ajax_post_function($(this));
    });
});


$(document).on('change', '.onlyView', function(e){
    e.preventDefault();
    var is_cheeck = $(this).prop("checked");
    $(this).prop("checked", !is_cheeck);
});

$(document).on('change', '.checkTask', function(e){

    var is_cheeck = $(this).prop("checked");
    if(!is_cheeck) {
        $(this).prop("checked", true);
    } else {
        var self = $(this);

        var FuncionOk = function (){
            ajax_post_function(self);
        };

        var FunctionCancelar = function (o){
            self.prop('checked', false);
        };

        showConfirmB("Tarea", "Vas a finalizar la tarea, ¿Estás de acuerdo?", FuncionOk, FunctionCancelar, [])
    }
});

function onUpdateColors(self){
    var all_complete = true;
    var total_subtask = 0;
    var pending_subtask = 0;
    self.find('.colorinput-color').each(function(){
        if(!$(this).hasClass('bg-green')) {
            all_complete = false;
            pending_subtask++;
        }
        total_subtask++;
    });

    var idTask = self.data('task');
    var idAgreement = self.data('agreement');

    $('.colorBar'+idAgreement+'_'+idTask).removeClass('bg-blue');
    $('.colorBar'+idAgreement+'_'+idTask).removeClass('bg-danger');
    $('.colorBar'+idAgreement+'_'+idTask).removeClass('bg-warning');
    $('.colorBar'+idAgreement+'_'+idTask).removeClass('bg-green');

    if(all_complete) {
        $('.colorBar'+idAgreement+'_'+idTask).addClass('bg-green');
    } else {

        var moment = require('moment');

        var startDate = self.find('.startDate').html();
        startDate = startDate.substring(0, (startDate.length - 6))+ ':00';
        startDate = moment(startDate, "DD-MM-YYYY HH:mm:ss");
        var startDateTxt = startDate.format('YYYY-MM-DD HH:mm:ss');

        var endDate = self.find('.endDate').html();
        endDate = endDate.substring(0, (endDate.length - 6)) + ':00';
        endDate = moment(endDate, "DD-MM-YYYY HH:mm:ss");
        var endDateTxt = endDate.format('YYYY-MM-DD HH:mm:ss');

        var currentDate = moment();
        var currentDateTxt = currentDate.format('YYYY-MM-DD HH:mm:ss');

        if(currentDate.isBefore(endDate)) {
            var minutosTotales = endDate.diff(startDate, 'minutes');
            var min30 = minutosTotales * .30;
            var alertDate = endDate.subtract(min30, 'minutes');

            if(currentDate.isAfter(alertDate)) {
                $('.colorBar'+idAgreement+'_'+idTask).addClass('bg-warning');
            } else {
                $('.colorBar'+idAgreement+'_'+idTask).addClass('bg-blue');
            }
        } else {
            $('.colorBar'+idAgreement+'_'+idTask).addClass('bg-danger');
        }
    }
}
function updateColors(selfParent){

    if(selfParent != null){
        selfParent.closest('.card_task').each(function() {
            onUpdateColors($(this));
        });
    } else {
        $('.card_task').each(function() {
            onUpdateColors($(this));
        });
    }
}

function checkTaskData(element){
    var formData = new FormData();

    formData.append("subtask", element.val());

    formData.append("agreement", element.data('agreement'));

    formData.append("_token", $("input[name='_token']").val());

    return formData;
}

function checkTask(o, self){

    label = self.parent();
    label.find("span").addClass("bg-green");
    label.find("span").attr('data-original-title', "Completada el " + o.complete_date);
    label.find("span").tooltip();

    self.prop('disabled', true);
    updateColors(self);
}

function checkTaskError(o, self){
    self.prop('checked', false);
    showAlert("Información", o.errors);
}


function updateTaskData(element){
    var formData = new FormData();
    formData.append("task", element.closest('.card_task').data('task'));
    formData.append("agreement", element.closest('.card_task').data('agreement'));

    var startDate = element.closest('.card_task').find('.startDate').html();
    startDate = startDate.substring(0, (startDate.length - 6));

    var endDate = element.closest('.card_task').find('.endDate').html();
    endDate = endDate.substring(0, (endDate.length - 6));

    formData.append("startDate", startDate+':00');

    formData.append("endDate", endDate+':00');
    formData.append("_token", $("input[name='_token']").val());

    return formData;
}

function updateTask(o, self){
    updateColors(self);
}

function updateTaskError(o, self){
    showAlert("Información", o.errors);
}



function ajax_post_function(element){
  //showLoader('Espera un momento...');

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
          //closeLoader();
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
