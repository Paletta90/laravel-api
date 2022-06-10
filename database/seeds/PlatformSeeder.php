<?php

use Illuminate\Database\Seeder;

use App\Models\Platform;

class PlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $platforms = [
            [
                'name' => 'Facebook',
                'icon' => 'https://cdn2.iconfinder.com/data/icons/social-media-2285/512/1_Facebook_colored_svg_copy-512.png'
            ],
            [
                'name' => 'Linkedin',
                'icon' => 'https://cdn2.iconfinder.com/data/icons/social-media-2285/512/1_Linkedin_unofficial_colored_svg-512.png'
            ],
            [
                'name' => 'Twitter',
                'icon' => 'https://cdn2.iconfinder.com/data/icons/social-media-2285/512/1_Twitter_colored_svg-512.png'
            ],
            [
                'name' => 'Instagram',
                'icon' => 'https://cdn2.iconfinder.com/data/icons/social-media-2285/512/1_Instagram_colored_svg_1-512.png'
            ],
            [
                'name' => 'Pinterest',
                'icon' => 'https://cdn2.iconfinder.com/data/icons/social-media-2285/512/1_Pinterest_colored_svg-512.png'
            ],
        ];

        foreach ($platforms as $platform) {
            $new_platform = new Platform();
            $new_platform -> name = $platform['name'];
            $new_platform -> icon = $platform['icon'];
            $new_platform -> save();
        }


    }
}
