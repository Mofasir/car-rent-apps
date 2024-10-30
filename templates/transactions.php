<?php
function renderTransactions($transactions) {
    ?>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 bg-blue-600 text-white py-3 px-4 text-center align-middle" rowspan="2">No</th>
                    <th class="border border-gray-300 bg-blue-600 text-white py-3 px-4 text-center align-middle" rowspan="2">Nama Penyewa</th>
                    <th class="border border-gray-300 bg-blue-600 text-white py-3 px-4 text-center align-middle" rowspan="2">Nama Mobil</th>
                    <th class="border border-gray-300 bg-blue-600 text-white py-3 px-4 text-center align-middle" rowspan="2">Program</th>
                    <th class="border border-gray-300 bg-blue-600 text-white py-3 px-4 text-center align-middle" rowspan="2">Biaya</th>
                    <th class="border border-gray-300 bg-blue-600 text-white py-3 px-4 text-center align-middle" rowspan="2">Lama Sewa (Hari)</th>
                    <th class="border border-gray-300 bg-blue-600 text-white py-3 px-4 text-center" colspan="5">Biaya Rental</th>
                    <th class="border border-gray-300 bg-blue-600 text-white py-3 px-4 text-center align-middle" rowspan="2">Total Biaya</th>
                </tr>
                <tr>
                    <th class="border border-gray-300 bg-blue-500 text-white py-3 px-4 text-center">Paket 1 (10%)</th>
                    <th class="border border-gray-300 bg-blue-500 text-white py-3 px-4 text-center">Paket 2 (20%)</th>
                    <th class="border border-gray-300 bg-blue-500 text-white py-3 px-4 text-center">Paket 3 (25%)</th>
                    <th class="border border-gray-300 bg-blue-500 text-white py-3 px-4 text-center">Harian</th>
                    <th class="border border-gray-300 bg-blue-500 text-white py-3 px-4 text-center">Extra/Hour</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($transactions)): ?>
                    <tr>
                        <td colspan="12" class="border border-gray-300 py-4 px-4 text-center text-gray-500">
                            Belum ada data transaksi
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($transactions as $index => $transaction): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 py-3 px-4 text-center"><?php echo $index + 1; ?></td>
                            <td class="border border-gray-300 py-3 px-4"><?php echo $transaction['nama_penyewa']; ?></td>
                            <td class="border border-gray-300 py-3 px-4"><?php echo $transaction['nama_mobil']; ?></td>
                            <td class="border border-gray-300 py-3 px-4"><?php echo $transaction['program']; ?></td>
                            <td class="border border-gray-300 py-3 px-4 text-right"><?php echo formatRupiah($transaction['biaya']); ?></td>
                            <td class="border border-gray-300 py-3 px-4 text-center"><?php echo $transaction['lama_sewa']; ?></td>
                            <td class="border border-gray-300 py-3 px-4 text-right"><?php echo formatRupiah($transaction['biaya_paket1']); ?></td>
                            <td class="border border-gray-300 py-3 px-4 text-right"><?php echo formatRupiah($transaction['biaya_paket2']); ?></td>
                            <td class="border border-gray-300 py-3 px-4 text-right"><?php echo formatRupiah($transaction['biaya_paket3']); ?></td>
                            <td class="border border-gray-300 py-3 px-4 text-right"><?php echo formatRupiah($transaction['biaya_harian']); ?></td>
                            <td class="border border-gray-300 py-3 px-4 text-right"><?php echo formatRupiah($transaction['biaya_extra']); ?></td>
                            <td class="border border-gray-300 py-3 px-4 text-right font-bold"><?php echo formatRupiah($transaction['total_biaya']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}
