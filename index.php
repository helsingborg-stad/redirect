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
        'xn--krnan-gra.se' => (object) [
          'domain' => 'karnan.se',
          'path' => true
        ],
        'oppna.helsingborg.se' => (object) [
          'domain' => 'helsingborg.io',
          'path' => true
        ],
        'adolfinaforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/adolfina-forskola/',
          'permanent' => true
        ],
        'allerumsforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/allerums-forskola/',
          'permanent' => true
        ],
        'arenansidrottsforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/arenans-idrottsforskola/',
          'permanent' => true
        ],
        'birkagatansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/birkagatans-forskola/',
          'permanent' => true
        ],
        'blidogatansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/blidogatans-forskola/',
          'permanent' => true
        ],
        'brommagatansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/brommagatans-forskola/',
          'permanent' => true
        ],
        'brunnsallensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/brunnsallens-forskola/',
          'permanent' => true
        ],
        'brunnsbergaforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/brunnsberga-forskola/',
          'permanent' => true
        ],
        'dalhemsforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/dalhems-forskola/',
          'permanent' => true
        ],
        'diamantensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/diamantens-forskola/',
          'permanent' => true
        ],
        'flohemforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/flohem-forskola/',
          'permanent' => true
        ],
        'fridasforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/fridas-forskola/',
          'permanent' => true
        ],
        'galaxensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/galaxens-forskola/',
          'permanent' => true
        ],
        'grashoppansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/grashoppans-forskola/',
          'permanent' => true
        ],
        'guldsmedsgatansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/guldsmedgatans-forskola/',
          'permanent' => true
        ],
        'hamiltonsforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/hamiltons-forskola/',
          'permanent' => true
        ],
        'humlegardensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/humlegardens-forskola/',
          'permanent' => true
        ],
        'husensjoforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/husensjo-forskola/',
          'permanent' => true
        ],
        'hastskonsforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/hastskons-forskola/',
          'permanent' => true
        ],
        'hogastensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/hogastens-forskola/',
          'permanent' => true
        ],
        'johnblundsforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/john-blunds-forskola/',
          'permanent' => true
        ],
        'kaprifolgatansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/kaprifolgatans-forskola/',
          'permanent' => true
        ],
        'kattarpsforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/kattarps-forskola/',
          'permanent' => true
        ],
        'kristallensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/kristallens-forskola/',
          'permanent' => true
        ],
        'lantmatarensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/lantmatarens-forskola/',
          'permanent' => true
        ],
        'lussebackensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/lussebackens-forskola/',
          'permanent' => true
        ],
        'mariaparkforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/maria-park-forskola/',
          'permanent' => true
        ],
        'musikantensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/musikantens-forskola/',
          'permanent' => true
        ],
        'myransforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/myrans-forskola/',
          'permanent' => true
        ],
        'morarpsforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/morarps-forskola/',
          'permanent' => true
        ],
        'nallensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/nallens-forskola/',
          'permanent' => true
        ],
        'nicandersgatansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/nicandersgatans-forskola/',
          'permanent' => true
        ],
        'nyckelpigansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/nyckelpigans-forskola/',
          'permanent' => true
        ],
        'nyponrosensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/nyponrosens-forskola/',
          'permanent' => true
        ],
        'opalensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/opalens-forskola/',
          'permanent' => true
        ],
        'pinjensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/pinjens-forskola/',
          'permanent' => true
        ],
        'paarpsforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/paarps-forskola/',
          'permanent' => true
        ],
        'palsjoostraforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/palsjo-ostra-forskola/',
          'permanent' => true
        ],
        'regnbagensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/regnbagens-forskola/',
          'permanent' => true
        ],
        'rimfaxeforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/rimfaxe-forskola/',
          'permanent' => true
        ],
        'ringstorpsforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/ringstorps-forskola/',
          'permanent' => true
        ],
        'ringstorpsparkensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/ringstorpsparkens-forskola/',
          'permanent' => true
        ],
        'rosenknoppensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/rosenknoppens-forskola/',
          'permanent' => true
        ],
        'rosenvagensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/rosenvagens-forskola/',
          'permanent' => true
        ],
        'raaforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/raa-forskola/',
          'permanent' => true
        ],
        'sagotradetsforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/sagotradets-forskola/',
          'permanent' => true
        ],
        'salladsgatansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/salladsgatans-forskola/',
          'permanent' => true
        ],
        'skaransforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/skarans-forskola/',
          'permanent' => true
        ],
        'skogsglantansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/skogsglantans-forskola/',
          'permanent' => true
        ],
        'slottsvangensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/slottsvangens-forskola/',
          'permanent' => true
        ],
        'snobollsgatansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/snobollsgatans-forskola/',
          'permanent' => true
        ],
        'solrosensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/solrosens-forskola/',
          'permanent' => true
        ],
        'sprakforskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/sprakforskolan/',
          'permanent' => true
        ],
        'stattenaforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/stattena-forskola/',
          'permanent' => true
        ],
        'tallkottensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/tallkottens-forskola/',
          'permanent' => true
        ],
        'toftaforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/tofta-forskola/',
          'permanent' => true
        ],
        'tornerhjelmsforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/tornerhjelms-forskola/',
          'permanent' => true
        ],
        'traktorsgatansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/traktorsgatans-forskola/',
          'permanent' => true
        ],
        'trollslandansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/trollslandans-forskola/',
          'permanent' => true
        ],
        'tradgardensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/tradgardens-forskola/',
          'permanent' => true
        ],
        'tuvehagensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/tuvehagens-forskola/',
          'permanent' => true
        ],
        'veingegatansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/veingegatans-forskola/',
          'permanent' => true
        ],
        'vikingsbergsforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/vikingsbergs-forskola/',
          'permanent' => true
        ],
        'viktoriaforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/viktoria-forskola/',
          'permanent' => true
        ],
        'villacanzonettaforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/villa-canzonetta-forskola/',
          'permanent' => true
        ],
        'vindogatansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/vindogatans-forskola/',
          'permanent' => true
        ],
        'vintergatansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/vintergatans-forskola/',
          'permanent' => true
        ],
        'vastrabergaforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/vastra-berga-forskola/',
          'permanent' => true
        ],
        'vaxthusetsforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/vaxthusets-forskola/',
          'permanent' => true
        ],
        'wrangelsgatansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/wrangelsgatans-forskola/',
          'permanent' => true
        ],
        'ahusgatansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/ahusgatans-forskola/',
          'permanent' => true
        ],
        'angslyckansforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/angslyckans-forskola/',
          'permanent' => true
        ],
        'appelgardensforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/appelgardens-forskola/',
          'permanent' => true
        ],
        'attekullaforskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/forskolor/attekulla-forskola/',
          'permanent' => true
        ],
        'allerumsskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/allerums-skola/',
          'permanent' => true
        ],
        'anneroskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/anneroskolan/',
          'permanent' => true
        ],
        'borgmastarskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/borgmastarskolan-anpassad-skola/',
          'permanent' => true
        ],
        'brunnsparksskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/brunnsparksskolan/',
          'permanent' => true
        ],
        'barslovsskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/barslovs-skola/',
          'permanent' => true
        ],
        'drottninghogsskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/drottninghogsskolan/',
          'permanent' => true
        ],
        'gantoftaskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/gantofta-skola/',
          'permanent' => true
        ],
        'glantanskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/glantanskolan/',
          'permanent' => true
        ],
        'gustavslundsskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/gustavslundsskolan/',
          'permanent' => true
        ],
        'holstagardsskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/holstagardsskolan/',
          'permanent' => true
        ],
        'husensjoskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/husensjo-skola/',
          'permanent' => true
        ],
        'hogastensskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/hogastensskolan/',
          'permanent' => true
        ],
        'kattarpsskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/kattarps-skola/',
          'permanent' => true
        ],
        'larodsskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/larods-skola/',
          'permanent' => true
        ],
        'mariaparkskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/maria-parkskolan/',
          'permanent' => true
        ],
        'synkopen.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/musikgrundskolan-synkopen/',
          'permanent' => true
        ],
        'morarpsskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/morarps-skola/',
          'permanent' => true
        ],
        'nannypalmkvistskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/nanny-palmkvistskolan/',
          'permanent' => true
        ],
        'paarpsskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/paarps-skola/',
          'permanent' => true
        ],
        'rausplanteringsskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/raus-planterings-skola/',
          'permanent' => true
        ],
        'ringstorpsskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/ringstorpsskolan/',
          'permanent' => true
        ],
        'rydebacksskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/rydebacksskolan/',
          'permanent' => true
        ],
        'raasodraskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/raa-sodra-skola/',
          'permanent' => true
        ],
        'ronnbacksskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/ronnbacksskolan-anpassad-skola/',
          'permanent' => true
        ],
        'stjorgensskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/st-jorgens-skola/',
          'permanent' => true
        ],
        'slottsvangsskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/slottsvangsskolan/',
          'permanent' => true
        ],
        'svensgardsskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/svensgardsskolan/',
          'permanent' => true
        ],
        'soderskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/soderskolan/',
          'permanent' => true
        ],
        'tagaborgsskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/tagaborgsskolan/',
          'permanent' => true
        ],
        'vastrabergaskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/vastra-berga-skola/',
          'permanent' => true
        ],
        'vastraramlosaskola.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/vastra-ramlosa-skola/',
          'permanent' => true
        ],
        'wieselgrensskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/wieselgrensskolan/',
          'permanent' => true
        ],
        'attekullaskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/attekullaskolan/',
          'permanent' => true
        ],
        'elinebergsskolan.helsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/elinebergsskolan/',
          'permanent' => true
        ],
        'allerum.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/odakra-fleninge-allerum-och-hjalmshult/',
        ],
        'attekulla.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/attekulla/',
        ],
        'xn--ttekulla-zza.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/attekulla/',
        ],
        'barslov.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/barslov/',
        ],
        'xn--brslv-mra6j.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/barslov/',
        ],
        'bibliotekfamiljenhelsingborg.se' => (object) [
          'domain' => 'bibliotekfh.se',
          'path' => true
        ],
        'borgmastarskolan.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/grundskolor/borgmastarskolan-anpassad-skola/'
        ],
        'xn--borgmstarskolan-4kb.se' => (object) [
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
          'path' => '/trafik-och-stadsplanering/stadsutvecklingsprojekt/'
        ],
        'xn--hbgvxer-8wa.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/trafik-och-stadsplanering/stadsutvecklingsprojekt/'
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
        'helsingborgtown.com' => (object) [
          'domain' => 'helsingborg.se',
          'path' => true
        ],
        'henrydunkersplats.se' => (object) [
          'domain' => 'stadslexikon.helsingborg.se',
          'path' => '/henry-dunkers-plats/'
        ],
        'hhtunneln.nu' => (object) [
          'domain' => 'hh-gruppen.org',
          'path' => true
        ],
        'hhtunneln.se' => (object) [
          'domain' => 'hh-gruppen.org',
          'path' => true
        ],
        'hogaborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/soder-eneborg-hogaborg/'
        ],
        'xn--hgaborg-90a.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/soder-eneborg-hogaborg/'
        ],
        'hogasten.se' => (object) [
          'domain' => 'stadslexikon.helsingborg.se',
          'path' => '/hgasten/'
        ],
        'xn--hgasten-90a.se' => (object) [
          'domain' => 'stadslexikon.helsingborg.se',
          'path' => '/hgasten/'
        ],
        'husensjo.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/wilson-park-husensjo-och-sofieberg/'
        ],
        'xn--husensj-g1a.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/wilson-park-husensjo-och-sofieberg/'
        ],
        'xn--hlsingborg-q5a.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => true
        ],
        'xn--hsslunda-0za.se' => (object) [
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
        'knahaken.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/uppleva-och-gora/friluftsliv-och-motion/badplatser-och-strander/badplatser-i-helsingborg/knahakenbadet/'
        ],
        'xn--knhaken-6wa.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/uppleva-och-gora/friluftsliv-och-motion/badplatser-och-strander/badplatser-i-helsingborg/knahakenbadet/'
        ],
        'kropp.se' => (object) [
          'domain' => 'stadslexikon.helsingborg.se',
          'path' => '/kropp/'
        ],
        'kvistofta.se' => (object) [
          'domain' => 'stadslexikon.helsingborg.se',
          'path' => '/kvistofta/'
        ],
        'larlingsgymnasium.se' => (object) [
          'domain' => 'larlingsgymnasium.helsingborg.se',
          'path' => true
        ],
        'larod.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/larod-hittarp-domsten/'
        ],
        'xn--lard-7qa.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/larod-hittarp-domsten/'
        ],
        'lussebacken.se' => (object) [
          'domain' => 'stadslexikon.helsingborg.se',
          'path' => '/lussebcken/'
        ],
        'xn--lussebcken-v5a.se' => (object) [
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
        'xn--mrarp-jua.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/morarp/'
        ],
        'municipio.nu' => (object) [
          'domain' => 'getmunicipio.com',
          'path' => true
        ],
        'narlunda.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/narlunda/'
        ],
        'xn--nrlunda-5wa.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/narlunda/'
        ],
        'odakra.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/odakra-fleninge-allerum-och-hjalmshult/'
        ],
        'xn--dkra-qoa4h.se' => (object) [
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
        'omsorghelsingborg.com' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/omsorg-och-stod/'
        ],
        'omsorghelsingborg.nu' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/omsorg-och-stod/'
        ],
        'omsorghelsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/omsorg-och-stod/'
        ],
        'omsorgihelsingborg.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/omsorg-och-stod/'
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
        'xn--pedagogsknenordvst-0tbm.se' => (object) [
          'domain' => 'pedagogsajten.familjenhelsingborg.se',
          'path' => true
        ],
        'planteringen.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/planteringen-miatorp/'
        ],
        'xn--plsj-qoa9h.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/palsjo-ostra/'
        ],
        'xn--plstorp-exa.se' => (object) [
          'domain' => 'stadslexikon.helsingborg.se',
          'path' => '/plstorp/'
        ],
        'raavallar.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/raa/'
        ],
        'xn--rvallar-exaa.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/raa/'
        ],
        'ramlosabrunnspark.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/ramlosa/'
        ],
        'xn--ramlsabrunnspark-pwb.se' => (object) [
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
        'xn--rnnbcksskolan-efb0y.se' => (object) [
          'domain' => 'ronnbacksskolan.helsingborg.se',
          'path' => true
        ],
        'xn--rosengrden-65a.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/rosengarden/'
        ],
        'rydeback.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/rydeback/'
        ],
        'xn--rydebck-9wa.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/rydeback/'
        ],
        'xn--rnnowskaskolan-vpb.se' => (object) [
          'domain' => 'ronnowskaskolan.helsingborg.se',
          'path' => true
        ],
        'senderod.se' => (object) [
          'domain' => 'stadslexikon.helsingborg.se',
          'path' => '/senderd/'
        ],
        'xn--senderd-f1a.se' => (object) [
          'domain' => 'stadslexikon.helsingborg.se',
          'path' => '/senderd/'
        ],
        'slottshojden.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/slottshojden-och-olympia/'
        ],
        'xn--slottshjden-xfb.se' => (object) [
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
        'xn--tgaborg-exa.se' => (object) [
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
        'xn--utvlinge-2za.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/rogle-tanga-utvalinge/'
        ],
        'vallakra.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/gantofta-och-vallakra/'
        ],
        'xn--vallkra-hxa.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/bo-bygga-och-miljo/bostader/bostadsomraden-och-samhallen/gantofta-och-vallakra/'
        ],
        'valluv.se' => (object) [
          'domain' => 'stadslexikon.helsingborg.se',
          'path' => '/vlluv/'
        ],
        'xn--vlluv-gra.se' => (object) [
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
        'xn--resundsparken-hmb.se' => (object) [
          'domain' => 'helsingborg.se',
          'path' => '/uppleva-och-gora/friluftsliv-och-motion/parker-och-gronomrade/oresundsparken/'
        ],
        'xn--ppnasoc-80a.se' => (object) [
          'domain' => 'oppnasoc.helsingborg.se',
          'path' => true
        ],
        'xn--ppnasoc-80a.com' => (object) [
          'domain' => 'oppnasoc.helsingborg.se',
          'path' => true
        ],
        'oppnasoc.se' => (object) [
          'domain' => 'oppnasoc.helsingborg.se',
          'path' => true
        ],

        /**
         * Loopia helsingborgfamily.se
         */

         'conventionbureauhelsingborg.com' => (object) [
          'domain' => 'helsingborgceb.com',
          'path' => true
        ],
        'conventionbureauhelsingborg.se' => (object) [
          'domain' => 'helsingborgceb.com',
          'path' => true
        ],
        'cvbhelsingborg.com' => (object) [
          'domain' => 'helsingborgceb.com',
          'path' => true
        ],
        'cvbhelsingborg.se' => (object) [
          'domain' => 'helsingborgceb.com',
          'path' => true
        ],
        'guidehelsingborg.com' => (object) [
          'domain' => 'visithelsingborg.com',
          'path' => true
        ],
        'guidehelsingborg.se' => (object) [
          'domain' => 'visithelsingborg.com',
          'path' => true
        ],
        'helsingborgconventionbureau.com' => (object) [
          'domain' => 'helsingborgceb.com',
          'path' => true
        ],
        'helsingborgconventionbureau.se' => (object) [
          'domain' => 'helsingborgceb.com',
          'path' => true
        ],
        'helsingborgcvb.com' => (object) [
          'domain' => 'helsingborgceb.com',
          'path' => true
        ],
        'helsingborgcvb.se' => (object) [
          'domain' => 'helsingborgceb.com',
          'path' => true
        ],
        'helsingborgfamily.se' => (object) [
          'domain' => 'familjenhelsingborg.se',
          'path' => true
        ],
        'helsingborgfamily.com' => (object) [
          'domain' => 'familjenhelsingborg.se',
          'path' => true
        ],
        'naringslivsdagarna.se' => (object) [
          'domain' => 'hbgtalks.se',
          'path' => true
        ],
        'xn--nringslivsdagarna-qqb.se' => (object) [
          'domain' => 'hbgtalks.se',
          'path' => true
        ],
        'hbgtalks.nu' => (object) [
          'domain' => 'hbgtalks.se',
          'path' => true
        ],
        'it.helsingborg.se' => (object) [
          'domain' => 'itportalen.helsingborg.se',
          'path' => false
        ],
        'driftinfo.helsingborg.se' => (object) [
          'domain' => 'itportalen.helsingborg.se',
          'path' => false,
        ],
        'delahbg.com' => (object) [
          'domain' => 'delahbg.se',
          'path' => true,
        ]
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

      $this->map            = $this->getMap(); //Must run first

      $currentDomain        = $this->getCurrentDomain();
      $newDomain            = $this->getNewDomain($currentDomain);
      $newPath              = $this->getNewPath($currentDomain);
      $isPermanentRedirect  = $this->isPermanentRedirect($currentDomain);
    
      if($newDomain) {
        $this->makeRedirect(
          $newDomain,
          $newPath,
          $isPermanentRedirect
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
    * Get the the type of redirect to preforme
    *
    * @param string $domain The domain for which to retrieve the new path.
    * @return string True if redirect is permanent, otherwise.
    */
    private function isPermanentRedirect($domain) {
      if(array_key_exists($domain, $this->map)) {
        if(isset($this->map[$domain]->permanent) && $this->map[$domain]->permanent == true) {
          return true;
        }
      }
      return false;
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
