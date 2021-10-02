<?php
require 'simple_html_dom.php';

if($_SERVER['REQUEST_METHOD'] == 'GET')
{

  $name = $_GET['name'];
  $html = file_get_html("https://www.coingecko.com/en/coins/". $name, false);

  foreach($html->find('body') as $crypto) {
      $item['crypto'] = $crypto->find('h1[class=mr-md-3 tw-pl-2 md:tw-mb-0 tw-text-xl tw-font-bold tw-mb-0]', 0)->plaintext; $item['crypto'] = trim($item['crypto'], " ");
      $item['price'] = $crypto->find('span[class=no-wrap]', 0)->plaintext;
      $item['in_btc'] = $crypto->find('div[class=tw-mb-0.5]', 0)->plaintext; $item['in_btc'] = substr($item['in_btc'], 0, strpos($item['in_btc'], "BTC")) . "BTC"; $item['in_btc'] = trim($item['in_btc'], " "); 
      $item['1h'] = $crypto->find('div[class=tw-flex tw-flex-row text-center] div[class=tw-flex-1 py-2 border px-0 tw-rounded-md tw-rounded-t-none tw-rounded-r-none]', 0)->plaintext; $item['1h'] = trim($item['1h'], " ");
      $item['24h'] = $crypto->find('span[class=live-percent-change tw-ml-2 tw-text-xl]', 0)->plaintext; $item['24h'] = trim($item['24h'], " ");
      $item['7day'] = $crypto->find('div[class=tw-flex-1 py-2 border px-0]', 1)->plaintext; $item['7day'] = trim($item['7day'], " ");
      $item['14day'] = $crypto->find('div[class=tw-flex-1 py-2 border px-0]', 2)->plaintext; $item['14day'] = trim($item['14day'], " ");
      $item['30day'] = $crypto->find('div[class=tw-flex-1 py-2 border px-0]', 3)->plaintext; $item['30day'] = trim($item['30day'], " ");
      $item['1year'] = $crypto->find('div[class=tw-flex tw-flex-row text-center] div[class=tw-flex-1 py-2 border px-0 tw-rounded-md tw-rounded-t-none tw-rounded-l-none]', 0)->plaintext; $item['1year'] = trim($item['1year'], " ");
      $item['rank'] = $crypto->find('div[class=tw-inline-flex tw-items-center tw-px-2 tw-py-0.5 tw-rounded-md tw-text-xs tw-font-medium tw-bg-gray-800 tw-text-gray-100 tw-mb-1 md:tw-mb-0 md:tw-mt-0 dark:tw-bg-gray-600 dark:tw-bg-opacity-40]', 0)->plaintext; $item['rank'] = trim($item['rank'], " ");
      $item['market_cap'] = $crypto->find('div[class=tw-flex-grow tw-w-full tw-h-10 tw-py-2.5 lg:tw-border-t-0 tw-border-b tw-border-gray-200 dark:tw-border-opacity-10 tw-pl-0] span[class=tw-text-gray-900 dark:tw-text-white tw-float-right tw-font-medium]', 0)->plaintext; $item['market_cap'] = trim($item['market_cap'], " ");
      $item['24h_trading_vol'] = $crypto->find('div[class=tw-flex-grow tw-w-full tw-h-10 tw-py-2.5 tw-border-b tw-border-gray-200 dark:tw-border-opacity-10 tw-pl-0] span[class=tw-text-gray-900 dark:tw-text-white tw-float-right tw-font-medium]', 0)->plaintext; $item['24h_trading_vol'] = trim($item['24h_trading_vol'], " ");
      $item['total_supply'] = $crypto->find('div[class=tw-flex-grow tw-w-full tw-h-10 tw-py-2.5 tw-border-b tw-border-gray-200 dark:tw-border-opacity-10 tw-pl-0] span[class=tw-text-gray-900 dark:tw-text-white tw-float-right tw-font-medium tw-mr-1]', 1)->plaintext; $item['total_supply'] = trim($item['total_supply'], " ");
      $item['circulating_supply'] = $crypto->find('div[class=tw-flex-grow tw-w-full tw-h-10 tw-py-2.5 tw-border-b tw-border-gray-200 dark:tw-border-opacity-10 tw-pl-0] span[class=tw-text-gray-900 dark:tw-text-white tw-float-right tw-font-medium tw-mr-1]', 0)->plaintext; $item['circulating_supply'] = trim($item['circulating_supply'], " ");
      $item['website'] = $crypto->find('div[class=coin-link-row tw-mb-0] div[class=tw-flex flex-wrap tw-font-normal] a[class=tw-px-2.5 tw-py-1 tw-my-0.5 tw-mr-1 tw-rounded-md tw-text-sm tw-font-medium tw-bg-gray-100 tw-text-gray-800 hover:tw-bg-gray-200 dark:tw-text-white dark:tw-bg-white dark:tw-bg-opacity-10 dark:hover:tw-bg-opacity-20 dark:focus:tw-bg-opacity-20 ]', 0)->href;
      $item['icon'] = $crypto->find('div[class=tw-flex tw-text-gray-900 dark:tw-text-white tw-mt-2 tw-items-center] img[class=tw-rounded-full]', 0)->src;
      $cryptos[] = $item;
  }
  
  echo json_encode($cryptos, JSON_UNESCAPED_UNICODE);
}
?>