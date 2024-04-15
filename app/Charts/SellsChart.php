<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class SellsChart extends Chart
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
            'responsive' => true,
            'title'   => [
                'text' => 'المبيعات',
                'display' => true,
            ],
            'legend'  => [
                'position' => 'bottom',
            ],
        ]);
    }
}
