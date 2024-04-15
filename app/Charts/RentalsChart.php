<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class RentalsChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->options([
            'id' => 'tes',
            'responsive' => true,
            'title'   => [
                'text' => 'الإيجار',
                'display' => true,
            ],
            'legend'  => [
                'position' => 'bottom',
            ]
        ]);
    }
}
