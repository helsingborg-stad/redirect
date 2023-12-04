<?php

/**
 * Class Redirect
 * 
 * This class handles redirects based on the current domain and path.
 */
Class Redirect {

    /**
     * @var string $notFoundDomain The default domain to redirect to if no matching domain is found.
     */
    private $notFoundDomain = "helsingborg.se";

    /**
     * @var array $map An associative array mapping old domains to new domains.
     * Init with function getMap(); 
     * 
     */
    private $map = null;

    /**
     * @return array $map An associative array mapping old domains to new domains.
     * 
     * Path options: 
     *  string  New path to redirect to.
     *  true    Use current path requested. 
     *  false   Do not add any path
     */
    private function getMap() {
      return [
        'visit.helsingborg.se' => (object) [
          'domain' => 'visithelsingborg.com',
          'path' => true
        ],
        'chefsintro.helsingborg.se' => (object) [
          'domain' => 'hbglearns.helsingborg.se',
          'path' => '/learn/course/internal/view/elearning/94/stadsgemensam-chefsintroduktion'
        ],
        'hrintro.helsingborg.se' => (object) [
          'domain' => 'hbglearns.helsingborg.se',
          'path' => '/learn/course/internal/view/elearning/62/stadsgemensam-hr-introduktion'
        ],
        'intro.helsingborg.se' => (object) [
          'domain' => 'rise.articulate.com',
          'path' => '/share/hPxfaArDJXRz45E8ShrOeVs_6Gos5v-8#/'
        ],
        'ssa2021.helsingborg.se' => (object) [
          'domain' => 'ssa.helsingborg.se',
          'path' => true
        ],
        'greenchange.helsingborg.se' => (object) [
          'domain' => 'klimatavtal.helsingborg.se',
          'path' => true
        ],
        'oppna.helsingborg.se' => (object) [
          'domain' => 'helsingborg.io',
          'path' => true
        ],
        'kulturmagasinet.helsingborg.se' => (object) [
          'domain' => 'helsingborgsmuseum.se',
          'path' => true
        ],
        'ideslussen.helsingborg.se' => (object) [
          'domain' => 'intranat.helsingborg.se',
          'path' => '/hjalp-och-stod/ideslussen/'
        ],
        'inhabiton.helsingborg.se' => (object) [
          'domain' => 'inhabithon.helsingborg.se',
          'path' => true
        ],
        'kungshult.helsingborg.se' => (object) [
          'domain' => 'vardochomsorg.helsingborg.se',
          'path' => '/senior/boende-for-aldre/vardboenden/kungshult/'
        ],
        'oceanhamnenwbd.se' => (object) [
          'domain' => 'hplus.helsingborg.se',
          'path' => '/etapper/oceanhamnen/kontorslokaler-i-oceanhamnen/'
        ],
        'omsorgsjobb.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/jobb/'
        ],
        'planteringarutangranser.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/uppleva-och-gora/stadsodling/'
        ],
        'trumslagaren.helsingborg.se' => (object) [
          'domain' => 'vardochomsorg.helsingborg.se',
          'path' => '/funktionsnedsattning/daglig-verksamhet/trumslagaren/'
        ],
        'abradden.helsingborg.se' => (object) [
          'domain' => 'vardochomsorg.helsingborg.se',
          'path' => '/senior/boende-for-aldre/vardboenden/abradden/'
        ],
        'action.helsingborg.se' => (object) [
          'domain' => 'foretagare.helsingborg.se',
          'path' => true
        ],
        'v2.styleguide.helsingborg.se' => (object) [
          'domain' => 'styleguide.getmunicipio.com',
          'path' => true
        ],
        'styleguide.helsingborg.se' => (object) [
          'domain' => 'styleguide.getmunicipio.com',
          'path' => true
        ],
        'helsingborg2035.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/kommun-och-politik/helsingborg-2035/'
        ],
        'blifamiljehem.familjenhelsingborg.se' => (object) [
          'domain' => 'familjenhelsingborg.se',
          'path' => false
        ],
        'skoljobb.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/skoljobb'
        ],
        'passagefestival.helsingborg.se' => (object) [
          'domain' => 'passagefestival.nu',
          'path' => '/en/'
        ],
        'bug.getmunicipio.com' => (object) [
          'domain' => 'forms.clickup.com',
          'path' => '/2619042/f/2fxn2-596/OLQ2ARKQIK3NFPYQ61'
        ],
        'fredriksdalsteatern.nu' => (object) [
          'domain' => 'anagram.se',
          'path' => '/live/anagram-live-pa-fredriksdalsteatern/'
        ],
        'fredriksdalsteatern.se' => (object) [
          'domain' => 'anagram.se',
          'path' => '/live/anagram-live-pa-fredriksdalsteatern/'
        ],
        'fredriksdalsteatern.com' => (object) [
          'domain' => 'anagram.se',
          'path' => '/live/anagram-live-pa-fredriksdalsteatern/'
        ],
        'visit.familjenhelsingborg.se' => (object) [
          'domain' => 'visitfamiljenhelsingborg.com',
          'path' => true
        ],
        'visitfamiljenhelsingborg.se' => (object) [
          'domain' => 'visitfamiljenhelsingborg.com',
          'path' => true
        ],
        'kärnan.se' => (object) [
          'domain' => 'karnan.se',
          'path' => true
        ],
        'oppna.helsingborg.se' => (object) [
          'domain' => 'helsingborg.io',
          'path' => true
        ],
        'adolfinaforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/adolfina-forskola/'
        ],
        'allerumsforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/allerums-forskola/'
        ],
        'arenansidrottsforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/arenans-idrottsforskola/'
        ],
        'birkagatansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/birkagatans-forskola/'
        ],
        'blidogatansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/blidogatans-forskola/'
        ],
        'brommagatansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/brommagatans-forskola/'
        ],
        'brunnsallensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/brunnsallens-forskola/'
        ],
        'brunnsbergaforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/brunnsberga-forskola/'
        ],
        'dalhemsforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/dalhems-forskola/'
        ],
        'diamantensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/diamantens-forskola/'
        ],
        'flohemforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/flohem-forskola/'
        ],
        'fridasforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/fridas-forskola/'
        ],
        'galaxensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/galaxens-forskola/'
        ],
        'grashoppansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/grashoppans-forskola/'
        ],
        'guldsmedsgatansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/guldsmedgatans-forskola/'
        ],
        'hamiltonsforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/hamiltons-forskola/'
        ],
        'humlegardensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/humlegardens-forskola/'
        ],
        'husensjoforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/husensjo-forskola/'
        ],
        'hastskonsforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/hastskons-forskola/'
        ],
        'hogastensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/hogastens-forskola/'
        ],
        'johnblundsforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/john-blunds-forskola/'
        ],
        'kaprifolgatansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/kaprifolgatans-forskola/'
        ],
        'kattarpsforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/kattarps-forskola/'
        ],
        'kristallensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/kristallens-forskola/'
        ],
        'lantmatarensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/lantmatarens-forskola/'
        ],
        'lussebackensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/lussebackens-forskola/'
        ],
        'mariaparkforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/maria-park-forskola/'
        ],
        'musikantensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/musikantens-forskola/'
        ],
        'myransforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/myrans-forskola/'
        ],
        'morarpsforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/morarps-forskola/'
        ],
        'nallensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/nallens-forskola/'
        ],
        'nicandersgatansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/nicandersgatans-forskola/'
        ],
        'nyckelpigansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/nyckelpigans-forskola/'
        ],
        'nyponrosensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/nyponrosens-forskola/'
        ],
        'opalensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/opalens-forskola/'
        ],
        'pinjensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/pinjens-forskola/'
        ],
        'paarpsforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/paarps-forskola/'
        ],
        'palsjoostraforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/palsjo-ostra-forskola/'
        ],
        'regnbagensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/regnbagens-forskola/'
        ],
        'rimfaxeforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/rimfaxe-forskola/'
        ],
        'ringstorpsforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/ringstorps-forskola/'
        ],
        'ringstorpsparkensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/ringstorpsparkens-forskola/'
        ],
        'rosenknoppensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/rosenknoppens-forskola/'
        ],
        'rosenvagensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/rosenvagens-forskola/'
        ],
        'raaforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/raa-forskola/'
        ],
        'sagotradetsforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/sagotradets-forskola/'
        ],
        'salladsgatansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/salladsgatans-forskola/'
        ],
        'skaransforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/skarans-forskola/'
        ],
        'skogsglantansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/skogsglantans-forskola/'
        ],
        'slottsvangensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/slottsvangens-forskola/'
        ],
        'snobollsgatansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/snobollsgatans-forskola/'
        ],
        'solrosensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/solrosens-forskola/'
        ],
        'sprakforskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/sprakforskolan/'
        ],
        'stattenaforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/stattena-forskola/'
        ],
        'tallkottensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/tallkottens-forskola/'
        ],
        'toftaforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/tofta-forskola/'
        ],
        'tornerhjelmsforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/tornerhjelms-forskola/'
        ],
        'traktorsgatansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/traktorsgatans-forskola/'
        ],
        'trollslandansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/trollslandans-forskola/'
        ],
        'tradgardensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/tradgardens-forskola/'
        ],
        'tuvehagensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/tuvehagens-forskola/'
        ],
        'veingegatansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/veingegatans-forskola/'
        ],
        'vikingsbergsforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/vikingsbergs-forskola/'
        ],
        'viktoriaforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/viktoria-forskola/'
        ],
        'villacanzonettaforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/villa-canzonetta-forskola/'
        ],
        'vindogatansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/vindogatans-forskola/'
        ],
        'vintergatansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/vintergatans-forskola/'
        ],
        'vastrabergaforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/vastra-berga-forskola/'
        ],
        'vaxthusetsforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/vaxthusets-forskola/'
        ],
        'wrangelsgatansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/wrangelsgatans-forskola/'
        ],
        'ahusgatansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/ahusgatans-forskola/'
        ],
        'angslyckansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/angslyckans-forskola/'
        ],
        'appelgardensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/appelgardens-forskola/'
        ],
        'attekullaforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/attekulla-forskola/'
        ],
        'allerumsskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/allerums-skola/'
        ],
        'anneroskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/anneroskolan/'
        ],
        'borgmastarskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/borgmastarskolan-anpassad-skola/'
        ],
        'brunnsparksskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/brunnsparksskolan/'
        ],
        'barslovsskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/barslovs-skola/'
        ],
        'drottninghogsskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/drottninghogsskolan/'
        ],
        'gantoftaskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/gantofta-skola/'
        ],
        'glantanskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/glantanskolan/'
        ],
        'gustavslundsskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/gustavslundsskolan/'
        ],
        'holstagardsskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/holstagardsskolan/'
        ],
        'husensjoskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/husensjo-skola/'
        ],
        'hogastensskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/hogastensskolan/'
        ],
        'kattarpsskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/kattarps-skola/'
        ],
        'larodsskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/larods-skola/'
        ],
        'mariaparkskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/maria-parkskolan/'
        ],
        'synkopen.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/musikgrundskolan-synkopen/'
        ],
        'morarpsskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/morarps-skola/'
        ],
        'nannypalmkvistskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/nanny-palmkvistskolan/'
        ],
        'paarpsskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/paarps-skola/'
        ],
        'rausplanteringsskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/raus-planterings-skola/'
        ],
        'ringstorpsskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/ringstorpsskolan/'
        ],
        'rydebacksskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/rydebacksskolan/'
        ],
        'raasodraskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/raa-sodra-skola/'
        ],
        'ronnbacksskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/ronnbacksskolan-anpassad-skola/'
        ],
        'stjorgensskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/st-jorgens-skola/'
        ],
        'slottsvangsskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/slottsvangsskolan/'
        ],
        'svensgardsskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/svensgardsskolan/'
        ],
        'soderskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/soderskolan/'
        ],
        'tagaborgsskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/tagaborgsskolan/'
        ],
        'vastrabergaskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/vastra-berga-skola/'
        ],
        'vastraramlosaskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/vastra-ramlosa-skola/'
        ],
        'wieselgrensskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/wieselgrensskolan/'
        ],
        'attekullaskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/attekullaskolan/'
        ],
        'elinebergsskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/elinebergsskolan/'
        ],
        'allerum.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/odakra-fleninge-allerum-och-hjalmshult/'
        ],
        'attekulla.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/attekulla/'
        ],
        'ättekulla.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/attekulla/'
        ],
        'barslov.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/barslov/'
        ],
        'xn--brslv-mra6j.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/barslov/'
        ],
        'bibliotekfamiljenhelsingborg.se' => (object) [
          'domain' => 'bibliotekfh.se',
          'path' => true
        ],
        'borgmastarskolan.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/borgmastarskolan-anpassad-skola/'
        ],
        'borgmästarskolan.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/borgmastarskolan-anpassad-skola/'
        ],
        'brunnsparken.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/uppleva-och-gora/friluftsliv-och-motion/parker-och-gronomrade/ramlosa-brunnspark/'
        ],
        'dalhem.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/drottninghog-fredriksdal-dalhem/'
        ],
        'domsten.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/larod-hittarp-domsten/'
        ],
        'drottningh.com' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/drottninghog-fredriksdal-dalhem/'
        ],
        'xn--drottninghg-0fb.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/drottninghog-fredriksdal-dalhem/'
        ],
        'drottninghog.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/drottninghog-fredriksdal-dalhem/'
        ],
        'dunkers.se' => (object) [
          'domain' => 'dunkerskulturhus.se',
          'path' => true
        ],
        'dunkerskulturhus.com' => (object) [
          'domain' => 'dunkerskulturhus.se',
          'path' => true
        ],
        'elineberg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/elineberg/'
        ],
        'eneborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/soder-eneborg-hogaborg/'
        ],
        'eskilsminne.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/eskilsminne-och-gustavslund/'
        ],
        'faltabacken.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/trafik-och-stadsplanering/planering-och-utveckling/natur-och-kultur/bevarandeprogram/faltabacken/'
        ],
        'familjenhelsingborg.com' => (object) [
          'domain' => 'familjenhelsingborg.se',
          'path' => true
        ],
        'filbornaskolan.se' => (object) [
          'domain' => 'filbornaskolan.helsingborg.se',
          'path' => true
        ],
        'fjarestad.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/trafik-och-stadsplanering/planering-och-utveckling/natur-och-kultur/naturreservat/befintliga-naturreservat/fjarestad-gantofta/'
        ],
        'xn--fjrestad-1za.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/trafik-och-stadsplanering/planering-och-utveckling/natur-och-kultur/naturreservat/befintliga-naturreservat/fjarestad-gantofta/'
        ],
        'fleninge.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/odakra-fleninge-allerum-och-hjalmshult/'
        ],
        'frillestad.se' => (object) [
          'domain' => 'stadslexikon.helsingborg.se',
          'path' => '/frillestad/'
        ],
        'fleninge.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/odakra-fleninge-allerum-och-hjalmshult/'
        ],
        'xn--fltabacken-q5a.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/trafik-och-stadsplanering/planering-och-utveckling/natur-och-kultur/bevarandeprogram/faltabacken/'
        ],
        'gantofta.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/gantofta-och-vallakra/'
        ],
        'getmunicipio.nu' => (object) [
          'domain' => 'getmunicipio.com',
          'path' => true
        ],
        'getmunicipio.se' => (object) [
          'domain' => 'getmunicipio.com',
          'path' => true
        ],
        'getmunicipio.website' => (object) [
          'domain' => 'getmunicipio.com',
          'path' => true
        ],
        'groningen.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/uppleva-och-gora/friluftsliv-och-motion/parker-och-gronomrade/groningen/'
        ],
        'xn--grningen-o4a.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/uppleva-och-gora/friluftsliv-och-motion/parker-och-gronomrade/groningen/'
        ],
        'gustavslund.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/eskilsminne-och-gustavslund/'
        ],
        'gymnasieansokan.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskola-och-utbildning/gymnasium/ansokan-och-antagning/'
        ],
        'xn--gymnasieanskan-5pb.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskola-och-utbildning/gymnasium/ansokan-och-antagning/'
        ],
        'gymnasiemassaskanenordvast.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/gymnasiemassan/'
        ],
        'hasslarp.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/kattarp-och-hasslarp/'
        ],
        'hasslunda.se' => (object) [
          'domain' => 'stadslexikon.helsingborg.se',
          'path' => '/hsslunda/'
        ],
        'hbgnet.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => true
        ],
        'hbgvaxer.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => true
        ],
        'hbgväxer.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => true
        ],
        'helsingborg-arena.se' => (object) [
          'domain' => 'hbgarena.se',
          'path' => true
        ],
        'helsingborg.eu' => (object) [
          'domain' => 'helsingborg.se',
          'path' => true
        ],
        'helsingborgsstad.eu' => (object) [
          'domain' => 'helsingborg.se',
          'path' => true
        ],
        'helsingborgsstad.info' => (object) [
          'domain' => 'helsingborg.se',
          'path' => true
        ],
        'helsingborgsstad.net' => (object) [
          'domain' => 'helsingborg.se',
          'path' => true
        ],
        'helsingborgsstad.nu' => (object) [
          'domain' => 'helsingborg.se',
          'path' => true
        ],
        'helsingborgsstad.org' => (object) [
          'domain' => 'helsingborg.se',
          'path' => true
        ],
        'helsingborgsstudent.se' => (object) [
          'domain' => 'studentstadenhelsingborg.se',
          'path' => true
        ],
        'helsingborgsstad.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => true
        ],
        'helsingborgstad.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => true
        ],
        'hogaborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/soder-eneborg-hogaborg/'
        ],
        'högaborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/soder-eneborg-hogaborg/'
        ],
        'hogasten.se' => (object) [
          'domain' => 'stadslexikon.helsingborg.se',
          'path' => '/hgasten/'
        ],
        'husensjo.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/wilson-park-husensjo-och-sofieberg/'
        ],
        'husensjö.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/wilson-park-husensjo-och-sofieberg/'
        ],
        'hälsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => true
        ],
        'hässlunda.se' => (object) [
          'domain' => 'stadslexikon.helsingborg.se',
          'path' => '/hsslunda/'
        ],
        'jordbodalen.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/uppleva-och-gora/friluftsliv-och-motion/naturomrade/jordbodalen/'
        ],
        'kattarp.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/kattarp-och-hasslarp/'
        ],
        'kropp.se' => (object) [
          'domain' => 'stadslexikon.helsingborg.se',
          'path' => '/kropp/'
        ],
        'kvistofta.se' => (object) [
          'domain' => 'stadslexikon.helsingborg.se',
          'path' => '/kvistofta/'
        ],
        'larod.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/larod-hittarp-domsten/'
        ],
        'laröd.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/larod-hittarp-domsten/'
        ],
        'lussebacken.se' => (object) [
          'domain' => 'stadslexikon.helsingborg.se',
          'path' => '/lussebcken/'
        ],
        'lussebäcken.se' => (object) [
          'domain' => 'stadslexikon.helsingborg.se',
          'path' => '/lussebcken/'
        ],
        'margaretaplatsen.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/uppleva-och-gora/friluftsliv-och-motion/parker-och-gronomrade/margaretaplatsen/'
        ],
        'mariapark.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/mariastaden/'
        ],
        'mariastaden.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/mariastaden/'
        ],
        'miatorp.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/planteringen-miatorp/'
        ],
        'morarp.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/morarp/'
        ],
        'mörarp.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/morarp/'
        ],
        'municipio.nu' => (object) [
          'domain' => 'municipio.se',
          'path' => true
        ],
        'narlunda.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/narlunda/'
        ],
        'närlunda.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/narlunda/'
        ],
        'odakra.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/odakra-fleninge-allerum-och-hjalmshult/'
        ],
        'ödåkra.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/odakra-fleninge-allerum-och-hjalmshult/'
        ],
        'olympiapark.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/slottshojden-och-olympia/'
        ],
        'olympiaskolan.se' => (object) [
          'domain' => 'olympiaskolan.helsingborg.se',
          'path' => true
        ],
        'oresundsparken.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/uppleva-och-gora/friluftsliv-och-motion/parker-och-gronomrade/oresundsparken/'
        ],
        'ottarp.se' => (object) [
          'domain' => 'stadslexikon.helsingborg.se',
          'path' => '/ottarp/'
        ],
        'paarp.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/paarp/'
        ],
        'palsjo.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/palsjo-ostra/'
        ],
        'pedagoghelsingborg.se' => (object) [
          'domain' => 'pedagogsajten.familjenhelsingborg.se',
          'path' => true
        ],
        'pedagogsajten.se' => (object) [
          'domain' => 'pedagogsajten.familjenhelsingborg.se',
          'path' => true
        ],
        'pedagogskanenordvast.se' => (object) [
          'domain' => 'pedagogsajten.familjenhelsingborg.se',
          'path' => true
        ],
        'pedagogskånenordväst.se' => (object) [
          'domain' => 'pedagogsajten.familjenhelsingborg.se',
          'path' => true
        ],
        'planteringen.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/planteringen-miatorp/'
        ],
        'pålsjö.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/palsjo-ostra/'
        ],
        'pålstorp.se' => (object) [
          'domain' => 'stadslexikon.helsingborg.se',
          'path' => '/plstorp/'
        ],
        'raavallar.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/raa/'
        ],
        'rååvallar.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/raa/'
        ],
        'ramlosabrunnspark.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/ramlosa/'
        ],
        'ramlösabrunnspark.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/ramlosa/'
        ],
        'rangvalla.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/adolfsberg-ragnvalla-vastergard/'
        ],
        'raus.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/raus-vang-raus-sodra/'
        ],
        'ringstorp.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/stattena-och-ringstorp/'
        ],
        'ronnbacksskolan.se' => (object) [
          'domain' => 'ronnbacksskolan.helsingborg.se',
          'path' => true
        ],
        'rönnbäcksskolan.se' => (object) [
          'domain' => 'ronnbacksskolan.helsingborg.se',
          'path' => true
        ],
        'rosengården.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/rosengarden/'
        ],
        'rydeback.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/rydeback/'
        ],
        'rydebäck.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/rydeback/'
        ],
        'rönnowskaskolan.se' => (object) [
          'domain' => 'ronnowskaskolan.helsingborg.se',
          'path' => true
        ],
        'senderod.se' => (object) [
          'domain' => 'stadslexikon.helsingborg.se',
          'path' => '/senderd/'
        ],
        'senderöd.se' => (object) [
          'domain' => 'stadslexikon.helsingborg.se',
          'path' => '/senderd/'
        ],
        'slottshojden.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/slottshojden-och-olympia/'
        ],
        'slottshöjden.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/slottshojden-och-olympia/'
        ],
        'stattena.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/stattena-och-ringstorp/'
        ],
        'sundstorget.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/uppleva-och-gora/friluftsliv-och-motion/parker-och-gronomrade/sundstorget/'
        ],
        'tagaborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/tagaborg/'
        ],
        'tågaborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/tagaborg/'
        ],
        'tychobraheskolan.net' => (object) [
          'domain' => 'tychobraheskolan.helsingborg.se',
          'path' => true
        ],
        'tychobraheskolan.org' => (object) [
          'domain' => 'tychobraheskolan.helsingborg.se',
          'path' => true
        ],
        'tychobraheskolan.se' => (object) [
          'domain' => 'tychobraheskolan.helsingborg.se',
          'path' => true
        ],
        'utvalinge.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/rogle-tanga-utvalinge/'
        ],
        'utvälinge.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/rogle-tanga-utvalinge/'
        ],
        'vallakra.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/gantofta-och-vallakra/'
        ],
        'vallåkra.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/gantofta-och-vallakra/'
        ],
        'valluv.se' => (object) [
          'domain' => 'stadslexikon.helsingborg.se',
          'path' => '/vlluv/'
        ],
        'välluv.se' => (object) [
          'domain' => 'stadslexikon.helsingborg.se',
          'path' => '/vlluv/'
        ],
        'vasatorp.se' => (object) [
          'domain' => 'stadslexikon.helsingborg.se',
          'path' => '/vasatorp/'
        ],
        'vikingsberg.se' => (object) [
          'domain' => 'stadslexikon.helsingborg.se',
          'path' => '/vikingsberg-2/'
        ],
        'visithelsingborg.eu' => (object) [
          'domain' => 'visithelsingborg.com',
          'path' => true
        ],
        'wilsonpark.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/wilson-park-husensjo-och-sofieberg/'
        ],
        'öresundsparken.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/uppleva-och-gora/friluftsliv-och-motion/parker-och-gronomrade/oresundsparken/'
        ],
        'öppnasoc.se' => (object) [
          'domain' => 'oppnasoc.helsingborg.se',
          'path' => true
        ],
        'öppnasoc.com' => (object) [
          'domain' => 'oppnasoc.helsingborg.se',
          'path' => true
        ],
        'oppnasoc.se' => (object) [
          'domain' => 'oppnasoc.helsingborg.se',
          'path' => true
        ],
      ];
    }

    /**
     * Redirect constructor.
     * 
     * Initializes the redirect process by obtaining the current domain, determining the new domain,
     * and getting the current path. If a new domain is found, a redirect is made to the new domain.
     * Otherwise, a redirect is made to the default not found domain.
     */
    public function __construct() {

      $this->map      = $this->getMap(); //Must run first

      $currentDomain  = $this->getCurrentDomain();
      $newDomain      = $this->getNewDomain($currentDomain);
      $newPath        = $this->getNewPath($currentDomain);
    
      if($newDomain) {
        $this->makeRedirect(
          $newDomain,
          $newPath
        );
      }

      $this->makeRedirect(
        $this->notFoundDomain,
        $newPath
      );
    }

    /**
     * Get the current domain.
     *
     * @return string|false The current domain if available, false otherwise.
     */
    private function getCurrentDomain() {
      return $_SERVER['HTTP_HOST'] ?? false;
    }

    /**
     * Get the new domain based on the given domain.
     *
     * @param string $domain The current domain.
     * @return string|false The new domain if it exists in the mapping, false otherwise.
     */
    private function getNewDomain($domain) {
      if(array_key_exists($domain, $this->map)) {
        return $this->map[$domain]->domain;
      }
      return false;
    }

    /**
    * Get the new path for a given domain from the map.
    *
    * @param string $domain The domain for which to retrieve the new path.
    * @return string The new path if found, or an empty string if not found.
    */
    private function getNewPath($domain) {
      if(array_key_exists($domain, $this->map)) {
        
        $path = $this->map[$domain]->path;

        if(is_string($path)) {
          return $this->map[$domain]->path;
        }

        if(is_bool($path) && $path === true) {
          return $this->getCurrentPath(); 
        }
      }
      return "";
    }

    /**
     * Get the current path.
     *
     * @return string The current path excluding the file name.
     */
    private function getCurrentPath() {
      return str_replace(basename(__FILE__), '', $_SERVER['REQUEST_URI'] ?? '');
    }

    /**
     * Make a redirect to the specified domain and path.
     *
     * @param string $newDomain The domain to redirect to.
     * @param string $currentPath The current path to be appended to the new domain.
     * @param bool $permanent Whether the redirect is permanent (301) or temporary (302).
     * @return void
     */
    private function makeRedirect($newDomain, $currentPath, $permanent = false) {
      header('Location: https://' . $newDomain . $currentPath, true, $permanent ? 301 : 302);
      exit;
    }
  }

  new Redirect();
