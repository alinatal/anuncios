<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::select(DB::raw("
        INSERT INTO `pages` (`id`, `name`, `description`, `slug`, `created_at`, `updated_at`) VALUES
        (1, 'Quienes somos', '<p>Aqu&iacute; ir&iacute;a quienes somos</p>', 'quienes-somos', '2020-07-22 00:21:49', '2020-07-22 00:21:49'),
        (2, 'Contacto', '<p>Aqu&iacute; informaci&oacute;n de contacto</p>', 'contacto', '2020-07-22 00:22:28', '2020-07-22 00:22:28'),
        (3, 'Acerca de', '<p>Esto es acerca de</p>', 'acerca-de', '2020-07-22 00:27:24', '2020-07-22 00:27:24'),
        (4, 'Preguntas frecuentes', '<p>esto son las preguntas frecuentes</p>', 'preguntas-frecuentes', '2020-07-22 00:27:44', '2020-07-22 00:27:44'),
        (5, 'Normas de conducta', '<p>Estas son las normas de conducta</p>', 'normas-de-conducta', '2020-07-22 00:28:10', '2020-07-22 00:28:10'),
        (6, 'Política de privacidad', '<p>Esta es nuestra pol&iacute;tica de privacidad</p>', 'politica-de-privacidad', '2020-07-22 00:28:32', '2020-07-22 00:28:32'),
        (7, 'Condiciones de uso', '<p>Estas son nuestras condiciones de uso</p>', 'condiciones-de-uso', '2020-07-22 00:28:42', '2020-07-22 00:28:42');
        "));
    }
}
