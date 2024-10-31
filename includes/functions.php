<?php
/**
 * File berisi fungsi-fungsi helper
 * 
 * Functions:
 * - formatRupiah(): Memformat angka ke format mata uang Rupiah
 * - renderResult(): Menampilkan hasil perhitungan rental
 */

function formatRupiah($amount) {
    return "Rp. " . number_format($amount, 0, ',', '.');
}

function renderResult($result) {
    $html = "<div class='mt-6 p-4 bg-gray-50 rounded'>";
    $html .= "<h2 class='text-xl font-bold mb-4'>Hasil Perhitungan</h2>";
    $html .= "<p>Total Biaya Dasar: " . formatRupiah($result['base_cost']) . "</p>";
    $html .= "<p>Diskon: " . ($result['discount'] * 100) . "%</p>";
    $html .= "<p>Biaya Tambahan: " . formatRupiah($result['extra_cost']) . "</p>";
    $html .= "<p class='font-bold'>Total Biaya: " . formatRupiah($result['total_cost']) . "</p>";
    $html .= "</div>";
    return $html;
}
