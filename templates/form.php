<?php
/**
 * Template untuk form input rental
 * 
 * Functions:
 * - renderForm(): Menampilkan form input dengan fields:
 *   - Nama Penyewa
 *   - Pilihan Mobil
 *   - Program Rental
 *   - Lama Sewa
 *   - Jam Tambahan
 */

function renderForm($carPrices) {
    ?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="space-y-4">
        <div>
            <label class="block mb-2">Nama Penyewa:</label>
            <input type="text" name="nama_penyewa" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block mb-2">Pilih Mobil:</label>
            <select name="mobil" class="w-full border rounded p-2" required>
                <option value="" selected disabled>--- pilih mobil ---</option>
                <?php foreach($carPrices as $car => $price): ?>
                    <option value="<?php echo $car; ?>">
                        <?php echo $car . " - " . formatRupiah($price); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label class="block mb-2">Program Rental:</label>
            <select name="program" class="w-full border rounded p-2" required>
                <option value="" selected disabled>--- pilih program ---</option>
                <option value="Paket 1">Paket 1 (4 Hari) - Diskon 10%</option>
                <option value="Paket 2">Paket 2 (7 Hari) - Diskon 20%</option>
                <option value="Paket 3">Paket 3 (10 Hari) - Diskon 25%</option>
                <option value="Harian">Non Paket / Harian</option>
            </select>
        </div>

        <div>
            <label class="block mb-2">Lama Sewa (Hari):</label>
            <input type="number" name="lama_sewa" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block mb-2">Jam Tambahan:</label>
            <input type="number" name="extra_hours" class="w-full border rounded p-2" value="0">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Hitung Biaya
        </button>
    </form>
    <?php
}
