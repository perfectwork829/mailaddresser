<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {

            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->increments('id');
            $table->string('name', 100)->default('');
            $table->string('gender', 1)->default('');
            $table->string('mobile1', 10)->default('')->index();
            $table->string('mobile2', 10)->default('')->index();
            $table->string('mobile3', 10)->default('')->index();
            $table->string('mobile4', 10)->default('')->index();
            $table->string('phone1', 10)->default('')->index();
            $table->string('phone2', 10)->default('')->index();
            $table->string('phone3', 10)->default('')->index();
            $table->string('streetaddress', 50)->default('');
            $table->mediumInteger('zipcode')->default(0)->index();
            $table->string('town', 25)->default('');
            $table->integer('birthdate')->default(0)->index();
            $table->string('living', 25)->default('');

            $table->index(['gender', 'living', 'zipcode', 'birthdate']);
            $table->index(['living', 'zipcode', 'birthdate']);
            $table->index(['zipcode', 'birthdate']);
            $table->index(['gender', 'zipcode', 'birthdate']);
        });

        \Illuminate\Support\Facades\DB::unprepared("
            create table addresses_mobile like addresses;
        ");

        \Illuminate\Support\Facades\DB::unprepared("
            create table addresses_fixedLandLine like addresses;
        ");

        \Illuminate\Support\Facades\DB::unprepared("
            create table addresses_phone like addresses;
        ");

        \Illuminate\Support\Facades\DB::unprepared("
            create table addresses_streetAddress like addresses;
        ");

        // AFTER INSERT TRIGGER
        "
            DELIMITER $$

            CREATE OR REPLACE TRIGGER denormalize_addresses AFTER INSERT ON addresses
                FOR EACH ROW BEGIN
                    IF NEW.streetaddress != '' AND NEW.zipcode != 0 AND NEW.town != '' THEN
                        INSERT INTO addresses_streetAddress
                            (id,name,gender,mobile1,mobile2,mobile3,mobile4,phone1,phone2,phone3,streetaddress,zipcode,town,birthdate,living) VALUES
                            (NEW.id,NEW.name,NEW.gender,NEW.mobile1,NEW.mobile2,NEW.mobile3,NEW.mobile4,NEW.phone1,NEW.phone2,NEW.phone3,NEW.streetaddress,NEW.zipcode,NEW.town,NEW.birthdate,NEW.living);
                    END IF;
                    IF NEW.mobile1 != '' OR NEW.mobile2 != '' OR NEW.mobile3 != '' OR NEW.mobile4 != '' THEN
                        INSERT INTO addresses_mobile
                            (id,name,gender,mobile1,mobile2,mobile3,mobile4,phone1,phone2,phone3,streetaddress,zipcode,town,birthdate,living) VALUES
                            (NEW.id,NEW.name,NEW.gender,NEW.mobile1,NEW.mobile2,NEW.mobile3,NEW.mobile4,NEW.phone1,NEW.phone2,NEW.phone3,NEW.streetaddress,NEW.zipcode,NEW.town,NEW.birthdate,NEW.living);
                    END IF;
                    IF NEW.phone1 != '' OR NEW.phone2 != '' OR NEW.phone3 != '' THEN
                        INSERT INTO addresses_fixedLandLine
                            (id,name,gender,mobile1,mobile2,mobile3,mobile4,phone1,phone2,phone3,streetaddress,zipcode,town,birthdate,living) VALUES
                            (NEW.id,NEW.name,NEW.gender,NEW.mobile1,NEW.mobile2,NEW.mobile3,NEW.mobile4,NEW.phone1,NEW.phone2,NEW.phone3,NEW.streetaddress,NEW.zipcode,NEW.town,NEW.birthdate,NEW.living);
                    END IF;
                    IF NEW.phone1 != '' OR NEW.phone2 != '' OR NEW.phone3 != '' OR NEW.mobile1 != '' OR NEW.mobile2 != '' OR NEW.mobile3 != '' OR NEW.mobile4 != '' THEN
                        INSERT INTO addresses_phone
                            (id,name,gender,mobile1,mobile2,mobile3,mobile4,phone1,phone2,phone3,streetaddress,zipcode,town,birthdate,living) VALUES
                            (NEW.id,NEW.name,NEW.gender,NEW.mobile1,NEW.mobile2,NEW.mobile3,NEW.mobile4,NEW.phone1,NEW.phone2,NEW.phone3,NEW.streetaddress,NEW.zipcode,NEW.town,NEW.birthdate,NEW.living);
                    END IF;
                END$$

            DELIMITER ;
        ";
        // AFTER UPDATE TRIGGER
        "
            DELIMITER $$

            CREATE OR REPLACE TRIGGER denormalize_on_update AFTER UPDATE ON addresses
                FOR EACH ROW BEGIN
                    IF NEW.streetaddress != '' AND NEW.zipcode != 0 AND NEW.town != '' THEN
                        INSERT INTO addresses_streetAddress
                            (id,name,gender,mobile1,mobile2,mobile3,mobile4,phone1,phone2,phone3,streetaddress,zipcode,town,birthdate,living) VALUES
                            (NEW.id,NEW.name,NEW.gender,NEW.mobile1,NEW.mobile2,NEW.mobile3,NEW.mobile4,NEW.phone1,NEW.phone2,NEW.phone3,NEW.streetaddress,NEW.zipcode,NEW.town,NEW.birthdate,NEW.living)
                        ON DUPLICATE KEY UPDATE
                            name = NEW.name,
                            gender = NEW.gender,
                            mobile1 = NEW.mobile1,
                            mobile2 = NEW.mobile2,
                            mobile3 = NEW.mobile3,
                            mobile4 = NEW.mobile4,
                            phone1 = NEW.phone1,
                            phone2 = NEW.phone2,
                            phone3 = NEW.phone3,
                            streetaddress = NEW.streetaddress,
                            zipcode = NEW.zipcode,
                            town = NEW.town,
                            birthdate = NEW.birthdate,
                            living = NEW.living;
                    ELSE
                        DELETE FROM addresses_streetAddress WHERE id = NEW.id;
                    END IF;
                    IF NEW.mobile1 != '' OR NEW.mobile2 != '' OR NEW.mobile3 != '' OR NEW.mobile4 != '' THEN
                        INSERT INTO addresses_mobile
                            (id,name,gender,mobile1,mobile2,mobile3,mobile4,phone1,phone2,phone3,streetaddress,zipcode,town,birthdate,living) VALUES
                            (NEW.id,NEW.name,NEW.gender,NEW.mobile1,NEW.mobile2,NEW.mobile3,NEW.mobile4,NEW.phone1,NEW.phone2,NEW.phone3,NEW.streetaddress,NEW.zipcode,NEW.town,NEW.birthdate,NEW.living)
                        ON DUPLICATE KEY UPDATE
                            name = NEW.name,
                            gender = NEW.gender,
                            mobile1 = NEW.mobile1,
                            mobile2 = NEW.mobile2,
                            mobile3 = NEW.mobile3,
                            mobile4 = NEW.mobile4,
                            phone1 = NEW.phone1,
                            phone2 = NEW.phone2,
                            phone3 = NEW.phone3,
                            streetaddress = NEW.streetaddress,
                            zipcode = NEW.zipcode,
                            town = NEW.town,
                            birthdate = NEW.birthdate,
                            living = NEW.living;
                    ELSE
                        DELETE FROM addresses_streetAddress WHERE id = NEW.id;
                    END IF;
                    IF NEW.phone1 != '' OR NEW.phone2 != '' OR NEW.phone3 != '' THEN
                        INSERT INTO addresses_fixedLandLine
                            (id,name,gender,mobile1,mobile2,mobile3,mobile4,phone1,phone2,phone3,streetaddress,zipcode,town,birthdate,living) VALUES
                            (NEW.id,NEW.name,NEW.gender,NEW.mobile1,NEW.mobile2,NEW.mobile3,NEW.mobile4,NEW.phone1,NEW.phone2,NEW.phone3,NEW.streetaddress,NEW.zipcode,NEW.town,NEW.birthdate,NEW.living)
                        ON DUPLICATE KEY UPDATE
                            name = NEW.name,
                            gender = NEW.gender,
                            mobile1 = NEW.mobile1,
                            mobile2 = NEW.mobile2,
                            mobile3 = NEW.mobile3,
                            mobile4 = NEW.mobile4,
                            phone1 = NEW.phone1,
                            phone2 = NEW.phone2,
                            phone3 = NEW.phone3,
                            streetaddress = NEW.streetaddress,
                            zipcode = NEW.zipcode,
                            town = NEW.town,
                            birthdate = NEW.birthdate,
                            living = NEW.living;
                    ELSE
                        DELETE FROM addresses_streetAddress WHERE id = NEW.id;
                    END IF;
                    IF NEW.phone1 != '' OR NEW.phone2 != '' OR NEW.phone3 != '' OR NEW.mobile1 != '' OR NEW.mobile2 != '' OR NEW.mobile3 != '' OR NEW.mobile4 != '' THEN
                        INSERT INTO addresses_phone
                            (id,name,gender,mobile1,mobile2,mobile3,mobile4,phone1,phone2,phone3,streetaddress,zipcode,town,birthdate,living) VALUES
                            (NEW.id,NEW.name,NEW.gender,NEW.mobile1,NEW.mobile2,NEW.mobile3,NEW.mobile4,NEW.phone1,NEW.phone2,NEW.phone3,NEW.streetaddress,NEW.zipcode,NEW.town,NEW.birthdate,NEW.living)
                        ON DUPLICATE KEY UPDATE
                            name = NEW.name,
                            gender = NEW.gender,
                            mobile1 = NEW.mobile1,
                            mobile2 = NEW.mobile2,
                            mobile3 = NEW.mobile3,
                            mobile4 = NEW.mobile4,
                            phone1 = NEW.phone1,
                            phone2 = NEW.phone2,
                            phone3 = NEW.phone3,
                            streetaddress = NEW.streetaddress,
                            zipcode = NEW.zipcode,
                            town = NEW.town,
                            birthdate = NEW.birthdate,
                            living = NEW.living;
                    ELSE
                        DELETE FROM addresses_streetAddress WHERE id = NEW.id;
                    END IF;
                END$$

            DELIMITER ;
        ";
        // AFTER DELETE TRIGGER
        "
            DELIMITER $$

            CREATE OR REPLACE TRIGGER denormalize_after_delete AFTER DELETE ON addresses
                FOR EACH ROW BEGIN
                    DELETE FROM addresses_fixedLandLine WHERE id = old.id;
                    DELETE FROM addresses_mobile WHERE id = old.id;
                    DELETE FROM addresses_phone WHERE id = old.id;
                    DELETE FROM addresses_streetAddress WHERE id = old.id;
                END$$

            DELIMITER ;
        ";


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::unprepared("
            DROP TRIGGER IF EXISTS addresses.denormalize_addresses
        ");
        Schema::drop('addresses');
        Schema::drop('addresses_mobile');
        Schema::drop('addresses_fixedLandLine');
        Schema::drop('addresses_phone');
        Schema::drop('addresses_streetAddress');
    }
}
