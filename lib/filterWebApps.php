<?php

function filterWebApps($tasks)
{
     return array_values(
         array_filter(
            $tasks,
            function ($task) {
                $path = array_values(array_filter(preg_split("#/#", $task["appId"])));

                switch (true) {
                    case !isset($path[1]):
                    case $path[1] != "web":
                        return false;

                    default:
                        return true;
                }
            }
        )
    );
}
