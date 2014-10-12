<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
|--------------------------------------------------------------------------
| Menu
|--------------------------------------------------------------------------
|
*/

define('M_ADMIN',							1);
	define('M_DASHBOARD',						2);
	define('M_CABANG',							10);
		define('M_CABANG_ADD',						11);
		define('M_CABANG_EDIT',						12);
		define('M_CABANG_DELETE',					13);
	define('M_KONFIGURASI',						20);
		define('M_KONFIGURASI_EDIT',				21);
	define('M_ROLE',							30);
		define('M_ROLE_ADD',						31);
		define('M_ROLE_EDIT',						32);
		define('M_ROLE_DELETE',						33);
	define('M_USER',							35);
		define('M_USER_ADMIN',						36);
			define('M_USER_ADMIN_ADD',						37);
			define('M_USER_ADMIN_EDIT',						38);
			define('M_USER_ADMIN_DELETE',					39);
		define('M_USER_KASIR',						40);
			define('M_USER_KASIR_ADD',						41);
			define('M_USER_KASIR_EDIT',						42);
			define('M_USER_KASIR_DELETE',					43);
		define('M_USER_MEKANIK',					44);
			define('M_USER_MEKANIK_ADD',					45);
			define('M_USER_MEKANIK_EDIT',					46);
			define('M_USER_MEKANIK_DELETE',					47);
	define('M_MASTER_DATA',						50);
		define('M_MASTER_DATA_KOLEGA',				51);
			define('M_MASTER_DATA_KOLEGA_ADD',			52);
			define('M_MASTER_DATA_KOLEGA_EDIT',			53);
			define('M_MASTER_DATA_KOLEGA_DELETE',		54);
		define('M_MASTER_DATA_SUPPLIER',			61);
			define('M_MASTER_DATA_SUPPLIER_ADD',		62);
			define('M_MASTER_DATA_SUPPLIER_EDIT',		63);
			define('M_MASTER_DATA_SUPPLIER_DELETE',		64);
		define('M_MASTER_DATA_LOKASI_BARANG',		81);
			define('M_MASTER_DATA_LOKASI_BARANG_ADD',	82);
			define('M_MASTER_DATA_LOKASI_BARANG_EDIT',	83);
			define('M_MASTER_DATA_LOKASI_BARANG_DELETE',84);
		define('M_MASTER_DATA_SATUAN',				91);
			define('M_MASTER_DATA_SATUAN_ADD',			92);
			define('M_MASTER_DATA_SATUAN_EDIT',			93);
			define('M_MASTER_DATA_SATUAN_DELETE',		94);
		define('M_MASTER_DATA_GOLONGAN',			101);
			define('M_MASTER_DATA_GOLONGAN_ADD',		102);
			define('M_MASTER_DATA_GOLONGAN_EDIT',		103);
			define('M_MASTER_DATA_GOLONGAN_DELETE',		104);
		define('M_MASTER_DATA_TEMPLATE',			115);
			define('M_MASTER_DATA_TEMPLATE_ADD',		116);
			define('M_MASTER_DATA_TEMPLATE_EDIT',		117);
			define('M_MASTER_DATA_TEMPLATE_DELETE',		118);
		define('M_MASTER_DATA_FINGERPRINT',			121);
			define('M_MASTER_DATA_FINGERPRINT_ADD',		122);
			define('M_MASTER_DATA_FINGERPRINT_EDIT',	123);
			define('M_MASTER_DATA_FINGERPRINT_DELETE',	124);
		define('M_MASTER_DATA_PAID_CARD',			125);
			define('M_MASTER_DATA_PAID_CARD_ADD',		126);
			define('M_MASTER_DATA_PAID_CARD_EDIT',		127);
			define('M_MASTER_DATA_PAID_CARD_DELETE',	128);
	define('M_ABSENSI',								130);
	define('M_REPORT_A',							140);
		define('M_REPORT_A_ABSENSI',					141);
		define('M_REPORT_A_RIWAYAT_KENDARAAN',			142);
		define('M_REPORT_A_RIWAYAT_KENDARAAN_DETAIL',	143);
		define('M_REPORT_A_SERVICE',					144);
		define('M_REPORT_A_SERVICE_DETAIL',				145);
		define('M_REPORT_A_PENJUALAN',					146);
		define('M_REPORT_A_PENJUALAN_DETAIL',			147);
		define('M_REPORT_A_MEKANIK',					148);
		define('M_REPORT_A_MEKANIK_DETAIL',				149);
define('M_KASIR',							201);
	define('M_LIST_TRANSAKSI',					210);
	define('M_PENDAFTARAN',						220);
	define('M_COMPLAINT',						230);
	define('M_SERVICE',							240);
	define('M_PENJUALAN',						250);
		define('M_PENJUALAN_JUAL',					251);
		define('M_PENJUALAN_LIST',					252);
	define('M_DATA_CUSTOMER',					260);
		define('M_DATA_CUSTOMER_ADD_EDIT',			261);
		define('M_DATA_CUSTOMER_LIST',				262);
	define('M_STOCK',							270);
		define('M_STOCK_LIST',						271);
		define('M_STOCK_ADD',						272);
		define('M_STOCK_UPLOAD',					273);
		define('M_STOCK_ADJUSTMENT',				274);
		define('M_STOCK_SEND_KOLEGA',				275);
		define('M_STOCK_RETRIEVE_KOLEGA',			276);
		define('M_STOCK_PO',						277);
		define('M_STOCK_DO',						278);
	define('M_PCO',								280);
	define('M_SERVICE_KARYAWAN',				290);
	define('M_REPORT_K',						300);
		define('M_REPORT_K_RIWAYAT_KENDARAAN',		301);
		define('M_REPORT_K_RIWAYAT_KENDARAAN_DETAIL',302);
		define('M_REPORT_K_SERVICE',				303);
		define('M_REPORT_K_SERVICE_DETAIL',			304);
		define('M_REPORT_K_PENJUALAN',				305);
		define('M_REPORT_K_PENJUALAN_DETAIL',		306);
		define('M_REPORT_K_MEKANIK',				307);

/*
|--------------------------------------------------------------------------
| TIPE PERUSAHAAN
|--------------------------------------------------------------------------
|
*/

define('PUSAT',				1);
define('CABANG',			2);
define('KOLEGA',			3);

/*
|--------------------------------------------------------------------------
| TIPE User 
|--------------------------------------------------------------------------
|
*/

define('ADMIN',				1);
define('KASIR',				2);
define('MEKANIK',			3);

/* End of file constants.php */
/* Location: ./application/config/constants.php */
