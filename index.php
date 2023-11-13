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
