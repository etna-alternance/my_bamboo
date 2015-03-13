<?php

function remapApps($apps)
{
    $reindexed_apps = [];

    foreach ($apps as $app) {
        list(, $app_name) = preg_split("#/#", $app["appId"]);

        switch (true) {
            case strpos($app_name, "."):
                $domains = [$app_name];
                break;

            default:
                $domains = [
                    "{$app_name}.etna-alternance.net",
                    "{$app_name}.etna.io",
                ];
                break;
        }

        foreach ($domains as $domain) {
            if (!isset($reindexed_apps[$domain])) {
                $reindexed_apps[$domain] = [
                    "fqdn"     => $domain,
                    "domain"   => preg_replace("#^[^.]+.#", "", $domain),
                    "backends" => [],
                ];
            }

            $reindexed_apps[$domain]["backends"][] = "{$app["host"]}:{$app["ports"][0]}";
        }
    }

    return $reindexed_apps;
}
