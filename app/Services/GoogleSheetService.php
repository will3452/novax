<?php

namespace App\Services;

use Google\Client;
use Google\Service\Sheets;
use Illuminate\Support\Facades\Cache;

class GoogleSheetService
{
    protected Sheets $service;
    protected string $spreadsheetId;

    public function __construct()
    {
        $client = new Client();
        $client->setAuthConfig(storage_path("app/google/service-account.json"));
        $client->addScope(Sheets::SPREADSHEETS);

        $this->service = new Sheets($client);
        $this->spreadsheetId = config("services.google_sheet_id");
    }

    public function getRows(string $range)
    {
        return $this->service->spreadsheets_values
            ->get($this->spreadsheetId, $range)
            ->getValues();
    }

    public function updateRow(string $range, array $values)
    {
        $body = new Sheets\ValueRange([
            "values" => [$values],
        ]);

        return $this->service->spreadsheets_values->update(
            $this->spreadsheetId,
            $range,
            $body,
            ["valueInputOption" => "RAW"],
        );
    }

    public function getAllBundleRarities(): array
{
    return Cache::remember('bundle_rarity_sheet', 300, function () {

        $spreadsheetId = config('services.google_bundle_sheet_id');
        $range = 'Sheet1!A2:C100';

        $rows = $this->service->spreadsheets_values
            ->get($spreadsheetId, $range)
            ->getValues();

        $result = [];

        if ($rows) {
            foreach ($rows as $row) {
                if (isset($row[1])) {
                    $productName = trim($row[1]);
                    $rarity = $row[2] ?? null;
                    $result[$productName] = $rarity;
                }
            }
        }

        return $result;
    });
}

public function parseCurrency(string $value): int
{
    $clean = preg_replace("/[^\d.]/", "", $value);
    return (int) floatval($clean);
}

public function syncSingleProduct($product)
{
    $range = 'Sheet1!A2:K1000'; // A to K = 11 columns
    $rows = $this->getRows($range);

    if (!$rows) {
        return;
    }

    foreach ($rows as $row) {

        $pid = $row[0] ?? null;

        if ($pid == $product->sheet_id) {

            $product->update([
                'name'           => $row[2] ?? $product->name,
                'image'          => $row[1] ?? $product->image,
                'card_set_category' => $row[4] ?? $product->card_set_category,
                'search_keyword' => $row[5] ?? $product->search_keyword,
                'rarity' => $row[6] ?? null,
                'price' => isset($row[10]) ? $this->parseCurrency($row[10]) : $product->price,
            ]);

            break;
        }
    }
}
}