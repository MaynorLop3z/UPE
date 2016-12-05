
$(document).ready(function(){
    $(".onlyLettersS").keypress(function (event) {
        var inputValue = event.charCode;
        // allow letters and whitespaces only.
        onlyLettersS(inputValue, event);
    });
    
    $('.onlyNumbers').keypress(function (event) {
        var inputValue = event.charCode;
        if(!(inputValue >= 48 && inputValue <= 57) && (inputValue != 0) ) {
            event.preventDefault();
        };
    });
//    
//    $('.dateYMD').mask("0000r00r00", {
//        translation: {
//          'r': {
//            pattern: /[\/]/,
//            fallback: '-'
//          },
//          placeholder: "Año-Mes-Dia"
//        }   
//    });
});

function onlyLettersS(inputValue, event){
    if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)) {
        //alert("Retorna falso");
        event.preventDefault();
        return false;
    }
    else{
        //alert("Retorna verdadero");
        return true;
    }
    
}