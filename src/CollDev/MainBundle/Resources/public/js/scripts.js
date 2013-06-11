/**
 * Clase para la compartición en las redes sociales
 * 
 * @type class Singleton
 */
var Share =  {
    text: '',
    text_short: '',
    
    //Site config
    site_image: 'images/e6fff08.jpg',
    site_name: 'GymFinger',
    site_url: 'http://alice2.colldev.com/',
    
    //Facebook config
    face: '',
    face_appId: '427102800717300',
    face_class: 'share-fb',
    face_div_class: '',
    face_function_name: 'postToFeed',
    face_method: 'feed',
    face_pid: 'msg',
    face_text: 'Compártelo en Facebook',
    
    //Google Plus
    plus: '',
    plus_calltoactionlabel: 'RECORD',
    plus_calltoactionurl: 'fager/share',
    plus_class: 'g-interactivepost',
    plus_clientid: '215236839872.apps.googleusercontent.com',
    plus_cookiepolicy: 'single_host_origin',
    plus_text: 'Cuéntale a tus amigos!',
    
    //Twitter
    tweet: '',
    tweet_class: 'twitter-share-button',
    tweet_count: 'horizontal',
    tweet_div_class: '',
    tweet_href: 'https://twitter.com/share',
    tweet_lang: 'es',
    tweet_size: 'large',
    tweet_text: 'Twittealo',
    
    /**
     * Inicializa la la compartición
     * 
     * @param {string} text Texto a ser mostrado en las redes sociales.
     * @param {string} text_short Texto corto a ser mostrado en Twitter por ejemplo.
     */
    init: function(text, text_short){
        Share.text = text;
        Share.text_short = text_short;
    },
    /**
     * Comparte en todas las redes sociales disponibles
     * 
     * @returns {div DOM element} Capa con todos los botones
     */
    all: function(){
        return $('<div />').addClass('share').append(Share.googlePlus(), Share.facebook(), Share.twitter());
    },
    /**
     * Compartir en Facebook
     * 
     * @returns {div DOM element} Capa con el botón de Facebook
     */
    facebook: function(){
        var $a = $('<a />')
                    .addClass(Share.face_class)
                    .attr({"onclick" : Share.face_function_name + '(); return false;'})
                    .text(Share.face_text);
        var $p = $('<p />').attr({ id : Share.face_pid });
        var $script = $('<script />')
                    .text(
                        'FB.init(' +
                        '    {' +
                        '        "appId"  : "' + Share.face_appId + '",' +
                        '        "status" : true,' +
                        '        "cookie" : true' +
                        '    }' +
                        ');' +
                        'function ' + Share.face_function_name + '() {' +
                        '    function callback(response) {' +
                        '        document.getElementById("' + Share.face_pid + '").innerHTML = "Post ID: " + response["post_id"];' +
                        '    };' +
                        '    FB.ui(' +
                        '        {' +
                        '            "method"      : "' + Share.face_method + '",' +
                        '            "name"        : "' + Share.site_name + '",' +
                        '            "caption"     : "' + Share.site_url + '",' +
                        '            "description" : "' + Share.text + '",' +
                        '            "message"     : "' + Share.text + '",' +
                        '            "link"        : "' + Share.site_url + '",' +
                        '            "picture"     : "' + Share.site_url + Share.site_image + '",' +
                        '        }' +
                        '    );'+
                        '};'
                    );
        return $('<div />').addClass(Share.face_div_class).append($a, $p, $script);
    },
    /**
     * Compartir en Google+
     * 
     * @returns {div DOM element} Capa con el botón de Google+
     */
    googlePlus: function(){
        var $span_icon  = $('<span />').addClass('icon');
        var $span_label = $('<span />').addClass('label').text(Share.plus_text);
        return $('<button />')
                .addClass(Share.plus_class)
                .attr(
                    {
                        "data-cookiepolicy"      : Share.plus_cookiepolicy,
                        "data-contenturl"        : Share.site_url,
                        "data-clientid"          : Share.plus_clientid,
                        "data-prefilltext"       : Share.text,
                        "data-calltoactionlabel" : Share.plus_calltoactionlabel,
                        "data-calltoactionurl"   : Share.site_url + Share.plus_calltoactionurl
                    }
                ).append($span_icon, $span_label);
    },
    /**
     * Compartir en Twitter
     * 
     * @returns {div DOM element} Capa con el botón de Twitter
     */
    twitter: function(){
        var $a = $('<a />')
                    .addClass(Share.tweet_class)
                    .attr(
                        {
                            "data-count"    : Share.tweet_count,
                            "data-hashtags" : Share.site_name,
                            "data-lang"     : Share.tweet_lang,
                            "data-size"     : Share.tweet_size,
                            "data-text"     : Share.text_short,
                            "data-url"      : Share.site_url,
                            "href"          : Share.tweet_href
                        }
                    )
                    .text(Share.tweet_text);
        var $script = $('<script />').text('!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");');
        return $('<div />').addClass(Share.tweet_div_class).append($a, $script);
    }
};