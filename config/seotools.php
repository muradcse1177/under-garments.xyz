<?php
/**
 * @see https://github.com/artesaos/seotools
 */

return [
    'meta' => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => false, // set false to total remove
            'titleBefore'  => false, // Put defaults.title before page title, like 'It's Over 9000! - Dashboard'
            'description'  => 'Under-garments.xyz are Undergarments online shop in Bangladesh, providing wide range of goponjinish, secret shop and undergarments products like bra, panty, lingerie, nighties, shapewear, condom etc.', // set false to total remove
            'separator'    => ' - ',
            'keywords'     => ['undergarments online shop in bangladesh, undergarments online shop, undergarments bd, undergarments online shopping, undergarments online shopping bd, undergarments, goponjinish, goponjinish online shop, goponjinish online shop bd, goponjinish online shopping bd, guponjinish, goponio, goromgorom, lubrication gel, bra, bra online shop in bangladesh, bra online shop bd, bra online shopping bd, bra bd, bra bangladesh, bra shop, bra online shop, sports bra, sports bra online shop, sports bra online shop bangladesh, sports bra online shopping, sports bra bd, sports bra dhaka, sports bra chittagong, push up bra, push up bra online shop bd, push up bra online shopping bd, push up bra online shop bangladesh, strapless bra online shop bangladesh, best condoms online shop in bangladesh, condom online shop bd, condoms online shopping, condoms online shopping bd, durex condoms online shopping , durex condoms online shopping bd, durex condoms online shop, panther condoms online shopping, panther condoms online shopping bd, man force condoms online shopping , u and me condoms online shopping bd, lingerie online shop in bangladesh, lingerie online shopping bd, lingerie online shop, underwear online shop in bangladesh, underwear online shop bd, nighty online shop in bangladesh, nighty online shop bd, nighties dress bd, nighties shopping, panty online shop bangladesh, panty online shopping bd, thong, maternity bra, nursing bra, kly gel, saree online shopping bd, sari bangladesh, pohela boishakh saree, tangail saree shopping, burka online shop in bangladesh, broke online shop, islamic cloth online shopping bd, abaya burka online shop bd, hijab, cosmetics online shop, shapewear online shopping bd, amazon bd online shop, online shopping bd'],
            'canonical'    => false, // Set to null or 'full' to use Url::full(), set to 'current' to use Url::current(), set false to total remove
            'robots'       => false, // Set to 'all', 'none' or any combination of index/noindex and follow/nofollow
        ],
        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],

        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => false, // set false to total remove
            'description'  => 'Under-garments.xyz are Undergarments online shop in Bangladesh, providing wide range of goponjinish, secret shop and undergarments products like bra, panty, lingerie, nighties, shapewear, condom etc.', // set false to total remove
            'url'         => false, // Set null for using Url::current(), set false to total remove
            'type'        => false,
            'site_name'   => false,
            'images'      => [],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            //'card'        => 'summary',
            //'site'        => '@LuizVinicius73',
        ],
    ],
    'json-ld' => [
        /*
         * The default configurations to be used by the json-ld generator.
         */
        'defaults' => [
            'title'       => false, // set false to total remove
            'description'  => 'We are Undergarments online shop in Bangladesh, providing wide range of goponjinish, secret shop and undergarments products like bra, panty, lingerie, nighties, shapewear, condom etc.', // set false to total remove
            'url'         => false, // Set null for using Url::current(), set false to total remove
            'type'        => 'WebPage',
            'images'      => [],
        ],
    ],
];
