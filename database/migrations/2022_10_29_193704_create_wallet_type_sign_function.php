<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletTypeSignFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::unprepared('
                CREATE DEFINER=`administrator`@`localhost`
                FUNCTION `wallet_type_sign`(`amount` DECIMAL(15,2),
                         `type` ENUM("deposit","withdraw","reward", "payment"))
                RETURNS decimal(15,2)
                NO SQL

                BEGIN
                    DECLARE signed_amount DECIMAL(15,2);
                    SELECT 
                        CASE  WHEN type = "withdraw"
                                OR type = "payment"
                             THEN amount * (-1)
                             ELSE amount
                        END
                    INTO signed_amount;
                    
                    RETURN signed_amount;
                END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP FUNCTION IF EXISTS wallet_type_sign');
    }
}
