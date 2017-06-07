require('./bootstrap');
$(function(){
  // window.fastclick(document.body);
  window.conversionToMinutes = function (secondNum, len) {
        if(secondNum !== undefined){
            secondNum = parseInt(secondNum);
            var minute = parseInt(secondNum / 60);
            var second = parseInt(secondNum % 60);
            if(minute >= 0 && second >= 0){
                minute = String(minute);
                second = String(second);
                return new Array(len - minute.length + 1).join('0') + ((minute + ':' + new Array(2 - second.length + 1).join('0') + second).split('').join(''));
            } else {
                return '0';
            }
        }
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
