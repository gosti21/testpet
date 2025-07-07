<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Family;
use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $families = [
            'Alimentos' => [
                'Perros' => [
                    'Alimento seco',
                    'Alimento húmedo',
                    'Snacks',
                    'Dietas especiales',
                    'Cachorros',
                    'Adultos',
                    'Senior',
                ],
                'Gatos' => [
                    'Alimento seco',
                    'Alimento húmedo',
                    'Snacks',
                    'Dietas especiales',
                    'Gatitos',
                    'Adultos',
                    'Senior',
                ],
                'Aves' => [
                    'Semillas',
                    'Alimento balanceado',
                    'Snacks',
                    'Suplementos',
                ],
                'Peces' => [
                    'Alimento en escamas',
                    'Alimento en pellets',
                    'Alimento para fondo',
                    'Suplementos',
                ],
                'Roedores' => [
                    'Alimento balanceado',
                    'Snacks',
                    'Heno',
                    'Suplementos',
                ],
                'Reptiles' => [
                    'Alimento vivo',
                    'Alimento seco',
                    'Suplementos',
                ],
            ],
            'Accesorios' => [
                'Perros' => [
                    'Collares',
                    'Correas',
                    'Arneses',
                    'Platos y bebederos',
                    'Camas',
                    'Ropa',
                    'Transportadoras',
                    'Juguetes',
                    'Cepillos',
                    'Otros',
                ],
                'Gatos' => [
                    'Collares',
                    'Rascadores',
                    'Areneros',
                    'Platos y bebederos',
                    'Camas',
                    'Ropa',
                    'Transportadoras',
                    'Juguetes',
                    'Cepillos',
                    'Otros',
                ],
                'Aves' => [
                    'Jaulas',
                    'Bebederos',
                    'Comederos',
                    'Juguetes',
                    'Perchas',
                    'Baños',
                    'Otros',
                ],
                'Peces' => [
                    'Acuarios',
                    'Filtros',
                    'Decoración',
                    'Iluminación',
                    'Aireadores',
                    'Termómetros',
                    'Otros',
                ],
                'Roedores' => [
                    'Jaulas',
                    'Ruedas',
                    'Casitas',
                    'Comederos',
                    'Bebederos',
                    'Juguetes',
                    'Otros',
                ],
                'Reptiles' => [
                    'Terrarios',
                    'Lámparas',
                    'Sustratos',
                    'Decoración',
                    'Comederos',
                    'Bebederos',
                    'Otros',
                ],
            ],
            'Higiene y Cuidado' => [
                'Perros' => [
                    'Shampoo',
                    'Acondicionador',
                    'Cepillos',
                    'Cortaúñas',
                    'Toallitas',
                    'Perfumes',
                    'Repelentes',
                    'Limpieza dental',
                    'Otros',
                ],
                'Gatos' => [
                    'Shampoo',
                    'Cepillos',
                    'Cortaúñas',
                    'Toallitas',
                    'Arenas sanitarias',
                    'Desodorantes',
                    'Limpieza dental',
                    'Otros',
                ],
                'Aves' => [
                    'Baños',
                    'Desinfectantes',
                    'Limpieza de jaulas',
                    'Otros',
                ],
                'Peces' => [
                    'Acondicionadores de agua',
                    'Limpieza de acuarios',
                    'Redes',
                    'Otros',
                ],
                'Roedores' => [
                    'Sustratos',
                    'Limpieza de jaulas',
                    'Cepillos',
                    'Otros',
                ],
                'Reptiles' => [
                    'Sustratos',
                    'Limpieza de terrarios',
                    'Desinfectantes',
                    'Otros',
                ],
            ],
            'Salud' => [
                'Perros' => [
                    'Vitaminas',
                    'Desparasitantes',
                    'Antipulgas',
                    'Suplementos',
                    'Botiquín',
                    'Otros',
                ],
                'Gatos' => [
                    'Vitaminas',
                    'Desparasitantes',
                    'Antipulgas',
                    'Suplementos',
                    'Botiquín',
                    'Otros',
                ],
                'Aves' => [
                    'Vitaminas',
                    'Desparasitantes',
                    'Suplementos',
                    'Otros',
                ],
                'Peces' => [
                    'Acondicionadores',
                    'Medicamentos',
                    'Suplementos',
                    'Otros',
                ],
                'Roedores' => [
                    'Vitaminas',
                    'Desparasitantes',
                    'Suplementos',
                    'Otros',
                ],
                'Reptiles' => [
                    'Vitaminas',
                    'Suplementos',
                    'Desparasitantes',
                    'Otros',
                ],
            ],
            'Juguetes' => [
                'Perros' => [
                    'Pelotas',
                    'Cuerdas',
                    'Juguetes interactivos',
                    'Mordedores',
                    'Otros',
                ],
                'Gatos' => [
                    'Pelotas',
                    'Ratones',
                    'Juguetes con catnip',
                    'Cañas',
                    'Otros',
                ],
                'Aves' => [
                    'Columpios',
                    'Campanas',
                    'Espejos',
                    'Otros',
                ],
                'Peces' => [
                    'Decoraciones móviles',
                    'Otros',
                ],
                'Roedores' => [
                    'Ruedas',
                    'Túneles',
                    'Mordedores',
                    'Otros',
                ],
                'Reptiles' => [
                    'Escondites',
                    'Rampas',
                    'Otros',
                ],
            ],
            'Transporte' => [
                'Perros' => [
                    'Transportadoras',
                    'Bolsos',
                    'Cinturones de seguridad',
                    'Jaulas',
                    'Otros',
                ],
                'Gatos' => [
                    'Transportadoras',
                    'Bolsos',
                    'Jaulas',
                    'Otros',
                ],
                'Aves' => [
                    'Jaulas de viaje',
                    'Bolsos',
                    'Otros',
                ],
                'Roedores' => [
                    'Jaulas de viaje',
                    'Bolsos',
                    'Otros',
                ],
                'Reptiles' => [
                    'Terrarios portátiles',
                    'Bolsos',
                    'Otros',
                ],
            ],
            'Ropa y Moda' => [
                'Perros' => [
                    'Camisetas',
                    'Abrigos',
                    'Disfraces',
                    'Zapatos',
                    'Pañuelos',
                    'Otros',
                ],
                'Gatos' => [
                    'Camisetas',
                    'Abrigos',
                    'Disfraces',
                    'Pañuelos',
                    'Otros',
                ],
            ],
            'Educación y Adiestramiento' => [
                'Perros' => [
                    'Clickers',
                    'Premios de adiestramiento',
                    'Libros',
                    'Silbatos',
                    'Otros',
                ],
                'Gatos' => [
                    'Premios de adiestramiento',
                    'Libros',
                    'Otros',
                ],
            ],
            'Ofertas' => [
                'General' => [
                    'Descuentos',
                    'Combos',
                    'Nuevos productos',
                    'Liquidaciones',
                ],
            ],
        ];

        foreach ($families as $family => $categories) {

            $family = Family::create([
                'name' => $family,
            ]);

            foreach ($categories as $categoy => $subcategories) {

                $category = Category::create([
                    'name' => $categoy,
                    'family_id' => $family->id
                ]);

                foreach ($subcategories as $subcategory) {
                    Subcategory::create([
                        'name' => $subcategory,
                        'category_id' => $category->id,
                    ]);
                }
            }
        }
    }
}
