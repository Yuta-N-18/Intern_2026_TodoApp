<?php

/**
 * 課題：お買い物合計マシーンを作ろう
 * * 以下の関数 calculateTotal を完成させてください。
 * * 【期待する出力例】
 * --- カートA ---
 * 合計金額: 3500円
 * 税込合計(10%): 3850円
 * * --- カートB ---
 * 【送料無料対象です！】
 * 合計金額: 6500円
 * 税込合計(10%): 7150円
 */
function calculateTotal($prices) {
    // 1. 合計金額を保持する変数（$sumなど）を 0 で初期化してください
    $total_price = 0;

    // 2. [繰り返し] foreach を使い、$prices の中身をすべて足し合わせてください
    foreach ($prices as $price){
        $total_price += $price;
    }

    // 3. [条件分岐] 合計が 5000 以上の時、以下のメッセージを出力してください
    // 「【送料無料対象です！】」
    if($total_price >= 5000){
        echo "【送料無料対象です！】\n";
    }

    // 4. [順次] 合計金額を表示してください
    // 表示形式：「合計金額: 〇〇円」
    echo "合計金額: {$total_price}円\n";

    // 5. [順次] 合計に 1.1 を掛けた「税込金額」を表示してください
    // 表示形式：「税込合計(10%): 〇〇円」
    $total_price_tax_included = $total_price * 1.1;
    echo "税込合計(10%): {$total_price_tax_included}円\n";
}

// --- 動作確認用（書き換えないでください） ---

echo "--- カートA ---\n";
calculateTotal([1000, 500, 2000]); 

echo "\n--- カートB ---\n";
calculateTotal([3000, 2500, 1000]);