<?php

namespace CollDev\FagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * Displays the Fast Fingers Game.
     *
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
    
    /**
     * List of words to type
     *
     * @Route("/getWords")
     * @Template()
     * @return \CollDev\FagerBundle\Controller\Response
     */
    public function getWordsAction()
    {
        $words = array('infante', 'marzo', 'duda', 'piedra', 'rapidez', 'yate', 'como', 'grave', 'norte', 'ropa', 'hermandad', 'niño', 'deber', 'oro', 'octubre', 'cabeza', 'Bolivia', 'sitio', 'miedo', 'incluso', 'edad', 'seis', 'hermana', 'pimienta', 'vuelta', 'huevo', 'labio', 'gobierno', 'enfermo', 'lugar', 'nuevo', 'tocar', 'demás', 'amor', 'frase', 'miércoles', 'partido', 'vegetal', 'texto', 'evitar', 'piel', 'calle', 'alma', 'casa', 'medieval', 'rostro', 'muestra', 'viejo', 'montaña', 'durante', 'ocupar', 'estación', 'hoy', 'pueblo', 'ochenta', 'loca', 'salchicha', 'tierra', 'oscuro', 'alguno', 'caliente', 'artista', 'haber', 'elemento', 'simple', 'mineral', 'nunca', 'paquete', 'espacio', 'mentira', 'interior', 'saludo', 'celeste', 'social', 'arriba', 'persona', 'sonar', 'nieve', 'Italia', 'revista', 'abierto', 'Brasilia', 'mayo', 'tomate', 'tener', 'domingo', 'piso', 'sentido', 'uno', 'pelo', 'equipo', 'China', 'otoño', 'estadio', 'cama', 'ganar', 'arquero', 'cine', 'meter', 'grande', 'cerca', 'bueno', 'tercer', 'tres', 'precio', 'Holanda', 'Malta', 'idioma', 'mesa', 'tonto', 'yo', 'usted', 'papel', 'lengua', 'menudo', 'mariposa', 'cebolla', 'antes', 'waterpolo', 'rico', 'tuerca', 'espuma', 'encontrar', 'mes', 'quien', 'dos', 'cimiento', 'página', 'medicina', 'ave', 'tan', 'listo', 'decir', 'estudio', 'temer', 'querer', 'abril', 'flor', 'seguro', 'madre', 'profundo', 'jabón', 'cantar', 'fondo', 'junto', 'punto', 'queso', 'pena', 'serio', 'tomar', 'martes', 'deseo', 'ciclismo', 'unir', 'verdad', 'radio', 'estar', 'resto', 'ayer', 'ella', 'recibir', 'total', 'arroba', 'notar', 'dedo', 'largo', 'comer', 'rana', 'ciencia', 'valor', 'donde', 'muralla', 'gente', 'hormiga', 'sentado', 'aire', 'gracia', 'doble', 'justo', 'siesta', 'famoso', 'carta', 'imprenta', 'trabajo', 'pronto', 'España', 'coche', 'cabra', 'contra', 'abogado', 'llegar', 'nervio', 'debajo', 'vivienda', 'araña', 'Chile', 'solo', 'hacia', 'delicado', 'nacer', 'forma', 'vista', 'echar', 'oveja', 'unidad', 'puro', 'ocho', 'este', 'tipo', 'correr', 'bombero', 'claridad', 'puerto', 'verano', 'señor', 'conocer', 'terminar', 'siquiera', 'carne', 'lince', 'Cuba', 'soldado', 'crear', 'pleno', 'cinco', 'señora', 'juego', 'cuadro', 'sueño', 'pues', 'prensa', 'cien', 'malo', 'imagen', 'tratar', 'hija', 'pescado', 'perro', 'otro', 'mejor', 'física', 'noche', 'oficial', 'empresa', 'Praga', 'oreja', 'definir', 'quinientos', 'cortar', 'presente', 'abajo', 'hospital', 'biología', 'mar', 'paraguas', 'alambre', 'barco', 'caso', 'dar', 'escritor', 'mano', 'saber', 'junio', 'semana', 'tienda', 'clavo', 'dato', 'base', 'falta', 'morir', 'ciudad', 'chispa', 'seguir', 'treinta', 'venir', 'almendra', 'aunque', 'salida', 'vida', 'concierto', 'yegua', 'bajo', 'restaurante', 'guerra', 'enseñar', 'joven', 'amistad', 'negro', 'rojo', 'más', 'memoria', 'lento', 'baloncesto', 'romper', 'siempre', 'acto', 'Viena', 'batería', 'arroz', 'pie', 'gris', 'parte', 'escoba', 'puente', 'oficina', 'cincuenta', 'real', 'vivir', 'felicidad', 'lenguaje', 'privar', 'defensa', 'nombre', 'ser', 'nadie', 'minuto', 'chaqueta', 'que', 'Roma', 'Lisboa', 'siete', 'agua', 'final', 'Australia', 'tirar', 'avenida', 'mercado', 'hacer', 'año', 'viento', ',dormido', 'veinte', 'mil', 'cintura', 'noventa', 'hombro', 'cuello', 'novela', 'ir', 'también', 'patata', 'primero', 'cuerpo', 'valer', 'manera', 'ratón', 'adiós', 'lunes', 'normal', 'dolor', 'bigote', 'Sevilla', 'sala', 'sombra', 'profesora', 'lucha', 'serie', 'tono', 'mucho', 'mismo', 'despacio', 'fuerte', 'situar', 'referir', 'azul', 'importar', 'reducir', 'riesgo', 'pobre', 'golpe', 'oeste', 'libertad', 'tarde', 'avellana', 'varias', 'nariz', 'nivel', 'canasta', 'hora', 'exacto', 'travieso', 'campo', 'paz', 'parecer', 'ahora', 'mono', 'duro', 'sacar', 'sonrisa', 'vestir', 'espalda', 'taxi', 'ley', 'Francia', 'zorro', 'historia', 'porque', 'futuro', 'serpiente', 'algo', 'igual', 'natación', 'órgano', 'nuestro', 'marinero', 'sector', 'primer', 'palacio', 'hasta', 'pero', 'dónde', 'marciano', 'volver', 'ninguno', 'pintor', 'playa', 'comienzo', 'noviembre', 'paso', 'Lima', 'dinero', 'mundo', 'jefe', 'luego', 'marchar', 'afecto', 'creer', 'servicio', 'lado', 'modo', 'alguien', 'superar', 'mujer', 'tarea', 'camello', 'cara', 'nada', 'silencio', 'despierto', 'ventana', 'Londres', 'subir', 'claro', 'dios', 'dejar', 'jirafa', 'odiado', 'vender', 'pastora', 'menor', 'crisis', 'diario', 'vaca', 'hermoso', 'rosa', 'música', 'cielo', 'suelo', 'museo', 'lejos', 'rato', 'fuente', 'rey', 'remedio', 'idea', 'plan', 'Madrid', 'jueves', 'camino', 'quitar', 'querido', 'león', 'temprano', 'poner', 'bien', 'libro', 'preciso', 'hombre', 'medio', 'vecino', 'hueso', 'poco', 'animal', 'cerrado', 'gesto', 'propio', 'invierno', 'quién', 'tenis', 'etapa', 'corto', 'tender', 'pared', 'mañana', 'llevar', 'luz', 'llenar', 'hablar', 'moral', 'tras', 'cuando', 'vivo', 'sal', 'usado', 'escalera', 'curioso', 'reunir', 'romántico', 'boca', 'sumario', 'proceso', 'pierna', 'Luanda', 'gato', 'enviar', 'general', 'puesto', 'menos', 'entrada', 'golondrina', 'leer', 'verde', 'tiempo', 'sol', 'agosto', 'tampoco', 'puerta', 'parque', 'elegido', 'padre', 'hola', 'poder', 'peso', 'gritar', 'gaviota', 'barrio', 'pasar', 'eso', 'aprender', 'kiwi', 'siglo', 'mientras', 'camino', 'voz', 'flauta', 'parar', 'violeta', 'mitad', 'encima', 'sobre', 'obra', 'fuego', 'blanco', 'según', 'canario', 'muy', 'viaje', 'sur', 'mover', 'beber', 'suerte', 'gustar', 'marido', 'cerdo', 'pareja', 'avión', 'viernes', 'caer', 'zona', 'masa', 'materia', 'quedar', 'error', 'libre', 'prueba', 'ver', 'país', 'brazo', 'todo', 'borrasca', 'momento', 'cosa', 'autor', 'cultura', 'indicar', 'alto', 'enero', 'diez', 'fiesta', 'lluvia', 'par', 'grupo');
//        $words = array('infante', 'marzo', 'duda', 'piedra', 'rapidez', 'yate', 'como', 'grave', 'norte', 'ropa', 'hermandad', 'niño', 'deber', 'oro', 'octubre', 'cabeza', 'Bolivia', 'sitio', 'miedo', 'incluso', 'edad', 'seis', 'hermana', 'pimienta', 'vuelta', 'huevo', 'labio', 'gobierno', 'enfermo', 'lugar', 'nuevo', 'tocar', 'demás', 'amor');
        shuffle($words);
        
        return new Response(implode(",", $words));
    }
    
    /**
     * End Game event
     *
     * @Route("/endGame")
     * @Template()
     * @return \CollDev\FagerBundle\Controller\Response
     */
    public function endGameAction()
    {
	$return = array("responseCode" => 200, 'response' => 'Statistic successfully created.');
        
    	return new Response(json_encode($return), 200, array('Content-Type'=>'application/json'));
    }
}
