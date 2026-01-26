<?php

namespace App\Services;
use Google\Client;
use Google\Service\Sheets;

class GoogleSheetService
{
    protected Sheets $service;

    public function __construct()
    {
        $client = new Client();
        $client->setAuthConfig(storage_path("app/google/service-account.json"));
        $client->addScope(Sheets::SPREADSHEETS);

        $this->service = new Sheets($client);
    }

    public function getRows(string $range)
    {
        return $this->service->spreadsheets_values
            ->get(env("GOOGLE_SHEET_ID"), $range)
            ->getValues();
    }

    public function updateRow(string $range, array $values)
    {
        $body = new Sheets\ValueRange([
            "values" => [$values],
        ]);

        return $this->service->spreadsheets_values->update(
            env("GOOGLE_SHEET_ID"),
            $range,
            $body,
            ["valueInputOption" => "RAW"],
        );
    }
}
