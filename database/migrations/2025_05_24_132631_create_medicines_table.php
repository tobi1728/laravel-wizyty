<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('medicine_name');
            $table->string('medicine_form');
            $table->string('active_substance');
            $table->string('medicine_category');
            $table->string('medicine_producer');
            $table->text('medicine_description');
        });

        DB::table('medicines')->insert([
            ['id'=>1, 'medicine_name'=>'Apap', 'medicine_form'=>'tabletka', 'active_substance'=>'Paracetamol','medicine_category'=>'Przeciwbólowe', 'medicine_producer'=>'US PHARMACIA', 'medicine_description'=>'Lek przecibólowy dla dzieci i dorosłych.'],
            ['id'=>2, 'medicine_name'=>'Ibuprom', 'medicine_form'=>'tabletka', 'active_substance'=>'Ibuprofen', 'medicine_category'=>'Przeciwbólowe', 'medicine_producer'=>'USP Zdrowie', 'medicine_description'=>'Lek przeciwbólowy i przeciwzapalny.'],
            ['id'=>3, 'medicine_name'=>'Rutinoscorbin', 'medicine_form'=>'tabletka', 'active_substance'=>'Rutyna, Witamina C', 'medicine_category'=>'Wzmacniające odporność', 'medicine_producer'=>'GSK', 'medicine_description'=>'Wzmacnia naczynia krwionośne i odporność.'],
            ['id'=>4, 'medicine_name'=>'Strepsils', 'medicine_form'=>'pastylka', 'active_substance'=>'Amylmetakrezol, Alkohol dichlorobenzylowy', 'medicine_category'=>'Na gardło', 'medicine_producer'=>'Reckitt Benckiser', 'medicine_description'=>'Łagodzi ból gardła i dezynfekuje.'],
            ['id'=>5, 'medicine_name'=>'Polopiryna S', 'medicine_form'=>'tabletka', 'active_substance'=>'Kwas acetylosalicylowy', 'medicine_category'=>'Przeciwgorączkowe', 'medicine_producer'=>'Polfa Warszawa', 'medicine_description'=>'Obniża gorączkę i działa przeciwzapalnie.'],
            ['id'=>6, 'medicine_name'=>'Neo-Angin', 'medicine_form'=>'pastylka', 'active_substance'=>'Dichlorobenzylowy alkohol, Amylmetakrezol, Levomentol', 'medicine_category'=>'Na gardło', 'medicine_producer'=>'Divapharma', 'medicine_description'=>'Łagodzi ból gardła i odświeża oddech.'],
            ['id'=>7, 'medicine_name'=>'No-Spa', 'medicine_form'=>'tabletka', 'active_substance'=>'Drotaweryna', 'medicine_category'=>'Rozkurczowe', 'medicine_producer'=>'Sanofi', 'medicine_description'=>'Łagodzi skurcze mięśni gładkich.'],
            ['id'=>8, 'medicine_name'=>'Mucosolvan', 'medicine_form'=>'syrop', 'active_substance'=>'Ambroksol', 'medicine_category'=>'Wykrztuśne', 'medicine_producer'=>'Boehringer Ingelheim', 'medicine_description'=>'Ułatwia odkrztuszanie wydzieliny z dróg oddechowych.'],
            ['id'=>9, 'medicine_name'=>'Fervex', 'medicine_form'=>'saszetka', 'active_substance'=>'Paracetamol, Feniramina, Witamina C', 'medicine_category'=>'Na przeziębienie', 'medicine_producer'=>'UPSA', 'medicine_description'=>'Łagodzi objawy przeziębienia i grypy.'],
            ['id'=>10, 'medicine_name'=>'Gripex', 'medicine_form'=>'tabletka', 'active_substance'=>'Paracetamol, Pseudoefedryna, Deksbromfeniramina', 'medicine_category'=>'Na przeziębienie', 'medicine_producer'=>'US Pharmacia', 'medicine_description'=>'Działa przeciwbólowo, przeciwgorączkowo i udrażnia nos.'],
            ['id'=>11, 'medicine_name'=>'Xenna', 'medicine_form'=>'tabletka', 'active_substance'=>'Sennozydy', 'medicine_category'=>'Przeczyszczające', 'medicine_producer'=>'Teva', 'medicine_description'=>'Wspomaga wypróżnianie przy zaparciach.'],
            ['id'=>12, 'medicine_name'=>'Smecta', 'medicine_form'=>'saszetka', 'active_substance'=>'Diosmektyt', 'medicine_category'=>'Przeciwbiegunkowe', 'medicine_producer'=>'Ipsen', 'medicine_description'=>'Chroni błonę śluzową jelit i łagodzi biegunkę.'],
            ['id'=>13, 'medicine_name'=>'Loratadyna', 'medicine_form'=>'tabletka', 'active_substance'=>'Loratadyna', 'medicine_category'=>'Przeciwalergiczne', 'medicine_producer'=>'Polpharma', 'medicine_description'=>'Łagodzi objawy alergii skórnych i wziewnych.'],
            ['id'=>14, 'medicine_name'=>'Zyrtec', 'medicine_form'=>'krople', 'active_substance'=>'Ceteryzyna', 'medicine_category'=>'Przeciwalergiczne', 'medicine_producer'=>'UCB', 'medicine_description'=>'Działa przeciwalergicznie i przeciwświądowo.'],
            ['id'=>15, 'medicine_name'=>'Nurofen', 'medicine_form'=>'tabletka', 'active_substance'=>'Ibuprofen', 'medicine_category'=>'Przeciwbólowe', 'medicine_producer'=>'Reckitt Benckiser', 'medicine_description'=>'Działa przeciwbólowo, przeciwgorączkowo i przeciwzapalnie.'],
            ['id'=>16, 'medicine_name'=>'Cerutin', 'medicine_form'=>'tabletka', 'active_substance'=>'Rutyna, Witamina C', 'medicine_category'=>'Wzmacniające odporność', 'medicine_producer'=>'Aflofarm', 'medicine_description'=>'Wzmacnia odporność i uszczelnia naczynia.'],
            ['id'=>17, 'medicine_name'=>'Stoperan', 'medicine_form'=>'tabletka', 'active_substance'=>'Loperamid', 'medicine_category'=>'Przeciwbiegunkowe', 'medicine_producer'=>'Polpharma', 'medicine_description'=>'Hamuje perystaltykę jelit i zatrzymuje biegunkę.'],
            ['id'=>18, 'medicine_name'=>'Theraflu', 'medicine_form'=>'saszetka', 'active_substance'=>'Paracetamol, Feniramina, Fenylefryna', 'medicine_category'=>'Na przeziębienie', 'medicine_producer'=>'GSK', 'medicine_description'=>'Łagodzi objawy przeziębienia i grypy.'],
            ['id'=>19, 'medicine_name'=>'Metafen', 'medicine_form'=>'tabletka', 'active_substance'=>'Paracetamol, Ibuprofen', 'medicine_category'=>'Przeciwbólowe', 'medicine_producer'=>'US Pharmacia', 'medicine_description'=>'Połączone działanie przeciwbólowe i przeciwgorączkowe.'],
            ['id'=>20, 'medicine_name'=>'Otrivin', 'medicine_form'=>'aerozol', 'active_substance'=>'Ksylometazolina', 'medicine_category'=>'Na katar', 'medicine_producer'=>'Novartis', 'medicine_description'=>'Obkurcza błonę śluzową nosa i ułatwia oddychanie.'],
            ['id'=>21, 'medicine_name'=>'Panadol Baby', 'medicine_form'=>'zawiesina', 'active_substance'=>'Paracetamol', 'medicine_category'=>'Dla dzieci', 'medicine_producer'=>'GSK', 'medicine_description'=>'Przeciwgorączkowy lek dla niemowląt i małych dzieci.'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
