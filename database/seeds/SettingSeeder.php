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
        Setting::add('site_name', 'Anuncios Lucena');
        Setting::add('site_email', 'info@anuncioslucena.com');
        Setting::add('site_phone', '123 456 789');
        Setting::add('site_logo', '/img/logo.png');
        Setting::add('site_footer_text', '“Si no lo usas, súbelo”. Bajo esta premisa, en seis años wallapop se ha convertido en una comunidad en la que cada día millones de personas compran y venden productos de segunda mano. Y no hemos hecho más que empezar. Comprar segunda mano es la mejor forma de conseguir lo que necesitas a un precio mejor. ¡Pero va mucho más allá! Cada vez que compras algo en wallapop, fomentas un consumo más responsable, porque alargas la vida de los productos y evitas su sobreproducción. Vender segunda mano es decirle al mundo que podemos vivir más con menos. Más espacio en casa, más dinero extra, más nuevas experiencias, más recuerdos inolvidables, más lo que quieras, y menos cosas sin usar guardadas en el armario. Por fin, la sociedad ha comprendido que la segunda mano es una nueva forma de consumir llena de beneficios. Esta es la razón por la que cada vez más personas usan wallapop, la plataforma líder de las páginas de segunda mano y de anuncios clasificados.', 'textarea');
        Setting::add('site_footer_head', 'Sobre nosotros');
        Setting::add('site_twitter', 'https://twitter.com/');
        Setting::add('site_facebook', 'https://facebook.com/');
        Setting::add('site_instagram', 'https://instagram.com/');

    }
}
