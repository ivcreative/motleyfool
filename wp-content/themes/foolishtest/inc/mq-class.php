<?php

/**
 * Class to get the API recommendations
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 */
defined('ABSPATH') || die('Access Denied');

/**
 * MG_Utilities class
 */
class MQ_Utilities {

    public function fool_api_recommend($slugcaps) {
        $api_url = ('https://financialmodelingprep.com/api/v3/company/profile/' . $slugcaps . '');
        $request = wp_remote_get($api_url, array('timeout' => 120));
        $body = wp_remote_retrieve_body($request);

        $data = json_decode($body);
        $profile = $data->profile;

        if (!empty($data)) {

            echo '<div class="company-equalize">';
            echo '<article role="article" id="post_" class="company-item">';
            echo '<header>';
            echo '<img src="' . $profile->image . '" alt="' . $profile->companyName . '">';
            echo '<h3 class="eqh3">' . $profile->companyName . '</h3>';
            echo '</header>';
            echo '<section class="counciltxt">';
            echo '<p>Exchange: ' . $profile->exchange . '</p>';
            echo '<p>Description: ' . $profile->description . '</p>';
            echo '<p>Industry: ' . $profile->industry . '</p>';
            echo '<p>Sector: ' . $profile->sector . '</p>';
            echo '<p>CEO: ' . $profile->ceo . '</p>';
            echo '<p><a href="' . esc_url($profile->website) . '" target="_new">Website</a></p>';
            echo '</section>';
            echo '</article>';

            echo '</div>';
        } else {
            echo 'No company found';
        }
    }

    /**
     * API of Companies
     */
    public function fool_api_company($slugcaps) {
        $api_url = ('https://financialmodelingprep.com/api/v3/company/profiless/' . $slugcaps . '');
        $stock_price_url = ('https://financialmodelingprep.com/api/v3/stock/real-time-price/' . $slugcaps . ''); // Gettng the price in real time
        $request = wp_remote_get($api_url, array('timeout' => 120));
        $request_price = wp_remote_get($stock_price_url, array('timeout' => 120));
        $body = wp_remote_retrieve_body($request);
        $body_price = wp_remote_retrieve_body($request_price);

        $data = json_decode($body);
        $data_price = json_decode($request);
        $profile = $data->profile;
        
        echo '<pre>';
        var_dump($body);
        echo '</pre>';

        if (!empty($data)) {

            echo '<div class="company-equalize">';
            echo '<article role="article" id="post_" class="company-item">';
            echo '<header>';
            echo '<h3 class="eqh3"></h3>';
            echo '</header>';
            echo '<section class="counciltxt">';
            echo '<p>Price: ' . $data_price->price . '</p>';
            echo '<p>Price change: ' . $profile->changes . 'xxxx</p>';
            echo '<p>Price change in %: ' . $profile->changesPercentage . '</p>';
            echo '<p>52 week range: ' . $profile->range . '</p>';
            echo '<p>Beta: ' . $profile->beta . '</p>';
            echo '<p>Volume Average: ' . $profile->volAvg . '</p>';
            echo '<p>Market Capitalisation: ' . $profile->mktCap . '</p>';
            $lastdivi = isset($profile->lastDiv) ? $profile->lastDiv : 'N/A';
            echo '<p>Last Dividend: ' . $lastdivi . '</p>';
            echo '</section>';
            echo '</article>';

            echo '</div>';
        } else {
            echo 'No company found';
        }
    }

    /**
     * API of Grabbing the Logo of a company for the header section
     */
    public function fool_api_logo($slugcaps) {
        $api_url_logo = ('https://financialmodelingprep.com/api/v3/company/profile/' . $slugcaps . '');
        $request_logo = wp_remote_get($api_url_logo, array('timeout' => 120));
        $body_logo = wp_remote_retrieve_body($request_logo);
        $data_logo = json_decode($body_logo);
        $hlogo = $data_logo->profile;

        if (!empty($data_logo)) {

            echo '<img src="' . $hlogo->image . '" alt="' . $hlogo->companyName . '">';
        } else {
            echo ''; //add empty space if doesnt exist
        }
    }

    /*
     * Quick dirty way to get the tickers and companies taxonomy depending on the page or post
     */

    public function companynames() {
        $company_tags = get_the_terms($post->ID, 'company_tag');
        if ($company_tags) :
            foreach ($company_tags as $term) :
                $term_tag = $term->name;
                $companycaps = strtoupper($term_tag);
            endforeach;
            return $companycaps;
        endif;
    }

    public function tickernames() {
        $ticker_tags = get_the_terms($post->ID, 'ticker');
        if ($ticker_tags) :
            foreach ($ticker_tags as $termx) :
                $term_ticker = $termx->name;
                $tickercaps = strtoupper($term_ticker);
            endforeach;
            return $tickercaps;
        endif;
    }

}
