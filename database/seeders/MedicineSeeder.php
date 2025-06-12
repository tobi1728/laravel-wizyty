<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medicine;

class MedicineSeeder extends Seeder
{
    public function run(): void
    {
        $medicines = [
            [
                'medicine_name' => 'Apap',
                'medicine_form' => 'tabletka',
                'active_substance' => 'Paracetamol',
                'medicine_category' => 'Przeciwbólowe',
                'medicine_producer' => 'US PHARMACIA',
                'medicine_description' => 'Lek przecibólowy dla dzieci i dorosłych.',
            ],
            [
                'medicine_name' => 'Ibuprom',
                'medicine_form' => 'tabletka',
                'active_substance' => 'Ibuprofen',
                'medicine_category' => 'Przeciwbólowe',
                'medicine_producer' => 'USP Zdrowie',
                'medicine_description' => 'Lek przeciwbólowy i przeciwzapalny.',
            ],
            [
                'medicine_name' => 'Rutinoscorbin',
                'medicine_form' => 'tabletka',
                'active_substance' => 'Rutyna, Witamina C',
                'medicine_category' => 'Wzmacniające odporność',
                'medicine_producer' => 'GSK',
                'medicine_description' => 'Wzmacnia naczynia krwionośne i odporność.',
            ],
            [
                'medicine_name' => 'Strepsils',
                'medicine_form' => 'pastylka',
                'active_substance' => 'Amylmetakrezol, Alkohol dichlorobenzylowy',
                'medicine_category' => 'Na gardło',
                'medicine_producer' => 'Reckitt Benckiser',
                'medicine_description' => 'Łagodzi ból gardła i dezynfekuje.',
            ],
            [
                'medicine_name' => 'Polopiryna S',
                'medicine_form' => 'tabletka',
                'active_substance' => 'Kwas acetylosalicylowy',
                'medicine_category' => 'Przeciwgorączkowe',
                'medicine_producer' => 'Polfa Warszawa',
                'medicine_description' => 'Obniża gorączkę i działa przeciwzapalnie.',
            ],
            [
                'medicine_name' => 'No-Spa',
                'medicine_form' => 'tabletka',
                'active_substance' => 'Drotaweryna',
                'medicine_category' => 'Rozkurczowe',
                'medicine_producer' => 'Sanofi',
                'medicine_description' => 'Stosowany przy bólach brzucha i skurczach.',
            ],
            [
                'medicine_name' => 'Gripex',
                'medicine_form' => 'tabletka',
                'active_substance' => 'Paracetamol, Kofeina, Fenylefryna',
                'medicine_category' => 'Na przeziębienie',
                'medicine_producer' => 'USP Zdrowie',
                'medicine_description' => 'Na objawy przeziębienia i grypy.',
            ],
            [
                'medicine_name' => 'Fervex',
                'medicine_form' => 'saszetka',
                'active_substance' => 'Paracetamol, Kwas askorbinowy',
                'medicine_category' => 'Na przeziębienie',
                'medicine_producer' => 'Bristol Myers Squibb',
                'medicine_description' => 'Rozpuszczalny lek na objawy przeziębienia.',
            ],
            [
                'medicine_name' => 'Panadol',
                'medicine_form' => 'tabletka',
                'active_substance' => 'Paracetamol',
                'medicine_category' => 'Przeciwbólowe',
                'medicine_producer' => 'GSK',
                'medicine_description' => 'Stosowany przy bólach głowy i gorączce.',
            ],
            [
                'medicine_name' => 'Scorbolamid',
                'medicine_form' => 'tabletka',
                'active_substance' => 'Paracetamol, Kofeina, Witamina C',
                'medicine_category' => 'Na przeziębienie',
                'medicine_producer' => 'Aflofarm',
                'medicine_description' => 'Pomaga zwalczać przeziębienie.',
            ],
            [
                'medicine_name' => 'Thiocodin',
                'medicine_form' => 'tabletka',
                'active_substance' => 'Kodeina, Sulfogwajakol',
                'medicine_category' => 'Przeciwkaszlowe',
                'medicine_producer' => 'Hasco-Lek',
                'medicine_description' => 'Lek przeciwkaszlowy z kodeiną.',
            ],
            [
                'medicine_name' => 'Neo-Angin',
                'medicine_form' => 'pastylka',
                'active_substance' => 'Amylmetakrezol, Alkohol dichlorobenzylowy',
                'medicine_category' => 'Na gardło',
                'medicine_producer' => 'Divapharma',
                'medicine_description' => 'Na ból gardła i dezynfekcję.',
            ],
            [
                'medicine_name' => 'Groprinosin',
                'medicine_form' => 'tabletka',
                'active_substance' => 'Inozyna pranobeks',
                'medicine_category' => 'Wzmacniające odporność',
                'medicine_producer' => 'Gedeon Richter',
                'medicine_description' => 'Wzmacnia odporność i działa przeciwwirusowo.',
            ],
            [
                'medicine_name' => 'Paracetamol Hasco',
                'medicine_form' => 'tabletka',
                'active_substance' => 'Paracetamol',
                'medicine_category' => 'Przeciwbólowe',
                'medicine_producer' => 'Hasco-Lek',
                'medicine_description' => 'Popularny lek przeciwbólowy.',
            ],
            [
                'medicine_name' => 'Pyralgina',
                'medicine_form' => 'tabletka',
                'active_substance' => 'Metamizol',
                'medicine_category' => 'Przeciwbólowe',
                'medicine_producer' => 'Polpharma',
                'medicine_description' => 'Silny lek przeciwbólowy.',
            ],
            [
                'medicine_name' => 'Acodin',
                'medicine_form' => 'tabletka',
                'active_substance' => 'Dekstrometorfan',
                'medicine_category' => 'Przeciwkaszlowe',
                'medicine_producer' => 'US Pharmacia',
                'medicine_description' => 'Na suchy kaszel.',
            ],
            [
                'medicine_name' => 'ACC',
                'medicine_form' => 'tabletka musująca',
                'active_substance' => 'Acetylocysteina',
                'medicine_category' => 'Wykrztuśne',
                'medicine_producer' => 'Sandoz',
                'medicine_description' => 'Ułatwia odkrztuszanie wydzieliny.',
            ],
            [
                'medicine_name' => 'Aspirin',
                'medicine_form' => 'tabletka',
                'active_substance' => 'Kwas acetylosalicylowy',
                'medicine_category' => 'Przeciwgorączkowe',
                'medicine_producer' => 'Bayer',
                'medicine_description' => 'Stosowany na gorączkę i ból.',
            ],
            [
                'medicine_name' => 'Coldrex',
                'medicine_form' => 'saszetka',
                'active_substance' => 'Paracetamol, Fenylefryna, Witamina C',
                'medicine_category' => 'Na przeziębienie',
                'medicine_producer' => 'GSK',
                'medicine_description' => 'Lek na objawy grypy i przeziębienia.',
            ],
            [
                'medicine_name' => 'Cerutin',
                'medicine_form' => 'tabletka',
                'active_substance' => 'Rutyna, Witamina C',
                'medicine_category' => 'Wzmacniające odporność',
                'medicine_producer' => 'Polfa Łódź',
                'medicine_description' => 'Na wzmocnienie odporności.',
            ],
            [
                'medicine_name' => 'Febrisan',
                'medicine_form' => 'saszetka',
                'active_substance' => 'Paracetamol, Kwas askorbinowy',
                'medicine_category' => 'Na przeziębienie',
                'medicine_producer' => 'USP Zdrowie',
                'medicine_description' => 'Rozpuszczalny proszek na przeziębienie.',
            ],
        ];

        foreach ($medicines as $medicine) {
            Medicine::create($medicine);
        }
    }
}
