<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kategori;
use App\Models\SubKategori;
use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        // Kategori::factory(3)->create();
        // SubKategori::factory(10)->create();
        // Supplier::factory(3)->create();
        DB::statement("
            INSERT INTO `brands` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
            (1, 'Mustika', 'brand-mustika', 0, '2023-11-06 21:28:29', '2023-11-06 21:28:29'),
            (2, 'Gorden', 'brand-gorden', 0, '2023-11-06 21:28:45', '2023-11-06 21:28:45'),
            (3, 'lifebuoy', 'brand-lifebuoy', 0, '2023-11-16 04:30:55', '2023-11-16 04:31:02');                
        ");
        DB::statement("    
            INSERT INTO `kategoris` (`id`, `name`, `slug`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
            (15, 'Lemari', 'lemari', 'ini lemari', NULL, 0, '2023-11-02 01:17:06', '2023-11-02 01:17:06'),
            (16, 'Pakaian', 'pakaian', 'ini pakaian', NULL, 0, '2023-11-02 01:17:28', '2023-11-02 01:17:28'),
            (17, 'Pecah Belah', 'pecah-belah', 'barang barang yang mudah pecah', NULL, 0, '2023-11-02 01:17:57', '2023-11-02 01:17:57'),
            (18, 'Dekorasi Rumah', 'dekorasi-rumah', 'ini gorden', NULL, 0, '2023-11-02 01:31:14', '2023-11-02 01:34:33');
        ");
        DB::statement("
            INSERT INTO `sub_kategoris` (`id`, `id_kategori`, `name`, `slug`, `description`, `status`, `created_at`, `updated_at`) VALUES
            (43, 15, 'Satu Pintu', 'lemari-satu-pintu', 'sub kategori untuk lemari satu pintu', 0, '2023-11-02 01:26:57', '2023-11-02 01:27:55'),
            (44, 15, 'Dua Pintu', 'lemari-dua-pintu', 'sub kategori untuk lemari dua pintu', 0, '2023-11-02 01:27:31', '2023-11-02 01:27:31'),
            (45, 17, 'Gelas', 'pecah-belah-gelas', 'sub kategori untuk gelas', 0, '2023-11-02 01:28:23', '2023-11-02 01:28:23'),
            (46, 17, 'Piring', 'pecah-belah-piring', 'sub kategori untuk piring', 0, '2023-11-02 01:28:53', '2023-11-02 01:28:53'),
            (47, 16, 'Baju Pria', 'pakaian-baju-pria', 'sub kategori untuk pakaian', 0, '2023-11-02 01:29:28', '2023-11-02 01:29:28'),
            (48, 18, 'Gorden', 'sub-gorden', 'ini subkategori gorden', 0, '2023-11-02 01:35:15', '2023-11-02 01:35:15'),
            (49, 18, 'Taplak Meja', 'taplak-meja', 'ini taplak meja', 0, '2023-11-02 18:34:18', '2023-11-02 18:34:18');
        ");
        DB::statement("
            INSERT INTO `suppliers` (`id`, `name`, `email`, `no_telp`, `alamat`, `created_at`, `updated_at`) VALUES
            (1, 'Pietro Doyle', 'smurray@gmail.com', '1-920-822-4574', '3832 Koss Terrace Apt. 420\nLysanneborough, MN 38368', '2023-11-06 21:30:04', '2023-11-06 21:30:04'),
            (2, 'Zachery Nikolaus', 'ebradtke@hotmail.com', '480.250.4184', '1456 Nader Summit\nEast Murphy, NJ 50994', '2023-11-06 21:30:04', '2023-11-06 21:30:04'),
            (3, 'Alycia Jacobs I', 'bernier.vaughn@powlowski.biz', '+1 (854) 620-1269', '9637 Kiera Track\nElizabethport, OH 88978', '2023-11-06 21:30:04', '2023-11-06 21:30:04');
        ");
        DB::statement("
            INSERT INTO `products` (`id`, `id_kategori`, `id_sub_kategori`, `id_brand`, `name`, `slug`, `harga_beli`, `harga_jual`, `jumlah`, `trending`, `status`, `created_at`, `updated_at`, `deskripsi`) VALUES
            (1, 18, 48, 2, 'Gorden Amanda hijau', 'gorden-amanda-hijau', 188000, 200000, 8, 0, 0, '2023-11-07 05:38:37', '2023-11-07 19:37:33', 'ini gorden amanda hijau'),
            (2, 18, 48, 1, 'Gorden pinto', 'gorden-pinto', 180000, 185000, 25, 0, 0, '2023-11-07 05:42:41', '2023-11-07 19:36:47', 'ini gorden pinto'),
            (3, 18, 49, 1, 'Taplak Meja', 'taplak-meja', 80000, 100000, 161, 0, 0, '2023-11-07 05:46:42', '2023-11-07 19:36:25', 'ini taplak meja'),
            (4, 17, 46, 1, 'Piring antik', 'piring-antik', 188888, 777777, 353, 0, 0, '2023-11-15 16:11:41', '2023-11-15 16:11:41', 'ini piring antik');
        ");
        DB::statement("
            INSERT INTO `produk_suppliers` (`id`, `id_supplier`, `id_produk`, `created_at`, `updated_at`) VALUES
            (2, 3, 2, NULL, NULL),
            (3, 3, 3, NULL, NULL),
            (4, 3, 1, NULL, NULL),
            (5, 2, 4, NULL, NULL);
        ");
        DB::statement("
            INSERT INTO `gambar_produks` (`id`, `id_produk`, `image`, `created_at`, `updated_at`) VALUES
            (1, 1, 'uploads/produk/1699360717-654a2fcd72a62.jpg', '2023-11-07 05:38:37', '2023-11-07 05:38:37'),
            (2, 2, 'uploads/produk/1699361130-654a316ab13ed.jpg', '2023-11-07 05:45:30', '2023-11-07 05:45:30'),
            (3, 4, 'uploads/produk/1700064701-6554edbd54079.jpg', '2023-11-15 16:11:41', '2023-11-15 16:11:41');
        ");

        DB::statement("
            INSERT INTO `users` (`id`, `name`, `photo_profile`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role_as`) VALUES
            (1, 'admin', 'user-1.jpg', 'admin@example.com', NULL, '\$2y\$10\$qTc3.DpwH.dltLoZeTYAqu.Ipfug60X0Eje4Ie4es1xBT2FKeQKQy', NULL, '2023-10-28 17:42:57', '2023-10-28 17:42:57', 1),
            (2, 'radenk', 'user-1.jpg', 'radenk@example.com', NULL, '\$2y\$10\$nG1H.PqOIIcS5vu0wLnOseNq4RRtL37m.BWJS.y6PZAC0zHXuitlu', NULL, '2023-10-30 20:04:31', '2023-11-22 05:31:06', 2),
            (3, 'asdf', 'user-1.jpg', 'asdf@asdf', NULL, '\$2y\$10\$TJv5xHcPQ3sQT4.wfohrOO45KFL8.wFWXCypZzx2.g9bwPvOcKBei', NULL, '2023-10-30 20:07:17', '2023-10-30 20:07:17', 0),
            (4, 'asdf', 'user-1.jpg', 'fdas@fdas', NULL, '\$2y\$10\$99rfqjOsCRLEzjSnmietZuDjJsVbsFgGQfLd7bEmI0P.ZEJUanug.', NULL, '2023-10-30 20:08:10', '2023-10-30 20:08:10', 0),
            (5, 'fasd', 'user-1.jpg', 'fasd@asdf', NULL, '\$2y\$10\$d76XJ0KDmTI7QCnsmLhqte0DTD16HY/vNDcTINLPn3qTaXiGiqsyy', NULL, '2023-10-30 20:08:40', '2023-10-30 20:08:40', 0),
            (7, 'asdf@adf', 'user-1.jpg', 'asdf@adf', NULL, '\$2y\$10\$xqZhbnU2hTYXuw7x/8z.TeTvKZbw/8wHkrhcD7ztZFL60whBbD5jy', NULL, '2023-10-31 19:19:53', '2023-10-31 19:19:53', 0),
            (8, 'usertest', 'user-1.jpg', 'usertest@gmail.com', NULL, '\$2y\$10\$NhEuFzmyZ.twTKwKGqYtFeSyEDUXdT0FsdWvPgRfJ/VjbvwFMBD4q', NULL, '2023-11-07 20:04:32', '2023-11-07 20:04:32', 0),
            (9, 'testuser', 'user-1.jpg', 'testuser@gmail.com', NULL, '\$2y\$10\$oXzB4DQJftah/njpXg2zTOteQcwOpoMxliFqdoAF7ZS5WuJM/65Bu', NULL, '2023-11-07 20:06:05', '2023-11-07 20:06:05', 2),
            (10, 'initesbuatuser', 'user-1.jpg', 'tesaja@example.com', NULL, '\$2y\$10\$PCVaGHeLTABNzlCcgBAsF.mw/TnuByYh9TyE0EmtRV25SmrV2GnRa', NULL, '2023-11-22 02:39:34', '2023-11-22 02:39:34', 2);
        ");
        DB::statement("
            INSERT INTO `sliders` (`id`, `title`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
            (1, 'Belanja Cepat Gak Perlu Ribet', 'dsaghjfadf', 'uploads/slider/1699360013-654a2d0d763d2.jpg', 0, '2023-11-07 05:26:53', '2023-11-07 05:26:53'),
            (2, 'Klik, Bayar, dan Terima? Emang boleh semudah itu', '.', 'uploads/slider/1699360179-654a2db37344e.jpg', 0, '2023-11-07 05:29:39', '2023-11-07 05:29:39');        
        ");
        DB::statement("
            INSERT INTO `pemesanan_produks` (`id`, `id_produk`, `id_supplier`, `status`, `jumlah_stok_sekarang`, `jumlah_beli_stok`, `total_harga_pesan`, `created_at`, `updated_at`) VALUES
            (17, 4, 2, 'batal', 359, 90, 16999920, '2023-11-30 08:18:57', '2023-11-30 09:40:33'),
            (18, 3, 3, 'sudah restock', 82, 50, 4000000, '2023-11-30 08:18:59', '2023-11-30 08:39:34'),
            (19, 3, 3, 'sudah restock', 182, 100, 8000000, '2023-11-30 08:45:12', '2023-11-30 08:46:49'),
            (20, 2, 3, 'batal', 50, 10, 1800000, '2023-11-30 08:45:19', '2023-11-30 09:51:26'),
            (21, 4, 2, 'belum di pesan', 359, NULL, 0, '2023-12-01 01:28:55', '2023-12-01 01:28:55'),
            (23, 4, 2, 'belum di pesan', 359, NULL, 0, '2023-12-01 01:32:16', '2023-12-01 01:32:16'),
            (24, 1, 3, 'telah di pesan', 8, 50, 9400000, '2023-12-01 05:26:43', '2023-12-04 08:34:26');
        ");
    }
}
