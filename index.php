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
