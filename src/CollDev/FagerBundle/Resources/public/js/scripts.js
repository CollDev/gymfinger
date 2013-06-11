/* 
 * Observaciones:
    * La tabla/entidad Statistic, deberia llamarse StatisticFager, porque quizas mas adelante hayan otros modulos de estadisticas
    * Se debe analizar bien el como se esta calculando el statistic_keystrokes y statistic_accuracy
    * Actualmente, las estadisticas son solo por palabras, y no por letras... es decir, si me equivoco letras y borro, no lo toma en cuenta
    * Tener en consideracion el implementar Google Analitics y sus respectivos _trackPageview (como en el juego de referencia)
 * 
 * Pregunta:
    * Las pulsaciones o keystrokes: los esta restando cuando una palabra es incorrecta, esta bien eso ?
 * Respuesta:
    * Eso está bien, debido a que en condiciones de exámenes de mecanografía, la calificación es tomada de esa manera.
 */
$.ajaxSetup({
    type: "POST",
    async: false
});
/**
 * Maneja el juego Fast fingers (Fager)
 * 
 * @type class Singleton
 */
var FagerGame = {
    /**
     * @type Array Arreglo que almacena las palabras que provienen del servidor (word1,word2,...,wordN)
     */
    words: [],
    /**
     * @type String Concatena el contenido de los span de las palabras a mostrar.
     */
    visible_words_html: '',
    /**
     * @type Array El keycode de la tecla que envia una palabra y permite escribir una nueva (despues podria ser otro o varios, ejemplo [9, 13, 32])
     */
    key_new_word: [32, 13],
    /**
     * @type Number Es una bandera que indica si ya inicio el juego o no.
     */
    start_game: 0,
    /**
     * @type String Almacena el intervalo del reloj.
     */
    timer: "",
    /**
     * @type Number Tiempo de inicio del juego (segun lo planeado, deberia ser del lado del server)
     */
    start_time: 0,
    /**
     * @type Number Tiempo de finalizacion del juego (segun lo planeado, deberia ser del lado del server)
     */
    end_time: 0,
    /**
     * @type Number Tiempo de duracion del juego en segundos.
     */
    duration: 60,
    /**
     * @type Number Tiempo de duracion del juego en segundos.
     */
    remaining: 0,
    /**
     * @type Number Almacena la cantidad de veces que el usuario borra una letra.
     */
    backspace_counter: 0,
    /**
     * @type String Es el valor de la palabra que el usuario acaba de enviar.
     */
    user_word: '',
    /**
     * @type String Almacena todas las palabras que el usuario ha escrito.
     */
    all_user_words: '',
    /**
     * @type Number Es el índice de la palabra actual dentro del arreglo words.
     */
    word_index: 0,
    /**
     * @type String Es el contenido html del palabra actual de todos los span.
     */
    current_word: '',
    /**
     * @type Number Es el número de fila de la palabra actual.
     */
    row_number: 0,
    /**
     * @type Number Es el tamaño en px de la altura de las palabras.
     */
    line_height: $("div.container-words").css("line-height").replace("px", ""),
    /**
     * @type Number Es la cantidad total de palabras escritas.
     */
    statistic_total: 0,
    /**
     * @type Number Es la cantidad de teclas pulsadas.
     */
    statistic_keystrokes: 0,
    /**
     * @type Number Es la cantidad de teclas válidas pulsadas.
     */
    statistic_validkeys: 0,
    /**
     * @type Number Es la cantidad de palabras correctas.
     */
    statistic_correct: 0,
    /**
     * @type Number Es la cantidad de palabras incorrectas.
     */
    statistic_wrong: 0,
    /**
     * @type Number Es el porcentaje de precision del juego.
     */
    statistic_accuracy: 0,
    /**
     * @type Number Cantidad de veces que al presionar una tecla, vuelve de color rojo a la palabra.
     */
    statistic_mistakes: 0,
    /**
     * @type Number Cantidad de veces que al presionar una tecla, no vuelve de color rojo a la palabra.
     */
    statistic_goodies: 0,
    /**
     * Inicializa todas las variables y prepara los eventos necesarios para el juego.
     */
    init: function() {
        FagerGame.restart();
        $("input#input-words").on("keyup", function(event) {
            if (!FagerGame.start_game) {
                //start
                FagerGame.start_game = 1;
                FagerGame.timer = window.setInterval(function(){ FagerGame.countdown(); }, 1000);
                FagerGame.start_time = FagerGame.getTime();
            }
            FagerGame.statistic_keystrokes++;
            if (event.which === 8) FagerGame.backspace_counter++;
            FagerGame.user_word = $.trim($("input#input-words").val());
            FagerGame.current_word = $("div.visible-words span[word_index='" + FagerGame.word_index + "']");
            if (FagerGame.key_new_word.indexOf(event.which) !== -1 && FagerGame.user_word === "") {
                $("input#input-words").val("");
            } else if (FagerGame.key_new_word.indexOf(event.which) !== -1) {
                FagerGame.statistic_total++;
                FagerGame.all_user_words+= FagerGame.user_word + ',';
                FagerGame.current_word.removeClass("highlight-wrong");
                if (FagerGame.user_word === FagerGame.words[FagerGame.word_index]) {
                    FagerGame.current_word.removeClass("highlight").addClass("correct");
                    FagerGame.statistic_correct++;
                    FagerGame.statistic_validkeys+= FagerGame.words[FagerGame.word_index].length + 1;
                } else {
                    FagerGame.current_word.removeClass("highlight").addClass("wrong");
                    FagerGame.statistic_wrong++;
                    FagerGame.statistic_validkeys-= Math.round(FagerGame.words[FagerGame.word_index].length / 2);
                }
                FagerGame.word_index++;
                FagerGame.current_word = $("div.visible-words span[word_index='" + FagerGame.word_index + "']");
                if (!FagerGame.current_word.length) {
                    FagerGame.endGame();
                    return false;
                }
                if (FagerGame.current_word.position().left === 0) 
                    $("div.visible-words").animate({ top: ((FagerGame.line_height * -1) * ++FagerGame.row_number) + "px" }, 500);
                FagerGame.current_word.addClass("highlight");
                $("input#input-words").val("");
            } else {
                if (FagerGame.user_word.replace(/\s/g,'') === FagerGame.words[FagerGame.word_index].substr(0, FagerGame.user_word.length)){
                    FagerGame.current_word.removeClass("highlight-wrong").addClass("highlight");
                    FagerGame.statistic_goodies++;
                }else{
                    FagerGame.current_word.removeClass("highlight").addClass("highlight-wrong");
                    FagerGame.statistic_mistakes++;
                }
            }
        });
        $("div.restart-fager").on("click", function() {
            FagerGame.restart();
        });
    },
    /**
     * Reestablece todas las variables y muestra un nuevo listado de palabras
     */
    restart: function() {
        $("div.container-result").fadeOut().remove();
        FagerGame.words = [];
        FagerGame.visible_words_html = '';
        FagerGame.start_game = 0;
        window.clearInterval(FagerGame.timer);
        FagerGame.timer = "";
        FagerGame.start_time = 0;
        FagerGame.end_time = 0;
        FagerGame.backspace_counter = 0;
        FagerGame.user_word = '';
        FagerGame.all_user_words = '';
        FagerGame.word_index = 0;
        FagerGame.current_word = '';
        FagerGame.row_number = 0;
        FagerGame.statistic_ip = $('.brand').data('ip');
        FagerGame.statistic_total = 0;
        FagerGame.statistic_keystrokes = 0;
        FagerGame.statistic_validkeys = 0;
        FagerGame.statistic_correct = 0;
        FagerGame.statistic_wrong = 0;
        FagerGame.statistic_accuracy = 0;
        FagerGame.statistic_mistakes = 0,
        FagerGame.statistic_goodies = 0,
        FagerGame.remaining = FagerGame.duration;
        $("div.timer").text(Math.floor(FagerGame.duration / 60) + ":" + (FagerGame.duration % 60 > 9 ? FagerGame.duration % 60 : "0" + FagerGame.duration % 60));
        $("div.container-game").hide();
        $("div.ajax-load").fadeIn();
        $.ajax($('.brand').attr('href') + "fager/getWords").done(function(data) {
            FagerGame.words = data.split(",");
            for (var i in FagerGame.words)
                FagerGame.visible_words_html+= '<span word_index="' + i + '">' + FagerGame.words[i] + '</span> ';
            $("div.visible-words").html(FagerGame.visible_words_html).css("top", "1px").find("span:first").addClass("highlight");
            $("input#input-words").val("").focus();
            $("div.ajax-load").hide();
            $("div.container-game").fadeIn();
        });
    },
    /**
     * Es la cuenta regresiva; al acabar el tiempo guarda y muestra los resultados
     */
    countdown: function() {
	FagerGame.remaining--;
        $("div.timer").text(Math.floor(FagerGame.remaining / 60) + ":" + (FagerGame.remaining % 60 > 9 ? FagerGame.remaining % 60 : "0" + FagerGame.remaining % 60));
        if (FagerGame.remaining > 0) return;
        FagerGame.endGame();
    },
    /**
     * Retorna el tiempo actual
     * 
     * @returns {Date} Fecha y hora actual en formato UTC
     */
    getTime: function() {
        return new Date().getTime();
    },
    /**
     * Esconde el juego, envía los datos y recibe los resultados por ajax, mostrándolos en una tabla
     */
    endGame: function() {
        $('div.container-game').hide();
        window.clearInterval(FagerGame.timer);
        FagerGame.timer = "";
        FagerGame.end_time = FagerGame.getTime();
        $.ajax({
            url: $('.brand').attr('href') + 'fager/statistic/',
            dataType: 'json',
            data: {
                total:      FagerGame.statistic_total,
                keystrokes: FagerGame.statistic_keystrokes,
                correct:    FagerGame.statistic_correct,
                wrong:      FagerGame.statistic_wrong,
                start_time: FagerGame.start_time,
                end_time:   FagerGame.end_time,
                duration:   FagerGame.duration,
                user_input: FagerGame.all_user_words,
                mistakes:   FagerGame.statistic_mistakes,
                goodies:    FagerGame.statistic_goodies,
                backspace_counter: FagerGame.backspace_counter
            }
        }).done(function(res) {
            Share.init(
                'Mi record es de ' + res.stats.total + ' palabras, Teclas presionadas: ' + res.stats.keystrokes + ', Precisión: ' + res.stats.accuracy + '%, Palabras por minuto: ' + res.stats.wpm + ', en ' + FagerGame.duration + ' segundos. ¿Podrás ganarme?',
                'Mi record es de ' + res.stats.total + ' palabras, precisión ' + res.stats.accuracy + '%, ' + res.stats.wpm + ' palabras por minuto, en ' + FagerGame.duration + ' segundos. ¿Podrás ganarme?'
            );
            var $share = Share.all();
            var $table = $('<table />')
                    .addClass('table-striped')
                    .append(
                        $('<tr />').append($('<td />').text('Total de palabras escritas'),  $('<td />').text(res.stats.total)),
                        $('<tr />').append($('<td />').text('Palabras correctas'),          $('<td />').text(res.stats.correct).css({ color : 'green'})),
                        $('<tr />').append($('<td />').text('Palabras incorrectas'),        $('<td />').text(res.stats.wrong).css({ color : 'red' })),
                        $('<tr />').append($('<td />').text('Total de teclas presionadas'), $('<td />').text(res.stats.keystrokes)),
                        $('<tr />').append($('<td />').text('Teclas acertadas'),            $('<td />').text(res.stats.goodies).css({ color : 'green'})),
                        $('<tr />').append($('<td />').text('Teclas erradas'),              $('<td />').text(res.stats.mistakes).css({ color : 'red'})),
                        $('<tr />').append($('<td />').text('Tecla backspace'),             $('<td />').text(res.stats.backspace_counter).css({ color : 'red'})),
                        $('<tr />').append($('<td />').text('Porcentaje de precisión'),     $('<td />').text(res.stats.accuracy).css({ color : 'green'})),
                        $('<tr />').append($('<td />').text('Palabras por minuto'),         $('<td />').text(res.stats.wpm)),
                        $('<tr />').append($('<td />').text('Teclas por segundo'),          $('<td />').text(res.stats.kps))
                    );
            var $result = $('<div />')
                    .addClass('container-result')
                    .append($share, $('<h3 />').text('Resultados'), $table, $('div.restart-fager').clone(true));
            $('div.container-game').after($result);
            $.getScript('https://apis.google.com/js/client:plusone.js');
        });
    }
};

$(document).on('ready', FagerGame.init());