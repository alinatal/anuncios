<?php

use Illuminate\Database\Seeder;
use App\Setting;


class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $primary_menu = json_encode([
            'Inicio' => '/',
            'Categorías' => '/categorias',
            'Quiénes somos' => '/quienes-somos',
            'Contacto' => '/contacto'
        ]);
        $secondary_menu = json_encode([
            'Inicio' => '/',
            'Acerca de' => '/acerca-de',
            'Preguntas frecuentes' => '/preguntas-frecuentes',
            'Normas de conducta' => '/normas-de-conducta',
            'Política de privacidad' => '/politica-de-privacidad',
            'Condiciones de uso' => '/condiciones-de-uso',
            'Condiciones de contratación de publicidad' => '/contratación-publicidad',
            'Contacto' => '/contacto'
        ]);
        Setting::insert([
            ['key' => 'site_name', 'value' => 'Anuncios Lucena', 'label'=> 'Nombre del sitio', 'order' => 1, 'type' => 'text' ],
            ['key' => 'site_description', 'value' => 'Somos una web de anuncios', 'label'=> 'Descripción del sitio', 'order' => 2, 'type' => 'text' ],
            ['key' => 'site_email', 'value' => 'info@anuncioslucena.com', 'label'=> 'Email', 'order' => 3, 'type' => 'text' ],
            ['key' => 'site_phone', 'value' => '123 456 789', 'label'=> 'Teléfono', 'order' => 4, 'type' => 'text'],
            ['key' => 'site_logo', 'value' => '/img/logo.png', 'label'=> 'Logo', 'order' => 5, 'type' => 'text' ],
            ['key' => 'site_google_anlytics', 'value' => 'Codigo de analytics', 'label'=> 'Google Analytics', 'order' => 6, 'type' => 'text' ],
            ['key' => 'site_footer_head', 'value' => 'Sobre nosotros', 'label'=> 'Título del pie de página', 'order' => 7, 'type' => 'text' ],
            ['key' => 'site_footer_text', 'value' => 'Texto del footer', 'label'=> 'Descripción del pie de página', 'order' => 8, 'type' => 'textarea'],
            ['key' => 'site_twitter', 'value' => 'https://twitter.com/', 'label'=> 'Twitter', 'order' => 9, 'type' => 'text' ],
            ['key' => 'site_facebook', 'value' => 'https://facebook.com/', 'label'=> 'Facebook', 'order' => 10, 'type' => 'text' ],
            ['key' => 'site_instagram', 'value' => 'https://instagram.com/', 'label'=> 'Instagram', 'order' => 11, 'type' => 'text' ],
            ['key' => 'site_primary_menu', 'value' => $primary_menu, 'label'=> 'Menu principal', 'order' => 12, 'type' => 'json' ],
            ['key' => 'site_secondary_menu', 'value' => $secondary_menu, 'label'=> 'Menu secundario', 'order' => 13, 'type' => 'json' ]
        ]);
        //Setting::add('site_name', 'Anuncios Lucena');
//        Setting::add('site_email', 'info@anuncioslucena.com');
//        Setting::add('site_phone', '123 456 789');
//        Setting::add('site_logo', '/img/logo.png');
//        Setting::add('site_footer_text', '“Si no lo usas, súbelo”. Bajo esta premisa, en seis años wallapop se ha convertido en una comunidad en la que cada día millones de personas compran y venden productos de segunda mano. Y no hemos hecho más que empezar. Comprar segunda mano es la mejor forma de conseguir lo que necesitas a un precio mejor. ¡Pero va mucho más allá! Cada vez que compras algo en wallapop, fomentas un consumo más responsable, porque alargas la vida de los productos y evitas su sobreproducción. Vender segunda mano es decirle al mundo que podemos vivir más con menos. Más espacio en casa, más dinero extra, más nuevas experiencias, más recuerdos inolvidables, más lo que quieras, y menos cosas sin usar guardadas en el armario. Por fin, la sociedad ha comprendido que la segunda mano es una nueva forma de consumir llena de beneficios. Esta es la razón por la que cada vez más personas usan wallapop, la plataforma líder de las páginas de segunda mano y de anuncios clasificados.', 'textarea');
//        Setting::add('site_footer_head', 'Sobre nosotros');
//        Setting::add('site_twitter', 'https://twitter.com/');
//        Setting::add('site_facebook', 'https://facebook.com/');
//        Setting::add('site_instagram', 'https://instagram.com/');
//        Setting::add('site_primary_menu',


    }
}
