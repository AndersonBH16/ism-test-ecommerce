<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'id' => 1,
                'name' => 'Televisor Smart 50"',
                'description' => 'Televisor Smart 50" 4K UHD con HDR, sistema operativo Android TV, conexión Wi-Fi, 3 puertos HDMI y control por voz con Google Assistant.',
                'price' => 12.30,
                'image' => 'https://images.pexels.com/photos/6976094/pexels-photo-6976094.jpeg',
                'stock' => 14,
                'category_id' => 1
            ],
            [
                'id' => 2,
                'name' => 'Audífonos Bluetooth',
                'description' => 'Audífonos Bluetooth con cancelación de ruido, 30 horas de autonomía, micrófono incorporado para llamadas y diseño ergonómico over-ear.',
                'price' => 14.60,
                'image' => 'https://images.pexels.com/photos/3945667/pexels-photo-3945667.jpeg',
                'stock' => 27,
                'category_id' => 1
            ],
            [
                'id' => 3,
                'name' => 'Laptop Dell Inspiron',
                'description' => 'Laptop Dell Inspiron 15.6", procesador Intel Core i7, 16GB RAM, SSD 512GB, tarjeta gráfica NVIDIA MX350 y Windows 11 preinstalado.',
                'price' => 16.90,
                'image' => 'https://images.pexels.com/photos/18105/pexels-photo.jpg',
                'stock' => 44,
                'category_id' => 1
            ],
            [
                'id' => 4,
                'name' => 'Cámara de seguridad Wi-Fi',
                'description' => 'Cámara de seguridad Wi-Fi 1080p con visión nocturna, detección de movimiento, ángulo de visión de 130° y almacenamiento en la nube.',
                'price' => 19.20,
                'image' => 'https://images.pexels.com/photos/4220967/pexels-photo-4220967.jpeg',
                'stock' => 45,
                'category_id' => 1
            ],
            [
                'id' => 5,
                'name' => 'Mouse inalámbrico Logitech',
                'description' => 'Mouse inalámbrico Logitech con sensor óptico de 2400DPI, batería recargable, diseño ergonómico y conexión USB tipo A.',
                'price' => 21.50,
                'image' => 'https://images.pexels.com/photos/2115257/pexels-photo-2115257.jpeg',
                'stock' => 44,
                'category_id' => 1
            ],
            [
                'id' => 6,
                'name' => 'Teclado mecánico RGB',
                'description' => 'Teclado mecánico RGB con interruptores Blue, retroiluminación personalizable, reposamuñecas ergonómico y construcción en aluminio.',
                'price' => 23.80,
                'image' => 'https://images.pexels.com/photos/52608/pexels-photo-52608.jpeg',
                'stock' => 33,
                'category_id' => 1
            ],
            [
                'id' => 7,
                'name' => 'Parlante portátil JBL',
                'description' => 'Parlante portátil JBL con 20W de potencia, resistencia al agua IPX7, batería de 12 horas y conectividad Bluetooth 5.0.',
                'price' => 26.10,
                'image' => 'https://images.pexels.com/photos/1649771/pexels-photo-1649771.jpeg',
                'stock' => 23,
                'category_id' => 1
            ],
            [
                'id' => 8,
                'name' => 'Monitor LED 24"',
                'description' => 'Monitor LED 24" Full HD, tiempo de respuesta 5ms, puertos HDMI/VGA, modo lectura y filtro contra luz azul.',
                'price' => 28.40,
                'image' => 'https://images.pexels.com/photos/777001/pexels-photo-777001.jpeg',
                'stock' => 49,
                'category_id' => 1
            ],
            [
                'id' => 9,
                'name' => 'Tablet Samsung Galaxy',
                'description' => 'Tablet Samsung Galaxy S6 Lite 10.4", S Pen incluido, 64GB almacenamiento, Android 12 y batería de 7040mAh.',
                'price' => 30.70,
                'image' => 'https://images.pexels.com/photos/1334597/pexels-photo-1334597.jpeg',
                'stock' => 42,
                'category_id' => 1
            ],
            [
                'id' => 10,
                'name' => 'Cargador portátil 20,000 mAh',
                'description' => 'Cargador portátil 20,000 mAh con carga rápida PD 18W, doble entrada USB, compatible con smartphones y tablets.',
                'price' => 33.00,
                'image' => 'https://images.pexels.com/photos/1038628/pexels-photo-1038628.jpeg',
                'stock' => 12,
                'category_id' => 1
            ],
            [
                'id' => 11,
                'name' => 'Reloj inteligente Xiaomi',
                'description' => 'Reloj inteligente Xiaomi con pantalla AMOLED de 1.6", monitor de frecuencia cardíaca, SpO2, 120 modos deportivos y 14 días de batería.',
                'price' => 35.30,
                'image' => 'https://images.pexels.com/photos/437037/pexels-photo-437037.jpeg',
                'stock' => 48,
                'category_id' => 2
            ],
            [
                'id' => 12,
                'name' => 'Dron con cámara HD',
                'description' => 'Dron con cámara HD 4K, estabilización EIS, control por GPS, tiempo de vuelo de 25 minutos y alcance de 800 metros.',
                'price' => 37.60,
                'image' => 'https://images.pexels.com/photos/1261822/pexels-photo-1261822.jpeg',
                'stock' => 32,
                'category_id' => 2
            ],
            [
                'id' => 13,
                'name' => 'Lámpara LED inteligente',
                'description' => 'Lámpara LED inteligente compatible con Alexa y Google Home, 16 millones de colores, control por app y temporizador programable.',
                'price' => 39.90,
                'image' => 'https://images.pexels.com/photos/1493226/pexels-photo-1493226.jpeg',
                'stock' => 45,
                'category_id' => 2
            ],
            [
                'id' => 14,
                'name' => 'Disco SSD 1TB',
                'description' => 'Disco SSD 1TB NVMe M.2, velocidades de lectura/escritura hasta 3500/3000MB/s, compatible con PC y laptops.',
                'price' => 42.20,
                'image' => 'https://images.pexels.com/photos/2588757/pexels-photo-2588757.jpeg',
                'stock' => 39,
                'category_id' => 2
            ],
            [
                'id' => 15,
                'name' => 'Router Wi-Fi 6',
                'description' => 'Router Wi-Fi 6 AX1800, doble banda, 4 antenas externas, soporta hasta 128 dispositivos y cobertura de 150m².',
                'price' => 44.50,
                'image' => 'https://images.pexels.com/photos/1148820/pexels-photo-1148820.jpeg',
                'stock' => 50,
                'category_id' => 2
            ],
            [
                'id' => 16,
                'name' => 'Proyector Full HD',
                'description' => 'Proyector Full HD 1080p, 5000 lúmenes, conexión HDMI/USB, corrección trapezoidal y altavoces estéreo integrados.',
                'price' => 46.80,
                'image' => 'https://images.pexels.com/photos/3062545/pexels-photo-3062545.jpeg',
                'stock' => 42,
                'category_id' => 2
            ],
            [
                'id' => 17,
                'name' => 'Memoria USB 128GB',
                'description' => 'Memoria USB 128GB USB 3.0, velocidad de transferencia hasta 100MB/s, diseño compacto con protección contra agua.',
                'price' => 49.10,
                'image' => 'https://images.pexels.com/photos/2588758/pexels-photo-2588758.jpeg',
                'stock' => 48,
                'category_id' => 2
            ],
            [
                'id' => 18,
                'name' => 'Impresora multifuncional HP',
                'description' => 'Impresora multifuncional HP con escáner, copiadora, Wi-Fi Direct, tinta instantánea y capacidad de 150 hojas.',
                'price' => 51.40,
                'image' => 'https://images.pexels.com/photos/2651794/pexels-photo-2651794.jpeg',
                'stock' => 25,
                'category_id' => 2
            ],
            [
                'id' => 19,
                'name' => 'Webcam 1080p',
                'description' => 'Webcam 1080p con micrófono dual, autofocus, luz de ajuste automático y clip universal para monitores y laptops.',
                'price' => 53.70,
                'image' => 'https://images.pexels.com/photos/51383/photo-camera-digital-camera-photography-51383.jpeg',
                'stock' => 13,
                'category_id' => 2
            ],
            [
                'id' => 20,
                'name' => 'Control universal inteligente',
                'description' => 'Control universal inteligente compatible con TV, aire acondicionado, soundbars y más de 6000 marcas, programable por app.',
                'price' => 56.00,
                'image' => 'https://images.pexels.com/photos/6076410/pexels-photo-6076410.jpeg',
                'stock' => 19,
                'category_id' => 2
            ],
            [
                'id' => 21,
                'name' => 'Balón de fútbol profesional',
                'description' => 'Balón de fútbol profesional tamaño 5, material PU de alta resistencia, diseño termoadherido para mejor precisión.',
                'price' => 58.30,
                'image' => 'https://images.pexels.com/photos/47356/freestyle-soccer-ball-sport-game-47356.jpeg',
                'stock' => 46,
                'category_id' => 3
            ],
            [
                'id' => 22,
                'name' => 'Bicicleta de montaña',
                'description' => 'Bicicleta de montaña 21 velocidades, cuadro de aluminio, suspensión delantera, frenos de disco mecánicos y ruedas 29".',
                'price' => 60.60,
                'image' => 'https://images.pexels.com/photos/100582/pexels-photo-100582.jpeg',
                'stock' => 42,
                'category_id' => 3
            ],
            [
                'id' => 23,
                'name' => 'Guantes para gimnasio',
                'description' => 'Guantes para gimnasio con agarre antideslizante, soporte para muñeca, material transpirable y diseño sin costuras.',
                'price' => 62.90,
                'image' => 'https://images.pexels.com/photos/4662346/pexels-photo-4662346.jpeg',
                'stock' => 23,
                'category_id' => 3
            ],
            [
                'id' => 24,
                'name' => 'Esterilla de yoga',
                'description' => 'Esterilla de yoga antideslizante de 6mm grosor, material ecológico TPE, dimensiones 183x61cm y fácil de limpiar.',
                'price' => 65.20,
                'image' => 'https://images.pexels.com/photos/4056723/pexels-photo-4056723.jpeg',
                'stock' => 17,
                'category_id' => 3
            ],
            [
                'id' => 25,
                'name' => 'Casco para ciclismo',
                'description' => 'Casco para ciclismo con 22 ventilaciones, sistema de ajuste dial, peso ligero (280g) y certificación de seguridad CE.',
                'price' => 67.50,
                'image' => 'https://images.pexels.com/photos/5807570/pexels-photo-5807570.jpeg',
                'stock' => 50,
                'category_id' => 3
            ],
            [
                'id' => 26,
                'name' => 'Botella deportiva térmica',
                'description' => 'Botella deportiva térmica 750ml, mantiene líquidos fríos 24h/calientes 12h, acero inoxidable y diseño sin BPA.',
                'price' => 69.80,
                'image' => 'https://images.pexels.com/photos/1552252/pexels-photo-1552252.jpeg',
                'stock' => 24,
                'category_id' => 3
            ],
            [
                'id' => 27,
                'name' => 'Reloj deportivo Garmin',
                'description' => 'Reloj deportivo Garmin con GPS, monitoreo de frecuencia cardíaca, resistencia al agua 50m y batería de 7 días.',
                'price' => 72.10,
                'image' => 'https://images.pexels.com/photos/190819/pexels-photo-190819.jpeg',
                'stock' => 45,
                'category_id' => 3
            ],
            [
                'id' => 28,
                'name' => 'Set de pesas 10kg',
                'description' => 'Set de pesas 10kg (2x5kg) con revestimiento de neopreno, ergonómicas y superficie antideslizante para mayor seguridad.',
                'price' => 74.40,
                'image' => 'https://images.pexels.com/photos/703016/pexels-photo-703016.jpeg',
                'stock' => 19,
                'category_id' => 3
            ],
            [
                'id' => 29,
                'name' => 'Gafas de natación',
                'description' => 'Gafas de natación con protección UV, lentes antiempañantes, ajuste hermético y diseño hidrodinámico para competición.',
                'price' => 76.70,
                'image' => 'https://images.pexels.com/photos/1263348/pexels-photo-1263348.jpeg',
                'stock' => 31,
                'category_id' => 3
            ],
            [
                'id' => 30,
                'name' => 'Cuerda para saltar',
                'description' => 'Cuerda para saltar profesional con rodamientos de bolas, longitud ajustable 2.8m y mangos ergonómicos antideslizantes.',
                'price' => 79.00,
                'image' => 'https://images.pexels.com/photos/3764537/pexels-photo-3764537.jpeg',
                'stock' => 49,
                'category_id' => 3
            ],
            [
                'id' => 31,
                'name' => 'Lego Star Wars',
                'description' => 'Set Lego Star Wars Millennium Falcon con 1350 piezas, figuras exclusivas de Han Solo, Chewbacca y display stand incluido.',
                'price' => 81.30,
                'image' => 'https://images.pexels.com/photos/1089438/pexels-photo-1089438.jpeg',
                'stock' => 21,
                'category_id' => 4
            ],
            [
                'id' => 32,
                'name' => 'Muñeca Barbie Fashion',
                'description' => 'Muñeca Barbie Fashionista con 3 looks intercambiables, 10 articulaciones, cabello peinable y accesorios de moda.',
                'price' => 83.60,
                'image' => 'https://images.pexels.com/photos/5878507/pexels-photo-5878507.jpeg',
                'stock' => 29,
                'category_id' => 4
            ],
            [
                'id' => 33,
                'name' => 'Carrito de control remoto',
                'description' => 'Carrito de control remoto 1:10 escala, velocidad 25km/h, batería recargable 7.4V y suspensión independiente.',
                'price' => 85.90,
                'image' => 'https://images.pexels.com/photos/1638459/pexels-photo-1638459.jpeg',
                'stock' => 32,
                'category_id' => 4
            ],
            [
                'id' => 34,
                'name' => 'Rompecabezas 1000 piezas',
                'description' => 'Rompecabezas 1000 piezas con imagen de paisaje oceánico, piezas de cartón premium y tamaño final 50x70cm.',
                'price' => 88.20,
                'image' => 'https://images.pexels.com/photos/396547/pexels-photo-396547.jpeg',
                'stock' => 22,
                'category_id' => 4
            ],
            [
                'id' => 35,
                'name' => 'Juego de mesa Monopoly',
                'description' => 'Juego de mesa Monopoly Edición Ciudad, incluye propiedades personalizadas, 8 fichas clásicas y billetes de papel.',
                'price' => 90.50,
                'image' => 'https://images.pexels.com/photos/5878503/pexels-photo-5878503.jpeg',
                'stock' => 45,
                'category_id' => 4
            ],
            [
                'id' => 36,
                'name' => 'Peluche gigante panda',
                'description' => 'Peluche gigante panda de 1.2 metros, material suave hipoalergénico, relleno de fibra siliconada y lavable a máquina.',
                'price' => 92.80,
                'image' => 'https://images.pexels.com/photos/6621339/pexels-photo-6621339.jpeg',
                'stock' => 28,
                'category_id' => 4
            ],
            [
                'id' => 37,
                'name' => 'Dinosaurio interactivo',
                'description' => 'Dinosaurio interactivo con sensores de movimiento, 15 sonidos realistas, luces LED y modo automático/pasivo.',
                'price' => 95.10,
                'image' => 'https://images.pexels.com/photos/162319/dinosaur-toy-plastic-animal-162319.jpeg',
                'stock' => 37,
                'category_id' => 4
            ],
            [
                'id' => 38,
                'name' => 'Set de plastilina creativa',
                'description' => 'Set de plastilina creativa 12 colores, no tóxica, incluye moldes y herramientas para modelado infantil.',
                'price' => 97.40,
                'image' => 'https://images.pexels.com/photos/4623098/pexels-photo-4623098.jpeg',
                'stock' => 48,
                'category_id' => 4
            ],
            [
                'id' => 39,
                'name' => 'Pista de autos Hot Wheels',
                'description' => 'Pista de autos Hot Wheels con 2 lazos, 3 rampas, efecto de colisión y compatible con la mayoría de autos a escala 1:64.',
                'price' => 99.70,
                'image' => 'https://images.pexels.com/photos/163036/mario-luigi-yoschi-figures-163036.jpeg',
                'stock' => 39,
                'category_id' => 4
            ],
            [
                'id' => 40,
                'name' => 'Juego educativo de letras',
                'description' => 'Juego educativo de letras magnéticas, 112 piezas en caja de madera, para aprender ortografía y formar palabras.',
                'price' => 102.00,
                'image' => 'https://images.pexels.com/photos/590570/pexels-photo-590570.jpeg',
                'stock' => 40,
                'category_id' => 4
            ],
            [
                'id' => 41,
                'name' => 'Juego de sábanas Queen',
                'description' => 'Juego de sábanas Queen 300 hilos, algodón egipcio, incluye 1 funda, 1 sábana ajustable y 2 fundas de almohada.',
                'price' => 104.30,
                'image' => 'https://images.pexels.com/photos/6311392/pexels-photo-6311392.jpeg',
                'stock' => 33,
                'category_id' => 5
            ],
            [
                'id' => 42,
                'name' => 'Cortinas blackout',
                'description' => 'Cortinas blackout termoacústicas 140x240cm, tejido multicapa, ganchos incluidos y disponible en 6 colores neutros.',
                'price' => 106.60,
                'image' => 'https://images.pexels.com/photos/6311394/pexels-photo-6311394.jpeg',
                'stock' => 35,
                'category_id' => 5
            ],
            [
                'id' => 43,
                'name' => 'Almohadas de espuma viscoelástica',
                'description' => 'Almohadas de espuma viscoelástica 50x70cm, densidad 4D, funda transpirable y soporte cervical ergonómico.',
                'price' => 108.90,
                'image' => 'https://images.pexels.com/photos/6758771/pexels-photo-6758771.jpeg',
                'stock' => 26,
                'category_id' => 5
            ],
            [
                'id' => 44,
                'name' => 'Lámpara de pie moderna',
                'description' => 'Lámpara de pie moderna con 3 niveles de brillo, luz cálida/fría, control táctil y base metálica estabilizada.',
                'price' => 111.20,
                'image' => 'https://images.pexels.com/photos/1457842/pexels-photo-1457842.jpeg',
                'stock' => 15,
                'category_id' => 5
            ],
            [
                'id' => 45,
                'name' => 'Reloj de pared decorativo',
                'description' => 'Reloj de pared decorativo 40cm diámetro, movimiento silencioso japonés, números romanos y marco de madera MDF.',
                'price' => 113.50,
                'image' => 'https://images.pexels.com/photos/279746/pexels-photo-279746.jpeg',
                'stock' => 29,
                'category_id' => 5
            ],
            [
                'id' => 46,
                'name' => 'Organizador de zapatos',
                'description' => 'Organizador de zapatos vertical 12 niveles, estructura de tela resistente y metal, ahorra espacio en clósets.',
                'price' => 115.80,
                'image' => 'https://images.pexels.com/photos/5824517/pexels-photo-5824517.jpeg',
                'stock' => 49,
                'category_id' => 5
            ],
            [
                'id' => 47,
                'name' => 'Perchero metálico',
                'description' => 'Perchero metálico de pared con 8 ganchos, acabado en oro rosado, soporte hasta 15kg y fácil instalación.',
                'price' => 118.10,
                'image' => 'https://images.pexels.com/photos/6311635/pexels-photo-6311635.jpeg',
                'stock' => 25,
                'category_id' => 5
            ],
            [
                'id' => 48,
                'name' => 'Cuadro decorativo minimalista',
                'description' => 'Cuadro decorativo minimalista 60x90cm, impresión canvas, marco de madera natural y listo para colgar.',
                'price' => 120.40,
                'image' => 'https://images.pexels.com/photos/1571460/pexels-photo-1571460.jpeg',
                'stock' => 12,
                'category_id' => 5
            ],
            [
                'id' => 49,
                'name' => 'Mueble auxiliar de madera',
                'description' => 'Mueble auxiliar de madera maciza 45x35x60cm, 3 cajones con sistema suave-cierre, estilo rústico moderno.',
                'price' => 122.70,
                'image' => 'https://images.pexels.com/photos/37347/office-sitting-room-executive-sitting.jpg',
                'stock' => 14,
                'category_id' => 5
            ],
            [
                'id' => 50,
                'name' => 'Espejo con luces LED',
                'description' => 'Espejo con luces LED 10x aumentos, 3 tonos de luz, base antideslizante y alimentación por USB o pilas.',
                'price' => 10.00,
                'image' => 'https://images.pexels.com/photos/4207785/pexels-photo-4207785.jpeg',
                'stock' => 24,
                'category_id' => 5
            ],
            [
                'id' => 51,
                'name' => 'Juego de ollas de acero',
                'description' => 'Juego de ollas de acero inoxidable 10 piezas, fondo difusor, mangos ergonómicos anti-calor y tapa de vidrio.',
                'price' => 12.30,
                'image' => 'https://images.pexels.com/photos/4239013/pexels-photo-4239013.jpeg',
                'stock' => 27,
                'category_id' => 6
            ],
            [
                'id' => 52,
                'name' => 'Licuadora de alta potencia',
                'description' => 'Licuadora de alta potencia 1500W, vaso de vidrio 2L, 10 velocidades, función pulso y cuchillas de acero inoxidable.',
                'price' => 14.60,
                'image' => 'https://images.pexels.com/photos/4397919/pexels-photo-4397919.jpeg',
                'stock' => 13,
                'category_id' => 6
            ],
            [
                'id' => 53,
                'name' => 'Freidora de aire',
                'description' => 'Freidora de aire 5.5L digital, 8 programas preestablecidos, temperatura ajustable 80-200°C y libre de aceite.',
                'price' => 16.90,
                'image' => 'https://images.pexels.com/photos/4063850/pexels-photo-4063850.jpeg',
                'stock' => 16,
                'category_id' => 6
            ],
            [
                'id' => 54,
                'name' => 'Set de cuchillos profesionales',
                'description' => 'Set de cuchillos profesionales 6 piezas, acero alemán 56HRC, mangos ergonómicos y funda protectora de madera.',
                'price' => 19.20,
                'image' => 'https://images.pexels.com/photos/3059735/pexels-photo-3059735.jpeg',
                'stock' => 30,
                'category_id' => 6
            ],
            [
                'id' => 55,
                'name' => 'Cafetera automática',
                'description' => 'Cafetera automática con molinero integrado, prepara hasta 12 tazas, función programable y jarra térmica.',
                'price' => 21.50,
                'image' => 'https://images.pexels.com/photos/312418/pexels-photo-312418.jpeg',
                'stock' => 13,
                'category_id' => 6
            ],
            [
                'id' => 56,
                'name' => 'Tostadora de pan',
                'description' => 'Tostadora de pan 2 ranuras, 6 niveles de tostado, función descongelar y bandeja extraíble para migas.',
                'price' => 23.80,
                'image' => 'https://images.pexels.com/photos/4397893/pexels-photo-4397893.jpeg',
                'stock' => 47,
                'category_id' => 6
            ],
            [
                'id' => 57,
                'name' => 'Tabla de picar antibacteriana',
                'description' => 'Tabla de picar antibacteriana 40x25cm, material plástico HDPE, superficie antideslizante y fácil de limpiar.',
                'price' => 26.10,
                'image' => 'https://images.pexels.com/photos/128402/pexels-photo-128402.jpeg',
                'stock' => 22,
                'category_id' => 6
            ],
            [
                'id' => 58,
                'name' => 'Microondas digital',
                'description' => 'Microondas digital 25L, 10 niveles de potencia, función descongelamiento y panel de control intuitivo.',
                'price' => 28.40,
                'image' => 'https://images.pexels.com/photos/4397917/pexels-photo-4397917.jpeg',
                'stock' => 41,
                'category_id' => 6
            ],
            [
                'id' => 59,
                'name' => 'Horno eléctrico',
                'description' => 'Horno eléctrico de 40L, termostato ajustable 100-250°C, temporizador 60min y bandejas antiadherentes.',
                'price' => 30.70,
                'image' => 'https://images.pexels.com/photos/1629781/pexels-photo-1629781.jpeg',
                'stock' => 46,
                'category_id' => 6
            ],
            [
                'id' => 60,
                'name' => 'Batidora de mano',
                'description' => 'Batidora de mano 600W, 5 velocidades, accesorios para batir/picar/amasar y diseño ergonómico liviano.',
                'price' => 33.00,
                'image' => 'https://images.pexels.com/photos/4207788/pexels-photo-4207788.jpeg',
                'stock' => 19,
                'category_id' => 6
            ],
            [
                'id' => 61,
                'name' => 'Camiseta básica blanca',
                'description' => 'Camiseta básica blanca 100% algodón orgánico, costuras reforzadas, corte clásico y disponible en tallas S-XXL.',
                'price' => 35.30,
                'image' => 'https://images.pexels.com/photos/428338/pexels-photo-428338.jpeg',
                'stock' => 28,
                'category_id' => 7
            ],
            [
                'id' => 62,
                'name' => 'Pantalón jeans azul',
                'description' => 'Pantalón jeans azul corte slim, mezcla algodón-elastano, 5 bolsillos, cierre con botón y hebilla metálica.',
                'price' => 37.60,
                'image' => 'https://images.pexels.com/photos/1598507/pexels-photo-1598507.jpeg',
                'stock' => 32,
                'category_id' => 7
            ],
            [
                'id' => 63,
                'name' => 'Chaqueta impermeable',
                'description' => 'Chaqueta impermeable con capucha, membrana transpirable, costuras selladas y bolsillos internos con cierre.',
                'price' => 39.90,
                'image' => 'https://images.pexels.com/photos/1183266/pexels-photo-1183266.jpeg',
                'stock' => 24,
                'category_id' => 7
            ],
            [
                'id' => 64,
                'name' => 'Vestido casual floral',
                'description' => 'Vestido casual floral midi, tejido liviano, escote en V, mangas cortas y disponible en 4 combinaciones de colores.',
                'price' => 42.20,
                'image' => 'https://images.pexels.com/photos/1021291/pexels-photo-1021291.jpeg',
                'stock' => 18,
                'category_id' => 7
            ],
            [
                'id' => 65,
                'name' => 'Camisa manga larga',
                'description' => 'Camisa manga larga de lino, cuello clásico, botones de nácar y diseño semi-ajustado para hombre y mujer.',
                'price' => 44.50,
                'image' => 'https://images.pexels.com/photos/769733/pexels-photo-769733.jpeg',
                'stock' => 46,
                'category_id' => 7
            ],
            [
                'id' => 66,
                'name' => 'Pantalón de vestir',
                'description' => 'Pantalón de vestir clásico, plano frontal, tela antiarrugas, talles 28-42 y disponible en 5 colores neutros.',
                'price' => 46.80,
                'image' => 'https://images.pexels.com/photos/1485031/pexels-photo-1485031.jpeg',
                'stock' => 47,
                'category_id' => 7
            ],
            ['id' => 67, 'name' => 'Blusa elegante', 'description' => 'Blusa elegante de seda natural, cuello halter, espalda drapeada y forro interior para mayor comodidad.', 'price' => 49.10, 'image_url' => 'https://images.pexels.com/photos/994523/pexels-photo-994523.jpeg', 'stock' => 43, 'category_id' => 7],
            ['id' => 68, 'name' => 'Sudadera con capucha', 'description' => 'Sudadera con capucha unisex, felpa de algodón, bolsillo canguro y cordón ajustable en tallas XS-3XL.', 'price' => 51.40, 'image_url' => 'https://images.pexels.com/photos/6634370/pexels-photo-6634370.jpeg', 'stock' => 27, 'category_id' => 7],
            ['id' => 69, 'name' => 'Ropa deportiva Nike', 'description' => 'Ropa deportiva Nike Dri-FIT, set de camiseta y pantalón corto, tecnología de absorción de humedad y costuras planas.', 'price' => 53.70, 'image_url' => 'https://images.pexels.com/photos/2529147/pexels-photo-2529147.jpeg', 'stock' => 36, 'category_id' => 7],
            ['id' => 70, 'name' => 'Pijama de algodón', 'description' => 'Pijama de algodón 100% 2 piezas, estampado rayas, botones delanteros y tallas S-XXL en varios colores.', 'price' => 56.00, 'image_url' => 'https://images.pexels.com/photos/4202325/pexels-photo-4202325.jpeg', 'stock' => 49, 'category_id' => 7],
            ['id' => 71, 'name' => 'Gafas de sol polarizadas', 'description' => 'Gafas de sol polarizadas UV400, montura acetato, lentes resistentes a impactos y estilo aviador unisex.', 'price' => 58.30, 'image_url' => 'https://images.pexels.com/photos/1336873/pexels-photo-1336873.jpeg', 'stock' => 47, 'category_id' => 8],
            ['id' => 72, 'name' => 'Reloj analógico Casio', 'description' => 'Reloj analógico Casio con correa de resina, resistencia al agua 50m, cronómetro y alarma diaria.', 'price' => 60.60, 'image_url' => 'https://images.pexels.com/photos/277319/pexels-photo-277319.jpeg', 'stock' => 37, 'category_id' => 8],
            ['id' => 73, 'name' => 'Mochila antirrobo', 'description' => 'Mochila antirrobo con bloqueo RFID, múltiples compartimentos, material resistente al agua y soporte para laptop 15".', 'price' => 62.90, 'image_url' => 'https://images.pexels.com/photos/2905238/pexels-photo-2905238.jpeg', 'stock' => 32, 'category_id' => 8],
            ['id' => 74, 'name' => 'Cartera de cuero', 'description' => 'Cartera de cuero genuino, 12 ranuras para tarjetas, bolsillo para billetes y cierre magnético seguro.', 'price' => 65.20, 'image_url' => 'https://images.pexels.com/photos/2905236/pexels-photo-2905236.jpeg', 'stock' => 41, 'category_id' => 8],
            ['id' => 75, 'name' => 'Cinturón de piel', 'description' => 'Cinturón de piel vacuno 3.8cm, hebilla metálica anticorrosiva, disponible en 4 colores y tallas 30-42.', 'price' => 67.50, 'image_url' => 'https://images.pexels.com/photos/1152077/pexels-photo-1152077.jpeg', 'stock' => 19, 'category_id' => 8],
            ['id' => 76, 'name' => 'Bufanda de lana', 'description' => 'Bufanda de lana merino, tejido doble faz, 180cm de largo y suave al tacto sin picazón.', 'price' => 69.80, 'image_url' => 'https://images.pexels.com/photos/298863/pexels-photo-298863.jpeg', 'stock' => 45, 'category_id' => 8],
            ['id' => 77, 'name' => 'Gorro tejido', 'description' => 'Gorro tejido de invierno, mezcla lana-acrílico, forro polar interior y diseño unisex en 8 colores.', 'price' => 72.10, 'image_url' => 'https://images.pexels.com/photos/35185/hats-fedora-hat-manufacture-stack.jpg', 'stock' => 35, 'category_id' => 8],
            ['id' => 78, 'name' => 'Paraguas plegable', 'description' => 'Paraguas plegable automático 8 varillas, 120cm de cobertura, tela impermeable y mango antideslizante.', 'price' => 74.40, 'image_url' => 'https://images.pexels.com/photos/59999/blue-umbrella-thunderstorm-rain-59999.jpeg', 'stock' => 31, 'category_id' => 8],
            ['id' => 79, 'name' => 'Correa para smartwatch', 'description' => 'Correa para smartwatch intercambiable 20mm, material silicona hipoalergénica, compatible con múltiples modelos.', 'price' => 76.70, 'image_url' => 'https://images.pexels.com/photos/437038/pexels-photo-437038.jpeg', 'stock' => 39, 'category_id' => 8],
            ['id' => 80, 'name' => 'Llavero personalizado', 'description' => 'Llavero personalizado con grabado láser, acero inoxidable, hasta 20 caracteres y cadena de seguridad.', 'price' => 79.00, 'image_url' => 'https://images.pexels.com/photos/207983/pexels-photo-207983.jpeg', 'stock' => 10, 'category_id' => 8],
            ['id' => 81, 'name' => 'Agenda 2025', 'description' => 'Agenda 2025 profesional, 384 páginas, papel libre de ácido, marcador de página y cubierta de cuero sintético.', 'price' => 81.30, 'image_url' => 'https://images.pexels.com/photos/590493/pexels-photo-590493.jpeg', 'stock' => 47, 'category_id' => 9],
            ['id' => 82, 'name' => 'Cuaderno universitario', 'description' => 'Cuaderno universitario 200 hojas rayadas, tapa dura, elástico de cierre y bolsillo interior para documentos.', 'price' => 83.60, 'image_url' => 'https://images.pexels.com/photos/159711/books-bookstore-book-reading-159711.jpeg', 'stock' => 33, 'category_id' => 9],
            ['id' => 83, 'name' => 'Bolígrafo Parker', 'description' => 'Bolígrafo Parker Jotter edición clásica, punta media, tinta azul y mecanismo click de acero inoxidable.', 'price' => 85.90, 'image_url' => 'https://images.pexels.com/photos/316466/pexels-photo-316466.jpeg', 'stock' => 12, 'category_id' => 9],
            ['id' => 84, 'name' => 'Libro Cien años de soledad', 'description' => 'Libro Cien años de soledad - Edición especial 50 aniversario, tapa dura con sobrecubierta ilustrada.', 'price' => 88.20, 'image_url' => 'https://images.pexels.com/photos/159866/book-book-pages-read-literature-159866.jpeg', 'stock' => 36, 'category_id' => 9],
            ['id' => 85, 'name' => 'Estuche escolar', 'description' => 'Estuche escolar transparente 25cm, 3 compartimentos, cierre hermético y diseño resistente a golpes.', 'price' => 90.50, 'image_url' => 'https://images.pexels.com/photos/159618/office-school-supplies-pencil-pen-159618.jpeg', 'stock' => 12, 'category_id' => 9],
            ['id' => 86, 'name' => 'Set de marcadores', 'description' => 'Set de marcadores profesionales 12 colores, punta biselada, base alcohol y secado rápido sin traspaso.', 'price' => 92.80, 'image_url' => 'https://images.pexels.com/photos/159752/art-school-supplies-pen-pencils-159752.jpeg', 'stock' => 24, 'category_id' => 9],
            ['id' => 87, 'name' => 'Regla metálica', 'description' => 'Regla metálica 30cm con escala métrica e imperial, bordes biselados y grabado láser resistente.', 'price' => 95.10, 'image_url' => 'https://images.pexels.com/photos/159519/back-to-school-paper-office-supplies-159519.jpeg', 'stock' => 35, 'category_id' => 9],
            ['id' => 88, 'name' => 'Lápices de colores', 'description' => 'Lápices de colores profesionales 24 unidades, mina resistente a la rotura, colores vibrantes y madera sustentable.', 'price' => 97.40, 'image_url' => 'https://images.pexels.com/photos/159752/art-school-supplies-pen-pencils-159752.jpeg', 'stock' => 11, 'category_id' => 9],
            ['id' => 89, 'name' => 'Diccionario español-inglés', 'description' => 'Diccionario español-inglés Oxford, 80,000 entradas, ejemplos de uso, verbos irregulares y guía de pronunciación.', 'price' => 99.70, 'image_url' => 'https://images.pexels.com/photos/159866/book-book-pages-read-literature-159866.jpeg', 'stock' => 23, 'category_id' => 9],
            ['id' => 90, 'name' => 'Atlas geográfico', 'description' => 'Atlas geográfico actualizado 2025, 320 páginas a todo color, mapas políticos/físicos y datos demográficos.', 'price' => 102.00, 'image_url' => 'https://images.pexels.com/photos/1370295/pexels-photo-1370295.jpeg', 'stock' => 32, 'category_id' => 9],
            [
                'id' => 91,
                'nombre' => 'Crema hidratante facial',
                'descripcion' => 'Crema hidratante facial con ácido hialurónico y vitamina E, textura ligera, libre de aceites y fragancias.',
                'precio' => 104.30,
                'imagen' => 'https://images.pexels.com/photos/4041392/pexels-photo-4041392.jpeg',
                'stock' => 40,
                'categoria_id' => 10,
            ],
            [
                'id' => 92,
                'nombre' => 'Perfume floral 50ml',
                'descripcion' => 'Perfume floral 50ml con notas de jazmín, peonía y vainilla, fijación media-alta y envase con vaporizador.',
                'precio' => 106.60,
                'imagen' => 'https://images.pexels.com/photos/2533266/pexels-photo-2533266.jpeg',
                'stock' => 13,
                'categoria_id' => 10,
            ],
            [
                'id' => 93,
                'nombre' => 'Maquillaje base líquida',
                'descripcion' => 'Maquillaje base líquida cobertura media-alta, 12 tonos disponibles, fórmula libre de aceites y SPF 15.',
                'precio' => 108.90,
                'imagen' => 'https://images.pexels.com/photos/3373736/pexels-photo-3373736.jpeg',
                'stock' => 18,
                'categoria_id' => 10,
            ],
            [
                'id' => 94,
                'nombre' => 'Esmalte de uñas rojo',
                'descripcion' => 'Esmalte de uñas rojo acabado gel, secado rápido, aplicación en 1 capa y duración hasta 7 días sin descascarar.',
                'precio' => 111.20,
                'imagen' => 'https://images.pexels.com/photos/3997374/pexels-photo-3997374.jpeg',
                'stock' => 39,
                'categoria_id' => 10,
            ],
            [
                'id' => 95,
                'nombre' => 'Cepillo alisador',
                'descripcion' => 'Cepillo alisador cerámico 230°C, iones negativos, ajuste de temperatura digital y placas flotantes.',
                'precio' => 113.50,
                'imagen' => 'https://images.pexels.com/photos/3993247/pexels-photo-3993247.jpeg',
                'stock' => 10,
                'categoria_id' => 10,
            ],
            [
                'id' => 96,
                'nombre' => 'Plancha de cabello',
                'descripcion' => 'Plancha de cabello profesional 25mm, calentamiento en 30 segundos, tecnología tourmalina y cierre automático.',
                'precio' => 115.80,
                'imagen' => 'https://images.pexels.com/photos/3993327/pexels-photo-3993327.jpeg',
                'stock' => 48,
                'categoria_id' => 10,
            ],
            [
                'id' => 97,
                'nombre' => 'Labial mate',
                'descripcion' => 'Labial mate larga duración 5g, pigmentación intensa, textura cremosa y en 8 tonos de la paleta nude-rojo.',
                'precio' => 118.10,
                'imagen' => 'https://images.pexels.com/photos/2533266/pexels-photo-2533266.jpeg',
                'stock' => 37,
                'categoria_id' => 10,
            ],
            [
                'id' => 98,
                'nombre' => 'Sombras para ojos',
                'descripcion' => 'Paleta de sombras para ojos 12 colores mate/brillantes, alta pigmentación, base fijadora incluida y espejo.',
                'precio' => 120.40,
                'imagen' => 'https://images.pexels.com/photos/3997373/pexels-photo-3997373.jpeg',
                'stock' => 30,
                'categoria_id' => 10,
            ],
            [
                'id' => 99,
                'nombre' => 'Mascarilla facial carbón',
                'descripcion' => 'Mascarilla facial de carbón activado, purificante, control de grasa y poros, aplicación en 15 minutos.',
                'precio' => 122.70,
                'imagen' => 'https://images.pexels.com/photos/4041391/pexels-photo-4041391.jpeg',
                'stock' => 28,
                'categoria_id' => 10,
            ],
            [
                'id' => 100,
                'nombre' => 'Removedor de maquillaje',
                'descripcion' => 'Removedor de maquillaje bifásico para ojos/labios, apto para lentes de contacto, sin alcohol y pH balanceado.',
                'precio' => 10.00,
                'imagen' => 'https://images.pexels.com/photos/4041392/pexels-photo-4041392.jpeg',
                'stock' => 43,
                'categoria_id' => 10,
            ],
        ]);
    }
}
//      php artisan make:seeder ProductSeeder
//      Run:
//      php artisan db:seed --class=ProductSeeder

