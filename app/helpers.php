<?php

        function expired($myPlace)
        {
            $duration = $myPlace->pivot->duration;
            $now = date("Y-m-d");
            $start = date("Y-m-d", strtotime($myPlace->pivot->date));
            $end = date("Y-m-d", strtotime($start." +".$duration." days"));
            $remaining_days = (strtotime($end) - strtotime($now)) / 86400;

            return [
                'end' => $end,
                'remaining_days' => $remaining_days,
            ];
        }
