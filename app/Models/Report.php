<?php namespace App\Models;

use App\Models\Enums\SaleStat;
use Carbon\Carbon;
use Eloquent, DB, Validator, Input;

class Report extends Eloquent
{
  public function getSales($from_date, $to_date) {
    $to_date = Carbon::createFromFormat('d-m-Y', $to_date);
    $to_date->addDay(1);

    $s = "SELECT date(sale_on) as sale_on, sum(nett_total) as nett_total, sum(gross_total) as gross_total,
    sum(promo_discount) as promo_discount, sum(product_discount) as product_discount from sale
    where sale_on >= :from_date and sale_on < :to_date
    and stat in ('".SaleStat::Paid."', '".SaleStat::Delivered."') 
    group by date(sale_on)";
    $p['from_date'] = $from_date;
    $p['to_date'] = $to_date;

    $data = DB::select($s, $p);
    return $data;
  }
}