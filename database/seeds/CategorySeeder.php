<?php

use Illuminate\Database\Seeder;
use App\Category;
use Faker\Generator as Faker;
use \Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
//        Category::insert([
//            ['name' => 'Inmobiliaria - Venta', 'image' => $faker->imageUrl()],
//            ['name' => 'Inmobiliaria - Alquiler', 'image' => $faker->imageUrl()],
//            ['name' => 'Motor', 'image' => $faker->imageUrl()],
//            ['name' => 'Trabajo', 'image' => $faker->imageUrl()],
//            ['name' => 'Viajes y vacaciones', 'image' => $faker->imageUrl()],
//            ['name' => 'Hogar y jardín', 'image' => $faker->imageUrl()],
//            ['name' => 'Negocios', 'image' => $faker->imageUrl()],
//            ['name' => 'Informática y móviles', 'image' => $faker->imageUrl()],
//            ['name' => 'Imagen, juegos y sonido', 'image' => $faker->imageUrl()],
//            ['name' => 'Deportes y ocio', 'image' => $faker->imageUrl()],
//            ['name' => 'Moda y complementos', 'image' => $faker->imageUrl()],
//            ['name' => 'Mascotas', 'image' => $faker->imageUrl()],
//            ['name' => 'Maquinaria y herramientas', 'image' => $faker->imageUrl()],
//            ['name' => 'Libros', 'image' => $faker->imageUrl()],
//        ]);
//        Category::insert([
//            //Inmobiliaria - Venta - Categoria 1
//            ['name' => 'Casas y pisos', 'image' => $faker->imageUrl(), 'parent_id' => 1],
//            ['name' => 'Chalets', 'image' => $faker->imageUrl(), 'parent_id' => 1],
//            ['name' => 'Parking', 'image' => $faker->imageUrl(), 'parent_id' => 1],
//            ['name' => 'Locales comerciales', 'image' => $faker->imageUrl(), 'parent_id' => 1],
//            ['name' => 'Naves industriales', 'image' => $faker->imageUrl(), 'parent_id' => 1],
//            ['name' => 'Fincas rústicas', 'image' => $faker->imageUrl(), 'parent_id' => 1],
//            ['name' => 'Parcelas', 'image' => $faker->imageUrl(), 'parent_id' => 1],
//
//            //Inmobiliaria - Alquiler - Categoria 2
//            ['name' => 'Casas y pisos', 'image' => $faker->imageUrl(), 'parent_id' => 2],
//            ['name' => 'Chalets', 'image' => $faker->imageUrl(), 'parent_id' => 2],
//            ['name' => 'Parking', 'image' => $faker->imageUrl(), 'parent_id' => 2],
//            ['name' => 'Locales comerciales', 'image' => $faker->imageUrl(), 'parent_id' => 2],
//            ['name' => 'Naves industriales', 'image' => $faker->imageUrl(), 'parent_id' => 2],
//            ['name' => 'Arrendamiento fincas', 'image' => $faker->imageUrl(), 'parent_id' => 2],
//            ['name' => 'Alquiler de oficinas', 'image' => $faker->imageUrl(), 'parent_id' => 2],
//            ['name' => 'Otros', 'image' => $faker->imageUrl(), 'parent_id' => 2],
//        ]);
        //for ($i = 0; $i < 50; $i++) factory(App\Category::class, 1)->create();

        DB::select(DB::raw("
        INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `created_at`, `updated_at`, `_lft`, `_rgt`, `parent_id`) VALUES
        (1, 'Inmobiliaria - Venta', 'inmobiliaria-venta', '/img/no-image.png', '2020-07-21 23:59:16', '2020-07-21 23:59:16', 1, 16, NULL),
        (2, 'Inmobiliaria - Alquiler', 'inmobiliaria-alquiler', '/img/no-image.png', '2020-07-21 23:59:25', '2020-07-21 23:59:25', 17, 34, NULL),
        (3, 'Motor', 'motor', '/img/no-image.png', '2020-07-21 23:59:30', '2020-07-21 23:59:30', 35, 58, NULL),
        (4, 'Trabajo', 'trabajo', '/img/no-image.png', '2020-07-21 23:59:35', '2020-07-21 23:59:35', 59, 64, NULL),
        (5, 'Viajes y vacaciones', 'viajes-y-vacaciones', '/img/no-image.png', '2020-07-21 23:59:44', '2020-07-21 23:59:44', 65, 72, NULL),
        (6, 'Hogar y jardín', 'hogar-y-jardin', '/img/no-image.png', '2020-07-21 23:59:50', '2020-07-21 23:59:50', 73, 84, NULL),
        (7, 'Negocios', 'negocios', '/img/no-image.png', '2020-07-21 23:59:56', '2020-07-21 23:59:56', 85, 98, NULL),
        (8, 'Informática y móviles', 'informatica-y-moviles', '/img/no-image.png', '2020-07-22 00:00:02', '2020-07-22 00:00:02', 99, 116, NULL),
        (9, 'Imagen, juegos y sonido', 'imagen-juegos-y-sonido', '/img/no-image.png', '2020-07-22 00:00:11', '2020-07-22 00:00:11', 117, 128, NULL),
        (10, 'Deportes y ocio', 'deportes-y-ocio', '/img/no-image.png', '2020-07-22 00:00:19', '2020-07-22 00:00:19', 129, 144, NULL),
        (11, 'Moda y complementos', 'moda-y-complementos', '/img/no-image.png', '2020-07-22 00:00:25', '2020-07-22 00:00:25', 145, 162, NULL),
        (12, 'Mascotas', 'mascotas', '/img/no-image.png', '2020-07-22 00:00:31', '2020-07-22 00:00:31', 163, 176, NULL),
        (13, 'Maquinaria y herramientas', 'maquinaria-y-herramientas', '/img/no-image.png', '2020-07-22 00:00:40', '2020-07-22 00:00:40', 177, 182, NULL),
        (14, 'Libros', 'libros', '/img/no-image.png', '2020-07-22 00:00:44', '2020-07-22 00:00:44', 183, 192, NULL),
        (15, 'Casas y pisos', 'casas-y-pisos', '/img/no-image.png', '2020-07-22 00:00:58', '2020-07-22 00:00:58', 2, 3, 1),
        (16, 'Chalets', 'chalets', '/img/no-image.png', '2020-07-22 00:01:04', '2020-07-22 00:01:04', 4, 5, 1),
        (17, 'Parking', 'parking', '/img/no-image.png', '2020-07-22 00:01:09', '2020-07-22 00:01:09', 6, 7, 1),
        (18, 'Locales comerciales', 'locales-comerciales', '/img/no-image.png', '2020-07-22 00:01:14', '2020-07-22 00:01:14', 8, 9, 1),
        (19, 'Naves industriales', 'naves-industriales', '/img/no-image.png', '2020-07-22 00:01:21', '2020-07-22 00:01:21', 10, 11, 1),
        (20, 'Fincas rústicas', 'fincas-rusticas', '/img/no-image.png', '2020-07-22 00:01:26', '2020-07-22 00:01:26', 12, 13, 1),
        (21, 'Parcelas', 'parcelas', '/img/no-image.png', '2020-07-22 00:01:32', '2020-07-22 00:01:32', 14, 15, 1),
        (22, 'Casas y pisos', 'casas-y-pisos-1', '/img/no-image.png', '2020-07-22 00:01:46', '2020-07-22 00:01:46', 18, 19, 2),
        (23, 'Chalets', 'chalets-1', '/img/no-image.png', '2020-07-22 00:01:51', '2020-07-22 00:01:51', 20, 21, 2),
        (24, 'Parking', 'parking-1', '/img/no-image.png', '2020-07-22 00:02:04', '2020-07-22 00:02:04', 22, 23, 2),
        (25, 'Locales comerciales', 'locales-comerciales-1', '/img/no-image.png', '2020-07-22 00:02:10', '2020-07-22 00:02:10', 24, 25, 2),
        (26, 'Naves industriales', 'naves-industriales-1', '/img/no-image.png', '2020-07-22 00:02:18', '2020-07-22 00:02:18', 26, 27, 2),
        (27, 'Arrendamiento fincas', 'arrendamiento-fincas', '/img/no-image.png', '2020-07-22 00:02:25', '2020-07-22 00:02:25', 28, 29, 2),
        (28, 'Alquiler de oficinas', 'alquiler-de-oficinas', '/img/no-image.png', '2020-07-22 00:02:32', '2020-07-22 00:02:32', 30, 31, 2),
        (29, 'Otros', 'otros', '/img/no-image.png', '2020-07-22 00:02:37', '2020-07-22 00:02:37', 32, 33, 2),
        (30, 'Coches', 'coches', '/img/no-image.png', '2020-07-22 00:02:43', '2020-07-22 00:02:43', 36, 37, 3),
        (31, 'Furgonetas', 'furgonetas', '/img/no-image.png', '2020-07-22 00:02:49', '2020-07-22 00:02:49', 38, 39, 3),
        (32, 'Camiones', 'camiones', '/img/no-image.png', '2020-07-22 00:02:58', '2020-07-22 00:02:58', 40, 41, 3),
        (33, 'Autocaravanas', 'autocaravanas', '/img/no-image.png', '2020-07-22 00:03:06', '2020-07-22 00:03:06', 42, 43, 3),
        (34, 'Remolques', 'remolques', '/img/no-image.png', '2020-07-22 00:03:18', '2020-07-22 00:03:18', 44, 45, 3),
        (35, 'Tractores', 'tractores', '/img/no-image.png', '2020-07-22 00:03:42', '2020-07-22 00:03:42', 46, 47, 3),
        (36, 'Quads', 'quads', '/img/no-image.png', '2020-07-22 00:03:50', '2020-07-22 00:03:50', 48, 49, 3),
        (37, 'Scooters', 'scooters', '/img/no-image.png', '2020-07-22 00:03:56', '2020-07-22 00:03:56', 50, 51, 3),
        (38, 'Motos', 'motos', '/img/no-image.png', '2020-07-22 00:04:01', '2020-07-22 00:04:01', 52, 53, 3),
        (39, 'Recambios', 'recambios', '/img/no-image.png', '2020-07-22 00:04:08', '2020-07-22 00:04:08', 54, 55, 3),
        (40, 'Otros', 'otros-1', '/img/no-image.png', '2020-07-22 00:04:16', '2020-07-22 00:04:16', 56, 57, 3),
        (41, 'Ofertas de trabajo', 'ofertas-de-trabajo', '/img/no-image.png', '2020-07-22 00:04:27', '2020-07-22 00:04:27', 60, 61, 4),
        (42, 'Demandas de trabajo', 'demandas-de-trabajo', '/img/no-image.png', '2020-07-22 00:04:36', '2020-07-22 00:04:36', 62, 63, 4),
        (43, 'Viajes de agencias', 'viajes-de-agencias', '/img/no-image.png', '2020-07-22 00:04:52', '2020-07-22 00:04:52', 66, 67, 5),
        (44, 'Alquiler costa', 'alquiler-costa', '/img/no-image.png', '2020-07-22 00:05:01', '2020-07-22 00:05:01', 68, 69, 5),
        (45, 'Alquiler rural', 'alquiler-rural', '/img/no-image.png', '2020-07-22 00:05:12', '2020-07-22 00:05:12', 70, 71, 5),
        (46, 'Muebles', 'muebles', '/img/no-image.png', '2020-07-22 00:05:21', '2020-07-22 00:05:21', 74, 75, 6),
        (47, 'Electrodomésticos', 'electrodomesticos', '/img/no-image.png', '2020-07-22 00:05:42', '2020-07-22 00:05:42', 76, 77, 6),
        (48, 'Artículos de bebé', 'articulos-de-bebe', '/img/no-image.png', '2020-07-22 00:05:59', '2020-07-22 00:05:59', 78, 79, 6),
        (49, 'Mobiliario jardín', 'mobiliario-jardin', '/img/no-image.png', '2020-07-22 00:06:11', '2020-07-22 00:06:11', 80, 81, 6),
        (50, 'Herramientas jardín', 'herramientas-jardin', '/img/no-image.png', '2020-07-22 00:06:21', '2020-07-22 00:06:21', 82, 83, 6),
        (51, 'Traspasos y ventas', 'traspasos-y-ventas', '/img/no-image.png', '2020-07-22 00:06:36', '2020-07-22 00:06:36', 86, 87, 7),
        (52, 'Mobiliario hostelería', 'mobiliario-hosteleria', '/img/no-image.png', '2020-07-22 00:06:50', '2020-07-22 00:06:50', 88, 89, 7),
        (53, 'Mobiliario oficinas', 'mobiliario-oficinas', '/img/no-image.png', '2020-07-22 00:07:00', '2020-07-22 00:07:00', 90, 91, 7),
        (54, 'Mobiliario comercial', 'mobiliario-comercial', '/img/no-image.png', '2020-07-22 00:07:17', '2020-07-22 00:07:17', 92, 93, 7),
        (55, 'Mobiliario peluquería', 'mobiliario-peluqueria', '/img/no-image.png', '2020-07-22 00:07:35', '2020-07-22 00:07:35', 94, 95, 7),
        (56, 'Otros', 'otros-2', '/img/no-image.png', '2020-07-22 00:07:44', '2020-07-22 00:07:44', 96, 97, 7),
        (57, 'Ordenadores', 'ordenadores', '/img/no-image.png', '2020-07-22 00:07:56', '2020-07-22 00:07:56', 100, 101, 8),
        (58, 'Portátiles', 'portatiles', '/img/no-image.png', '2020-07-22 00:08:02', '2020-07-22 00:08:02', 102, 103, 8),
        (59, 'Tablets', 'tablets', '/img/no-image.png', '2020-07-22 00:08:10', '2020-07-22 00:08:10', 104, 105, 8),
        (60, 'Impresoras', 'impresoras', '/img/no-image.png', '2020-07-22 00:08:16', '2020-07-22 00:08:16', 106, 107, 8),
        (61, 'Móviles', 'moviles', '/img/no-image.png', '2020-07-22 00:08:24', '2020-07-22 00:08:24', 108, 109, 8),
        (62, 'Accesorios móviles', 'accesorios-moviles', '/img/no-image.png', '2020-07-22 00:08:38', '2020-07-22 00:08:38', 110, 111, 8),
        (63, 'Telefonía fija', 'telefonia-fija', '/img/no-image.png', '2020-07-22 00:08:45', '2020-07-22 00:08:45', 112, 113, 8),
        (64, 'Otros', 'otros-3', '/img/no-image.png', '2020-07-22 00:08:54', '2020-07-22 00:08:54', 114, 115, 8),
        (65, 'Fotografía', 'fotografia', '/img/no-image.png', '2020-07-22 00:09:08', '2020-07-22 00:09:08', 118, 119, 9),
        (66, 'Instrumentos musicales', 'instrumentos-musicales', '/img/no-image.png', '2020-07-22 00:09:16', '2020-07-22 00:09:16', 120, 121, 9),
        (67, 'Televisores', 'televisores', '/img/no-image.png', '2020-07-22 00:09:21', '2020-07-22 00:09:21', 122, 123, 9),
        (68, 'Equipos de sonido', 'equipos-de-sonido', '/img/no-image.png', '2020-07-22 00:09:31', '2020-07-22 00:09:31', 124, 125, 9),
        (69, 'Consolas y juegos', 'consolas-y-juegos', '/img/no-image.png', '2020-07-22 00:09:38', '2020-07-22 00:09:38', 126, 127, 9),
        (70, 'Bicicletas', 'bicicletas', '/img/no-image.png', '2020-07-22 00:09:45', '2020-07-22 00:09:45', 130, 131, 10),
        (71, 'Caza', 'caza', '/img/no-image.png', '2020-07-22 00:09:51', '2020-07-22 00:09:51', 132, 133, 10),
        (72, 'Pesca', 'pesca', '/img/no-image.png', '2020-07-22 00:09:55', '2020-07-22 00:09:55', 134, 135, 10),
        (73, 'Camping', 'camping', '/img/no-image.png', '2020-07-22 00:10:00', '2020-07-22 00:10:00', 136, 137, 10),
        (74, 'Maquinaria gimnasio', 'maquinaria-gimnasio', '/img/no-image.png', '2020-07-22 00:10:11', '2020-07-22 00:10:11', 138, 139, 10),
        (75, 'Patinetes', 'patinetes', '/img/no-image.png', '2020-07-22 00:10:15', '2020-07-22 00:10:15', 140, 141, 10),
        (76, 'Otros', 'otros-4', '/img/no-image.png', '2020-07-22 00:10:22', '2020-07-22 00:10:22', 142, 143, 10),
        (77, 'Moda infantil', 'moda-infantil', '/img/no-image.png', '2020-07-22 00:10:46', '2020-07-22 00:10:46', 146, 147, 11),
        (78, 'Moda mujer', 'moda-mujer', '/img/no-image.png', '2020-07-22 00:12:23', '2020-07-22 00:12:23', 148, 149, 11),
        (79, 'Moda hombre', 'moda-hombre', '/img/no-image.png', '2020-07-22 00:12:27', '2020-07-22 00:12:27', 150, 151, 11),
        (80, 'Zapatos mujer', 'zapatos-mujer', '/img/no-image.png', '2020-07-22 00:12:32', '2020-07-22 00:12:32', 152, 153, 11),
        (81, 'Zapatos hombre', 'zapatos-hombre', '/img/no-image.png', '2020-07-22 00:12:36', '2020-07-22 00:12:36', 154, 155, 11),
        (82, 'Gafas', 'gafas', '/img/no-image.png', '2020-07-22 00:12:39', '2020-07-22 00:12:39', 156, 157, 11),
        (83, 'Bolsos', 'bolsos', '/img/no-image.png', '2020-07-22 00:12:43', '2020-07-22 00:12:43', 158, 159, 11),
        (84, 'Otros', 'otros-5', '/img/no-image.png', '2020-07-22 00:12:45', '2020-07-22 00:12:45', 160, 161, 11),
        (85, 'Perros', 'perros', '/img/no-image.png', '2020-07-22 00:13:00', '2020-07-22 00:13:00', 164, 165, 12),
        (86, 'Gatos', 'gatos', '/img/no-image.png', '2020-07-22 00:13:03', '2020-07-22 00:13:03', 166, 167, 12),
        (87, 'Peces', 'peces', '/img/no-image.png', '2020-07-22 00:13:05', '2020-07-22 00:13:05', 168, 169, 12),
        (88, 'Pájaros', 'pajaros', '/img/no-image.png', '2020-07-22 00:13:08', '2020-07-22 00:13:08', 170, 171, 12),
        (89, 'Caballos', 'caballos', '/img/no-image.png', '2020-07-22 00:13:11', '2020-07-22 00:13:11', 172, 173, 12),
        (90, 'Otros', 'otros-6', '/img/no-image.png', '2020-07-22 00:13:14', '2020-07-22 00:13:14', 174, 175, 12),
        (91, 'Herramienta manual', 'herramienta-manual', '/img/no-image.png', '2020-07-22 00:13:25', '2020-07-22 00:13:25', 178, 179, 13),
        (92, 'Herramienta industrial', 'herramienta-industrial', '/img/no-image.png', '2020-07-22 00:13:31', '2020-07-22 00:13:31', 180, 181, 13),
        (93, 'Cursos', 'cursos', '/img/no-image.png', '2020-07-22 00:13:40', '2020-07-22 00:13:40', 184, 185, 14),
        (94, 'Bachillerato', 'bachillerato', '/img/no-image.png', '2020-07-22 00:13:43', '2020-07-22 00:13:43', 186, 187, 14),
        (95, 'Conservatorio', 'conservatorio', '/img/no-image.png', '2020-07-22 00:13:47', '2020-07-22 00:13:47', 188, 189, 14),
        (96, 'Otros', 'otros-7', '/img/no-image.png', '2020-07-22 00:13:50', '2020-07-22 00:13:50', 190, 191, 14);








            "));

    }
}
