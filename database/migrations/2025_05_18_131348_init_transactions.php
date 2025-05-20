<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('registers')->insert([
            [
                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -6.99,
                'origin'         => "Jocs",
                'created_at'     => "2025-05-18 17:49:06",
                'updated_at'     => "2025-05-18 17:49:06",
            ],
            [
                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -323.63,
                'origin'         => "Vols Albania",
                'created_at'     => "2025-05-18 18:49:06",
                'updated_at'     => "2025-05-18 18:49:06",
            ],
            [
                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -7.60,
                'origin'         => "Estanc vilobi onyar",
                'created_at'     => "2025-05-18 18:49:06",
                'updated_at'     => "2025-05-18 18:49:06",
            ],
            // Registro 1
            [
                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -158.30,
                'origin'         => "Transferencia a Roque SL",
                'created_at'     => "2025-05-18 18:49:06",
                'updated_at'     => "2025-05-18 18:49:06",
            ],
            // Registro 2
            [
                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -3,
                'origin'         => "Gelats Ca la Lola Peratallada",
                'created_at'     => "2025-05-18 17:30:06",
                'updated_at'     => "2025-05-18 17:30:06",
            ],
            // Registro 3
            [
                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -20,
                'origin'         => "Charter Palamos",
                'created_at'     => "2025-05-18 14:30:02",
                'updated_at'     => "2025-05-18 14:30:02",
            ],
            // Registro 4
            [
                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -1,
                'origin'         => "Supermercat King's Palamós",
                'created_at'     => "2025-05-17 10:12:39",
                'updated_at'     => "2025-05-17 10:12:39",
            ],
            // Registro 5
            [
                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -23.60,
                'origin'         => "Frankfurter König Girona",
                'created_at'     => "2025-05-16 15:10:06",
                'updated_at'     => "2025-05-16 15:10:06",
            ],
            // Registro 6
            [
                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -6.50,
                'origin'         => "Taradell Padel Club",
                'created_at'     => "2025-05-15 18:49:06",
                'updated_at'     => "2025-05-15 18:49:06",
            ],
            // Registro 7
            [
                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -4.37,
                'origin'         => "Corp Alim Guissona Vilobi Onyar",
                'created_at'     => "2025-05-15 12:49:23",
                'updated_at'     => "2025-05-15 12:49:23",
            ],
            // Registro 8
            [
                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -4.99,
                'origin'         => "Paypal Itunes App",
                'created_at'     => "2025-05-14 18:49:04",
                'updated_at'     => "2025-05-14 18:49:04",
            ],
            // Registro 9
            [
                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -1.99,
                'origin'         => "Paypal Itunes App",
                'created_at'     => "2025-05-14 18:49:04",
                'updated_at'     => "2025-05-14 18:49:04",
             ],
	     [
            // Registro 10

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -4,
                'origin'         => "Corp Alim Guissona Vilobi Onyar",
                'created_at'     => "2025-05-13 12:49:26",
                'updated_at'     => "2025-05-13 12:49:26",
             ],
	     [
            // Registro 11

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -7.60,
                'origin'         => "Daunis Estancia Vilobi Onyar",
                'created_at'     => "2025-05-12 19:29:06",
                'updated_at'     => "2025-05-12 19:29:06",
             ],
	     [
            // Registro 12

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -4,
                'origin'         => "Corp Alim Guissona Vilobi Onyar",
                'created_at'     => "2025-05-12 12:29:06",
                'updated_at'     => "2025-05-12 12:29:06",
             ],
	     [
            // Registro 13

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -2.20,
                'origin'         => "Bar Can Costa Taradell",
                'created_at'     => "2025-05-12 09:37:06",
                'updated_at'     => "2025-05-12 09:37:06",
             ],
	     [
            // Registro 14

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -15.80,
                'origin'         => "Pago Biz Victor Martínez",
                'created_at'     => "2025-05-12 18:49:06",
                'updated_at'     => "2025-05-12 18:49:06",
             ],
	     [
            // Registro 15

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -3.50,
                'origin'         => "Bistro HR Taradell",
                'created_at'     => "2025-05-12 15:49:06",
                'updated_at'     => "2025-05-12 15:49:06",
             ],
	     [
            // Registro 16

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -4,
                'origin'         => "Tulotero Madrid",
                'created_at'     => "2025-05-09 18:49:06",
                'updated_at'     => "2025-05-09 18:49:06",
             ],
	     [
            // Registro 17

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => 350,
                'origin'         => "Ingreso efectivo cajero automatico",
                'created_at'     => "2025-05-18 15:49:06",
                'updated_at'     => "2025-05-18 15:49:06",
             ],
	     [
            // Registro 18

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -6.20,
                'origin'         => "Daunis Estanc Vilobi Onyar",
                'created_at'     => "2025-05-08 19:35:06",
                'updated_at'     => "2025-05-08 19:35:06",
             ],
	     [
            // Registro 19

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -4.02,
                'origin'         => "Corp Alim Guissona Vilobi Onyar",
                'created_at'     => "2025-05-08 12:49:06",
                'updated_at'     => "2025-05-08 12:49:06",
             ],
	     [
            // Registro 20

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -5.98,
                'origin'         => "Paypal Itunes App",
                'created_at'     => "2025-05-08 10:10:06",
                'updated_at'     => "2025-05-08 10:10:06",
             ],
	     [
            // Registro 21

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -10,
                'origin'         => "Bet365",
                'created_at'     => "2025-05-06 18:49:06",
                'updated_at'     => "2025-05-06 18:49:06",
             ],
	     [
            // Registro 22

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -6.23,
                'origin'         => "Corp Alim Guissona Vilobi Onyar",
                'created_at'     => "2025-05-05 14:54:06",
                'updated_at'     => "2025-05-05 14:54:06",
             ],
	     [
            // Registro 23

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -1.20,
                'origin'         => "Taradell Padel Club",
                'created_at'     => "2025-05-05 10:49:06",
                'updated_at'     => "2025-05-05 10:49:06",
             ],
	     [
            // Registro 24

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => 16.20,
                'origin'         => "Bizum Mireia Planas",
                'created_at'     => "2025-05-05 10:09:06",
                'updated_at'     => "2025-05-05 10:09:06",
             ],
	     [
            // Registro 25

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -20,
                'origin'         => "Bet365",
                'created_at'     => "2025-05-05 08:38:06",
                'updated_at'     => "2025-05-05 08:38:06",
             ],
	     [
            // Registro 26

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -27.02,
                'origin'         => "Hipermercat Esclat Malla",
                'created_at'     => "2025-05-04 17:28:06",
                'updated_at'     => "2025-05-04 17:28:06",
             ],
	     [
            // Registro 27

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => 50,
                'origin'         => "Bizum Victor Martínez",
                'created_at'     => "2025-05-04 17:00:06",
                'updated_at'     => "2025-05-04 17:00:06",

             ],
	     [
            // Registro 28

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -27.02,
                'origin'         => "Biz Mireia Planas",
                'created_at'     => "2025-05-04 16:05:06",
                'updated_at'     => "2025-05-04 16:05:06",
             ],
	     [
            // Registro 29

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -49.55,
                'origin'         => "Hipermercat Esclat Malla",
                'created_at'     => "2025-05-02 19:01:06",
                'updated_at'     => "2025-05-02 19:01:06",
             ],
	     [
            // Registro 30

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -3.53,
                'origin'         => "Ferreteria Vivet Taradell",
                'created_at'     => "2025-05-02 18:39:06",
                'updated_at'     => "2025-05-02 18:39:06",
             ],
	     [
            // Registro 31

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -6.50,
                'origin'         =>     "Taradell Padel Club",
                'created_at'     => "2025-05-02 16:49:06",
                'updated_at'     => "2025-05-02 16:49:06",
             ],
	     [
            // Registro 32

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -66.14,
                'origin'         => "Adeudo recibo AJ Taradell",
                'created_at'     => "2025-05-02 13:29:06",
                'updated_at'     => "2025-05-02 13:29:06",
             ],
	     [
            // Registro 33

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => 12.43,
                'origin'         => "Abono Bizum Jordi Franquesa",
                'created_at'     => "2025-05-02 13:00:06",
                'updated_at'     => "2025-05-02 13:00:06",
             ],
	     [
            // Registro 34

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -12.23,
                'origin'         => "Supermercat Bonpreu",
                'created_at'     => "2025-05-02 12:28:06",
                'updated_at'     => "2025-05-02 12:28:06",
             ],
	     [
            // Registro 35

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -4.37,
                'origin'         => "Corp Alim Guissona Vilobi Onyar",
                'created_at'     => "2025-04-30 14:00:06",
                'updated_at'     => "2025-04-30 14:00:06",
             ],
	     [
            // Registro 36

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -6.10,
                'origin'         => "Daunis Estanc Vilobi Onyar",
                'created_at'     => "2025-04-29 17:03:06",
                'updated_at'     => "2025-04-29 17:03:06",
             ],
	     [
            // Registro 37

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -0.75,
                'origin'         => "Comisión Divisa No Euro",
                'created_at'     => "2025-04-29 16:06:06",
                'updated_at'     => "2025-04-29 16:06:06",
             ],
	     [
            // Registro 38

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -21.35,
                'origin'         => "OpenAI ChatGPT",
                'created_at'     => "2025-04-29 14:20:06",
                'updated_at'     => "2025-04-29 14:20:06",
             ],
	     [
            // Registro 39

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -1.50,
                'origin'         => "Corp Alim Guissona Vilobi Onyar",
                'created_at'     => "2025-04-28 17:23:06",
                'updated_at'     => "2025-04-28 17:23:06",
             ],
	     [
            // Registro 40

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -20,
                'origin'         => "Pago Bizum Mireia Planas",
                'created_at'     => "2025-04-28 17:03:06",
                'updated_at'     => "2025-04-28 17:03:06",
             ],
	     [
            // Registro 41

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -10,
                'origin'         => "Bet365",
                'created_at'     => "2025-04-28 14:03:06",
                'updated_at'     => "2025-04-28 14:03:06",
             ],
	     [
            // Registro 42

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -11.10,
                'origin'         => "Alimentación Asif Taradell",
                'created_at'     => "2025-04-28 13:54:06",
                'updated_at'     => "2025-04-28 13:54:06",
             ],
	     [
            // Registro 43

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -2,
                'origin'         => "Taradell Padel Club",
                'created_at'     => "2025-04-28 11:30:06",
                'updated_at'     => "2025-04-28 11:30:06",
             ],
	     [
            // Registro 44

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -3.50,
                'origin'         => "Bistro HR Taradell",
                'created_at'     => "2025-04-28 10:03:06",
                'updated_at'     => "2025-04-28 10:03:06",
             ],
	     [
            // Registro 45

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -10.50,
                'origin'         => "Taradell Padel Club",
                'created_at'     => "2025-04-25 17:03:06",
                'updated_at'     => "2025-04-25 17:03:06",
             ],
	     [
            // Registro 46

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => 1046.28,
                'origin'         => "Transferencia Consultoria Bisual SL",
                'created_at'     => "2025-04-25 15:06:06",
                'updated_at'     => "2025-04-25 15:06:06",
             ],
	     [
            // Registro 47

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -9.14,
                'origin'         => "Corp Alim Vilobi Onyar",
                'created_at'     => "2025-04-24 17:03:06",
                'updated_at'     => "2025-04-24 17:03:06",
             ],
	     [
            // Registro 48

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -7.60,
                'origin'         => "Estanc Taradell",
                'created_at'     => "2025-04-23 17:03:06",
                'updated_at'     => "2025-04-23 17:03:06",
             ],
	     [
            // Registro 49

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -1.50,
                'origin'         => "Corp Alim Vilobi Onyar",
                'created_at'     => "2025-04-22 14:20:06",
                'updated_at'     => "2025-04-22 14:20:06",
             ],
	     [
            // Registro 50

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -18.20,
                'origin'         => "Girona Futbol Club",
                'created_at'     => "2025-04-22 12:45:06",
                'updated_at'     => "2025-04-22 12:45:06",
             ],
	     [
            // Registro 51

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -5,
                'origin'         => "Bet365",
                'created_at'     => "2025-04-22 12:03:06",
                'updated_at'     => "2025-04-22 12:03:06",
             ],
	     [
            // Registro 52

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -10.25,
                'origin'         => "Taradell Padel Club",
                'created_at'     => "2025-04-21 19:03:06",
                'updated_at'     => "2025-04-21 19:03:06",
             ],
	     [
            // Registro 53

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -6.10,
                'origin'         => "Estanc de Taradell",
                'created_at'     => "2025-04-21 17:43:06",
                'updated_at'     => "2025-04-21 17:43:06",
             ],
	     [
            // Registro 54

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -19.48,
                'origin'         => "Parking Massens Barcelona",
                'created_at'     => "2025-04-21 15:46:06",
                'updated_at'     => "2025-04-21 15:46:06",
             ],
	     [
            // Registro 55

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -10.80,
                'origin'         =>     "Mataro Supermercat",
                'created_at'     => "2025-04-21 12:00:06",
                'updated_at'     => "2025-04-21 12:00:06",
             ],
	     [
            // Registro 56

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -7.50,
                'origin'         => "Omnia Cafe Bar",
                'created_at'     => "2025-04-17 21:03:06",
                'updated_at'     => "2025-04-17 21:03:06",
             ],
	     [
            // Registro 57

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -3.88,
                'origin'         => "Corp Alim Guissona Vilobi Onyar",
                'created_at'     => "2025-04-16 17:03:06",
                'updated_at'     => "2025-04-16 17:03:06",
             ],
	     [
            // Registro 58

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => 13.00,
                'origin'         => "Abono Bizum Jordi Franquesa",
                'created_at'     => "2025-04-16 14:03:06",
                'updated_at'     => "2025-04-16 14:03:06",
             ],
	     [
            // Registro 59

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -12.94,
                'origin'         => "Hipermercat Esclat Malla",
                'created_at'     => "2025-04-15 19:39:06",
                'updated_at'     => "2025-04-15 19:39:06",
             ],
	     [
            // Registro 60

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => 99.50,
                'origin'         => "Abono Bizum Victor Martínez",
                'created_at'     => "2025-04-15 17:00:06",
                'updated_at'     => "2025-04-15 17:00:06",
             ],
	     [
            // Registro 61

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -199.00,
                'origin'         => "Girona FC",
                'created_at'     => "2025-04-15 16:44:06",
                'updated_at'     => "2025-04-15 16:44:06",
             ],
	     [
            // Registro 62

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -5.42,
                'origin'         => "Corp Alim Guissona Vilobi Onyar",
                'created_at'     => "2025-04-15 14:27:06",
                'updated_at'     => "2025-04-15 14:27:06",
             ],
	     [
            // Registro 63

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => 47.00,
                'origin'         =>     "Abono Bizum Mireia Planas",
                'created_at'     => "2025-04-14 17:41:06",
                'updated_at'     => "2025-04-14 17:41:06",
             ],
	     [
            // Registro 64

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -3.50,
                'origin'         =>     "Ghiotto Gelateria Platja Aro",
                'created_at'     => "2025-04-14 17:03:06",
                'updated_at'     => "2025-04-14 17:03:06",
             ],
	     [
            // Registro 65

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -21.60,
                'origin'         => "La Tremenda Barber",
                'created_at'     => "2025-04-14 13:03:06",
                'updated_at'     => "2025-04-14 13:03:06",
             ],
	     [
            // Registro 66

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -80.06,
                'origin'         => "Market Sant Antoni",
                'created_at'     => "2025-04-11 19:03:06",
                'updated_at'     => "2025-04-11 19:03:06",
             ],
	     [
            // Registro 67

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -4.00,
                'origin'         => "Corp Alim Guissona Vilobi Onyar ",
                'created_at'     => "2025-04-11 16:03:06",
                'updated_at'     => "2025-04-11 16:03:06",
             ],
	     [
            // Registro 68

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -10.95,
                'origin'         => "Misako Shop",
                'created_at'     => "2025-04-11 15:34:06",
                'updated_at'     => "2025-04-11 15:34:06",
             ],
	     [
            // Registro 69

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -18.50,
                'origin'         => "De la Mur",
                'created_at'     => "2025-04-11 15:03:06",
                'updated_at'     => "2025-04-11 15:03:06",
             ],
	     [
            // Registro 70

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -15,
                'origin'         => "Peluquería Sole Taradell",
                'created_at'     => "2025-04-10 17:03:06",
                'updated_at'     => "2025-04-10 17:03:06",
             ],
	     [
            // Registro 71

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -1.40,
                'origin'         => "Corp Alim Guissona Vilobi Onyar",
                'created_at'     => "2025-04-10 16:20:06",
                'updated_at'     => "2025-04-10 16:20:06",
             ],
	     [
            // Registro 72

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -17.76,
                'origin'         => "Bon Preu SAU Taradell",
                'created_at'     => "2025-04-09 18:56:06",
                'updated_at'     => "2025-04-09 18:56:06",
             ],
	     [
            // Registro 73

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -14.78,
                'origin'         => "Paypal Itunes Apple",
                'created_at'     => "2025-04-09 17:03:06",
                'updated_at'     => "2025-04-09 17:03:06",
             ],
	     [
            // Registro 74

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -2.20,
                'origin'         => "La Llima Santa Eugenia",
                'created_at'     => "2025-04-09 16:50:06",
                'updated_at'     => "2025-04-09 16:50:06",
             ],
	     [
            // Registro 75

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -6.50,
                'origin'         => "Estanc Can Catala Santa Eugenia",
                'created_at'     => "2025-04-08 17:03:06",
                'updated_at'     => "2025-04-08 17:03:06",
             ],
	     [
            // Registro 76

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -5.81,
                'origin'         =>     "Corp Alim Guissona Vilobi Onyar",
                'created_at'     => "2025-04-08 16:34:06",
                'updated_at'     => "2025-04-08 16:34:06",
             ],
	     [
            // Registro 77

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -20,
                'origin'         => "Pago Bizum Mireia Planas",
                'created_at'     => "2025-04-07 22:34:06",
                'updated_at'     => "2025-04-07 22:34:06",
             ],
	     [
            // Registro 78

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -21.87,
                'origin'         => "KFC Mataro Park",
                'created_at'     => "2025-04-07 21:34:06",
                'updated_at'     => "2025-04-07 21:34:06",
             ],
	     [
            // Registro 78

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -7.45,
                'origin'         => "Estancia de Taradell",
                'created_at'     => "2025-04-07 16:34:06",
                'updated_at'     => "2025-04-07 16:34:06",
             ],
	     [
            // Registro 79

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -23.85,
                'origin'         => "Hipermercat Esclat Malla",
                'created_at'     => "2025-04-02 16:34:06",
                'updated_at'     => "2025-04-02 16:34:06",
             ],
	     [
            // Registro 80

                'user_id'        => 1,
                'account_id'     => 1,
                'amount'         => -11.50,
                'origin'         => "Taradell Padel Club",
                'created_at'     => "2025-04-02 11:34:06",
                'updated_at'     => "2025-04-02 11:34:06",

         ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
