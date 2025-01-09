<?php

namespace Database\Seeders;

use App\Models\License;
use Illuminate\Database\Seeder;

class LicenseSeeder extends Seeder
{
    public function run()
    {
        License::create([
            'name' => 'Basic',
            'short_description' => 'MP3 file for non-profit use only',
            'long_description' => 'Perfect for beginners or non-profit projects. Includes MP3 file with basic usage rights. Must credit producer in all uses. Limited to 5,000 streams.',
            'price' => 29.99,
            'features' => [
                'MP3 Format',
                'Non-profit use only',
                'No commercial rights',
                'Must credit producer'
            ]
        ]);

        License::create([
            'name' => 'Premium',
            'short_description' => 'WAV + MP3 files for commercial use',
            'long_description' => 'Ideal for professional artists. Includes WAV file with commercial rights. Unlimited streams and revenue generation. Radio play not included.',
            'price' => 49.99,
            'features' => [
                'WAV + MP3 Formats',
                'Commercial use allowed',
                'Unlimited streams',
                'Music video rights',
                'Must credit producer'
            ]
        ]);

        License::create([
            'name' => 'Exclusive',
            'short_description' => 'Full ownership rights with all files',
            'long_description' => 'Complete ownership of the beat. Includes all files (WAV, MP3, Stems). Beat will be removed from store after purchase. Unlimited commercial usage with full rights transfer.',
            'price' => 299.99,
            'features' =>[
                'All file formats',
                'Full ownership rights',
                'No credit required',
                'All commercial rights',
                'All distribution rights',
                'Beat removed from store'
            ]
        ]);
    }
}
