<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            [
                'name' => 'sabor',
                'type' => 1,
                'features' => [
                    [
                    'value' => 'v',
                    'description' => 'Vainilla'
                    ],
                    [
                    'value' => 'c',
                    'description' => 'Chocolate'
                    ],
                    
                ]
            ],
            [
                'name' => 'tamaño',
                'type' => 2,
                'features' => [
                    [
                        'value'=> '1',
                        'description'=> '1kg'
                    ],
                    [
                        'value'=> '3',
                        'description'=> '3kg'
                    ],
                    [
                        'value'=> '5',
                        'description'=> '5kg'
                    ],
                ]
            ],
    
        ];


        foreach ($options as $option) {
            $optionModel = Option::create([
                'name'=> $option['name'],
                'type'=> $option['type'],
            ]);

            foreach ($option['features'] as $feature) {
                $optionModel->features()->create([
                    'value' => $feature['value'],
                    'description' => $feature['description'],
                ]);
            }
        }
    } 
}
